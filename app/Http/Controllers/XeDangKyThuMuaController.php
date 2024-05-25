<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XeDangKyThuMuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dstm_waiting = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')
                                                    ->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')
                                                    ->where('trangthaipheduyet', 'Chờ duyệt')
                                                    ->orderBy('ngaydk','desc')->get();
        //
        $dstm_check = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd','nhanvien.hovaten as tennv')
                                                    ->join('nguoidung', 'xedangkythumua.mand','nguoidung.mand')
                                                    ->join('nhanvien','xedangkythumua.manv','nhanvien.manv')
                                                    ->where('trangthaipheduyet', 'Duyệt')->get();
        //
        $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd','nhanvien.hovaten as tennv')
                                                    ->join('nguoidung', 'xedangkythumua.mand','nguoidung.mand')
                                                    ->join('nhanvien','xedangkythumua.manv','nhanvien.manv')
                                                    ->where('trangthaipheduyet', 'Không duyệt')->get();
        //
        return view('dashboard.transaction.purchasing.purchasing-manage', [
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_uncheck' => $dstm_uncheck,
            'xedangkythumua_waiting' => $dstm_waiting,
        ]);
    }

    public function index2()
    {   
        return view('guest-acc.purchasing.purchasing-form')->with('cross', 'Bạn cần đăng nhập để sử dụng chức năng này !');
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagePathsString = '';
        $imagePaths = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $path = $image->store('posted', 'public');
                $imagePaths[] = $path;
            }
        }
        $id = 'MDK' . '-' . uniqid();
        $ngaydk = date('Y-m-d');
        $mota = 'Loại xe: ' . $request->loaixe . ', Tên hãng: ' . $request->tenhang . ', Năm đăng ký: ' . $request->namdangky . ', Xuất xứ:  ' . $request->xuatxu . ', Mô tả: ' . $request->mota;
        $imagePathsString = implode(',', $imagePaths);
        $mand = Auth::guard('guest')->user()->mand;

        DB::table('xedangkythumua')->insert([
            'madkthumua' => $id,
            'mand' => $mand,
            'ngaydk' => $ngaydk,
            'hinhanh' => $imagePathsString,
            'giaban' => $request->giaban,
            'mota' => $mota,
        ]);

        return redirect()->route('gui-form-thumua-Guest')->with('success-form-posting-Guest', 'Thông tin đã được gửi đi !');
    }

    public function show($id)
    {
        $dtm = $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('madkthumua', $id)->first();
        return view('dashboard.transaction.purchasing.purchasing-bike-detail', ['dtm' => $dtm]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
    public function duyetdon(Request $request, $id)
    {
        $manv = Auth::user()->manv;
        $trangthai = 'Duyệt';
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => $trangthai, 'manv' => $manv]);

        return redirect()->route('xedkthumua');
    }
    public function huydon(Request $request, $id)
    {
        $manv = Auth::user()->manv;
        $trangthai = 'Không duyệt';
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => $trangthai, 'manv' => $manv]);

        return redirect()->route('xedkthumua');
    }
    public function dondep()
    {
        $del = DB::table('xedangkythumua')->where('ngaydk')->delete();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}