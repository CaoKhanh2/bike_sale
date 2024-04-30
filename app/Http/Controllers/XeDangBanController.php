<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class XeDangBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dk_banxe = DB::select('SELECT xedangkyban.*,khachhang.hovaten FROM xedangkyban INNER JOIN khachhang ON xedangkyban.makh = khachhang.makh');

        // return view('dashboard.transaction.purchasing.purchasing_manage',['xedkban'=>$dk_banxe]);
    }

    public function getData()
    {
        $xedangban_xemay = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxemay.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxemay ON thongtinxe.matsxemay = thongsokythuatxemay.matsxemay INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

        $xedangban_xedapdien = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxedapdien.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxedapdien ON thongtinxe.matsxedapdien = thongsokythuatxedapdien.matsxedapdien INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

        return view('/sub-index',['db_xemay'=>$xedangban_xemay, 'db_xedapdien'=>$xedangban_xedapdien]);
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
