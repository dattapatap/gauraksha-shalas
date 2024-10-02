<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seva;
use App\Models\SevaImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SevaImageController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $seva = Seva::where('slug', $request->slug)->first();
        if(!$seva){
            abort(404);
        }
        $gallery = SevaImage::where('seva_id', $seva->id)->orderBy('id', 'desc')->paginate(30);
        return view('backend.sevas.gellery.index', compact('seva', 'gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $seva = Seva::where('slug', $request->slug)->first();
        if(!$seva){
            abort(404);
        }else{
            return view('backend.sevas.gellery.create', compact('seva'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'seva' => ['required', 'numeric'],
        ]);

        $seva =  Seva::where('id', $request->seva)->first();

        $imagePaths = $this->uploadImage($request, 'image', 'projects', '800', '450');


        $imageGallery               = new SevaImage();
        $imageGallery->image        = $imagePaths;
        $imageGallery->seva_id   = $request->seva;
        $imageGallery->status       = 1;

        $imageGallery->save();

        toastr('Image Uploaded Successfully!', 'success', 'success');

        return redirect()->route('admin.sevas.gallery', ['slug' => $seva->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $sevaImage = SevaImage::findOrFail($request->id);
        $this->deleteImage($sevaImage->image);
        $sevaImage->delete();

        return response(['status' => 'success', 'message' => 'Image Deleted Successfully!']);
    }
}
