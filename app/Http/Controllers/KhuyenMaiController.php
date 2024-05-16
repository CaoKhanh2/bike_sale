<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KhuyenMaiController extends Controller
{
    public function index()
    {
        $km = DB::table('khuyenmai')->get();
        $km_active = DB::table('khuyenmai')->selectRaw('*,DATEDIFF(thoigianketthuc,CURDATE()) AS thoigianconlai')->get();
        return view('dashboard.category.saling-events.saling-manage',['khuyenmai'=> $km,'khuyenmai_active'=> $km_active]);
    }
    public function store(Request $request)
    {
        DB::table('khuyenmai')->insert([
            'makhuyenmai' => $request->makhuyemai,
            'tenkhuyenmai' => $request->tenkhuyenmai,
            'dieukienapdung' => $request->dieukienapdung,
            'motakhuyenmai' => $request->mota,
            'thoigianbatdau' => $request->ngaybatdau,
            'thoigianketthuc' => $request->ngayketthuc,
        ]);

        return redirect('dashboard/category/saling-events/saling-manage')->with('success', 'Post created successfully!');    
    }
}
