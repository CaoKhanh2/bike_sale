<?php

namespace App\Exports;

use App\Models\DonHang;
use App\Models\ThongTinXe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TinhHinhBanHangExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    
    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('/Image/logo/logo.png'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('B3');

    //     return $drawing;
    // }

    public function query()
    {
        return DB::table('donhang')
            ->join('giohang', 'donhang.magh', '=', 'giohang.magh')
            ->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')
            ->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')
            ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
            ->select(
                'xedangban.maxe',
                'thongtinxe.tenxe',
                'donhang.ngaytaodon',
                'donhang.tongtien',
                
            )->orderBy('donhang.madh', 'asc');;
    }

    public function headings(): array
    {
        return [
            'Mã Xe',
            'Tên Xe',
            'Ngày Bán',
            'Thành Tiền'
        ];
    }

}
