<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TinhHinhBanHangExport;
use App\Exports\TinhHinhThuMuaExport;
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

        if (empty($tungay) && empty($denngay)) {
            $doanhthuthang = DonHang::selectRaw('MONTH(ngaytaodon) as thang, YEAR(ngaytaodon) as nam, SUM(tongtien) as tongdoanhthu')
                                ->join('giohang', 'donhang.magh', '=', 'giohang.magh')
                                ->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')
                                ->where('donhang.trangthai', 'Đã hoàn thành')
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

            $tu_ngay = date('Y-m-d', strtotime($tungay));
            $den_ngay = date('Y-m-d', strtotime($denngay));

            $thongtintbanhang = DB::table('donhang')->select('donhang.*', 'giohang.magh', 'ctgiohang.maxedangban', 'xedangban.maxedangban', 'thongtinxe.tenxe')->join('giohang', 'donhang.magh', '=', 'giohang.magh')->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')->where('donhang.trangthai', 'Đã hoàn thành')->get();
        } else {
            $thangTungay = date('Y-m', strtotime($tungay));
            $thangDenngay = date('Y-m', strtotime($denngay));

            $doanhthuthang = DonHang::selectRaw('MONTH(ngaytaodon) as thang, YEAR(ngaytaodon) as nam, SUM(tongtien) as tongdoanhthu')
                ->whereRaw("DATE_FORMAT(ngaytaodon, '%Y-%m') >= '$thangTungay' AND DATE_FORMAT(ngaytaodon, '%Y-%m') <= '$thangDenngay'")
                ->where('donhang.trangthai', 'Đã hoàn thành')
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

            $tu_ngay = date('Y-m-d', strtotime($tungay));
            $den_ngay = date('Y-m-d', strtotime($denngay));

            $thongtintbanhang = DB::table('donhang')
                ->select('donhang.*', 'giohang.magh', 'ctgiohang.maxedangban', 'xedangban.maxedangban', 'thongtinxe.tenxe')
                ->join('giohang', 'donhang.magh', '=', 'giohang.magh')
                ->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')
                ->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')
                ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
                ->where('donhang.trangthai', 'Đã hoàn thành')
                ->whereDate('donhang.ngaytaodon', '>=', $tu_ngay) // Lọc theo ngày bắt đầu
                ->whereDate('donhang.ngaytaodon', '<=', $den_ngay) // Lọc theo ngày kết thúc
                ->get();
        }

        //$thongtintbanhang = DB::table('donhang')->get();

        return view('dashboard.report.sales-situation', compact('giatien', 'thang', 'thongtintbanhang'));
    }
    public function export_report_sales_situation(Request $request)
    {
        $tungay = $request->tungay;
        $denngay = $request->denngay;

        $tu_ngay = date('Y-m-d', strtotime($tungay));
        $den_ngay = date('Y-m-d', strtotime($denngay));

        if (empty($tungay) && empty($denngay)) {
            $thongtintbanhang = DB::table('donhang')->select('donhang.*', 'giohang.magh', 'ctgiohang.maxedangban', 'xedangban.maxedangban', 'thongtinxe.tenxe', 'dongxe.loaixe')->join('giohang', 'donhang.magh', '=', 'giohang.magh')->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')->join('dongxe', 'dongxe.madx', '=', 'thongtinxe.madx')->where('donhang.trangthai', 'Đã hoàn thành')->get();
        } else {
            $thongtintbanhang = DB::table('donhang')
                ->select('donhang.*', 'giohang.magh', 'ctgiohang.maxedangban', 'xedangban.maxedangban', 'thongtinxe.tenxe', 'dongxe.loaixe')
                ->join('giohang', 'donhang.magh', '=', 'giohang.magh')
                ->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')
                ->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')
                ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
                ->join('dongxe', 'dongxe.madx', '=', 'thongtinxe.madx')
                ->where('donhang.trangthai', 'Đã hoàn thành')
                ->whereDate('donhang.ngaytaodon', '>=', $tu_ngay) // Lọc theo ngày bắt đầu
                ->whereDate('donhang.ngaytaodon', '<=', $den_ngay) // Lọc theo ngày kết thúc
                ->get();
        }

        $export = new TinhHinhBanHangExport($thongtintbanhang);

        return Excel::download($export, 'bao_cao_ban_hang.xlsx');
    }

    public function purchasingChart()
    {
        return view('dashboard.report.graph.chart-2');
        // return response()->json($thumuaxe);
    }

    public function data_purchasing_situation(Request $request)
    {
        $startYear = $request->tunam;
        $endYear = $request->dennam;
        $quater = $request->quy;

        $request->session()->put('tunam', $request->input('tunam'));
        $request->session()->put('dennam', $request->input('dennam'));
        $request->session()->put('quy', $request->input('quy'));

        if ($quater == 0) {
            $thumuaxe = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('COUNT(*) as total_vehicles'))
                ->where('trangthaipheduyet', 'Duyệt') // Thêm điều kiện trạng thái
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        } else {
            $thumuaxe = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('COUNT(*) as total_vehicles'))
                ->where('trangthaipheduyet', 'Duyệt') // Thêm điều kiện trạng thái
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->where(DB::raw('QUARTER(ngaydk)'), $quater)
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        }

        $nam = [];
        $quy = [];
        $tongxe = [];

        foreach ($thumuaxe as $i) {
            $nam[] = $i->year;
            $quy[] = $i->quarter;
            $tongxe[] = $i->total_vehicles;
        }

        if ($quater == 0) {
            $thongtinxethumua = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN 1 ELSE 0 END) AS total_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN 1 ELSE 0 END) AS total_xedapdien'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN giaban ELSE 0 END) AS total_giaban_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN giaban ELSE 0 END) AS total_giaban_xedapdien'))
                ->where('trangthaipheduyet', 'Duyệt')
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        } else {
            $thongtinxethumua = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN 1 ELSE 0 END) AS total_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN 1 ELSE 0 END) AS total_xedapdien'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN giaban ELSE 0 END) AS total_giaban_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN giaban ELSE 0 END) AS total_giaban_xedapdien'))
                ->where('trangthaipheduyet', 'Duyệt')
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->where(DB::raw('QUARTER(ngaydk)'), $quater)
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        }

        return view('dashboard.report.purchasing-situation', compact('nam', 'quy', 'tongxe', 'thongtinxethumua'));
    }

    public function export_report_purchasing_situation(Request $request)
    {
        $startYear = $request->tunam;
        $endYear = $request->dennam;
        $quater = $request->quy;

        if ($quater == 0) {
            $thongtinxethumua = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN 1 ELSE 0 END) AS total_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN 1 ELSE 0 END) AS total_xedapdien'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN giaban ELSE 0 END) AS total_giaban_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN giaban ELSE 0 END) AS total_giaban_xedapdien'))
                ->where('trangthaipheduyet', 'Duyệt')
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        } else {
            $thongtinxethumua = DB::table('xedangkythumua')
                ->select(DB::raw('YEAR(ngaydk) as year'), DB::raw('QUARTER(ngaydk) as quarter'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN 1 ELSE 0 END) AS total_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN 1 ELSE 0 END) AS total_xedapdien'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe máy%" THEN giaban ELSE 0 END) AS total_giaban_xemay'), DB::raw('SUM(CASE WHEN ghichu LIKE "%Xe đạp điện%" THEN giaban ELSE 0 END) AS total_giaban_xedapdien'))
                ->where('trangthaipheduyet', 'Duyệt')
                ->whereBetween(DB::raw('YEAR(ngaydk)'), [$startYear, $endYear])
                ->where(DB::raw('QUARTER(ngaydk)'), $quater)
                ->groupBy(DB::raw('YEAR(ngaydk)'), DB::raw('QUARTER(ngaydk)'))
                ->orderBy('year')
                ->orderBy('quarter')
                ->get();
        }

        // Create the export instance
        $export = new TinhHinhThuMuaExport($thongtinxethumua);

        return Excel::download($export, 'tinh_hinh_thu_mua_xe.xlsx');
    }
}
