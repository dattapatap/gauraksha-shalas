<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seva;
use App\Models\SevaImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class SevaController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $sevas = Seva::OrderBy('serial_no', 'desc')->paginate(10);
        return view('backend.sevas.index', compact('sevas'));
    }


    public function create()
    {
        return view('backend.sevas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seva_name' => ['required', 'max:100', 'unique:sevas,name,NULL,id,deleted_at,NULL'],
            'heading' => ['required', 'max:150'],
            'short_desc_1'  => ['required', 'max:1000'],
            'short_desc_2'  => ['nullable', 'max:1000'],
            'long_description' => ['nullable','string'],

            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
        ]);

        /** Handle the image upload */

        $totSevas = Seva::count();

        $seva = new Seva();

        $seva->name = ucwords($request->seva_name);
        $seva->slug = Str::slug($request->seva_name);
        $seva->heading = $request->heading;

        $seva->short_description_1 = $request->short_desc_1;
        $seva->short_description_2 = $request->short_desc_2;
        $seva->long_description  = $request->long_description;
        $seva->serial_no = $totSevas + 1 ;

        $seva->status =  0;

        $seva->seo_title = $request->seo_title;
        $seva->seo_description = $request->seo_description;

        $seva->save();

        toastr('Seva Created Successfully!', 'success');
        return redirect()->route('admin.sevas.index');

    }


    public function show(string $id)
    {

        $seva = Seva::where('id', $id)->first();

        if(!$seva){
            abort(404);
        }

        return view('backend.sevas.show', compact('seva'));

    }


    public function edit(string $id)
    {

        $seva = Seva::where('id', $id)->first();

        if(!$seva){
            abort(404);
        }
        return view('backend.sevas.edit', compact('seva'));

    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'seva_name' => ['required', 'max:100', 'unique:sevas,name,'. $id.',id,deleted_at,NULL'],
            'heading' => ['required', 'max:150'],
            'short_desc_1'  => ['required', 'max:1000'],
            'short_desc_2'  => ['nullable', 'max:1000'],
            'long_description' => ['nullable','string'],
            'serial_no' => ['required','numeric', 'unique:sevas,serial_no,'.$id],

            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
        ]);

        $seva =  Seva::findOrFail($id);

        $seva->name = ucwords($request->seva_name);
        $seva->slug = Str::slug($request->seva_name);
        $seva->heading = $request->heading;

        $seva->short_description_1 = $request->short_desc_1;
        $seva->short_description_2 = $request->short_desc_2;
        $seva->long_description  = $request->long_description;
        $seva->serial_no = $request->serial_no;

        $seva->seo_title = $request->seo_title;
        $seva->seo_description = $request->seo_description;

        $seva->save();


        toastr('Seva Updated Successfully!', 'success');

        return redirect()->route('admin.sevas.index');

    }


    public function destroy(string $id)
    {
        $seva = Seva::findOrFail($id);
        if($seva){
            $seva->delete();
        }
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $seva = Seva::findOrFail($request->id);

        if($request->status == 'true'){
            $sevaImg = SevaImage::where('seva_id', $seva->id)->count();

            if($sevaImg > 0){
                $seva->status = $request->status == 'true' ? 1 : 0;
                $seva->save();
                return response([ "status"=>true, 'message' => 'Status has been updated!']);
            }else{
                return response([ "status"=>false ,'message' => 'Please Add Seva Images Before Publish!']);
            }
        }else{
            $seva->status = $request->status == 'true' ? 1 : 0;
                $seva->save();
                return response([ "status"=>true, 'message' => 'Status has been updated!']);
        }
    }


}
