<?php

namespace App\Exports;

use App\Models\ChiTietKhoHang;
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

class TonKhoExport implements WithEvents, WithDrawings, WithDefaultStyles
{   
    protected $tonkho;
    protected $tenkho;

    public function __construct($tonkho, $tenkho)
    {
        $this->tonkho = $tonkho;
        $this->tenkho = $tenkho;
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
                $event->sheet->mergeCells('C1:F1');
                $event->sheet->setCellValue('C1', 'Công ty trách nhiệm hữu hạn thương mại dịch vụ kỹ thuật Toàn Phương');
                $event->sheet->getRowDimension(1)->setRowHeight(33);

                $event->sheet->getStyle('C1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '366092']],
                    'alignment' => ['wrapText' => true],
                ]);

                // $event->sheet->getColumnDimension('F')->setWidth(25);
                // Địa chỉ công ty
                $event->sheet->mergeCells('C2:F2');
                $event->sheet->setCellValue('C2', 'Địa chỉ: Số 1/115 đường Máng Nước, thôn Cái Tắt, Xã An Đồng, Huyện An Dương, Thành phố Hải Phòng');
                $event->sheet->getRowDimension(2)->setRowHeight(30);

                $event->sheet->getStyle('C2')->applyFromArray([
                    'font' => ['size' => 12],
                    'alignment' => ['wrapText' => true],
                ]);

                // Số điện thoại
                $event->sheet->mergeCells('C3:F3');
                $event->sheet->setCellValue('C3', 'Hotline: 0225.359.3816');

                // Email
                $event->sheet->mergeCells('C4:F4');
                $event->sheet->setCellValue('C4', 'Email: ');

                // Website
                $event->sheet->mergeCells('C5:F5');
                $event->sheet->setCellValue('C5', 'Website: https://xeToT.com/');

                // Tiêu đề
                $event->sheet->mergeCells('A7:F7');
                $event->sheet->setCellValue('A7', 'Báo cáo tồn kho');

                $event->sheet->getStyle('A7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 22, 'color' => ['rgb' => '244062']],
                ]);

                $tenkho = $this->tenkho;
                $ngay = date("t/m/Y", strtotime($tenkho->ngaynhapkho));

                $event->sheet->mergeCells('A8:F8');
                $event->sheet->setCellValue('A8', 'Ngày: '.$ngay);

                $event->sheet->mergeCells('A9:F9');
                $event->sheet->setCellValue('A9', 'Kho: '.$tenkho->tenkhohang);

                // Độ rộng của cột
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);


                $event->sheet->getStyle('A11:F11')->applyFromArray([
                    'font' => ['bold' => true, 'name' => 'Time New Roman', 'size' => 12],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8DB4E2']],
                ]);
                $event->sheet->getStyle('A11:F11')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Màu đen
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A11:F11')->applyFromArray([
                    'font' => ['bold' => true],
                ]);

                // Chèn dòng trống và merge cell
                $event->sheet->insertNewRowBefore(13, 1);
                // Thiết lập tiêu đề cho các cột
                $event->sheet->mergeCells('A11:A12');
                $event->sheet->setCellValue('A11', 'STT');

                $event->sheet->mergeCells('B11:B12');
                $event->sheet->setCellValue('B11', 'Mã xe');

                $event->sheet->mergeCells('C11:C12');
                $event->sheet->setCellValue('C11', 'Tên xe');

                $event->sheet->mergeCells('D11:D12');
                $event->sheet->setCellValue('D11', 'ĐVT');

                $event->sheet->mergeCells('E11:E12');
                $event->sheet->setCellValue('E11', 'Số lượng');

                $event->sheet->mergeCells('F11:F12');
                $event->sheet->setCellValue('F11', 'Giá tiền');

                $tonkho = $this->tonkho;

                // Thiết lập dòng tiêu đề từ dữ liệu trong view
                $count = 13;
                $k = 1;
                foreach ($tonkho as $i) {
                    $event->sheet->setCellValue('A' . $count, $k++);
                    $event->sheet->setCellValue('B' . $count, $i->maxe);
                    $event->sheet->setCellValue('C' . $count, $i->tenxe);
                    $event->sheet->setCellValue('D' . $count, 'chiếc');
                    $event->sheet->setCellValue('E' . $count, $i->soluong);
                    $event->sheet->setCellValue('F' . $count, $i->gianhapkho);
                    $count++;
                }

                $lastRow = $count - 1;
                $event->sheet->getStyle('A11:F' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], // Màu đen
                        ],
                    ],
                ]);

                $lastRow = $event->sheet->getHighestRow();

                $newRow = $lastRow + 3;

                $event->sheet->setCellValue('E' . $newRow, 'Ngày ' . now()->format('d') . ' tháng ' . now()->format('m') . ' năm ' . now()->format('Y'));

                $event->sheet->setCellValue('B' . $newRow + 2, 'Người lập biểu');
                $event->sheet->setCellValue('B' . $newRow + 3, '(Ký họ và tên)');

                $event->sheet->setCellValue('E' . $newRow + 2, 'Giám đốc');
                $event->sheet->setCellValue('E' . $newRow + 3, '(Ký họ và tên)');

                $event->sheet->getStyle('A' . $newRow . ':F' . $newRow + 2)->applyFromArray([
                    'font' => ['bold' => true],
                ]);
            },
        ];
    }
}
