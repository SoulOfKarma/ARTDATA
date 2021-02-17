<?php

namespace App\Http\Controllers;

use App\Ejecutores;
use Illuminate\Http\Request;

class EjecutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = Ejecutores::all();
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
     * @param  \App\Ejecutores  $ejecutores
     * @return \Illuminate\Http\Response
     */
    public function show(Ejecutores $ejecutores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ejecutores  $ejecutores
     * @return \Illuminate\Http\Response
     */
    public function edit(Ejecutores $ejecutores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ejecutores  $ejecutores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejecutores $ejecutores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ejecutores  $ejecutores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ejecutores $ejecutores)
    {
        //
    }
}
