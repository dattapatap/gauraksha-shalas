<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }


    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Toastr::success('Logged In Successfully', 'Success');
            return redirect()->route('admin.home');
        }else{
            Toastr::error("Invalid Credentials", 'Error');
            return redirect()->back();
        }
    }



}
