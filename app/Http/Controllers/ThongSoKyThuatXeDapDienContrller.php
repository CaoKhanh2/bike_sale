<?php

namespace App\Http\Controllers;
use App\Models\ThongSoKyThuatXeDapDien;


use Illuminate\Http\Request;

class ThongSoKyThuatXeDapDienContrller extends Controller
{
    public function data(){
        $thongsokythuatxedapdien = array(
            array('matsxedapdien' => 'TSXD-0001','trongluong' => NULL,'acquy' => NULL,'dongcodien' => NULL,'thoigiansacdien' => NULL,'phamvisudung' => NULL)
        );
        ThongSoKyThuatXeDapDien::insert($thongsokythuatxedapdien);
    }
}
