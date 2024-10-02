<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdoptCow;
use App\Models\DonationForm;
use App\Models\volunteer;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class ServicesController extends Controller
{
    use ImageUploadTrait;

    public function adoptCow(Request $request)
    {
        $adoptCow = AdoptCow::find(1);
        return view('backend.services.adopt-cow', compact('adoptCow'));
    }

    public function updateAdoptCow(Request $request){
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg','max:2000'],
            'heading' => ['required', 'max:100'],
            'short_desc_1' => ['required'],
            'short_desc_2' => ['required'],
            'more_desc' => ['nullable'],
            'adopt_id' => ['required'],
        ]);

        $adoptCow = AdoptCow::findOrFail($request->adopt_id);

        if(!$adoptCow){
            return redirect()->back()->with('Adopt id missing', 'error');
        }


        $logoPath = $this->updateImage($request, 'image', 'adopt', 1060, 795, $adoptCow->image);

        $adoptCow->image = empty(!$logoPath) ? $logoPath : $adoptCow->image;
        $adoptCow->heading = $request->heading;
        $adoptCow->short_desc_1 = $request->short_desc_1;
        $adoptCow->short_desc_2 = $request->short_desc_2;
        $adoptCow->more_desc = $request->more_desc;

        $adoptCow->save();

        toastr('Adopt Cow updated successfully!', 'success');

        return redirect()->back();
    }



    public function donations()
    {
        $donation = DonationForm::find(1);
        return view('backend.services.donations', compact('donation'));
    }


    public function updateDonationForm(Request $request){
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg','max:2000'],
            'heading' => ['required', 'max:100'],
            'short_desc_1' => ['required'],
            'short_desc_2' => ['required'],
            'more_desc' => ['nullable'],
            'donation_id' => ['required'],
            'amount_1' => ['required', 'numeric', 'lt:amount_2'],
            'amount_2' => ['required', 'numeric', 'gt:amount_1'],
            'amount_3' => ['required', 'numeric', 'gt:amount_2'],
        ]);

        $donationForm = DonationForm::findOrFail($request->donation_id);

        if(!$donationForm){
            return redirect()->back()->with('Donation form id missing', 'error');
        }


        $logoPath = $this->updateImage($request, 'image', 'donation', 1060, 795, $donationForm->image);

        $donationForm->image = empty(!$logoPath) ? $logoPath : $donationForm->image;
        $donationForm->heading = $request->heading;
        $donationForm->short_desc_1 = $request->short_desc_1;
        $donationForm->short_desc_2 = $request->short_desc_2;
        $donationForm->more_desc = $request->more_desc;
        $donationForm->amount_1 = $request->amount_1;
        $donationForm->amount_2 = $request->amount_2;
        $donationForm->amount_3 = $request->amount_3;

        $donationForm->save();

        toastr('Donation Form updated successfully!', 'success');

        return redirect()->back();
    }



    public function volunteer(Request $request)
    {

        $volunteer = volunteer::find(1);
        return view('backend.services.volunteer', compact('volunteer'));
    }

    public function updateVolunteerForm(Request $request){
        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg','max:2000'],
            'heading' => ['required', 'max:100'],
            'short_desc_1' => ['required'],
            'short_desc_2' => ['required'],
            'more_desc' => ['nullable'],
            'volunteer_id' => ['required'],
            'form_desc' => ['required']
        ]);

        $volunteer = volunteer::findOrFail($request->volunteer_id);

        if(!$volunteer){
            return redirect()->back()->with('Volunteer form id missing', 'error');
        }

        $logoPath = $this->updateImage($request, 'image', 'volunteer', 1060, 795, $volunteer->image);

        $volunteer->image = empty(!$logoPath) ? $logoPath : $volunteer->image;
        $volunteer->heading = $request->heading;
        $volunteer->short_desc_1 = $request->short_desc_1;
        $volunteer->short_desc_2 = $request->short_desc_2;
        $volunteer->more_desc = $request->more_desc;
        $volunteer->form_desc = $request->form_desc;

        $volunteer->save();

        toastr('Volunteer Details updated successfully!', 'success');

        return redirect()->back();
    }


}
