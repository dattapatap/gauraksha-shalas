<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Images;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImagesController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Images::paginate(10);
        return view('backend.image.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'title' => ['required', 'max:50'],
            'status' => ['required']
        ]);


        /** Handle file upload */
        $imagePath = $this->uploadImage($request, 'image', 'images', 600, 400);

        $totSliders = count(Images::all());

        $image = new Images();
        $image->image = $imagePath;
        $image->title = strtoupper($request->title);
        $image->status = $request->status;


        $image->serial = $totSliders + 1;
        $image->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.images.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Images::findOrFail($id);
        return view('backend.image.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'title' => ['required', 'max:200'],
            'serial' => ['required','numeric','unique:images,serial,'.$id],
            'status' => ['required']
        ]);

        $image = Images::findOrFail($id);

        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'image', 'images', 600, 400, $image->image);

        $image->image =  empty(!$imagePath) ? $imagePath : $image->image;
        $image->title = ucfirst($request->title);
        $image->serial = $request->serial;
        $image->status = $request->status;
        $image->save();

        toastr('Image Updated Successfully!', 'success');

        return redirect()->route('admin.images.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Images::findOrFail($id);
        $this->deleteImage($image->image);
        $image->delete();

        return response(['status' => 'success', 'message' => 'Image Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        Log::info('in status');
        $category = Images::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
