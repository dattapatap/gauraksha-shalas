<?php

namespace App\Http\Controllers;

use App\Models\AdoptCow;
use App\Models\DonationForm;
use App\Models\Seva;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class ServicesController extends Controller
{


    public function adoptCow(Request $request){

        $adoptCow = AdoptCow::find(1);
        if(!$adoptCow){
            abort(404);
        }
        return view('frontend.website.adoptcow', compact('adoptCow'));

    }


    public function volunteer(Request $request){
        $volunteer = Volunteer::find(1);
        if(!$volunteer){
            abort(404);
        }
        return view('frontend.website.volunteer', compact('volunteer'));
    }

    public function donate(Request $request){
        $donate = DonationForm::find(1);
        if(!$donate){
            abort(404);
        }
        return view('frontend.website.donate', compact('donate'));
    }




}
