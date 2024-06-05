<?php

namespace App\Http\Controllers;

use App\Models\ChiTietKhoHang;
use App\Models\PhieuNhap;
use App\Models\PhieuXuat;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class KhoHangController extends Controller
{
    public function index(Request $request)
    {
        // Kho hàng
        $makho = $request->makho;
        $maphieuxuat = $this->generateUniqueNumericId_export(10);

        $kho = DB::table('khohang')->select('khohang.*')->orderBy('tenkhohang', 'asc')->get();

        if ($makho == 'all') {
            $ttkho = DB::table('ctkhohang')->join('khohang', 'khohang.makho', 'ctkhohang.makho', 'ctkhohang.trangthai')->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')->select('ctkhohang.*', 'khohang.tenkhohang', 'thongtinxe.*')->where('ctkhohang.trangthai', 'Còn trong kho')->get();
        } else {
            $ttkho = DB::table('ctkhohang')->join('khohang', 'khohang.makho', 'ctkhohang.makho')->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')->select('ctkhohang.*', 'khohang.tenkhohang', 'thongtinxe.*')->where('ctkhohang.makho', $makho)->where('ctkhohang.trangthai', 'Còn trong kho')->get();
        }

        // Phiếu xuất
        $thongtinphieuxuat = DB::table('phieuxuat')->select('phieuxuat.*', 'khohang.*', 'ctkhohang.trangthai')->join('ctphieuxuat', 'ctphieuxuat.maphieuxuat', 'phieuxuat.maphieuxuat')->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')->join('khohang', 'khohang.makho', 'ctkhohang.makho')->distinct()->get();

        // Phiếu nhập
        $thongtinphieunhap = DB::table('phieunhap')->select('phieunhap.*', 'khohang.*', 'ctkhohang.trangthai')->join('ctphieunhap', 'phieunhap.maphieunhap', 'ctphieunhap.maphieunhap')->join('ctkhohang', 'ctphieunhap.machitietkho', 'ctkhohang.machitietkho')->join('khohang', 'khohang.makho', 'ctkhohang.makho')->distinct()->get();

        return view('dashboard.category.warehouse.warehouse-infor', compact('kho', 'ttkho', 'maphieuxuat', 'thongtinphieuxuat', 'thongtinphieunhap'));
    }

    public function index_add_warehouse(){ 

        return view('dashboard.category.warehouse.add-warehouse'); 
    }

    public function add_warehouse(Request $request){
        $rs = $request->validate(
            [
                'makho' => 'required|unique:khohang|max:5',
                'tenkho' => 'required|max:25',
                'diachi' => 'required|max:50'
            ],
            [
                'makho.required' => 'Bạn chưa nhập thông tin mã kho!',
                'makho.unique' => 'Mã kho hàng đã tồn tại!',
                'makho.max' => 'Mã kho hàng không được vượt quá 5 kí tự!',

                'tenkho.required' => 'Bạn chưa nhập thông tin tên kho hàng!',
                'tenkho.max' => 'Tên kho hàng không được vượt quá 25 ký tự!',
                
                'diachi.required' => 'Bạn chưa nhập thông tin địa chỉ kho hàng!',
                'diachi.max' => 'Địa chỉ không được vượt quá 50 ký tự!',
            ]
        );

        if($rs){
            DB::table('khohang')->insert([
            
                'makho' => $request->makho,
                'tenkhohang' => $request->tenkho,
                'diachi' => $request->diachi,
            ]);
            return back()->with('success-them-khohang', 'Kho hàng được thêm mới thành công!');
        }else {
            return back()->withInput();
        }

    }

    public function mutil_index_export(Request $request)
    {
        $dataArray = $request->input('data');
        $manv = Auth::user()->manv;

        $processedData = [];

        foreach ($dataArray as $data) {
            // Giải mã JSON thành mảng liên kết
            $decodedData = json_decode($data, true);

            // Kiểm tra và chuyển đổi các giá trị thành chuỗi nếu tồn tại
            $mactkho = isset($decodedData['mactkho']) ? (string) $decodedData['mactkho'] : null;
            $maphieuxuat = isset($decodedData['maphieuxuat']) ? (string) $decodedData['maphieuxuat'] : null;

            if ($mactkho && $maphieuxuat) {
                // Thêm vào mảng processedData
                $processedData[] = [
                    'mactkho' => $mactkho,
                    'maphieuxuat' => $maphieuxuat,
                ];
            }
        }

        if (!Session::has('visited')) {
            foreach ($processedData as $data) {
                $ctkho = DB::table('ctkhohang')
                    ->select('xedangban.giaban')
                    ->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')
                    ->join('xedangban', 'xedangban.maxe', 'thongtinxe.maxe')
                    ->where('ctkhohang.machitietkho', $data['mactkho'])
                    ->first();

                $check_phieuxuat = DB::table('phieuxuat')->where('maphieuxuat', $maphieuxuat)->exists();

                if ($check_phieuxuat == false) {
                    DB::table('phieuxuat')->insert([
                        'maphieuxuat' => $data['maphieuxuat'],
                        'manv' => $manv,
                        'ngayxuat' => Carbon::now(),
                    ]);
                }

                DB::table('ctphieuxuat')->insert([
                    'machitietphieuxuat' => Str::random(15),
                    'maphieuxuat' => $data['maphieuxuat'],
                    'machitietkho' => $data['mactkho'],
                    'dongia' => $ctkho->giaban,
                ]);

                DB::table('ctkhohang')
                    ->where('machitietkho', $data['mactkho'])
                    ->update([
                        'trangthai' => 'Đang xử lý',
                    ]);
            }
            Session::put('visited', false);
        }

        foreach ($processedData as $data) {
            $phieuxuat = DB::table('phieuxuat')
                ->where('maphieuxuat', $data['maphieuxuat'])
                ->first();
            $ctphieuxuat = DB::table('ctphieuxuat')
                ->select('ctphieuxuat.*', 'ctkhohang.maxe', 'thongtinxe.tenxe', 'xedangban.giaban')
                ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')
                ->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')
                ->join('xedangban', 'thongtinxe.maxe', 'xedangban.maxe')
                ->where('maphieuxuat', $data['maphieuxuat'])
                ->get();
            $ttkho = DB::table('ctkhohang')
                ->join('khohang', 'khohang.makho', 'ctkhohang.makho')
                ->select('ctkhohang.*', 'khohang.tenkhohang', 'khohang.diachi')
                ->where('machitietkho', $data['mactkho'])
                ->get();
            $tongtien_px = DB::table('ctphieuxuat')
                ->selectRaw('SUM(dongia * soluong) as tongtien')
                ->where('maphieuxuat', $data['maphieuxuat'])
                ->first();

            DB::table('phieuxuat')
                ->where('maphieuxuat', $data['maphieuxuat'])
                ->update([
                    'tongtien' => $tongtien_px->tongtien,
                ]);
        }

        return view('dashboard.category.warehouse.export-index', compact('phieuxuat', 'ctphieuxuat', 'ttkho', 'tongtien_px'));
    }

    public function perform_export(Request $request)
    {
        $maphieuxuat = $request->maphieuxuat;

        $dataArray = DB::table('ctphieuxuat')->select('ctkhohang.machitietkho')->join('phieuxuat', 'phieuxuat.maphieuxuat', 'ctphieuxuat.maphieuxuat')->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')->where('ctphieuxuat.maphieuxuat', $maphieuxuat)->get();

        foreach ($dataArray as $item) {
            DB::table('ctkhohang')
                ->where('machitietkho', $item->machitietkho)
                ->update([
                    'trangthai' => 'Đã xuất kho',
                ]);
        }
        return redirect()->route('thongtinkhohang')->with('success-thuchienxuatkho', 'Xuất hàng thành công !');
    }

    public function show_export_detail(Request $request)
    {
        $thongtinphieuxuat = DB::table('phieuxuat')
            ->select('phieuxuat.*', 'khohang.*', 'ctkhohang.*', 'ctphieuxuat.*', 'thongtinxe.maxe', 'thongtinxe.tenxe')
            ->join('ctphieuxuat', 'ctphieuxuat.maphieuxuat', 'phieuxuat.maphieuxuat')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')
            ->join('khohang', 'khohang.makho', 'ctkhohang.makho')
            ->join('thongtinxe', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->where('phieuxuat.maphieuxuat', $request->maphieuxuat)
            ->get();

        return view('dashboard.category.warehouse.receipt-export.export.export-list-infor', compact('thongtinphieuxuat'));
    }

    public function update_export_detail(Request $request)
    {
        $mactphieuxuat = $request->mactphieuxuat;

        $sl = DB::table('ctphieuxuat')->join('ctkhohang', 'ctkhohang.machitietkho', '=', 'ctphieuxuat.machitietkho')->where('ctphieuxuat.machitietphieuxuat', $mactphieuxuat)->value('ctkhohang.soluong');

        request()->validate(
            [
                'soluong' => [
                    'required',
                    function ($attribute, $value, $fail) use ($sl) {
                        if ($value > $sl) {
                            $fail('Số lượng không được lớn hơn ' . $sl);
                        }
                    },
                ],
            ],
            [
                'soluong.required' => 'Vui lòng không để trống.',
            ],
        );

        DB::table('ctphieuxuat')
            ->where('machitietphieuxuat', $mactphieuxuat)
            ->update([
                'soluong' => $request->soluong,
            ]);

        return back()->with('success-capnhat-chitietphieuxuat', 'Thông tin đã được cập nhật lại!');
    }

    public function destroy_export_detail($id)
    {
        DB::table('phieuxuat')->where('maphieuxuat', $id)->delete();
        return redirect()->route('thongtinkhohang')->with('success-xoa-phieuxuat', 'Xóa phiếu xuất thành công!');
    }

    public function warehouse_export_pdf(Request $request)
    {
        $phieuxuat = DB::table('phieuxuat')
            ->where('maphieuxuat', $request->maphieuxuat)
            ->first();

        $ct_phieuxuat = DB::table('ctphieuxuat')
            ->select('ctphieuxuat.*', 'ctkhohang.machitietkho')
            ->join('phieuxuat', 'phieuxuat.maphieuxuat', 'ctphieuxuat.maphieuxuat')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')
            ->where('ctphieuxuat.maphieuxuat', $request->maphieuxuat)
            ->get();

        $ttkho = DB::table('ctkhohang')
            ->join('khohang', 'khohang.makho', 'ctkhohang.makho')
            ->select('ctkhohang.*', 'khohang.tenkhohang', 'khohang.diachi')
            ->whereIn('ctkhohang.machitietkho', $ct_phieuxuat->pluck('machitietkho')->toArray()) // Phương thức pluck('machitietkho') được sử dụng để lấy ra một mảng của tất cả các giá trị từ cột machitietkho của đối tượng $ct_phieuxuat
            ->get();

        $ctphieuxuat = DB::table('ctphieuxuat')
            ->select('ctphieuxuat.*', 'ctkhohang.maxe', 'thongtinxe.tenxe', 'xedangban.giaban')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieuxuat.machitietkho')
            ->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')
            ->join('xedangban', 'thongtinxe.maxe', 'xedangban.maxe')
            ->where('ctphieuxuat.maphieuxuat', $request->maphieuxuat)
            ->get();

        $tongtien_px = DB::table('ctphieuxuat')
            ->selectRaw('SUM(dongia * soluong) as tongtien')
            ->where('maphieuxuat', $request->maphieuxuat)
            ->first();

        $data = [
            'title' => 'Thông tin Phiếu Xuất',
            'phieuxuat' => $phieuxuat,
            'ct_phieuxuat' => $ct_phieuxuat,
            'ttkho' => $ttkho,
            'ctphieuxuat' => $ctphieuxuat,
            'tongtien_px' => $tongtien_px,
        ];

        $pdf = PDF::loadView('dashboard.category.warehouse.receipt-export.export.export-a4', $data);

        return $pdf->stream('myPDF.pdf');
    }

    public function mutil_index_receipt()
    {
        $thongtinxe = DB::table('thongtinxe')
            ->leftJoin('ctkhohang', 'thongtinxe.maxe', '=', 'ctkhohang.maxe') // Lấy dữ liệu ở phía bảng thongtinxe
            ->whereNull('ctkhohang.maxe') //Chỉ lấy các kết quả trong bảng thongtinxe mà bên phía bên bảng ctkhohang không có
            ->select('thongtinxe.*')
            ->get();
        $khohang = DB::table('khohang')->get();

        return view('dashboard.category.warehouse.receipt-index', compact('thongtinxe', 'khohang'));
    }

    public function mutil_store_receipt(Request $request)
    {
        $manv = Auth::user()->manv;

        $maphieunhap = $this->generateUniqueNumericId_receipt(10);

        $makho = $request->khohang;
        $thongtinxe = $request->thongtinxe;
        $gianhapkho = $request->gianhapkho;
        $soluong = $request->soluong;

        $request->validate(
            [
                'khohang' => 'required',
                'thongtinxe.*' => 'required',
                'soluong.*' => 'required|numeric',
                'gianhapkho.*' => 'required|numeric',
            ],
            [
                'khohang.required' => 'Vui lòng chọn kho muốn nhập hàng!',
                'thongtinxe.*.required' => 'Vui lòng chọn mặt hàng cần nhập!',
                'gianhapkho.*.required' => 'Vui lòng nhập giá tiền nhập kho!',
                'soluong.*.required' => 'Vui lòng nhập số lượng cần nhập!',
                'soluong.*.numeric' => 'Số lượng phải là một số!',
                'gianhapkho.*.numeric' => 'Giá nhập kho phải là một số!',
            ],
        );

        $processedData = [];
        $mactkho = [];
        $mactphieunhap = [];

        $count = count($thongtinxe);
        for ($i = 0; $i < $count; $i++) {
            $mactkho[] = $this->generateUniqueNumericId_detail_warehouse(10);
            $mactphieunhap[] = Str::random(15);
        }

        $processedData[] = [
            'thongtinxe' => $thongtinxe,
            'gianhapkho' => $gianhapkho,
            'soluong' => $soluong,
            'mactkho' => $mactkho,
            'mactphieunhap' => $mactphieunhap,
        ];

        // /dd($processedData);

        DB::table('phieunhap')->insert([
            'maphieunhap' => $maphieunhap,
            'manv' => $manv,
            'ngaynhap' => Carbon::now(),
        ]);

        $ngaynhapkho = DB::table('phieunhap')->select('ngaynhap')->where('maphieunhap', $maphieunhap)->first();

        foreach ($processedData as $data) {
            $count = count($data['thongtinxe']);
            for ($i = 0; $i < $count; $i++) {
                DB::table('ctkhohang')->insert([
                    'machitietkho' => $data['mactkho'][$i],
                    'makho' => $makho,
                    'maxe' => $data['thongtinxe'][$i],
                    'soluong' => $data['soluong'][$i],
                    'gianhapkho' => $data['gianhapkho'][$i],
                    'ngaynhapkho' => $ngaynhapkho->ngaynhap,
                    'trangthai' => "Còn trong kho",
                ]);

                DB::table('ctphieunhap')->insert([
                    'machitietphieunhap' => $data['mactphieunhap'][$i],
                    'machitietkho' => $data['mactkho'][$i],
                    'maphieunhap' => $maphieunhap,
                    'dongia' => $data['gianhapkho'][$i],
                    'soluong' => $data['soluong'][$i],
                ]);
            }
        }

        $thanhtien = DB::table('ctphieunhap')->selectRaw('SUM(dongia*soluong) as tongtien')->where('maphieunhap', $maphieunhap)->first();

        //dd($thanhtien);

        DB::table('phieunhap')
            ->where('maphieunhap', $maphieunhap)
            ->update([
                'thanhtien' => $thanhtien->tongtien,
            ]);

        return back()->with('success-tao-phieunhap', 'Phiếu nhập được tạo thành công!');
    }

    public function show_receipt_detail(Request $request)
    {
        $thongtinphieunhap = DB::table('phieunhap')
            ->select('phieunhap.*', 'khohang.*', 'ctkhohang.*', 'ctphieunhap.*', 'thongtinxe.maxe', 'thongtinxe.tenxe')
            ->join('ctphieunhap', 'ctphieunhap.maphieunhap', 'phieunhap.maphieunhap')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieunhap.machitietkho')
            ->join('khohang', 'khohang.makho', 'ctkhohang.makho')
            ->join('thongtinxe', 'ctkhohang.maxe', 'thongtinxe.maxe')
            ->where('phieunhap.maphieunhap', $request->maphieunhap)
            ->get();

        return view('dashboard.category.warehouse.receipt-export.receipt.receipt-list-infor', compact('thongtinphieunhap'));
    }

    public function warehouse_receipt_pdf(Request $request)
    {
        $phieunhap = DB::table('phieunhap')
            ->where('maphieunhap', $request->maphieunhap)
            ->first();

        $ct_phieunhap = DB::table('ctphieunhap')
            ->select('ctphieunhap.*', 'ctkhohang.machitietkho')
            ->join('phieunhap', 'phieunhap.maphieunhap', 'ctphieunhap.maphieunhap')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieunhap.machitietkho')
            ->where('ctphieunhap.maphieunhap', $request->maphieunhap)
            ->get();

        $ttkho = DB::table('ctkhohang')
            ->join('khohang', 'khohang.makho', 'ctkhohang.makho')
            ->select('ctkhohang.*', 'khohang.tenkhohang', 'khohang.diachi')
            ->whereIn('ctkhohang.machitietkho', $ct_phieunhap->pluck('machitietkho')->toArray()) // Phương thức pluck('machitietkho') được sử dụng để lấy ra một mảng của tất cả các giá trị từ cột machitietkho của đối tượng $ct_phieunhap
            ->get();

        $ctphieunhap = DB::table('ctphieunhap')
            ->select('ctphieunhap.*', 'ctkhohang.maxe', 'thongtinxe.tenxe')
            ->join('ctkhohang', 'ctkhohang.machitietkho', 'ctphieunhap.machitietkho')
            ->join('thongtinxe', 'thongtinxe.maxe', 'ctkhohang.maxe')
            ->where('ctphieunhap.maphieunhap', $request->maphieunhap)
            ->get();

        $tongtien_px = DB::table('ctphieunhap')
            ->selectRaw('SUM(dongia * soluong) as tongtien')
            ->where('maphieunhap', $request->maphieunhap)
            ->first();

        $data = [
            'title' => 'Thông tin Phiếu Xuất',
            'phieunhap' => $phieunhap,
            'ct_phieunhap' => $ct_phieunhap,
            'ttkho' => $ttkho,
            'ctphieunhap' => $ctphieunhap,
            'tongtien_px' => $tongtien_px,
        ];

        $pdf = PDF::loadView('dashboard.category.warehouse.receipt-export.receipt.receipt-a4', $data);

        return $pdf->stream('myPDF.pdf');
    }

    private function generateUniqueNumericId_detail_warehouse($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (ChiTietKhoHang::where('machitietkho', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }

    private function generateUniqueNumericId_export($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (PhieuXuat::where('maphieuxuat', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }

    private function generateUniqueNumericId_receipt($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (PhieuNhap::where('maphieunhap', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }

    private function generateRandomNumber($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return str_pad(rand($min, $max), $length, '0', STR_PAD_LEFT);
    }
}
