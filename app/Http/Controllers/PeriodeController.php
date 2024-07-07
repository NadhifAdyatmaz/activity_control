<?php

namespace App\Http\Controllers;

use App\Models\Information;
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
        $infos = Information::all();
        return view('admin.masterdata.periode.index', compact('periodes', 'infos'));

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
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:periodes,name',
                'semester' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => "Nama Harus Diisi",
                'name.unique' => "Nama Sudah Ada",
                'semester.required' => "Semester Harus Diisi",
                'status.required' => "Status Harus Diisi",
            ]
        );

        // Custom validation for unique combination of name and semester
        $existingPeriode = Periode::where('name', $request->input('name'))
            ->where('semester', $request->input('semester'))
            ->first();

        if ($existingPeriode) {
            return back()->withErrors(['data' => 'Data sudah ada'])
                ->withInput();
        }

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
