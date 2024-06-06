<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

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
