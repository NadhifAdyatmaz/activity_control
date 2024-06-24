<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use App\Models\User;
use Redirect;
use Symfony\Component\HttpKernel\Profiler\Profile;

class MasterGuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->get();
        foreach ($gurus as $guru) {
            $guru->jadwal_count = Jadwal::where('user_id', $guru->id)->count();
            $guru->jurnal_count = Jurnal::whereHas('jadwal', function($query) use ($guru) {
                $query->where('user_id', $guru->id);
            })->count();
        }
        return view('admin.masterdata.guru.index', compact('gurus'));
        
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('admin.masterdata.guru')->with('success', 'Data Terhapus');
    }
}
