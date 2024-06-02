<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithDefaultStyles;


use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Events\AfterSheet;


use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TinhHinhBanHangExport implements WithDefaultStyles, WithDrawings, WithMapping, WithEvents, WithStyles
{

    protected $thongtintbanhang;

    public function __construct($thongtintbanhang)
    {
        $this->thongtintbanhang = $thongtintbanhang;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/Image/logo/logo.png'));
        $drawing->setHeight(120);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    // public function collection(): Collection
    // {
    //     $data = DB::table('donhang')
    //         ->join('giohang', 'donhang.magh', '=', 'giohang.magh')
    //         ->join('ctgiohang', 'giohang.magh', '=', 'ctgiohang.magh')
    //         ->join('xedangban', 'ctgiohang.maxedangban', '=', 'xedangban.maxedangban')
    //         ->join('thongtinxe', 'xedangban.maxe', '=', 'thongtinxe.maxe')
    //         ->join('dongxe', 'dongxe.madx', '=', 'thongtinxe.madx')
    //         ->select('xedangban.maxe', 'dongxe.loaixe', 'thongtinxe.tenxe', 'donhang.ngaytaodon', 'donhang.tongtien')
    //         ->orderBy('donhang.madh', 'asc')
    //         ->get()
    //         ->map(function ($item, $index) {
    //             $ngaytaodon = Carbon::parse($item->ngaytaodon);
    //             $item->ngaytaodon = $ngaytaodon->format('d/m/Y');
    //             $item->stt = $index + 1; // Add 'stt' field
    //             return $item;
    //         });

    //     // Add empty rows
    //     $emptyRows = collect(array_fill(0, 10, (object) ['stt' => '', 'maxe' => '', 'loaixe' => '', 'tenxe' => '', 'ngaytaodon' => '', 'tongtien' => '']));
    //     return $emptyRows->concat($data);
    // }

    public function map($row): array
    {
        return [$row->stt, $row->maxe, $row->loaixe, $row->tenxe, $row->ngaytaodon, $row->tongtien];
    }

    // Kẻ viền cho toàn bộ bảng
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A10:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        return null;
    }

    public function defaultStyles(Style $style): array
    {
        $styleArray = [
            'font' => [
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        return $styleArray;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(15);
                $event->sheet->getColumnDimension('F')->setWidth(15);


                // Tên công ty
                $event->sheet->mergeCells('D1:F1');
                $event->sheet->setCellValue('D1', 'Công ty trách nhiệm hữu hạn thương mại dịch vụ kỹ thuật Toàn Phương');
                $event->sheet->getRowDimension(1)->setRowHeight(33);

                $event->sheet->getStyle('D1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '366092']],
                    //'fill' => ['fillType' => Fill::FILL_SOLID],
                    'alignment' => ['wrapText' => true],
                ]);

                // Địa chỉ công ty
                $event->sheet->mergeCells('D2:F2');
                $event->sheet->setCellValue('D2', 'Địa chỉ: Số 1/115 đường Máng Nước, thôn Cái Tắt, Xã An Đồng, Huyện An Dương, Thành phố Hải Phòng');
                $event->sheet->getRowDimension(2)->setRowHeight(30);

                $event->sheet->getStyle('D2')->applyFromArray([
                    'font' => ['size' => 12],
                    //'fill' => ['fillType' => Fill::FILL_SOLID],
                    'alignment' => ['wrapText' => true],
                ]);

                // Số điện thoại
                $event->sheet->mergeCells('D3:F3');
                $event->sheet->setCellValue('D3', 'Hotline: 0225.359.3816');

                // Email
                $event->sheet->mergeCells('D4:F4');
                $event->sheet->setCellValue('D4', 'Email: ');

                //Website
                $event->sheet->mergeCells('D5:F5');
                $event->sheet->setCellValue('D5', 'Website: https://xeToT.com/');

                //Tiêu đề
                $event->sheet->mergeCells('B7:E7');
                $event->sheet->setCellValue('B7', 'BÁO CÁO BÁN HÀNG');

                $event->sheet->getStyle('B7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '244062']],
                    //'fill' => ['fillType' => Fill::FILL_SOLID],
                ]);

                // Set the headings in the 10th row
                $event->sheet->insertNewRowBefore(10, 1);

                $event->sheet->mergeCells('A10:A11');
                $event->sheet->mergeCells('B10:B11');
                $event->sheet->mergeCells('C10:C11');
                $event->sheet->mergeCells('D10:D11');
                $event->sheet->mergeCells('E10:E11');
                $event->sheet->mergeCells('F10:F11');


                $event->sheet->getStyle('A10:F10')->applyFromArray([
                    'font' => ['bold' => true, 'name' => 'Time New Roman', 'size' => 12],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8DB4E2']],
                ]);
                $event->sheet->getStyle('A10:F10')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Màu đen
                        ],
                    ],
                ]);
                
                $event->sheet->setCellValue('A10', 'STT');
                $event->sheet->setCellValue('B10', 'Mã xe');
                $event->sheet->setCellValue('C10', 'Loại xe');
                $event->sheet->setCellValue('D10', 'Tên xe');
                $event->sheet->setCellValue('E10', 'Ngày tạo đơn');
                $event->sheet->setCellValue('F10', 'Tổng tiền');

                $thongtintbanhang = $this->thongtintbanhang;

                // Thiết lập dòng tiêu đề từ dữ liệu trong view
                $count = 12;
                $index = 1;
                foreach ($thongtintbanhang as $i) {
                    $event->sheet->setCellValue('A' . $count, $index);
                    $event->sheet->setCellValue('B' . $count, $i->maxedangban);
                    $event->sheet->setCellValue('C' . $count, $i->loaixe);
                    $event->sheet->setCellValue('D' . $count, $i->tenxe);
                    $event->sheet->setCellValue('E' . $count, date('d-m-Y', strtotime($i->ngaytaodon)));
                    $event->sheet->setCellValue('F' . $count, $i->tongtien);
                    $count++; $index++;
                }

                $lastRow = $event->sheet->getHighestRow();

                $newRow = $lastRow + 4;

                $event->sheet->setCellValue('E' . $newRow, "Ngày " . now()->format('d') . " tháng " . now()->format('m') . " năm " . now()->format('Y'));

                $event->sheet->setCellValue('B' . $newRow+2, "Người lập biểu");
                $event->sheet->setCellValue('B' . $newRow+3, "(Ký họ và tên)");

                $event->sheet->setCellValue('E' . $newRow+2, "Giám đốc");
                $event->sheet->setCellValue('E' . $newRow+3, "(Ký họ và tên)");

                $event->sheet->getStyle('A' . $newRow . ':F' . $newRow+2)->applyFromArray([
                    'font' => ['bold' => true],
                ]);
            },
        ];
    }
}
