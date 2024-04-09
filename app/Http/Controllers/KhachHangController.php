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
        $kh = DB::table('khachhang')->get();
        return view('dashboard.category.customer.customer_info',['khachhang'=>$kh]);
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
        $validatedData = $request->validate([
            'makh' => 'required',
            'hoten' => 'required',
            'gt' => 'required',
            'ngsinh' => 'required',
            'sdt' => 'required',
            'email' => 'required'
        ]);

        $post = new KhachHang();
        $post->makh = $validatedData['makh'];
        $post->hovaten = $validatedData['hoten'];
        $post->gioitinh = $validatedData['gt'];
        $post->ngaysinh = $validatedData['ngsinh'];
        $post->sodienthoai = $validatedData['sdt'];
        $post->email = $validatedData['email'];
        $post->save();

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
        //
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
        //
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
