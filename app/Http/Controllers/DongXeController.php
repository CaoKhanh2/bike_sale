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
        // $data = [
        //     ['malx' => 'LX01', 'tenloaixe' => 'Honda Vision', 'mota' => ''],
        //     ['malx' => 'LX02', 'tenloaixe' => 'Honda Lead', 'mota' => ''],
        //     ['malx' => 'LX03', 'tenloaixe' => 'Honda Air Blade', 'mota' => ''],
        //     ['malx' => 'LX04', 'tenloaixe' => 'Honda Wade', 'mota' => ''],
        //     ['malx' => 'LX05', 'tenloaixe' => 'Honda Winner', 'mota' => ''],
        //     ['malx' => 'LX06', 'tenloaixe' => 'Yamaha Grande', 'mota' => ''],
        //     ['malx' => 'LX07', 'tenloaixe' => 'Yamaha Janus', 'mota' => ''],
        //     ['malx' => 'LX08', 'tenloaixe' => 'Yamaha Exciter', 'mota' => ''],
        //     ['malx' => 'LX09', 'tenloaixe' => 'Suzuki Raider', 'mota' => ''],
        //     ['malx' => 'LX10', 'tenloaixe' => 'Yamaha Exciter', 'mota' => ''],
        // ];
        // LoaiXe::insert($data);

        $dx = DB::select('SELECT dongxe.*,hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');
        $hx = DB::table('hangxe')->get();
        return view('dashboard.category.vehicle.vehicle_line.vehicle_line_infor',['dongxe'=>$dx, 'hangxe'=>$hx]);
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

        return redirect('dashboard/category/vehicle/vehicle_line_infor')->with('success', 'Post created successfully!');
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
        return redirect('dashboard/category/vehicle/vehicle_line_infor')->with('success', 'Post created successfully!');
    }
}
