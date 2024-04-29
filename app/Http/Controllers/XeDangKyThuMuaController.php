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
        $dstm_check = DB::table('DS_Thumua')->where('trangthaipheduyet','Duyệt')->get();
        $dstm_uncheck = DB::table('DS_Thumua')->where('trangthaipheduyet','Không duyệt')->get();
        return View('dashboard.transaction.purchasing.purchasing_manage', [
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_uncheck' => $dstm_uncheck
        ]);
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
        
        if($request->xe == 1){
            $imagePathsString = '';
            $imagePaths = [];

            if ($request->hasFile('anh')) {
                foreach ($request->file('anh') as $image) {
                    $path = $image->store('images','public');
                    $imagePaths[] = $path; 
                }
            }

            $imagePathsString = implode(',', $imagePaths);

            DB::table('xedangkythumua')->insert([
                'maxemay' => $request->mx,
                'madx' => $request->dx,
                'mahx' => $request->hx,
                'tenxe' => $request->tx,
                'dungtichxe' => $request->dtx,
                'sokmdadi' => $request->sokmdadi,
                'namdk' => $request->namdk,
                'hinhanh' => $imagePathsString,
                'giaban' => $request->giaban,
                //'tinhtrang' => $request->tt
            ]);

            return redirect('/dashboard/category/vehicle/vehicle_infor')->with('success', 'Thông tin đã được gửi đi');
    }}

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
        
    }
    public function updatedon(Request $request, $id)
    {   
        $trangthai = 'Duyệt';
        DB::table('xedangkythumua')->where('madkthumua', $id)
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
