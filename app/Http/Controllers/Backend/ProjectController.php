<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProductImageGallery;
use App\Models\ProjectImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class ProjectController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $projects = Project::OrderBy('serial_no', 'desc')->paginate(10);
        return view('backend.projects.index', compact('projects'));
    }


    public function create()
    {
        return view('backend.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => ['required', 'max:100', 'unique:projects,name,NULL,id,deleted_at,NULL'],
            'heading' => ['required', 'max:150'],
            'short_desc_1'  => ['required', 'max:1000'],
            'short_desc_2'  => ['nullable', 'max:1000'],
            'long_description' => ['nullable','string'],

            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
        ]);

        /** Handle the image upload */

        $totProjects = Project::count();

        $project = new Project();

        $project->name = ucwords($request->project_name);
        $project->slug = Str::slug($request->project_name);
        $project->heading = $request->heading;

        $project->short_description_1 = $request->short_desc_1;
        $project->short_description_2 = $request->short_desc_2;
        $project->long_description  = $request->long_description;
        $project->serial_no = $totProjects + 1 ;

        $project->status =  0;

        $project->seo_title = $request->seo_title;
        $project->seo_description = $request->seo_description;

        $project->save();

        toastr('Project Created Successfully!', 'success');
        return redirect()->route('admin.projects.index');

    }


    public function show(string $id)
    {

        $project = Project::where('id', $id)->first();

        if(!$project){
            abort(404);
        }

        return view('backend.project.show', compact('project'));

    }


    public function edit(string $id)
    {

        $project = Project::where('id', $id)->first();

        if(!$project){
            abort(404);
        }
        return view('backend.projects.edit', compact('project'));

    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'project_name' => ['required', 'max:100', 'unique:projects,name,'. $id.',id,deleted_at,NULL'],
            'heading' => ['required', 'max:150'],
            'short_desc_1'  => ['required', 'max:1000'],
            'short_desc_2'  => ['nullable', 'max:1000'],
            'long_description' => ['nullable','string'],
            'serial_no' => ['required','numeric', 'unique:projects,serial_no,'.$id],

            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
        ]);

        $project =  Project::findOrFail($id);

        $project->name = ucwords($request->project_name);
        $project->slug = Str::slug($request->project_name);
        $project->heading = $request->heading;

        $project->short_description_1 = $request->short_desc_1;
        $project->short_description_2 = $request->short_desc_2;
        $project->long_description  = $request->long_description;
        $project->serial_no = $request->serial_no;

        $project->seo_title = $request->seo_title;
        $project->seo_description = $request->seo_description;

        $project->save();


        toastr('Project Updated Successfully!', 'success');

        return redirect()->route('admin.projects.index');

    }


    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        if($project){
            $project->delete();
        }
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $project = Project::findOrFail($request->id);

        if($request->status == 'true'){
            $projectImg = ProjectImage::where('project_id', $project->id)->count();

            if($projectImg > 0){
                $project->status = $request->status == 'true' ? 1 : 0;
                $project->save();
                return response([ "status"=>true, 'message' => 'Status has been updated!']);
            }else{
                return response([ "status"=>false ,'message' => 'Please Add Project Images Before Publish!']);
            }
        }else{
            $project->status = $request->status == 'true' ? 1 : 0;
                $project->save();
                return response([ "status"=>true, 'message' => 'Status has been updated!']);
        }
    }


}
