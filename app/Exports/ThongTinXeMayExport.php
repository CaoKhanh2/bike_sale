<?php

namespace App\Exports;

use App\Models\ThongTinXe;
use App\Models\ThongSoKyThuatXeMay;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

class ThongTinXeMayExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return DB::table('thongtinxe')
        ->join('dongxe', 'thongtinxe.madx', '=', 'dongxe.madx')
        ->join('hangxe', 'dongxe.mahx', '=', 'hangxe.mahx')
        ->select(
            'thongtinxe.maxe',
            'thongtinxe.tenxe AS tenxe',
            'dongxe.tendongxe AS tendongxe',
            'hangxe.tenhang AS tenhang'
        )
        ->orderBy('thongtinxe.maxe', 'asc');
    }

    public function headings(): array
    {
        return [
            'Mã Xe',
            'Tên Xe',
            'Tên Dòng Xe',
            'Tên Hãng Xe'
        ];
    }
}
