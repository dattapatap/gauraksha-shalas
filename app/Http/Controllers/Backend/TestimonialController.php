<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial = Testimonial::paginate(10);
        return view('backend.testimonial.index',compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'quote' => ['required', 'max:300'],
            'rating' => ['required'],
            'title' => ['required', 'max:50'],
            'status' => ['required']
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'testimonial', 100, 100);

        $totSliders = count(Testimonial::all());

        $testimonial = new Testimonial();
        $testimonial->image = $imagePath;
        $testimonial->quote = strtoupper($request->quote);
        $testimonial->rating = $request->rating;
        $testimonial->name = strtoupper($request->title);
        $testimonial->status = $request->status;


        $testimonial->serial = $totSliders + 1;
        $testimonial->save();


        toastr('Testimonial Created Successfully!', 'success');

        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'quote' => ['required', 'max:300'],
            'rating' => ['required'],
            'title' => ['required', 'max:50'],
            'serial' => ['required','numeric','unique:testimonials,serial,'.$id],
            'status' => ['required']
        ]);

        $testimonial = Testimonial::findOrFail($id);

        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'image', 'testimonial', 100, 100, $testimonial->image);

        $testimonial->image =  empty(!$imagePath) ? $imagePath : $testimonial->image;
        $testimonial->quote = strtoupper($request->quote);
        $testimonial->rating = $request->rating;
        $testimonial->name = ucfirst($request->title);
        $testimonial->serial = $request->serial;
        $testimonial->status = $request->status;
        $testimonial->save();

        toastr('testimonial Updated Successfully!', 'success');

        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->deleteImage($testimonial->image);
        $testimonial->delete();

        return response(['status' => 'success', 'message' => 'testimonial Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Testimonial::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
