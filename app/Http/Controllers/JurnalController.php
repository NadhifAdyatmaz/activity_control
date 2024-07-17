<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jurnal;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JurnalController extends Controller
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
        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('periode_id', $id);
        })->whereNotNull('materi')
        ->whereNotNull('sakit')
        ->whereNotNull('izin')
        ->whereNotNull('alpha')
        ->whereNotNull('foto')
        ->whereNotNull('is_validation')
        ->whereNotNull('ttd')->get();
        $users = User::where('role', 'guru')->get();
        $infos = Information::all();

        return view('admin.jurnal.index', compact('jurnals', 'periodes', 'selectperiode', 'users', 'infos'));
    }

    public function approve(Request $request, $id)
    {
        try {
            $jurnal = Jurnal::findOrFail($id);
            $jurnal->is_validation = 'valid';
            $jurnal->save();

            return response()->json(['message' => 'Journal entry approved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error approving journal entry.'], 500);
        }
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
