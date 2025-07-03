<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            abort(404);
        }

        $user->update($request->validated());
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
