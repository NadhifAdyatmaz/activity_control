<?php

namespace App\Http\Controllers;

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
        $jadwals = Jadwal::all();
        // $jadwals = Jadwal::with('periodes','jampels', 'users', 'mapels', 'kelas')->get()->all();
        $periodes = Periode::where('status', 'active')->get();
        $jampels = Jampel::all();
        $mapels = Mapel::where('status', 'active')->get();
        $kelas = Kelas::where('status', 'active')->get();
        $users = User::where('role', 'guru')->get();


        return view('admin.jadwal.index', compact('jadwals', 'periodes', 'jampels', 'mapels', 'kelas', 'users'));
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
            $rules = array(
                'hari.*' => 'required',
                'periode_id.*' => 'required',
                'kelas_id.*' => 'required',
                'jampel_id.*' => 'required',
                'mapel_id.*' => 'required',
                'user_id.*' => 'required',
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $hari = $request->hari;
            $periode = $request->periode_id;
            $kelas = $request->kelas_id;
            $jampel = $request->jampel_id;
            $mapel = $request->mapel_id;
            $user = $request->user_id;
            for ($count = 0; $count < count($hari); $count++) {
                $data = array(
                    'hari' => $hari[$count],
                    'periode_id' => $periode[$count],
                    'kelas_id' => $kelas[$count],
                    'jampel_id' => $jampel[$count],
                    'mapel_id' => $mapel[$count],
                    'user_id' => $user[$count]
                );
                $insert_data[] = $data;
            }
            // \Log::info('Data yang akan disimpan:', $insert_data);

            Jadwal::insert($insert_data);
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
            $field = $request->name;
            $value = $request->value;

            $jadwal->find($request->pk)->update([$field => $value]);
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
