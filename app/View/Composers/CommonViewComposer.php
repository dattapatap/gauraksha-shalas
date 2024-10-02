<?php

namespace App\View\Composers;

use App\Models\About;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\View\View;

class CommonViewComposer
{
    public function compose(View $view)
    {
        $settings = Setting::find(1);
        $abouts = About::find(1);
        $projects = Project::where('status', true)->get();

        $view->with('settings', $settings);
        $view->with('abouts', $abouts);
        $view->with('projects', $projects);
    }
}

