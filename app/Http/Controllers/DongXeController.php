<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DongXe;
use Illuminate\Support\Facades\DB;

class DongXeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dx = DB::select('SELECT dongxe.*,hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');
        $hx = DB::table('hangxe')->get();
        return view('dashboard.category.vehicle.vehicle-line.vehicle-line_infor',['dongxe'=>$dx, 'hangxe'=>$hx]);
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
        DB::table('dongxe')->insert([
            'madx' => $request->mdx,
            'mahx' => $request->hx,
            'loaixe' => $request->lx,
            'tendongxe' => $request->tdx,
            'mota' => $request->mt,
        ]);

        return redirect('dashboard/category/vehicle/vehicle-line_infor')->with('success', 'Post created successfully!');
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
        DB::table('dongxe')->where('madx', $id)->delete();
        return redirect('dashboard/category/vehicle/vehicle-line_infor')->with('success', 'Post created successfully!');
    }

    public function data(){
        $dongxe = array(
            array('madx' => 'DX001','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Airblade','mota' => NULL),
            array('madx' => 'DX002','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Lead','mota' => NULL),
            array('madx' => 'DX003','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Vision','mota' => NULL),
            array('madx' => 'DX004','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Wave','mota' => NULL),
            array('madx' => 'DX005','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Winner','mota' => NULL),
            array('madx' => 'DX006','mahx' => 'HX05','loaixe' => 'Xe máy','tendongxe' => 'Piaggio Liberty','mota' => NULL),
            array('madx' => 'DX007','mahx' => 'HX03','loaixe' => 'Xe máy','tendongxe' => 'Suzuki Raider','mota' => NULL),
            array('madx' => 'DX008','mahx' => 'HX02','loaixe' => 'Xe máy','tendongxe' => 'Yamaha Exciter','mota' => NULL),
            array('madx' => 'DX009','mahx' => 'HX02','loaixe' => 'Xe máy','tendongxe' => 'Yamaha Grande','mota' => NULL),
            array('madx' => 'DX010','mahx' => 'HX07','loaixe' => 'Xe đạp điện','tendongxe' => 'Dibao CREER E','mota' => NULL),
            array('madx' => 'DX011','mahx' => 'HX07','loaixe' => 'Xe đạp điện','tendongxe' => 'Dibao Ninja','mota' => NULL),
            array('madx' => 'DX012','mahx' => 'HX10','loaixe' => 'Xe đạp điện','tendongxe' => 'Nijia Cap A','mota' => NULL),
            array('madx' => 'DX013','mahx' => 'HX11','loaixe' => 'Xe đạp điện','tendongxe' => 'Xiaomi Himo','mota' => NULL),
            array('madx' => 'DX014','mahx' => 'HX11','loaixe' => 'Xe đạp điện','tendongxe' => 'Xiaomi Ninebot','mota' => NULL),
            array('madx' => 'DX015','mahx' => 'HX09','loaixe' => 'Xe đạp điện','tendongxe' => 'Espero M133','mota' => NULL)
        );
        DongXe::insert($dongxe);
    }
}
