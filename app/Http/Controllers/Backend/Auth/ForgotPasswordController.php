<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Toastr;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email');
    }


    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
        ]);

        $token = Str::random(64);

          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

          Mail::send('backend.auth.email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });

          toastr()->success('We have e-mailed your password reset link!');
          return back();

    }


    public function showResetPasswordForm($token) {
        return view('backend.auth.passwords.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              toastr()->error('Invalid token!');
              return back()->withInput();
          }

          $user = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          toastr()->success('Your password has been changed!');
          return redirect('/admin');
    }


}
