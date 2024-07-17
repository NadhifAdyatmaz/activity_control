<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Jampel;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class GuruJadwalController extends Controller
{
    public function Gurujadwal()
    {
        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jadwals = Jadwal::where('periode_id', $id)
            ->where('user_id', $user->id)
            ->get();
        // $jadwals = Jadwal::with('periodes','jampels', 'users', 'mapels', 'kelas')->get()->all();
        $jampels = Jampel::all();
        $mapels = Mapel::where('status', 'active')->get();
        $kelas = Kelas::where('status', 'active')->get();
        $users = User::where('role', 'guru')->get();
        $infos = Information::all();

        return view('guru.jadwal.guru_jadwal', compact('jadwals', 'periodes', 'selectperiode', 'jampels', 'mapels', 'kelas', 'users', 'infos'));
    }

    public function insert(Request $request)
    {
        if ($request->ajax()) {
            // Check if jadwal_id already exists in Jurnal
            $existingJurnal = Jurnal::where('jadwal_id', $request->jadwal_id)->first();
            if ($existingJurnal) {
                return response()->json([
                    'error' => 'Jurnal sudah ditambahkan'
                ], 422);
            }

            // Retrieve the Jadwal entry
            $jadwal = Jadwal::find($request->jadwal_id);
            if (!$jadwal) {
                return response()->json([
                    'error' => 'Jadwal tidak ditemukan.'
                ], 404);
            }

            // Check if today matches the day in the jadwal
            $today = Carbon::now()->locale('id_ID')->dayName; // Get the day name in Indonesian
            if (strtolower($today) !== strtolower($jadwal->hari)) {
                return response()->json([
                    'error' => 'Anda tidak dapat menambahkan jurnal.'
                ], 422);
            }

            $info = Information::first();
            $pertemuan = $info->pertemuan;

            $tanggalJurnal = Carbon::now();

            for ($i = 1; $i <= $pertemuan; $i++) {
                if ($i > 1) {
                    $tanggalJurnal->addDays(7);
                }
                $data = [
                    'jadwal_id' => $request->jadwal_id ?? null,
                    'tanggal_jurnal' => $tanggalJurnal,
                    'name' => 'Pertemuan ' . $i,
                    'materi' => $request->materi ?? null,
                    'sakit' => $request->sakit ?? null,
                    'izin' => $request->izin ?? null,
                    'alpha' => $request->alpha ?? null,
                    'foto' => $request->foto ?? null,
                    'catatan' => $request->catatan ?? null,
                    'is_validation' => $request->is_validation ?? null,
                    'updated_at' => now()
                ];
                Jurnal::create($data);
            }

            return response()->json([
                'success' => 'Data Tersimpan.'
            ]);
        }
    }


    public function store(Request $request)
    {
        $jurnal = new Jurnal;

        $jurnal->jadwal_id = $request->jadwal_id ?? null;
        $jurnal->name = $request->name ?? null;
        $jurnal->materi = $request->materi ?? null;
        $jurnal->sakit = $request->sakit ?? null;
        $jurnal->izin = $request->izin ?? null;
        $jurnal->alpha = $request->alpha ?? null;
        $jurnal->foto = $request->foto ?? null;
        $jurnal->catatan = $request->catatan ?? null;
        $jurnal->is_validation = $request->is_validation ?? null;
        $jurnal->updated_at = $request->updated_at ?? null;

        $jurnal->save();

        return redirect('guru/jurnal')->with('success', 'Data Tersimpan');
    }
}
