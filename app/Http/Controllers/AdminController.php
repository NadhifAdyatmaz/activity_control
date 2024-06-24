<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard(){

        $jadwal_count = Jadwal::count();
        $jurnal_count = Jurnal::count();
        $guru_count = User::where('role','guru')->count();
        $approval = Jurnal::where('is_validation','invalid')->count();

        return view('admin.index', compact('guru_count','jadwal_count','jurnal_count','approval'));

    }

    public function AdminProfile(){

        return view('admin.profile.index');

    }

    // public function AdminJadwal(){

    //     return view('admin.jadwal.index');

    // }

    // public function AdminJurnal(){

    //     return view('admin.jurnal.index');

    // }
}
