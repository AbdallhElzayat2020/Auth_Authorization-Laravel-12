<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailOtpRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function showForm($email)
    {
        return view('auth.verify-email', compact('email'));
    }

    public function verify(VerifyEmailOtpRequest $request)
    {
        $user = User::whereEmail($request->email)->first();
        if ($user->otp !== implode("", $request->otp)) {
            return redirect()->back()->with('error', 'Invalid OTP, or Email, please try again.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified successfully, you can now login.');
    }
}
