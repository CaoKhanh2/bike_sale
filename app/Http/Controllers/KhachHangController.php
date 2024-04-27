<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kh = DB::table('nguoidung')->get();
        return view('dashboard.category.customer.customer_info', ['nguoidung' => $kh]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'makh' => 'required',
        //     'hoten' => 'required',
        //     'gt' => 'required',
        //     'ngsinh' => 'required',
        //     'sdt' => 'required',
        //     'email' => 'required',
        // ]);

        // $post = new KhachHang();
        // $post->makh = $validatedData['makh'];
        // $post->hovaten = $validatedData['hoten'];
        // $post->gioitinh = $validatedData['gt'];
        // $post->ngaysinh = $validatedData['ngsinh'];
        // $post->sodienthoai = $validatedData['sdt'];
        // $post->email = $validatedData['email'];
        // $post->save();

        // return redirect('/dashboard/category/customer/customer_info')->with('success', 'Post created successfully!');

        DB::table('nguoidung')
        ->insert([
            'makh' => $request->makh,
            'hovaten' => $request->hoten,
            'ngaysinh' => $request->ngsinh,
            'gioitinh' => $request->gt,
            'sodienthoai' => $request->sdt,
            'email' => $request->email,
            'diachi' => $request->dc
            // 'tinhtrang' => $request->tt
        ]);

        return redirect('/dashboard/category/customer/customer_info')->with('success', 'Post created successfully!');
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
        $kh = DB::table('khachhang')->where('makh', $id)->first();
        return view('/dashboard/category/customer/detail_customer_info', ['kh' => $kh]);
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
        // $kh = KhachHang::find($id);
        // $kh->hovaten = $request->hoten;
        // $kh->ngaysinh = $request->ngsinh;
        // $kh->gioitinh = $request->gt;
        // $kh->sodienthoai = $request->sdt;
        // $kh->email = $request->email;
        // $kh->diachi = $request->dc;
        // $kh->tinhtrang = $request->tt;

        // $kh->save();
        // return redirect('/dashboard/category/customer/customer_info')->with('success', 'Post created successfully!');

        DB::table('khachhang')
            ->where('makh', $id)
            ->update([
                'hovaten' => $request->hoten,
                'ngaysinh' => $request->ngsinh,
                'gioitinh' => $request->gt,
                'sodienthoai' => $request->sdt,
                'email' => $request->email,
                'diachi' => $request->dc,
                'tinhtrang' => $request->tt ? 1 : 0
            ]);

        return redirect('/dashboard/category/customer/customer_info')->with('success', 'Post created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Sử dụng Query Builder:
        DB::table('khachhang')->where('makh', $id)->delete();
        return redirect('/dashboard/category/customer/customer_info')->with('success', 'Post created successfully!');
    }
}
