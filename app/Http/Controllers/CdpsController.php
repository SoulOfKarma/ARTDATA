<?php

namespace App\Http\Controllers;

use App\Cdps;
use Illuminate\Http\Request;

class CdpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $get_all = Cdps::all();
            return $get_all;
        } catch (\Throwable $th) {
            return $th;
        }
        
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
     * @param  \App\Cdps  $cdps
     * @return \Illuminate\Http\Response
     */
    public function show(Cdps $cdps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cdps  $cdps
     * @return \Illuminate\Http\Response
     */
    public function edit(Cdps $cdps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cdps  $cdps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cdps $cdps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cdps  $cdps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cdps $cdps)
    {
        //
    }
}