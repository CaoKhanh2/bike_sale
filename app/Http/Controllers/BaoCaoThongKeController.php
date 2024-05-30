<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TinhHinhBanHangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

use App\Models\DonHang;


class BaoCaoThongKeController extends Controller
{
    public function data_sales_situation(Request $request)
    {
        $tungay = $request->tungay;
        $denngay = $request->denngay;

        $request->session()->put('tungay', $request->input('tungay'));
        $request->session()->put('denngay', $request->input('denngay'));

        $thangTungay = date('Y-m', strtotime($tungay));
        $thangDenngay = date('Y-m', strtotime($denngay));

        $doanhthuthang = DonHang::selectRaw('MONTH(ngaytaodon) as thang, YEAR(ngaytaodon) as nam, SUM(tongtien) as tongdoanhthu')
            ->whereRaw("DATE_FORMAT(ngaytaodon, '%Y-%m') >= '$thangTungay' AND DATE_FORMAT(ngaytaodon, '%Y-%m') <= '$thangDenngay'")
            ->groupBy('thang', 'nam')
            ->orderBy('thang')
            ->get();

        // Tạo mảng dữ liệu cho biểu đồ
        $thang = [];
        $giatien = [];

        foreach ($doanhthuthang as $i) {
            $thang[] = 'Tháng ' . $i->thang . '/' . $i->nam;
            $giatien[] = $i->tongdoanhthu;
        }


        $thongtintbanhang = DB::select("SELECT donhang.*, giohang.magh, ctgiohang.maxedangban, xedangban.maxedangban, thongtinxe.tenxe FROM donhang
                        INNER JOIN giohang ON donhang.magh = giohang.magh
                        INNER JOIN ctgiohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON ctgiohang.maxedangban = xedangban.maxedangban
                        INNER JOIN thongtinxe ON xedangban.maxe = thongtinxe.maxe");

        //$thongtintbanhang = DB::table('donhang')->get();

        return view('dashboard.report.sales-situation', compact('giatien', 'thang', 'thongtintbanhang'));
    }
    public function export_report_sales_situation()
    {
        return Excel::download(new TinhHinhBanHangExport, 'bao_cao_ban_hang.xlsx');
        
    }

    public function data_purchasing_situation() {

        return view('dashboard.report.purchasing-situation');

    }
}
