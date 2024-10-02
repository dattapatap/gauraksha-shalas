<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $project = Project::where('slug', $request->slug)->first();
        if(!$project){
            abort(404);
        }
        $gallery = ProjectImage::where('project_id', $project->id)->orderBy('id', 'desc')->paginate(30);
        return view('backend.projects.gellery.index', compact('project', 'gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $project = Project::where('slug', $request->slug)->first();
        if(!$project){
            abort(404);
        }else{
            return view('backend.projects.gellery.create', compact('project'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'project' => ['required', 'numeric'],
        ]);

        $project =  Project::where('id', $request->project)->first();

        $imagePaths = $this->uploadImage($request, 'image', 'projects', '800', '450');


        $imageGallery               = new ProjectImage();
        $imageGallery->image        = $imagePaths;
        $imageGallery->project_id   = $request->project;
        $imageGallery->status       = 1;

        $imageGallery->save();

        toastr('Image Uploaded Successfully!', 'success', 'success');

        return redirect()->route('admin.projects.gallery', ['slug' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $projectImage = ProjectImage::findOrFail($request->id);
        $this->deleteImage($projectImage->image);
        $projectImage->delete();

        return response(['status' => 'success', 'message' => 'Image Deleted Successfully!']);
    }
}
