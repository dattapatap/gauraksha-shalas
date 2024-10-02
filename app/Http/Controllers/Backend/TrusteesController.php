<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trustee;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class TrusteesController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trustees = Trustee::paginate(10);
        return view('backend.trustees.index',compact('trustees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.trustees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'name'  => ['required', 'max:50'],
            'designation' => ['required', 'max:50'],
            'description' => ['nullable'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'trustees', 400, 400);

        $last_trustee = Trustee::orderBy('id', 'desc')->first();

        $trustees = new Trustee();
        $trustees->image = $imagePath;
        $trustees->name = strtoupper($request->name);
        $trustees->designation = strtoupper($request->designation);
        $trustees->description = ($request->description);
        $trustees->status = 0;

        $trustees->serial = ($last_trustee)?($last_trustee->serial +1):1;

        $trustees->save();


        toastr('Trustee Created Successfully!', 'success');

        return redirect()->route('admin.trustees.index');
    }



    public function edit(string $id)
    {
        $trustees = Trustee::findOrFail($id);
        return view('backend.trustees.edit', compact('trustees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
            'name'  => ['required', 'max:50'],
            'designation' => ['required', 'max:50'],
            'description' => ['nullable'],
            'serial' => ['required', 'numeric'],
        ]);

        $trustees = Trustee::findOrFail($id);

        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'image', 'trustees', 500, 500, $trustees->image);

        $trustees->image =  empty(!$imagePath) ? $imagePath : $trustees->image;
        $trustees->name = strtoupper($request->name);
        $trustees->designation = strtoupper($request->designation);
        $trustees->description = $request->description;
        $trustees->serial = $request->serial;

        $trustees->save();

        toastr('Trustee Updated Successfully!', 'success');

        return redirect()->route('admin.trustees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trustees = Trustee::findOrFail($id);
        $this->deleteImage($trustees->image);
        $trustees->delete();

        return response(['status' => 'success', 'message' => 'Trustee Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Trustee::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
