<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Project;
use App\Models\Setting;

class HomeController extends Controller
{

    public function index()
    {

        $setting = Setting::find(1);
        $projects = \App\Models\Project::where('status', true)->orderBy('serial_no', 'asc')->limit(20)->get();
        $about = About::find(1);
        return view('frontend.home', compact('setting', 'projects', 'about'));
    }

    public function aboutus()
    {
        return view('frontend.website.about');
    }

    public function trustees(){
        return view('frontend.website.trustees');
    }


    public function contactus()
    {

        return view('frontend.website.contact-us');
    }

    public function blogs()
    {
        return view('frontend.website.blogs');
    }

    public function videos()
    {
        return view('frontend.website.videos');
    }

    public function gallery()
    {
        return view('frontend.website.gallery');
    }
    public function donate()
    {
        return view('frontend.website.donate');
    }




}
