<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DonHangController extends Controller
{
    public function index_checkout()
    {
        $mand = Auth::guard('guest')->user()->mand;
        
        $trangthai = "Đang chờ xử lý";

        $giohang_items =DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? AND giohang.ghichu = ?',
            [$mand, $trangthai]
        );
        return view('guest-acc.orders.checkout', compact('giohang_items'));
    }
}
