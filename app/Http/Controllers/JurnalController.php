<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jurnal;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnals = Jurnal::all();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $users = User::where('role', 'guru')->get();
        $infos = Information::all();

        return view('admin.jurnal.index', compact('jurnals','periodes','selectperiode','users','infos'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurnal $jurnal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurnal $jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurnal $jurnal)
    {
        //
    }
}
