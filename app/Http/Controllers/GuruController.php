<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jurnal;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function GuruDashboard(){

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jadwal_count = Jadwal::where('periode_id', $id)
        ->where('user_id', $user->id)
        ->count();
        $jurnal_count = Jurnal::whereHas('jadwal', function($query) use ($user,$id) {
            $query->where('user_id', $user->id)
            ->where('periode_id', $id);
        })->count();
        $guru_count = User::where('role','guru')->count();
        $approval = Jurnal::whereHas('jadwal', function($query) use ($user,$id) {
            $query->where('user_id', $user->id)
            ->where('is_validation','invalid')
            ->where('periode_id', $id);
        })->count();
        $infos = Information::all();

        return view('guru.guru_dashboard',compact('guru_count','jadwal_count','jurnal_count','approval','infos'));

    }
}
