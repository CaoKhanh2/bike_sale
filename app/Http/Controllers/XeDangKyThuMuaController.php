<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $dstm_check = DB::select('SELECT xedangkythumua.*,nguoidung.hovaten FROM xedangkythumua INNER JOIN nguoidung ON xedangkythumua.mand = nguoidung.mand WHERE trangthaipheduyet = "Duyệt"')->get();
        $dstm_uncheck = DB::select('SELECT xedangkythumua.*,nguoidung.hovaten FROM xedangkythumua INNER JOIN nguoidung ON xedangkythumua.mand = nguoidung.mand WHERE trangthaipheduyet = "Không duyệt"')->get();
        return View('dashboard.transaction.purchasing.purchasing_manage', [
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_uncheck' => $dstm_uncheck,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.selling_item');
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

        if ($request->hasFile('anh')) {
            foreach ($request->file('anh') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
        }
        $id = uniqid();

        $ngaydk = date('Y-m-d');
        $mota = $request->loaixe . ' ' . $request->tenhang . ' ' . $request->namdangky . ' ' . $request->xuatxu . ' ' . $request->mota;
        $imagePathsString = implode(',', $imagePaths);
        $mand = 'ND-001';
        DB::table('xedangkythumua')->insert([
            'madkthumua' => $id,
            'mand' => $mand,
            'ngaydk' => $ngaydk,
            'hinhanh' => $imagePathsString,
            'giaban' => $request->giaban,
            'mota' => $mota,
        ]);

        return redirect('/selling_item')->with('success', 'Thông tin đã được gửi đi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function updatedon(Request $request, $id)
    {
        $trangthai = 'Duyệt';
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => $trangthai]);

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
