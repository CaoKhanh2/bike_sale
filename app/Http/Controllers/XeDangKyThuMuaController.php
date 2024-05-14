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
        $dstm_waiting = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('trangthaipheduyet', 'Chờ duyệt')->get();
        //
        $dstm_check = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('trangthaipheduyet', 'Duyệt')->get();
        //
        $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('trangthaipheduyet', 'Không duyệt')->get();
        //
        return view('dashboard.transaction.purchasing.purchasing-manage', [
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_uncheck' => $dstm_uncheck,
        ]);
    }

    public function index2()
    {
        //dd(Auth::guard('guest')->check());
        //if (Auth::guard('guest')->check() == false) {
        return view('guest-acc.selling-item')->with('cross', 'Bạn cần đăng nhập để sử dụng chức năng này !');
        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

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

        return redirect('/purchasing-form')->with('success', 'Thông tin đã được gửi đi');
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
    public function show($id)
    {
    }

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
