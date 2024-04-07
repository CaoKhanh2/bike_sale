<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiXe;
use Illuminate\Support\Facades\DB;

class LoaiXeController extends Controller
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
        $lx = DB::table('loaixe')->get();
        return view('dashboard.category.vehicle.type_vehicle_infor',['loaixe'=>$lx]);
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
