<?php

namespace App\Http\Controllers;

use App\Models\XeDangBan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class XeDangBanController extends Controller
{
    public function index()
    {
        // $dk_banxe = DB::select('SELECT xedangkyban.*,khachhang.hovaten FROM xedangkyban INNER JOIN khachhang ON xedangkyban.makh = khachhang.makh');

        // return view('dashboard.transaction.purchasing.purchasing-manage',['xedkban'=>$dk_banxe]);
    }

    // public function index2()
    // {
    //     $xedangban_xemay = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxemay.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxemay ON thongtinxe.matsxemay = thongsokythuatxemay.matsxemay INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx INNER JOIN ctkhohang ON ctkhohang.machitietkho = thongtinxe.maxe WHERE ctkhohang.trangthai == "Còn trong kho"');

    //     $xedangban_xedapdien = DB::select('SELECT xedangban.*, thongtinxe.*, thongsokythuatxedapdien.*, dongxe.tendongxe, dongxe.loaixe, hangxe.tenhang FROM xedangban INNER JOIN thongtinxe  ON xedangban.maxe = thongtinxe.maxe INNER JOIN thongsokythuatxedapdien ON thongtinxe.matsxedapdien = thongsokythuatxedapdien.matsxedapdien INNER JOIN dongxe ON thongtinxe.madx = dongxe.madx INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx INNER JOIN ctkhohang ON ctkhohang.machitietkho = thongtinxe.maxe WHERE ctkhohang.trangthai == "Còn trong kho"');

    //     $hxm = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe máy"');

    //     $hxdd = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe đạp điện"');

    //     return view('/sub-index', ['db_xemay' => $xedangban_xemay, 'db_xedapdien' => $xedangban_xedapdien, 'hangxemay' => $hxm, 'hangxedapdien' => $hxdd]);
    // }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function showData()
    {
        $db_xemay = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxemay.*',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                            ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                        END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxemay', 'thongtinxe.matsxemay', 'thongsokythuatxemay.matsxemay')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('xedangban.trangthai','Còn xe')
            ->where('ctkhohang.trangthai', 'Còn trong kho')
            ->get();

        $db_xedapdien = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxedapdien.*',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                        ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                    END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxedapdien', 'thongtinxe.matsxedapdien', 'thongsokythuatxedapdien.matsxedapdien')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('xedangban.trangthai','Còn xe')
            ->where('ctkhohang.trangthai', 'Còn trong kho')
            ->get();

        $hangxemay = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe máy"');

        $hangxedapdien = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx WHERE loaixe = "Xe đạp điện"');

        return view('sub-index', compact('db_xemay', 'db_xedapdien', 'hangxemay', 'hangxedapdien'));
    }

    public function showData2()
    {
        $db_xemay = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxemay.*',
                'hangxe.tenhang',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                            ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                        END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxemay', 'thongtinxe.matsxemay', 'thongsokythuatxemay.matsxemay')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('ctkhohang.trangthai', 'Còn trong kho')
            ->where('xedangban.trangthai','Còn xe')
            ->orderBy('xedangban.ngayban', 'desc')
            ->limit(4)
            ->get();

            $db_xedapdien = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxedapdien.*',
                'hangxe.tenhang',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                        ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                    END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxedapdien', 'thongtinxe.matsxedapdien', 'thongsokythuatxedapdien.matsxedapdien')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('ctkhohang.trangthai', 'Còn trong kho')
            ->where('xedangban.trangthai','Còn xe')
            ->orderBy('xedangban.ngayban', 'desc')
            ->limit(4)
            ->get();

        $hangxe = DB::select('SELECT DISTINCT hangxe.*, dongxe.loaixe FROM hangxe INNER JOIN dongxe ON dongxe.mahx = hangxe.mahx');


            return view('index',compact('db_xemay','db_xedapdien', 'hangxe'));
    }

    public function show_Detail_Data($id)
    {
        $ct_thongtin_xemay = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxemay.*',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'khuyenmai.motakhuyenmai',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                    ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxemay', 'thongtinxe.matsxemay', 'thongsokythuatxemay.matsxemay')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('thongtinxe.maxe', $id)
            ->get();

        $ct_thongtin_xedapdien = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'xedangban.giaban as giagoc',
                'thongtinxe.*',
                'thongsokythuatxedapdien.*',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'khuyenmai.motakhuyenmai',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                    ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
            ->join('thongsokythuatxedapdien', 'thongtinxe.matsxedapdien', 'thongsokythuatxedapdien.matsxedapdien')
            ->join('dongxe', 'thongtinxe.madx', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('thongtinxe.maxe', $id)
            ->get();

        return view('sale-page', compact('ct_thongtin_xemay', 'ct_thongtin_xedapdien'));
    }

    public function index_post_sale_1(Request $request)
    {
        $maxe = $request->maxe;

        $maxedangban = $this->generateUniqueId();

        $ngayban = Carbon::now();

        return view('dashboard.transaction.selling.car-selling.vehicle-infor-sale', compact('maxe', 'maxedangban', 'ngayban'));
    }

    public function index_post_sale_2(Request $request)
    {
        $maxedangban = $this->generateUniqueId();

        $ngayban = Carbon::now();

        $thongtinxe = DB::table('thongtinxe')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))->from('xedangban')->whereRaw('xedangban.maxe = thongtinxe.maxe');
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('ctkhohang')->whereRaw('ctkhohang.maxe = thongtinxe.maxe');
            })
            ->select('thongtinxe.*')
            ->get();

        return view('dashboard.transaction.selling.car-selling.vehicle-directly', compact('thongtinxe', 'maxedangban', 'ngayban'));
    }

    public function add_post_sale(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'giaban' => 'required|max:11|min:8',
            ],
            [
                'giaban.required' => 'Bạn chưa nhập trường thông tin giá bán!',
                'giaban.max' => 'Giá bán không vượt quá 100,000,000 đ',
                'giaban.min' => 'Giá bán không được dưới quá 1,000,000 đ',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $giaban = str_replace(',', '', $request->giaban);

        $time = Carbon::now()->format('H:i:s');
        $date = Carbon::createFromFormat('d/m/Y', $request->ngayban)->format('Y-m-d');
        $datetime = $date . ' ' . $time;

        DB::table('xedangban')->insert([
            'maxedangban' => $request->maxedangban,
            'maxe' => $request->maxe,
            'ngayban' => $datetime,
            'giaban' => $giaban,
            'mota' => $request->mota,
            'trangthai' => 'Còn xe',
        ]);

        return redirect()->route('danhsach-donhang-dangbanxe')->with('success-them-xedangban', 'Xe đã được thêm vào mục đăng bán.');
    }

    public function destroy_post_sale($id)
    {
        DB::table('xedangban')->where('maxedangban', $id)->delete();
        return redirect()->route('danhsach-donhang-dangbanxe')->with('success-xoa-xedangban', 'Xe đã được xóa khỏi mục đăng bán.');
    }

    private function generateUniqueId()
    {
        $lastCar = DB::table('xedangban')->orderBy('maxedangban', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->maxedangban, 4));
            $newCarCode = 'XDB-' . str_pad($lastCarCode + 1, 5, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'XDB-00001';
        }

        return $newCarCode;
    }

    public function data()
    {
        $xedangban = [
            //array('maxedangban' => 'XDB-00001','maxe' => 'XD-0001','makhuyenmai' => NULL,'manv' => 'MNV-0003','namsx' => '2015','ngayban' => '2024-04-30 17:42:08','giaban' => '3500000.00','mota' => '','tranghthai' => 'Còn xe'),
            ['maxedangban' => 'XDB-00002', 'maxe' => 'XM-0001', 'makhuyenmai' => null, 'manv' => 'MNV-0004', 'namsx' => '2023', 'ngayban' => '2024-04-30 17:28:56', 'giaban' => '25000000.00', 'mota' => '', 'trangthai' => 'Còn xe'],
            ['maxedangban' => 'XDB-00003', 'maxe' => 'XM-0002', 'makhuyenmai' => null, 'manv' => 'MNV-0008', 'namsx' => '2024', 'ngayban' => '2024-05-01 16:41:45', 'giaban' => '45560000.00', 'mota' => '', 'trangthai' => 'Còn xe'],
            ['maxedangban' => 'XDB-00004', 'maxe' => 'XM-0004', 'makhuyenmai' => null, 'manv' => 'MNV-0009', 'namsx' => '2022', 'ngayban' => '2024-05-01 16:53:45', 'giaban' => '40000000.00', 'mota' => '', 'trangthai' => 'Còn xe'],
        ];
        XeDangBan::insert($xedangban);
    }
}
