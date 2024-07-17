<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        $infos = Information::all();
        return view('admin.masterdata.kelas.index', compact('kelas','infos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas,name',
            'jumlah_siswa' => 'required',
            'status' => 'required',
        ],
        [
            'name.required'=>"Nama Harus Diisi",
            'name.unique'=>"Nama Sudah Ada",
            'jumlah_siswa.required'=>"Jumlah Siswa Harus Diisi",
            'status.required'=>"Status Harus Diisi",
        ]);

        $existingKelas = Kelas::where('name', $request->input('name'))
            ->where('jumlah_siswa', $request->input('jumlah_siswa'))
            ->first();

        if ($existingKelas) {
            return back()->withErrors(['data' => 'Data sudah ada'])
                ->withInput();
        }

        $kelas = new Kelas;

        $kelas->name = $request->input('name');
        $kelas->jumlah_siswa = $request->input('jumlah_siswa');
        $kelas->status = $request->input('status');

        $kelas->save();

        return redirect('admin/master-kelas')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        if ($request->ajax()) {
            $field = $request->name;
            $value = $request->value;

            if (empty($value)) {
                return response()->json(['success' => false, 'error' => 'Field tidak boleh kosong.']);
            }
            $exists = $kelas->where($field, $value)->where('id', '!=', $request->pk)->exists();

            if ($exists) {
                return response()->json(['success' => false, 'error' => 'Nama sudah ada di database.']);
            }
            
            $kelas->find($request->pk)->update([$field => $value]);
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return Redirect::route('admin.masterdata.kelas')->with('success', 'Data Terhapus');
    }
}
