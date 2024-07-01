<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class GuruprofileController extends Controller
{
    public function Guruprofil()
    {
        $infos = Information::all();

        return view('guru.guru_profile',compact('infos'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $uploadedImage = $request->photo->move(public_path('images/guru/fotoprofil'), $photo);
            $imagePath = 'images/guru/fotoprofil/' . $photo;
            $request->user()->fill($request->validated());
            $request->user()->photo = $imagePath;
            $request->user()->save();

            return Redirect::route('guru.profile')->with('status', 'profile-updated');
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('guru.profile')->with('status', 'profile-updated');
    }


}
