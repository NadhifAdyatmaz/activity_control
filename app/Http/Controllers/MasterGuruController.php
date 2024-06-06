<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MasterGuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.masterdata.guru.index', compact('gurus'));
        
    }
}
