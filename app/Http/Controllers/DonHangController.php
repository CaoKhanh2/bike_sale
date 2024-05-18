<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DonHangController extends Controller
{
    public function index()
    {
        $donhang = DB::table('donhang')
        ->select('giohang.*', 'ctgiohang.*', 'donhang.*', 'nguoidung.*')
        ->join('giohang','giohang.magh', 'donhang.magh')
        ->join('ctgiohang', 'ctgiohang.magh', 'giohang.magh')
        ->join('xedangban', 'xedangban.maxedangban', 'donhang.maxedangban')
        ->join('nguoidung', 'nguoidung.mand', 'giohang.mand')
        ->get();
        return view('dashboard.transaction.selling.sell-manage', compact('donhang'));
    }
}
