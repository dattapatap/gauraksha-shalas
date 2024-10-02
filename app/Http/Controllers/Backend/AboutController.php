<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $about = About::findOrFail(1);
        return view('backend.about.index', compact('about'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg','max:2000'],
            'heading' => ['required', 'max:100'],
            'short_desc_1' => ['required'],
            'short_desc_2' => ['required'],
            'vision' => ['required'],
            'mission' => ['required'],
            'core_values' => ['required'],
            'cows_in_goshala' => ['required','numeric'],
            'gauvansh_sheltered' => ['required','numeric'],
            'gauvansh_rescued' => ['required','numeric'],
            'gauvansh_medicated' => ['required' , 'numeric'],
            'more_desc' => ['nullable'],
        ]);

        $about = About::findOrFail($id);

        if(!$about){
            return redirect()->back()->with('About id missing', 'error');
        }


        $logoPath = $this->updateImage($request, 'image', 'about', 1060, 795, $about->image);

        $about->image = empty(!$logoPath) ? $logoPath : $about->image;
        $about->heading = $request->heading;
        $about->short_desc_1 = $request->short_desc_1;
        $about->short_desc_2 = $request->short_desc_2;
        $about->vision = $request->vision;
        $about->mission = $request->mission;
        $about->core_values = $request->core_values;
        $about->cows_in_goshala = $request->cows_in_goshala;
        $about->gauvansh_sheltered = $request->gauvansh_sheltered;
        $about->gauvansh_rescued = $request->gauvansh_rescued;
        $about->gauvansh_medicated = $request->gauvansh_medicated;
        $about->more_desc = $request->more_desc;

        $about->save();

        toastr('About updated successfully!', 'success');

        return redirect()->back();

    }
    public function show(string $id){

    }
}
