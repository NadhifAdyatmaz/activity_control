<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodes = Periode::all();
        return view('admin.masterdata.periode.index', compact('periodes'));

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
        $request->validate(
            [
                'name' => 'required',
                'semester' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => "Nama Harus Diisi",
                'semester.required' => "Semester Harus Diisi",
                'status.required' => "Status Harus Diisi",
            ]
        );

        $periode = new Periode;

        $periode->name = $request->input('name');
        $periode->semester = $request->input('semester');
        $periode->status = $request->input('status');

        $periode->save();

        return redirect('admin/master-periode')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        if ($request->ajax()) {
            $field = $request->name; 
            $value = $request->value;

            $periode->find($request->pk)->update([$field => $value]);
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();

        return Redirect::route('admin.masterdata.periode')->with('success', 'Data Terhapus');

    }
}
