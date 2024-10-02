<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Videos;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Videos::paginate(10);
        return view('backend.videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_url' => ['required', 'regex:/^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i'],
            'title' => ['required', 'max:50'],
        ]);


        $totSliders = count(Videos::all());

        $video = new Videos();
        $video->title = strtoupper($request->title);
        $video->video = $request->video_url;
        $video->status = 0;


        $video->serial = $totSliders + 1;
        $video->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.videos.index');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Videos::findOrFail($id);
        return view('backend.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'video_url' => ['required', 'regex:/^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i'],
            'title' => ['required', 'max:50'],
            'serial_no' => ['required','numeric'],
        ]);

        $video = Videos::findOrFail($id);

        $video->video = $request->video_url;
        $video->title = $request->title;
        $video->serial = $request->serial_no;
        $video->save();

        toastr('Video Updated Successfully!', 'success');

        return redirect()->route('admin.videos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Videos::findOrFail($id);
        $banner->delete();

        return response(['status' => 'success', 'message' => 'Video Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Videos::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Video status has been updated!']);
    }
}
