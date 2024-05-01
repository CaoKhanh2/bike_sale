<?php

namespace App\Http\Controllers;

use App\Models\ThongSoKyThuatXeMay;
use Illuminate\Http\Request;

class ThongSoKyThuatXeMayContrller extends Controller
{
    public function data(){
        $thongsokythuatxemay = array(
            array('matsxemay' => 'TSXE-0001','khoiluong' => NULL,'dungtichxe' => NULL,'muctieuthunhienlieu' => NULL,'dungtichbinhxang' => NULL),
            array('matsxemay' => 'TSXE-0002','khoiluong' => NULL,'dungtichxe' => NULL,'muctieuthunhienlieu' => NULL,'dungtichbinhxang' => NULL),
            array('matsxemay' => 'TSXE-0003','khoiluong' => NULL,'dungtichxe' => NULL,'muctieuthunhienlieu' => NULL,'dungtichbinhxang' => NULL),
            array('matsxemay' => 'TSXM-0004','khoiluong' => NULL,'dungtichxe' => NULL,'muctieuthunhienlieu' => NULL,'dungtichbinhxang' => NULL)
        );
        ThongSoKyThuatXeMay::insert($thongsokythuatxemay);
    }
}
