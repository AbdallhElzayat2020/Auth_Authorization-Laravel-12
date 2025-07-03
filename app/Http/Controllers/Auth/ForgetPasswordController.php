<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendResetLinkMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email']]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            [
                'email' => $request->email,
            ],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new SendResetLinkMail($token));
        return back()->with('success', 'We have send you a password reset link to your email.');
    }


}
