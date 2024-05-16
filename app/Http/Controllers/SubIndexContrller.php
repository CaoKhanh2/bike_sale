<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubIndexContrller extends Controller
{
    // public function getData()
    // {
    //     $xedangban_xemay = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxemay.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxemay ON thongtinxe.matsxemay = thongsokythuatxemay.matsxemay INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

    //     $xedangban_xedapdien = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxedapdien.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxedapdien ON thongtinxe.matsxedapdien = thongsokythuatxedapdien.matsxedapdien INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

    //     $hxm = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe máy"');

    //     $hxdd = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe đạp điện"');


    //     return view('/sub-index',['db_xemay'=>$xedangban_xemay, 'db_xedapdien'=>$xedangban_xedapdien, 'hangxemay'=>$hxm, 'hangxedapdien'=>$hxdd]);
    // }

}
