<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        return view('backend.setting.index');

    }

    public function appsetting()
    {
        $appsettings = Setting::FindOrFail(1);
        $mailconfiguration = EmailConfiguration::first();
        return view('backend.setting.appsetting', compact('appsettings','mailconfiguration'));
    }

    public function updateAppSetting(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email_1'=> ['required','email'],
            'email_2'=> ['required','email'],
            'phone_1'=> ['required'],
            'phone_2'=> ['required'],
            'address'=> ['required'],
            'maps'   => ['required'],
            't_link' => ['required'],
            'f_link' => ['required'],
            'i_link' => ['required'],
            'y_link' => ['required']
        ]);



        $appsettings = Setting::findOrFail($request->id);

        $appsettings->name = $request->name;
        $appsettings->email_1 = $request->email_1;
        $appsettings->email_2 = $request->email_2;
        $appsettings->phone_1 = $request->phone_1;
        $appsettings->phone_2 = $request->phone_2;
        $appsettings->address = $request->address;
        $appsettings->maps = $request->maps;
        $appsettings->t_link = $request->t_link;
        $appsettings->f_link = $request->f_link;
        $appsettings->i_link = $request->i_link;
        $appsettings->y_link = $request->y_link;
        $appsettings->save();

        toastr('appsettings updated successfully!', 'success');

        return redirect()->back();
    }


    public function mailsettings(Request $request)
    {
        $mailconfiguration = EmailConfiguration::first();
        return view('backend.setting.emailsetting', compact('mailconfiguration'));
    }

    public function updateMailConfiguration(Request $request)
    {
        $request->validate([
            'email_from'=> ['required','email'],
            'email_cc'=> ['nullable','email'],
            'email_bcc'=> ['nullable','email'],
        ]);

        $mailconfiguration = EmailConfiguration::findOrFail($request->id);

        $mailconfiguration->email_from = $request->email_from;
        $mailconfiguration->email_cc = $request->email_cc;
        $mailconfiguration->email_bcc = $request->email_bcc;
        $mailconfiguration->save();

        toastr('Email Configuration updated successfully!', 'success');

        return redirect()->back();
    }

}
