<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class GuruprofileController extends Controller
{
    public function Guruprofil()
    {
        return view('guru.guru_profile');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $uploadedImage = $request->photo->move(public_path('images/guru'), $photo);
            $imagePath = 'images/guru/' . $photo;
            $request->user()->fill($request->validated());
            $request->user()->photo = $imagePath;
            $request->user()->save();

            return Redirect::route('guru.profile.update')->with('status', 'profile-updated');
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('guru.profile.update')->with('status', 'profile-updated');
    }


}
