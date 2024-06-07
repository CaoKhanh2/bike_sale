<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndexController extends Controller
{
    //
    public function index()
    {
        $sl_kh = DB::table('nguoidung')->count();
        $sl_dtm = DB::table('xedangkythumua')->where('trangthaipheduyet', 'Chờ duyệt')->count();
        $xe = DB::table('thongtinxe')->select('thongtinxe.*','xedangban.giaban')
                                    ->join('xedangban','thongtinxe.maxe','xedangban.maxe')
                                    ->orderBy('ngaynhap','asc')->limit(5)->get();
        $this_month = Carbon::now()->month;
        $sl_xedb = DB::table('xedangban')->where('trangthai','Còn xe')->count();
        $tt = DB::table('hoadon')->whereMonth('ngaytaohoadon',  $this_month)
                                ->sum('tonggiatrihoadon');
        return view('dashboard.index',compact('sl_kh','sl_dtm','xe','tt','sl_xedb'));
    }
}
