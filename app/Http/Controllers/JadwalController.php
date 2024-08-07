<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jampel;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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


        return view('admin.jadwal.index', compact('jadwals', 'periodes', 'selectperiode', 'jampels', 'mapels', 'kelas', 'users', 'infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    function insert(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                'hari' => $request->hari ?? null,
                'periode_id' => $request->periode_id ?? null,
                'kelas_id' => $request->kelas_id ?? null,
                'jampel_id' => $request->jampel_id ?? null,
                'mapel_id' => $request->mapel_id ?? null,
                'user_id' => $request->user_id ?? null
            ];

            // Insert data ke database
            Jadwal::create($data);

            return response()->json([
                'success' => 'Data Tersimpan.'
            ]);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'hari' => 'required',
                'periode_id' => 'required',
                'kelas_id' => 'required',
                'jampel_id' => 'required',
                'mapel_id' => 'required',
                'user_id' => 'required',

            ],
            [
                'hari.required' => "hari Harus Diisi",
                'periode_id.required' => "periode Harus Diisi",
                'kelas_id.required' => "kelas Harus Diisi",
                'jampel_id.required' => "jampel Harus Diisi",
                'mapel_id.required' => "mapel Harus Diisi",
                'user_id.required' => "Guru Harus Diisi",

            ]
        );

        $jadwal = new Jadwal;

        $jadwal->hari = $request->input('hari');
        $jadwal->periode_id = $request->input('periode_id');
        $jadwal->kelas_id = $request->input('kelas_id');
        $jadwal->jampel_id = $request->input('jampel_id');
        $jadwal->mapel_id = $request->input('mapel_id');
        $jadwal->user_id = $request->input('user_id');

        $jadwal->save();

        return redirect('admin/jadwal')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        if ($request->ajax()) {
            // Ensure the value is not null or empty
            $field = $request->name;
            $value = $request->value;

            if ($value === null || $value === '') {
                return response()->json(['success' => false, 'error' => 'Field tidak boleh kosong.']);
            }

            // Fetch the current row being updated
            $currentJadwal = $jadwal->find($request->pk);

            // Temporarily update the field with the new value
            $currentJadwal->$field = $value;

            // Check if the combination already exists
            $existingJadwal = Jadwal::where('periode_id', $currentJadwal->periode_id)
                ->where('hari', $currentJadwal->hari)
                ->where('jampel_id', $currentJadwal->jampel_id)
                ->where('kelas_id', $currentJadwal->kelas_id)
                ->where('id', '!=', $currentJadwal->id) // Exclude the current row
                ->first();

            if ($existingJadwal) {
                return response()->json(['success' => false, 'error' => 'Jadwal sudah tersedia']);
            }

            // Update the actual field in the database
            $currentJadwal->update([$field => $value]);

            return response()->json(['success' => true]);
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return Redirect::route('admin.jadwal')->with('success', 'Data Terhapus');

    }
}
