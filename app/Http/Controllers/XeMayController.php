<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class XeMayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hx = DB::table('hangxe')->get();
        // $dx = DB::select('SELECT dongxe.*,hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');
        $ttxm = DB::table('thongtinxemay')->get();

        return view('dashboard.category.vehicle.vehicle_infor', ['thongtinxemay' => $ttxm ]);
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
        $xm = DB::table('thongtinxemay')->where('maxemay', $id)->first();
        $dx = DB::table('dongxe')->get();
        $hx = DB::table('hangxe')->get();
        return view('/dashboard/category/vehicle/detail_vehicle_infor', ['xm' => $xm, 'dx' => $dx, 'hx' => $hx]);
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
