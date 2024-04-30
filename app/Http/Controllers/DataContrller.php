<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataContrller extends Controller
{
    public function getData(){
        $hangXeController = new HangXeController();
        $dongxeController = new DongXeController();
        $chucvuController = new ChucVuContrller();
        $taikhoanController = new TaiKhoanContrller();

        $result1 = $hangXeController->data();
        $result2 = $dongxeController->data();
        $result3 = $chucvuController->data();
        $result4 = $taikhoanController->data();
    }
}
