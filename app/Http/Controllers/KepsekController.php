<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jampel;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KepsekController extends Controller
{
    public function kepsekDashboard()
    {
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jadwal_count = Jadwal::where('periode_id', $id)->count();
        $jurnal_count = Jurnal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('periode_id', $id);
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd')->count();
        $guru_count = User::where('role', 'guru')->count();
        $approval = Jurnal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('periode_id', $id)->where('is_validation', 'invalid');
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd')->count();
        $infos = Information::all();

        return view('kepsek.index', compact('guru_count', 'jadwal_count', 'jurnal_count', 'approval', 'infos'));

    }

    public function kepsekProfile()
    {

        $infos = Information::all();

        return view('kepsek.profile', compact('infos'));

    }
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $uploadedImage = $request->photo->move(public_path('images/kepsek/fotoprofil'), $photo);
            $imagePath = 'images/kepsek/fotoprofil/' . $photo;
            $request->user()->fill($request->validated());
            $request->user()->photo = $imagePath;
            $request->user()->save();

            return Redirect::route('kepsek.profile')->with('status', 'profile-updated');
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('kepsek.profile')->with('status', 'profile-updated');
    }

    public function jadwal()
    {
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jadwals = Jadwal::where('periode_id', $id)->get();
        // $jadwals = Jadwal::with('periodes','jampels', 'users', 'mapels', 'kelas')->get()->all();
        $jampels = Jampel::all();
        $mapels = Mapel::where('status', 'active')->get();
        $kelas = Kelas::where('status', 'active')->get();
        $users = User::where('role', 'guru')->get();

        $infos = Information::all();


        return view('kepsek.jadwal.index', compact('jadwals', 'periodes', 'selectperiode', 'jampels', 'mapels', 'kelas', 'users', 'infos'));
    }

    public function jurnal()
    {
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        } 
        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('periode_id', $id);
        })->whereNotNull('materi')
        ->whereNotNull('sakit')
        ->whereNotNull('izin')
        ->whereNotNull('alpha')
        ->whereNotNull('foto')
        ->whereNotNull('is_validation')
        ->whereNotNull('ttd')->get();
        $users = User::where('role', 'guru')->get();
        $infos = Information::all();

        return view('kepsek.jurnal.index', compact('jurnals', 'periodes', 'selectperiode', 'users', 'infos'));
    }
}
