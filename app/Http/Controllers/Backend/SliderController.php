<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('backend.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2000'],
            'heading' => ['required', 'max:30'],
            'short_desc' => ['required', 'max:100'],
            'slider_type' => ['required'],
            'status' => ['required']
        ]);


        /** Handle file upload */
        if ($request->slider_type == '1') {
            $imagePath = $this->uploadImage($request, 'image', 'slider', 1920, 800);
        } else {
            $imagePath = $this->uploadImage($request, 'image', 'slider', 750, 850);
        }

        $totSliders = Slider::orderBy('id', 'desc')->first();
        if($totSliders){
            $serial = $totSliders->serial + 1;
        }else{
            $serial = 1;
        }

        $slider = new Slider();
        $slider->image = $imagePath;
        $slider->title = strtoupper($request->heading);
        $slider->desc = $request->short_desc;
        $slider->slider_type = $request->slider_type;
        $slider->status = $request->status;
        $slider->serial = $serial;
        $slider->save();

        toastr('Banner Added Successfully!', 'success');

        return redirect()->route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'heading' => ['required', 'max:30'],
            'short_desc' => ['required', 'max:100'],
            'slider_type' => ['required'],
            'serial' => ['required','numeric','unique:sliders,serial,'.$id],
            'status' => ['required']
        ]);

        $slider = Slider::findOrFail($id);

        /** Handle file upload */
        if ($request->slider_type == '1') {
            $imagePath = $this->updateImage($request, 'image', 'slider', 1920, 800, $slider->image);
        } else {
            $imagePath = $this->updateImage($request, 'image', 'slider', 750, 850, $slider->image);
        }

        $slider->image =  empty(!$imagePath) ? $imagePath : $slider->image;
        $slider->title = strtoupper($request->heading);
        $slider->desc = $request->short_desc;
        $slider->serial = $request->serial;
        $slider->slider_type = $request->slider_type;
        $slider->status = $request->status;
        $slider->save();

        toastr('Banner Updated Successfully!', 'success');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->image);
        $slider->delete();
        return response(['status' => 'success', 'message' => 'Banner Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Slider::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Banner Status has been updated!']);
    }
}
