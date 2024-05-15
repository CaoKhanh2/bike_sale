<?php

namespace App\Http\Controllers;

use App\Exports\ThongTinXeMayExport;
use App\Models\ThongTinXe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

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

        $hxm = DB::select('SELECT DISTINCT dongxe.mahx, hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe máy"');

        $hxdd = DB::select('SELECT DISTINCT dongxe.mahx, hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe đạp điện"');

        $dxm = DB::select('SELECT dongxe.madx, dongxe.tendongxe, dongxe.loaixe, dongxe.mahx FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe máy"');

        $dxdd = DB::select('SELECT dongxe.madx, dongxe.tendongxe, dongxe.loaixe, dongxe.mahx FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe đạp điện"');

        return view('dashboard.category.vehicle.vehicle-infor', [
            'thongtinxemay' => $ttxm,
            'thongtinxedapdien' => $ttxdd,
            'hangxemay' => $hxm,
            'hangxedapdien' => $hxdd,
            'dongxemay' => $dxm,
            'dongxedapdien' => $dxdd,
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
                $path = $image->store('vehicles', 'public');
                $imagePaths[] = $path;
            }
        }

        if ($request->xe == 1) {
            DB::table('thongsokythuatxemay')->insert([
                'matsxemay' => 'TS' . $request->mx,
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $request->mx,
                'matsxemay' => 'TS' . $request->mx,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'biensoxe' => $request->bsx,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu,
                //'tinhtrang' => $request->tt
            ]);

            return redirect('/dashboard/category/vehicle/vehicle-infor')->with('success', 'Post created successfully!');
        } else {
            DB::table('thongsokythuatxedapdien')->insert([
                'matsxedapdien' => 'TS' . $request->mx,
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $request->mx,
                'matsxedapdien' => 'TS' . $request->mx,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu,
                //'tinhtrang' => $request->tt
            ]);

            return redirect('/dashboard/category/vehicle/vehicle-infor')->with('success', 'Post created successfully!');
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
        $xm = DB::table('thongtinxe')->where('maxe', $id)->first();
        $dx = DB::table('dongxe')->get();
        $hx = DB::table('hangxe')->get();
        return view('/dashboard/category/vehicle/detail-vehicle-infor', ['xm' => $xm, 'dx' => $dx, 'hx' => $hx]);
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
    public function del_xemay($id)
    {
        DB::table('thongtinxe')->where('maxe', $id)->delete();
        DB::table('thongsokythuatxemay')
            ->where('matsxemay', 'TS' . $id)
            ->delete();
        return redirect('dashboard/category/vehicle/vehicle-infor')->with('success', 'Post created successfully!');
    }
    public function del_xedapdien($id)
    {
        DB::table('thongtinxe')->where('maxe', $id)->delete();
        DB::table('thongsokythuatxedapdien')
            ->where('matsxedapdien', 'TS' . $id)
            ->delete();
        return redirect('dashboard/category/vehicle/vehicle-infor')->with('success', 'Post created successfully!');
    }
    public function delete_image($id, $index)
    {
        $result = DB::select("SELECT hinhanh FROM thongtinxe WHERE '$id' = maxe");
        $image = $result[0]->hinhanh; // lấy một giá trị từ câu truy vấn
        $array = explode(',', $image);

        if (File::exists(storage_path('app/public/' . $array[$index]))) {
            File::delete(storage_path('app/public/' . $array[$index]));
        }

        unset($array[$index]);
        $new_array = implode(',', $array);

        DB::update('UPDATE thongtinxe SET hinhanh = ? WHERE maxe = ?', [$new_array, $id]);

        return redirect('dashboard/category/vehicle/vehicle-infor/{$id}')->with('success', 'Post created successfully!');
    }
    public function data()
    {
        $thongtinxe = [
            ['maxe' => 'XM-0001', 'madx' => 'DX003', 'matsxemay' => 'TSXE-0001', 'matsxedapdien' => null, 'tenxe' => 'Honda Vision 110cc', 'thoigiandasudung' => '4 năm', 'tinhtrangxe' => 'đã sử dụng 40%', 'sokmdadi' => '45', 'hinhanh' => 'vehicles/5y3pUJ5dE2Rn5zIjYo4FpeQBg9bMdBkcubSDzlmz.jpg,vehicles/IpocilGVPiJXnjlEJKEPBKS52Rn79NknOPiFMnoV.jpg,vehicles/MBGDciXkzzKWPb98UYaF4lwTMQ9TEWt5uQTgvLkB.jpg,vehicles/rVFCE8R7GQu91Ekwx1MEjMDOcd0FgQnJ9KhBbNfv.jpg', 'biensoxe' => '15-B1234.56', 'ghichu' => null],
            ['maxe' => 'XM-0002', 'madx' => 'DX001', 'matsxemay' => 'TSXE-0002', 'matsxedapdien' => null, 'tenxe' => 'Honda Airblade 160cc', 'thoigiandasudung' => '2 năm', 'tinhtrangxe' => 'đã sử dụng 20%', 'sokmdadi' => '65', 'hinhanh' => 'vehicles/EWrz0NFASRjMZxnIFXtVkg2WN9dq4tjrsdCdOfEp.jpg,vehicles/hzs5Cq83NLOGkNON36uWtcrWQvAbq3LCeOnkdA03.jpg', 'biensoxe' => '15-B1764.53', 'ghichu' => null],
            ['maxe' => 'XM-0003', 'madx' => 'DX005', 'matsxemay' => 'TSXE-0003', 'matsxedapdien' => null, 'tenxe' => 'Honda Winner X 2023', 'thoigiandasudung' => '3 năm', 'tinhtrangxe' => 'đã sử dụng 10%', 'sokmdadi' => '25', 'hinhanh' => 'vehicles/Rt95T2SqSUOjbugwIYdvmPqxIJvH0e8YWHA86ajt.webp,vehicles/yiRidzawyUJXLuASleXTPHCXb8KAuRVJWglv4mgg.jpg,vehicles/Uxcd9PB7jhb8Telg8FYbbwuAjJYiVwZZsaIOP0vO.webp', 'biensoxe' => '15-B1474.55', 'ghichu' => null],
            ['maxe' => 'XM-0004', 'madx' => 'DX009', 'matsxemay' => 'TSXM-0004', 'matsxedapdien' => null, 'tenxe' => 'Yamaha Grande 2022', 'thoigiandasudung' => '2 năm', 'tinhtrangxe' => 'đã sử dụng 30%', 'sokmdadi' => '250', 'hinhanh' => 'vehicles/Rw4prS0LyXUn6igkU74S1mbDIX1oVs4A5mzeMJz7.jpg,vehicles/wtEoo3PB2gZ1nQethKRVYyyGStdMM8myxl8dUf7k.png', 'biensoxe' => '15-B1592.86', 'ghichu' => null],
        ];
        ThongTinXe::insert($thongtinxe);
    }

    public function exporrt_excel_report_infor_motorbike()
    {
        return Excel::download(new ThongTinXeMayExport, 'thong_tin_xe_may.xlsx');
        
    }
}
