<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchContrller extends Controller
{
    public function searchData(Request $request){
        $tenxe = $request->tenxe;
        $timkiem = DB::select('SELECT xedangban.*, thongtinxe.*, dongxe.tendongxe, hangxe.tenhang, dongxe.loaixe FROM xedangban INNER JOIN thongtinxe ON xedangban.maxe = thongtinxe.maxe INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx WHERE thongtinxe.tenxe LIKE ?', ["%$tenxe%"]);

        return view('/sub_index-result',['tk'=>$timkiem]); 
    }
}
