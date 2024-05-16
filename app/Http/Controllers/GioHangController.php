<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public function show_cart(){

        $mand = Auth::guard('guest')->user()->mand;

        $gh = DB::select("SELECT giohang.*, ctgiohang.*, nguoidung.* FROM giohang INNER JOIN nguoidung ON giohang.mand = nguoidung.mand INNER JOIN ctgiohang ON ctgiohang.magh = giohang.magh WHERE giohang.mand = ? ",[$mand]);

        return route('hienthi-giohang-Guest',['gh'=>$gh]);
    }
}
