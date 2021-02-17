<?php

namespace App\Http\Controllers;

use App\Memos;
use Illuminate\Http\Request;

class MemosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = Memos::all();
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
     * @param  \App\Memos  $memos
     * @return \Illuminate\Http\Response
     */
    public function show(Memos $memos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memos  $memos
     * @return \Illuminate\Http\Response
     */
    public function edit(Memos $memos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memos  $memos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memos $memos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memos  $memos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memos $memos)
    {
        //
    }
}
