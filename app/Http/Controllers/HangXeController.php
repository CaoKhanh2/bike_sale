<?php

namespace App\Http\Controllers;

use App\Models\HangXe;
use Illuminate\Http\Request;

class HangXeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            ['mahx' => 'HX01', 'tenhang' => 'Honda', 'logo' => 'Image\logo_xe\Honda_Logo.png', 'xuatxu' => 'Nhật Bản', 'trangthai' => 1],
            ['mahx' => 'HX02', 'tenhang' => 'Yamaha', 'logo' => 'Image\logo_xe\Yamaha_Logo.png', 'xuatxu' => 'Nhật Bản', 'trangthai' => 1],
            ['mahx' => 'HX03', 'tenhang' => 'Suzuki', 'logo' => 'Image\logo_xe\suzuki.png', 'xuatxu' => 'Nhật Bản', 'trangthai' => 1],
            ['mahx' => 'HX04', 'tenhang' => 'Sym', 'logo' => 'public\Image\logo_xe\Sym_Logo.png', 'xuatxu' => 'Đài Loan', 'trangthai' => 1],
            ['mahx' => 'HX05', 'tenhang' => 'Honda', 'logo' => 'Image\logo_xe\Honda_Logo.png', 'xuatxu' => 'Nhật Bản', 'trangthai' => 1],
           
        ];
        
        HangXe::insert($data);
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
        //
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
