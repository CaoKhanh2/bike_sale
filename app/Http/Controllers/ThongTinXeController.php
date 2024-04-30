<?php

namespace App\Http\Controllers;

use App\Models\ThongTinXeDapDien;
use App\Models\ThongTinXeMay;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThongTinXeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$xeMayData = ThongTinXeMay::all(); 
        //$xeDapDienData = ThongTinXeDapDien::all();

        $ttxm = DB::select('SELECT thongtinxe.*, thongsokythuatxemay.*, dongxe.tendongxe, hangxe.tenhang FROM thongtinxe INNER JOIN thongsokythuatxemay  ON thongtinxe.matsxemay = thongsokythuatxemay.matsxemay INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

        $ttxdd = DB::select('SELECT thongtinxe.*, thongsokythuatxedapdien.*, dongxe.tendongxe, hangxe.tenhang FROM thongtinxe INNER JOIN thongsokythuatxedapdien  ON thongtinxe.matsxedapdien = thongsokythuatxedapdien.matsxedapdien INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

        $hx = DB::table('hangxe')->get();

        $dxm = DB::table('dongxe')->where('loaixe','Xe máy')->get();
        $dxdd = DB::table('dongxe')->where('loaixe','Xe đạp điện')->get();

        return view('dashboard.category.vehicle.vehicle_infor', [
            'thongtinxemay' => $ttxm,
            'thongtinxedapdien' => $ttxdd,
            'hangxe' => $hx,
            'dongxemay' => $dxm,
            'dongxedapdien' => $dxdd
            
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
        $imagePathsString = '';
        $imagePaths = [];

        if ($request->hasFile('anh')) {
            foreach ($request->file('anh') as $image) {
                $path = $image->store('images','public');
                $imagePaths[] = $path; 
            }
        }
        
        if($request->xe == 1){

            DB::table('thongsokythuatxemay')->insert([
                'matsxemay' => ("TS").($request->mx)
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $request->mx,
                'matsxemay' =>  ("TS").($request->mx),
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'biensoxe' => $request->bsx,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu
                //'tinhtrang' => $request->tt
            ]);

            return redirect('/dashboard/category/vehicle/vehicle_infor')->with('success', 'Post created successfully!');
        }else{

            DB::table('thongsokythuatxedapdien')->insert([
                'matsxedapdien' => ("TS").($request->mx)
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $request->mx,
                'matsxedapdien' =>  ("TS").($request->mx),
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu
                //'tinhtrang' => $request->tt
            ]);

            return redirect('/dashboard/category/vehicle/vehicle_infor')->with('success', 'Post created successfully!');
        }
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
    public function destroy_Xemay($id)
    {
        DB::table('thongtinxe')->where('maxe', $id)->delete();
        DB::table('thongsokythuatxemay')->where('matsxemay', ('TS').$id)->delete();
        return redirect('dashboard/category/vehicle/vehicle_infor')->with('success', 'Post created successfully!');
    }
}
