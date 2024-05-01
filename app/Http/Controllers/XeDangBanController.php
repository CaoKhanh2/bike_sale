<?php

namespace App\Http\Controllers;

use App\Models\XeDangBan;
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
    
    public function data(){
        $xedangban = array(
            array('maxedangban' => 'XDDB-00001','maxe' => 'XD-0001','makhuyenmai' => NULL,'manv' => 'MNV-0003','namsx' => '2015','ngayban' => '2024-04-30 17:42:08','giaban' => '3500000.00','mota' => '','tranghthai' => 'Còn xe'),
            array('maxedangban' => 'XMDB-00001','maxe' => 'XM-0001','makhuyenmai' => NULL,'manv' => 'MNV-0004','namsx' => '2023','ngayban' => '2024-04-30 17:28:56','giaban' => '25000000.00','mota' => '','tranghthai' => 'Còn xe'),
            array('maxedangban' => 'XMDB-00002','maxe' => 'XM-0002','makhuyenmai' => NULL,'manv' => 'MNV-0008','namsx' => '2024','ngayban' => '2024-05-01 16:41:45','giaban' => '45560000.00','mota' => '','tranghthai' => 'Còn xe'),
            array('maxedangban' => 'XMDB-00003','maxe' => 'XM-0004','makhuyenmai' => NULL,'manv' => 'MNV-0009','namsx' => '2022','ngayban' => '2024-05-01 16:53:45','giaban' => '40000000.00','mota' => '','tranghthai' => 'Còn xe')
        );
        XeDangBan::insert($xedangban);
    }
}
