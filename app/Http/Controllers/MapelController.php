<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapels = Mapel::all();
        $infos = Information::all();
        return view('admin.masterdata.mapel.index', compact('mapels','infos'));
        
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
            'name' => 'required',
            'status' => 'required',
        ],
        [
            'name.required'=>"Nama Harus Diisi",
            'status.required'=>"Status Harus Diisi",
        ]);

        $existingMapel = Mapel::where('name', $request->input('name'))
            ->first();

        if ($existingMapel) {
            return back()->withErrors(['data' => 'Data sudah ada'])
                ->withInput();
        }

        $mapel = new Mapel;

        $mapel->name = $request->input('name');
        $mapel->status = $request->input('status');

        $mapel->save();

        return redirect('admin/master-mapel')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        if ($request->ajax()) {
            $field = $request->name; 
            $value = $request->value;

            $mapel->find($request->pk)->update([$field => $value]);
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return Redirect::route('admin.masterdata.mapel')->with('success', 'Data Terhapus');
    }
}
