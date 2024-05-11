<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoThiController extends Controller
{
    public function salesChart(Request $request)
    {
        $tungay = $request->tungay;
        $denngay = $request->denngay;

        $thangTungay = date('Y-m', strtotime($tungay));
        $thangDenngay = date('Y-m', strtotime($denngay));
        
        $monthlySales = DonHang::selectRaw('MONTH(ngaytaodon) as month, YEAR(ngaytaodon) as year, SUM(tongtien) as total_sales')
            ->whereRaw("DATE_FORMAT(ngaytaodon, '%Y-%m') >= '$thangTungay' AND DATE_FORMAT(ngaytaodon, '%Y-%m') <= '$thangDenngay'")
            ->groupBy('month','year')
            ->orderBy('month')
            ->get();

        // Tạo mảng dữ liệu cho biểu đồ
        $months = [];
        $sales = [];

        foreach ($monthlySales as $item) {
            $months[] = 'Tháng ' . $item->month.'/'.$item->year;
            $sales[] = $item->total_sales;
        }

        return view('dashboard.report.sales-situation', compact('months', 'sales'));
    }
}
