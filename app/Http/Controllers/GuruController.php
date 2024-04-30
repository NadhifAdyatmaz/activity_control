<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function GuruDashboard(){

        return view('guru.guru_dashboard');

    }
}
