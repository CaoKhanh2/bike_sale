<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataContrller extends Controller
{
    public function getData(){
        $hangXeController = new HangXeController();
        $dongxeController = new DongXeController();
        $chucvuController = new ChucVuContrller();
        $nhanvienController = new NhanVienController();
        $taikhoanController = new TaiKhoanContrller();
        $thongsoxemayController = new ThongSoKyThuatXeMayContrller();
        $thongsoxedapdienController = new ThongSoKyThuatXeDapDienContrller();
        $thongtinxeController = new ThongTinXeController();
        $xedangbanController = new XeDangBanController();

        $result1 = $hangXeController->data();
        $result2 = $dongxeController->data();
        $result3 = $chucvuController->data();
        $result4 = $nhanvienController->data();
        $result5 = $taikhoanController->data();
        $result6 = $thongsoxemayController->data();
        $result7 = $thongsoxedapdienController->data();
        $result8 = $thongtinxeController->data();
        $result9 = $xedangbanController->data();
    }
}
