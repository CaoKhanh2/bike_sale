<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuContrller extends Controller
{
    public function data()
    {
        $data = [
            ['macv' => 'CV-01', 'tencv' => 'Nhân viên bán hàng', 'mota' => ''],
            ['macv' => 'CV-02', 'tencv' => 'Quản lý', 'mota' => ''],
        ];

        ChucVu::insert($data);
    }
}
