<?php

namespace App\Exports;

use App\Models\XeDangBan;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TinhHinhThuMuaExport implements WithEvents, WithDrawings, WithDefaultStyles
{
    protected $thongtinxethumua;

    public function __construct($thongtinxethumua)
    {
        $this->thongtinxethumua = $thongtinxethumua;
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('C1:E1');
                $event->sheet->setCellValue('C1', 'Công ty trách nhiệm hữu hạn thương mại dịch vụ kỹ thuật Toàn Phương');
                $event->sheet->getRowDimension(1)->setRowHeight(33);

                $event->sheet->getStyle('C1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '366092']],
                    'alignment' => ['wrapText' => true],
                ]);

                // $event->sheet->getColumnDimension('F')->setWidth(25);
                // Địa chỉ công ty
                $event->sheet->mergeCells('C2:E2');
                $event->sheet->setCellValue('C2', 'Địa chỉ: Số 1/115 đường Máng Nước, thôn Cái Tắt, Xã An Đồng, Huyện An Dương, Thành phố Hải Phòng');
                $event->sheet->getRowDimension(2)->setRowHeight(30);

                $event->sheet->getStyle('C2')->applyFromArray([
                    'font' => ['size' => 12],
                    'alignment' => ['wrapText' => true],
                ]);

                // Số điện thoại
                $event->sheet->mergeCells('C3:E3');
                $event->sheet->setCellValue('C3', 'Hotline: 0225.359.3816');

                // Email
                $event->sheet->mergeCells('C4:E4');
                $event->sheet->setCellValue('C4', 'Email: ');

                // Website
                $event->sheet->mergeCells('C5:E5');
                $event->sheet->setCellValue('C5', 'Website: https://xeToT.com/');

                // Tiêu đề
                $event->sheet->mergeCells('A7:E7');
                $event->sheet->setCellValue('A7', 'BÁO CÁO THU MUA XE');

                $event->sheet->getStyle('A7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '244062']],
                ]);

                // Độ rộng của cột
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);

                $event->sheet->getStyle('A9:E9')->applyFromArray([
                    'font' => ['bold' => true, 'name' => 'Time New Roman', 'size' => 12],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8DB4E2']],
                ]);
                $event->sheet->getStyle('A9:E9')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Màu đen
                        ],
                    ],
                ]);
                $event->sheet->getStyle('B10:E10')->applyFromArray([
                    'font' => ['bold' => true],
                ]);

                // Chèn dòng trống và merge cell
                $event->sheet->insertNewRowBefore(11, 1);

                // Thiết lập tiêu đề cho các cột
                $event->sheet->mergeCells('A9:A10');
                $event->sheet->setCellValue('A9', 'Thời gian');

                $event->sheet->mergeCells('B9:C9');
                $event->sheet->setCellValue('B9', 'Xe máy');
                $event->sheet->setCellValue('B10', 'Số lượng');
                $event->sheet->setCellValue('C10', 'Giá bán');

                $event->sheet->mergeCells('D9:E9');
                $event->sheet->setCellValue('D9', 'Xe đạp điện');
                $event->sheet->setCellValue('D10', 'Số lượng');
                $event->sheet->setCellValue('E10', 'Giá bán');

                $thongtinxethumua = $this->thongtinxethumua;

                // Thiết lập dòng tiêu đề từ dữ liệu trong view
                $count = 11;
                foreach ($thongtinxethumua as $i) {
                    $event->sheet->setCellValue('A' . $count, $i->year .' Quý ' .  $i->quarter);
                    $event->sheet->setCellValue('B' . $count, $i->total_xemay);
                    $event->sheet->setCellValue('C' . $count, $i->total_giaban_xemay);
                    $event->sheet->setCellValue('D' . $count, $i->total_xedapdien);
                    $event->sheet->setCellValue('E' . $count, $i->total_giaban_xedapdien);
                    $count++;
                }

                $lastRow = $count - 1;
                $event->sheet->getStyle('A9:E' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Màu đen
                        ],
                    ],
                ]);

                $lastRow = $event->sheet->getHighestRow();

                $newRow = $lastRow + 3;

                $event->sheet->setCellValue('D' . $newRow, 'Ngày ' . now()->format('d') . ' tháng ' . now()->format('m') . ' năm ' . now()->format('Y'));

                $event->sheet->setCellValue('B' . $newRow + 2, 'Người lập biểu');
                $event->sheet->setCellValue('B' . $newRow + 3, '(Ký họ và tên)');

                $event->sheet->setCellValue('D' . $newRow + 2, 'Giám đốc');
                $event->sheet->setCellValue('D' . $newRow + 3, '(Ký họ và tên)');

                $event->sheet->getStyle('A' . $newRow . ':F' . $newRow + 2)->applyFromArray([
                    'font' => ['bold' => true],
                ]);
            },
        ];
    }
}
