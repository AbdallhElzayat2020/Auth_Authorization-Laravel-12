<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $result = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$result) {
            return redirect()->back()->with(['error' => 'Invalid token or email.']);
        }

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();


        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        return to_route('login')->with('success', 'Password reset successfully. Please log in with your new password.');

    }
}
