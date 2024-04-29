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

        $ttxdd = DB::select('SELECT thongtinxe.*, thongsokythuatxedapdien.*, dongxe.tendongxe, hangxe.tenhang FROM thongtinxe INNER JOIN thongsokythuatxedapdien  ON thongtinxe.matsxemay = thongsokythuatxedapdien.matsxedapdien INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');

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

            DB::table('thongtinxemay')->insert([
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

            return redirect('/dashboard/category/vehicle/vehicle_infor')->with('success', 'Post created successfully!');
        }else{
            $imagePathsString = '';
            $imagePaths = [];

            if ($request->hasFile('anh')) {
                foreach ($request->file('anh') as $image) {
                    $path = $image->store('images','public');
                    $imagePaths[] = $path; 
                }
            }

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxedapdien')->insert([
                'maxedapdien' => $request->mx,
                'madx' => $request->dx,
                'mahx' => $request->hx,
                'tenxe' => $request->tx,
                'trongluong' => $request->trlg,
                'acquy' => $request->ac,
                'dongcodien' => $request->dcd,
                'sacdien' => $request->sd,
                'phamvisudung' => $request->pvsd,
                'hinhanh' => $imagePathsString,
                'giaban' => $request->giaban
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
    public function destroy($id)
    {
        //
    }
}
