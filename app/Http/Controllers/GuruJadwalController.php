<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jampel;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class GuruJadwalController extends Controller
{
    public function Gurujadwal()
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

        return view('guru.guru_jadwal', compact('jadwals', 'periodes', 'selectperiode', 'jampels', 'mapels', 'kelas', 'users'));
    }
    //
}
