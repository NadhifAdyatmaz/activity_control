<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jurnal;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jadwal_count = Jadwal::where('periode_id', $id)->count();
        $jurnal_count = Jurnal::count();
        $guru_count = User::where('role','guru')->count();
        $approval = Jurnal::where('is_validation','invalid')->count();
        $infos = Information::all();

        return view('admin.index', compact('guru_count','jadwal_count','jurnal_count','approval','infos'));

    }

    public function AdminProfile(){

        $infos = Information::all();

        return view('admin.profile.index', compact('infos'));

    }

    // public function AdminJadwal(){

    //     return view('admin.jadwal.index');

    // }

    // public function AdminJurnal(){

    //     return view('admin.jurnal.index');

    // }
}
