<?php

namespace App\Http\Controllers;

use App\ResolucionInternas;
use Illuminate\Http\Request;

class ResolucionInternasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = ResolucionInternas::all();
        return $get_all;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResolucionInternas  $resolucionInternas
     * @return \Illuminate\Http\Response
     */
    public function show(ResolucionInternas $resolucionInternas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResolucionInternas  $resolucionInternas
     * @return \Illuminate\Http\Response
     */
    public function edit(ResolucionInternas $resolucionInternas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResolucionInternas  $resolucionInternas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResolucionInternas $resolucionInternas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResolucionInternas  $resolucionInternas
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResolucionInternas $resolucionInternas)
    {
        //
    }
}
