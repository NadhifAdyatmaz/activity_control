<?php

namespace App\Http\Controllers;

use App\Models\Jampel;
use Illuminate\Http\Request;

class JampelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jampels = Jampel::all();
        return view('admin.masterdata.jampel.index', compact('jampels'));
        
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
    public function show(Jampel $jampel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jampel $jampel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jampel $jampel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jampel $jampel)
    {
        //
    }
}
