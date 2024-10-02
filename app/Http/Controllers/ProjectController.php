<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{


    public function projects(Request $request){

        $project = Project::with('project_images')
                    ->where('status', true)
                    ->where('slug', $request->slugs)->first();
        if(!$project){
            abort(404);
        }

        $lstProjects = Project::where('status', true)->orderBy('serial_no', 'asc')->get();
        return view('frontend.website.projects', compact('project', 'lstProjects'));

    }



}
