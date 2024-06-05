<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchContrller extends Controller
{
    public function searchData1(Request $request)
    {
        $tenxe = $request->tenxe;
        $loaixe = $request->loaixe;
        $hangxe = $request->hangxe;

        $timkiem = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'thongtinxe.*',
                'dongxe.tendongxe',
                'dongxe.loaixe',
                'hangxe.tenhang',
                'dongxe.loaixe',
                'xedangban.giaban as giagoc',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                    ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
            ->join('dongxe', 'thongtinxe.madx', '=', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', '=', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('ctkhohang.trangthai', 'Còn trong kho');

        if (!empty($tenxe) && !empty($loaixe) && !empty($hangxe)) {
            $timkiem
                ->where('thongtinxe.tenxe', 'LIKE', "%$tenxe%")
                ->where('dongxe.loaixe', $loaixe)
                ->where('hangxe.tenhang', $hangxe);
        }

        if (!empty($tenxe)) {
            $timkiem->where('thongtinxe.tenxe', 'LIKE', "%$tenxe%");
        }
        
        if (!empty($loaixe)) {
            $timkiem->where('dongxe.loaixe', $loaixe);
        }
        
        if (!empty($hangxe)) {
            $timkiem->where('hangxe.mahx', $hangxe);
        }

        $timkiem = $timkiem->get();

        $hangxe = DB::table('hangxe')->select('hangxe.*', 'dongxe.loaixe')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->get();
        $dongxe = DB::table('dongxe')->select('dongxe.loaixe', 'hangxe.*')->join('hangxe', 'dongxe.mahx', 'hangxe.mahx')->distinct()->get();

        return view('/sub-index-result', compact('timkiem', 'hangxe', 'dongxe'));
    }

    // public function search_subData1(Request $request)
    // {
    //     $tenxe = $request->tenxe;
    //     $loaixe = $request->loaixe;
    //     $hangxe = $request->hangxe;

    //     $timkiem = DB::table('xedangban')
    //         ->select(
    //             'xedangban.*',
    //             'thongtinxe.*',
    //             'dongxe.tendongxe',
    //             'hangxe.tenhang',
    //             'dongxe.loaixe',
    //             'xedangban.giaban as giagoc',
    //             'tilegiamgia',
    //             DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
    //                                 ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
    //                             END AS giaban'),
    //         )
    //         ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
    //         ->join('dongxe', 'thongtinxe.madx', '=', 'dongxe.madx')
    //         ->join('hangxe', 'dongxe.mahx', '=', 'hangxe.mahx')
    //         ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
    //         ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
    //         ->where('ctkhohang.trangthai', 'Còn trong kho');

    //     if (!empty($tenxe) && !empty($loaixe) && !empty($hangxe)) {
    //         $timkiem->where('thongtinxe.tenxe', 'LIKE', "%$tenxe%")->where('dongxe.loaixe', $loaixe)->where('hangxe.tenhang', $hangxe);
    //     } elseif (empty($tenxe)) {
    //         $timkiem->where('dongxe.loaixe', $loaixe)->where('hangxe.tenhang', $hangxe);
    //     }elseif (empty($tenxe) && empty($dongxe)) {
    //         $timkiem->where('dongxe.loaixe', $loaixe);
    //     }elseif (empty($loaixe)) {
    //         $timkiem->where('thongtinxe.tenxe', 'LIKE', "%$tenxe%");
    //     } elseif (empty($hangxe)){
    //         $timkiem->where('thongtinxe.tenxe', 'LIKE', "%$tenxe%")->where('dongxe.loaixe', $loaixe);
    //     }

    //     $timkiem = $timkiem->get();

    //     $hangxe = DB::table('hangxe')->select('hangxe.*', 'dongxe.loaixe')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->get();

    //     return view('/sub-index-result', compact('timkiem', 'hangxe'));
    // }

    public function searchData2(Request $request)
    {
        $tenxe = $request->tenxe;

        $timkiem = DB::table('xedangban')
            ->select(
                'xedangban.*',
                'thongtinxe.*',
                'dongxe.tendongxe',
                'hangxe.tenhang',
                'dongxe.loaixe',
                'xedangban.giaban as giagoc',
                'tilegiamgia',
                DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                    ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                END AS giaban'),
            )
            ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
            ->join('dongxe', 'thongtinxe.madx', '=', 'dongxe.madx')
            ->join('hangxe', 'dongxe.mahx', '=', 'hangxe.mahx')
            ->join('ctkhohang', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
            ->where('ctkhohang.trangthai', 'Còn trong kho')
            ->where('hangxe.mahx', $request->id)
            ->get();

        $hangxe = DB::table('hangxe')->select('hangxe.*', 'dongxe.loaixe')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->get();

        return view('/sub-index-result', compact('timkiem', 'hangxe'));
    }
}
