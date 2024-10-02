<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Admin;
use App\Models\Donor;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    use ImageUploadTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $about = About::find(1);
        $totdonations = Donor::sum('amount');

        $recentDonation = Donor::orderBy('created_at', 'desc')->limit(5)->get();

        return view('backend.home', compact( 'totdonations', 'about', 'recentDonation'));
    }

    public function getSalesChart(Request $request)
    {
        $monthlySales  = DB::select(
            'SELECT DATE_FORMAT(date, "%b") AS month, IFNULL( SUM(amount), 0) as amount
                FROM (
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS date UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 8 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 9 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 10 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 11 MONTH UNION ALL
                    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 12 MONTH
                ) AS dates
                LEFT JOIN donors
                ON (created_at >= date AND created_at < date + INTERVAL 1 MONTH)
                GROUP BY date ORDER BY date ASC'
        );
        return response()->json(['code' => 200, 'status' => true, 'sales' => $monthlySales], 200);
    }


    public function avatar()
    {
        $admin = Admin::first();
        return view('backend.setting.profile', compact('admin'));
    }


    public function updateAvatar(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'profile'        => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $logoPath = $this->updateImage($request, 'profile', 'admin_profile', 100, 100, $admin->profile);
        $admin->profile       = $logoPath;
        $admin->save();
        toastr('Profile Updated Successfully!', 'success');
        return redirect()->route('admin.settings.avatar');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:25'],
            'email'       => ['required', 'email'],
            'phone'       => ['nullable', 'regex:/^[6-9][0-9]{9}/', 'max:10', 'min:10'],
        ]);
        $admin = Auth::user();
        $admin->name       = $request->name;
        $admin->email      = $request->email;
        $admin->phone      = $request->phone;
        $admin->save();
        Toastr::success('Profile Updated');
        return redirect()->route('admin.settings.avatar');
    }


    public function changepassword(Request $request)
    {
        return view('backend.setting.changepassword');
    }


    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:5']
        ]);
        $request->user()->update([
            'password' => bcrypt($request->new_password)
        ]);
        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }


    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Toastr::success('Logged In Successfully');
        return redirect('/admin');
    }


}
