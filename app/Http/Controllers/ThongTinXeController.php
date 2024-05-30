<?php

namespace App\Http\Controllers;

use App\Exports\ThongTinXeMayExport;
use App\Models\ThongTinXe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ThongTinXeController extends Controller
{
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

        $xedangban = DB::table('thongtinxe')->leftJoin('xedangban', 'thongtinxe.maxe', 'xedangban.maxe')->whereNull('xedangban.maxe')->select('thongtinxe.*')->get();

        return view('dashboard.category.vehicle.vehicle-infor', [
            'thongtinxemay' => $ttxm,
            'thongtinxedapdien' => $ttxdd,
            'hangxemay' => $hxm,
            'hangxedapdien' => $hxdd,
            'dongxemay' => $dxm,
            'dongxedapdien' => $dxdd,
            'xedangban' => $xedangban,
        ]);
    }

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
            $maxemay = $this->generateUniqueId_moto();

            DB::table('thongsokythuatxemay')->insert([
                'matsxemay' => 'TS' . $maxemay,
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $maxemay,
                'matsxemay' => 'TS' . $maxemay,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu,
                //'tinhtrang' => $request->tt
            ]);

            return back()->with('success-them-thongtinxe', 'Thông tin xe đã được thêm.');
        } elseif ($request->xe == 2) {
            $maxedap = $this->generateUniqueId_bike();

            DB::table('thongsokythuatxedapdien')->insert([
                'matsxedapdien' => 'TS' . $maxedap,
            ]);

            $imagePathsString = implode(',', $imagePaths);

            DB::table('thongtinxe')->insert([
                'maxe' => $maxedap,
                'matsxedapdien' => 'TS' . $maxedap,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                'hinhanh' => $imagePathsString,
                'ghichu' => $request->ghichu,
                //'tinhtrang' => $request->tt
            ]);

            return back()->with('success-them-thongtinxe', 'Thông tin xe đã được thêm.');
        } else {
            return back()->with('cross-them-thongtinxe', 'Thông tin xe chưa được thêm!');
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
        $firstTwoChars = substr($id, 0, 2);

        if ($firstTwoChars == 'XM') {
            $xe = DB::table('thongtinxe')->select('thongtinxe.*', 'thongsokythuatxemay.*', 'dongxe.tendongxe')->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')->join('thongsokythuatxemay', 'thongsokythuatxemay.matsxemay', 'thongtinxe.matsxemay')->where('maxe', $id)->first();
        } else {
            $xe = DB::table('thongtinxe')->select('thongtinxe.*', 'thongsokythuatxedapdien.*', 'dongxe.tendongxe')->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')->join('thongsokythuatxedapdien', 'thongsokythuatxedapdien.matsxedapdien', 'thongtinxe.matsxedapdien')->where('maxe', $id)->first();
        }

        $dx = DB::table('dongxe')->get();
        $hx = DB::table('hangxe')->get();

        return view('/dashboard/category/vehicle/detail-vehicle-infor', ['xe' => $xe, 'dx' => $dx, 'hx' => $hx]);
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

    public function update_xe(Request $request)
    {
        request()->validate(
            [
                'tenxe' => 'max:50',
                // 'biensoxe' => 'max:15',
                'thoigiandasudung' => 'max:25',
                'tinhtrangxe' => 'max:50',
                'sokmdadi' => 'max:25',

                'khoiluong' => 'numeric',
                'dungtichxe' => 'max:10',
                'muctieuthunhienlieu' => 'max:35',
                'dungtichbinhxang' => 'max:15',

                'trongluong' => 'numeric',
                'acquy' => 'max:25',
                'dongcodien' => 'max:25',
                'thoigiansacdien' => 'max:15',
                'phamvisudung' => 'max:35',
            ],
            [
                'tenxe.max' => 'Tên xe không được vượt quá 50 ký tự.',
                //'biensoxe.max' => 'Biển số xe không được vượt quá 15 ký tự.',
                'thoigiandasudung.max' => 'Biển số xe không được vượt quá 25 ký tự.',
                'tinhtrangxe.max' => 'Biển số xe không được vượt quá 50 ký tự.',
                'sokmdadi.max' => 'Biển số xe không được vượt quá 25 ký tự.',

                'khoiluong.numeric' => 'Khối lượng phải là một số.',
                'dungtichxe.max' => 'Số ký tự nhập vào không được vượt quá 10 ký tự.',
                'muctieuthunhienlieu.max' => 'Số ký tự nhập vào không được vượt quá 35 ký tự.',
                'dungtichbinhxang.max' => 'Số ký tự nhập vào không được vượt quá 15 ký tự.',

                'trongluong.numeric' => 'Trọng lượng phải là một số.',
                'acquy.max' => 'Số ký tự nhập vào không được vượt quá 25 ký tự.',
                'dongcodien.max' => 'Số ký tự nhập vào không được vượt quá 25 ký tự.',
                'thoigiansacdien.max' => 'Số ký tự nhập vào không được vượt quá 15 ký tự.',
                'phamvisudung.max' => 'Số ký tự nhập vào không được vượt quá 35 ký tự.',
            ],
        );

        $imagePathsString = '';
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicles', 'public');
                $imagePaths[] = $path;
            }
        }
        $imagePathsString = implode(',', $imagePaths);

        $firstTwoChars = substr($request->maxe, 0, 2);

        $updateData = [
            'madx' => $request->dongxe,
            'tenxe' => $request->tenxe,
            'biensoxe' => $request->bsx,
            'ghichu' => $request->ghichu,
            'thoigiandasudung' => $request->thoigiansudung,
            'tinhtrangxe' => $request->tinhtrangxe,
            'sokmdadi' => $request->sokmdadi,
        ];

        if ($firstTwoChars == 'XM') {
            if (!empty($imagePathsString)) {
                $oldData = DB::table('thongtinxe')
                    ->where('maxe', $request->maxe)
                    ->pluck('hinhanh')
                    ->first();

                $newData = implode(',', array_filter([$oldData, $imagePathsString]));
                $updateData['hinhanh'] = $newData;
            }

            DB::table('thongtinxe')
                ->where('maxe', $request->maxe)
                ->update($updateData);
            DB::table('thongsokythuatxemay')
                ->where('matsxemay', 'TS' . $request->maxe)
                ->update([
                    'khoiluong' => $request->khoiluong,
                    'dungtichxe' => $request->dungtichxe,
                    'muctieuthunhienlieu' => $request->muctieuthunhienlieu,
                    'dungtichbinhxang' => $request->dungtichbinhxang,
                ]);

            return back()->with('success-thaydoi-thongtinxe', 'Thông tin được cập nhật thành công!');
        } elseif ($firstTwoChars == 'XD') {
            if (!empty($imagePathsString)) {
                $oldData = DB::table('thongtinxe')
                    ->where('maxe', $request->maxe)
                    ->pluck('hinhanh')
                    ->first();

                $newData = implode(',', array_filter([$oldData, $imagePathsString]));
                $updateData['hinhanh'] = $newData;
            }

            DB::table('thongtinxe')
                ->where('maxe', $request->maxe)
                ->update($updateData);
            DB::table('thongsokythuatxedapdien')
                ->where('matsxedapdien', 'TS' . $request->maxe)
                ->update([
                    'trongluong' => $request->trongluong,
                    'acquy' => $request->acquy,
                    'dongcodien' => $request->dongcodien,
                    'thoigiansacdien' => $request->thoigiansacdien,
                    'phamvisudung' => $request->phamvisudung,
                ]);

            return back()->with('success-thaydoi-thongtinxe', 'Thông tin được cập nhật thành công!');
        }

        return back()->with('cross-thaydoi-thongtinxe', 'Thông tin chưa được cập nhật thành công!');
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

        return back()->with('success-xoaanh-thongtinxe', 'Ảnh xe đã được xóa thành công!');
    }

    private function generateUniqueId_moto()
    {
        $lastCar = DB::table('thongtinxe')->where('maxe', 'like', 'XM%')->orderBy('maxe', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->maxe, 4));
            $newCarCode = 'XM-' . str_pad($lastCarCode + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'XM-0001';
        }

        return $newCarCode;
    }

    private function generateUniqueId_bike()
    {
        $lastCar = DB::table('thongtinxe')->where('maxe', 'like', 'XD%')->orderBy('maxe', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->maxe, 4));
            $newCarCode = 'XD-' . str_pad($lastCarCode + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'XD-0001';
        }

        return $newCarCode;
    }

    public function data()
    {
        $thongtinxe = [
            ['maxe' => 'XD-0001', 'madx' => 'DX012', 'matsxemay' => null, 'matsxedapdien' => null, 'tenxe' => 'Dibao Ninja', 'thoigiandasudung' => '2 năm', 'tinhtrangxe' => 'đã sử dụng 50%', 'sokmdadi' => '150', 'hinhanh' => 'vehicles/oP7aFutXvJohjELTcm4R6AeE6zeZ4LZCmE3JMGb4.jpg,vehicles/8GCQVyjXVZGPEOKAARHHVAJZC7k8Fxcd9IHiuRHg.jpg', 'biensoxe' => null, 'ghichu' => null],
            //['maxe' => 'XM-0001', 'madx' => 'DX003', 'matsxemay' => 'TSXM-0001', 'matsxedapdien' => null, 'tenxe' => 'Honda Vision 110cc', 'thoigiandasudung' => '4 năm', 'tinhtrangxe' => 'đã sử dụng 40%', 'sokmdadi' => '45', 'hinhanh' => 'vehicles/0u5smLX4b9zdcpXn52RRJussphidEgB8ojMOWw6t.jpg,vehicles/XX999reAtHYQJOFKPlgF2rlfZwKSirhCaJqyBN28.jpg,vehicles/1Uq4Co5ZFqsjHFboueKcihJJZZjb8Jytj4rYSAzP.jpg', 'biensoxe' => '15-B1234.56', 'ghichu' => null],
            //['maxe' => 'XM-0002', 'madx' => 'DX001', 'matsxemay' => 'TSXM-0002', 'matsxedapdien' => null, 'tenxe' => 'Honda Airblade 160cc', 'thoigiandasudung' => '2 năm', 'tinhtrangxe' => 'đã sử dụng 20%', 'sokmdadi' => '65', 'hinhanh' => 'vehicles/EWrz0NFASRjMZxnIFXtVkg2WN9dq4tjrsdCdOfEp.jpg,vehicles/hzs5Cq83NLOGkNON36uWtcrWQvAbq3LCeOnkdA03.jpg', 'biensoxe' => '15-B1764.53', 'ghichu' => null],
            //['maxe' => 'XM-0003', 'madx' => 'DX005', 'matsxemay' => 'TSXM-0003', 'matsxedapdien' => null, 'tenxe' => 'Honda Winner X 2023', 'thoigiandasudung' => '3 năm', 'tinhtrangxe' => 'đã sử dụng 10%', 'sokmdadi' => '25', 'hinhanh' => 'vehicles/Rt95T2SqSUOjbugwIYdvmPqxIJvH0e8YWHA86ajt.webp,vehicles/yiRidzawyUJXLuASleXTPHCXb8KAuRVJWglv4mgg.jpg,vehicles/Uxcd9PB7jhb8Telg8FYbbwuAjJYiVwZZsaIOP0vO.webp', 'biensoxe' => '15-B1474.55', 'ghichu' => null],
            //['maxe' => 'XM-0004', 'madx' => 'DX009', 'matsxemay' => 'TSXM-0004', 'matsxedapdien' => null, 'tenxe' => 'Yamaha Grande 2022', 'thoigiandasudung' => '2 năm', 'tinhtrangxe' => 'đã sử dụng 30%', 'sokmdadi' => '250', 'hinhanh' => 'vehicles/Rw4prS0LyXUn6igkU74S1mbDIX1oVs4A5mzeMJz7.jpg,vehicles/wtEoo3PB2gZ1nQethKRVYyyGStdMM8myxl8dUf7k.png', 'biensoxe' => '15-B1592.86', 'ghichu' => null],
        ];
        ThongTinXe::insert($thongtinxe);
    }

    public function exporrt_excel_report_infor_motorbike()
    {
        return Excel::download(new ThongTinXeMayExport(), 'thong_tin_xe_may.xlsx');
    }
}
