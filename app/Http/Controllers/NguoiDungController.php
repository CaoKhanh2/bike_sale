<?php

namespace App\Http\Controllers;

use App\Models\nguoidung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nd = DB::table('nguoidung')->get();
        return view('dashboard.category.customer.customer-info', ['nguoidung' => $nd]);
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
        //     'mand' => 'required',
        //     'hoten' => 'required',
        //     'gt' => 'required',
        //     'ngsinh' => 'required',
        //     'sdt' => 'required',
        //     'email' => 'required',
        // ]);

        // $post = new nguoidung();
        // $post->mand = $validatedData['mand'];
        // $post->hovaten = $validatedData['hoten'];
        // $post->gioitinh = $validatedData['gt'];
        // $post->ngaysinh = $validatedData['ngsinh'];
        // $post->sodienthoai = $validatedData['sdt'];
        // $post->email = $validatedData['email'];
        // $post->save();

        // return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');

        DB::table('nguoidung')
        ->insert([
            'mand' => $request->mand,
            'hovaten' => $request->hoten,
            'ngaysinh' => $request->ngsinh,
            'cccd' => $request->cccd,
            'gioitinh' => $request->gt,
            'sodienthoai' => $request->sdt,
            'email' => $request->email,
            'diachi' => $request->dc
            // 'tinhtrang' => $request->tt
        ]);

        return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nd = DB::table('nguoidung')->where('mand', $id)->first();
        return view('/dashboard/category/customer/detail_customer-info', ['nd' => $nd]);
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
        // $kh = nguoidung::find($id);
        // $kh->hovaten = $request->hoten;
        // $kh->ngaysinh = $request->ngsinh;
        // $kh->gioitinh = $request->gt;
        // $kh->sodienthoai = $request->sdt;
        // $kh->email = $request->email;
        // $kh->diachi = $request->dc;
        // $kh->tinhtrang = $request->tt;

        // $kh->save();
        // return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');

        if($id){
            DB::table('nguoidung')
            ->where('mand', $id)
            ->update([
                'hovaten' => $request->hoten,
                'ngaysinh' => $request->ngsinh,
                'cccd' => $request->cccd,
                'gioitinh' => $request->gt,
                'sodienthoai' => $request->sdt,
                'email' => $request->email,
                'diachi' => $request->dc,
                'tinhtrang' => $request->tt ? 1 : 0
            ]);
            
            return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');

        }else{
            
        }

        
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
        DB::table('nguoidung')->where('mand', $id)->delete();
        return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');
    }
}
