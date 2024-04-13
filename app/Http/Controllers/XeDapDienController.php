<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class XeDapDienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hx = DB::table('hangxe')->get();
        // $dx = DB::select('SELECT dongxe.*,hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');
        // $ttxdd = DB::select('SELECT thongtinxedapdien.*, hangxe.tenhang, dongxe.tendongxe FROM thongtinxedapdien INNER JOIN dongxe  ON dongxe.madx = thongtinxedapdien.madx INNER JOIN hangxe ON thongtinxedapdien.mahx = hangxe.mahx');
        

        // return view('dashboard.category.vehicle.vehicle_infor', ['thongtinxedapdien' => $ttxdd ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
