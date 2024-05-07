<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;

class DoThiController extends Controller
{
    public function salesChart()
    {
        $monthlySales = DonHang::selectRaw('MONTH(ngaytaodon) as month, SUM(tongtien) as total_sales')->groupBy('month')->orderBy('month')->get();

        // Tạo mảng dữ liệu cho biểu đồ
        $months = [];
        $sales = [];

        foreach ($monthlySales as $monthlySale) {
            $months[] = 'Tháng ' . $monthlySale->month;
            $sales[] = $monthlySale->total_sales;
        }

        return view('dashboard.report.graph.chart_1', compact('months', 'sales'));
    }
}
