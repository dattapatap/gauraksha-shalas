<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::paginate(10);
        return view('backend.banner.index',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'title' => ['required', 'max:50'],
            'btn_url' => ['required', 'url'],
            'status' => ['required']
        ]);


        /** Handle file upload */
        $imagePath = $this->uploadImage($request, 'image', 'banner', 400, 200);

        $totSliders = count(Banner::all());

        $banner = new Banner();
        $banner->image = $imagePath;
        $banner->title = strtoupper($request->title);
        $banner->btn_url = $request->btn_url;
        $banner->status = $request->status;


        $banner->serial = $totSliders + 1;
        $banner->save();



        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.banner.index');
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
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg,mp4', 'max:2000'],
            'title' => ['required', 'max:200'],
            'btn_url' => ['required', 'url'],
            'serial' => ['required','numeric','unique:banners,serial,'.$id],
            'status' => ['required']
        ]);

        $banner = Banner::findOrFail($id);

        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'image', 'banner', 1960, 816, $banner->image);

        $banner->image =  empty(!$imagePath) ? $imagePath : $banner->image;
        $banner->title = ucfirst($request->title);
        $banner->btn_url = $request->btn_url;
        $banner->serial = $request->serial;
        $banner->status = $request->status;
        $banner->save();

        toastr('Banner Updated Successfully!', 'success');

        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $this->deleteImage($banner->image);
        $banner->delete();

        return response(['status' => 'success', 'message' => 'Banner Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Banner::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
