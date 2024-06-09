<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\ThongBaoDuyetXeThuMuaMail;
use App\Mail\ThongBaoTuChoiXeThuMuaMail;
use Mail;

class XeDangKyThuMuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dstm_waiting = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('trangthaipheduyet', 'Chờ duyệt')->orderBy('ngaydk', 'desc')->get();
        //
        $dstm_procces = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd', 'nhanvien.hovaten as tennv')->join('nguoidung', 'xedangkythumua.mand', 'nguoidung.mand')->join('nhanvien', 'xedangkythumua.manv', 'nhanvien.manv')->where('trangthaipheduyet', 'Đang kiểm tra')->get();
        //
        $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd', 'nhanvien.hovaten as tennv')->join('nguoidung', 'xedangkythumua.mand', 'nguoidung.mand')->join('nhanvien', 'xedangkythumua.manv', 'nhanvien.manv')->where('trangthaipheduyet', 'Không duyệt')->get();
        $dstm_check = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd', 'nhanvien.hovaten as tennv')->join('nguoidung', 'xedangkythumua.mand', 'nguoidung.mand')->join('nhanvien', 'xedangkythumua.manv', 'nhanvien.manv')->where('trangthaipheduyet', 'Duyệt')->get();
        //
        return view('dashboard.transaction.purchasing.purchasing-manage', [
            'xedangkythumua_procces' => $dstm_procces,
            'xedangkythumua_uncheck' => $dstm_uncheck,
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_waiting' => $dstm_waiting,
        ]);
    }

    public function index2()
    {
        $hxm = DB::table('hangxe')->select('hangxe.tenhang', 'hangxe.mahx', 'loaixe')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->where('loaixe', 'Xe máy')->distinct()->get();
        $hxdd = DB::table('hangxe')->select('hangxe.tenhang', 'hangxe.mahx', 'loaixe')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->where('loaixe', 'Xe đạp điện')->distinct()->get();
        $dxdd = DB::table('dongxe')->select('dongxe.madx', 'dongxe.mahx', 'dongxe.tendongxe')->where('loaixe', 'Xe đạp điện')->distinct()->get();
        $dxm = DB::table('dongxe')->select('dongxe.madx', 'dongxe.mahx', 'dongxe.tendongxe')->where('loaixe', 'Xe máy')->distinct()->get();
        return view('guest-acc.purchasing.purchasing-form', compact('hxm', 'hxdd', 'dxdd', 'dxm'))->with('cross', 'Bạn cần đăng nhập để sử dụng chức năng này !');
    }

    public function store(Request $request)
    {
        $imagePathsString = '';
        $imagePaths = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $path = $image->store('posted', 'public');
                $imagePaths[] = $path;
            }
        }
        $id = 'MDK' . '-' . uniqid();
        $ngaydk = date('Y-m-d');
        $hangxe = DB::table('hangxe')
            ->select('mahx', 'tenhang')
            ->where('mahx', $request->hangxe)
            ->first();
       
        $giaban = $request->giaban;
        $giaban = str_replace(',', '', $giaban);
        $giaban = (int)$giaban;
        $ghichu = 'Thông tin liêu hệ: ' . $request->sdt . ' - '. $request->diachi . ', '. 'Loại xe: ' . $request->loaixe . ', Tên hãng: ' . $hangxe->mahx . '-' . $hangxe->tenhang . ', Tên xe: ' . $request->tenxe . ', Số km đã đi: ' . $request->kmdadi . ', Thời gian sử dụng: ' . $request->tgsd . ' năm' . ', Mô tả: ' . $request->mota;
        $imagePathsString = implode(',', $imagePaths);
        $mand = Auth::guard('guest')->user()->mand;
        DB::table('xedangkythumua')->insert([
            'madkthumua' => $id,
            'mand' => $mand,
            'ngaydk' => $ngaydk,
            'hinhanh' => $imagePathsString,
            'giaban' => $giaban,
            'ghichu' => $ghichu,
        ]);

        return redirect()->route('gui-form-thumua-Guest')->with('success-form-posting-Guest', 'Thông tin đã được gửi đi !');
    }

    public function show($id)
    {
        $dtm = $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('madkthumua', $id)->first();
        return view('dashboard.transaction.purchasing.purchasing-bike-detail', ['dtm' => $dtm]);
    }

    public function duyetdon(Request $request, $id)
    {
        $manv = Auth::user()->manv;
        $now = date('Y-m-d');
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => 'Đang kiểm tra', 'manv' => $manv, 'ngayduyet' => $now]);
        $dtm = DB::table('xedangkythumua')->where('madkthumua', $id)->first();
        $acc = DB::table('nguoidung')->join('xedangkythumua', 'xedangkythumua.mand','nguoidung.mand')->where('madkthumua', $id)->first();
        $mail = $acc->email;
        Mail::to($mail)->send(new ThongBaoDuyetXeThuMuaMail($dtm,$acc));
        return redirect()->route('xedkthumua');
    }
    public function huydon(Request $request, $id)
    {
        $manv = Auth::user()->manv;
        $now = date('Y-m-d');
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => 'Không duyệt', 'manv' => $manv, 'ngayduyet' => $now]);
        $dtm = DB::table('xedangkythumua')->where('madkthumua', $id)->first();
        $acc = DB::table('nguoidung')->join('xedangkythumua', 'xedangkythumua.mand','nguoidung.mand')->where('madkthumua', $id)->first();
        $mail = $acc->email;
        Mail::to($mail)->send(new ThongBaoTuChoiXeThuMuaMail($dtm,$acc));
        return redirect()->route('xedkthumua');
    }
    public function dondep()
    {
        $del = DB::table('xedangkythumua')->where('ngaydk')->delete();
    }
    public function add_bike($id)
    {
        $dtm = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('madkthumua', $id)->first();
        $str = $dtm->ghichu;
        //
        $parts = explode(',', $str);
        $info = [
            'Loai xe' => null,
            'Ten hang' => null,
            'tgsd' => null,
            'Ten xe' => null,
            'kmdadi' => null,
        ];
        $hangxe = [
            'mahx' => null,
            'tenhang' => null,
        ];
        foreach ($parts as $part) {
            $keyValue = explode(':', $part);
            $key = trim($keyValue[0]);
            $value = trim($keyValue[1]);

            switch ($key) {
                case 'Loại xe':
                    $info['Loai xe'] = $value;
                    break;
                case 'Tên hãng':
                    $info['Ten hang'] = $value;
                    break;
                case 'Thời gian sử dụng':
                    $info['tgsd'] = $value;
                    break;
                case 'Tên xe':
                    $info['Ten xe'] = $value;
                    break;
                case 'Số km đã đi':
                    $info['kmdadi'] = $value;
                    break;
            }
        }
       // dd($info['Loai xe']);
        $hx = explode('-', $info['Ten hang']);
        $hangxe['mahx'] = trim($hx[0]);
        $hangxe['tenhang'] = trim($hx[1]);
        $id = $dtm->madkthumua;
        $dongxe = DB::table('dongxe')->select('tendongxe','madx')->where('loaixe',$info['Loai xe'])->get();
        //dd($dongxe);
        return view('dashboard.transaction.purchasing.purchasing-submit-form', [
            'tt' => $info,
            'hangxe' => $hangxe,
            'id' => $id,
            'dongxe' => $dongxe

        ]);
    }
    public function store2(Request $request, $id)
    {
        $giaban = $request->giaban;
        $giaban = str_replace(',', '', $giaban);
        $giaban = (int)$giaban;
        DB::table('xedangkythumua')
        ->where('madkthumua', $id)
        ->update(['trangthaipheduyet' => 'Duyệt','giaban' => $giaban]);
        if ($request->xe == 1) {
            $maxemay = $this->generateUniqueId_moto();
            DB::table('thongsokythuatxemay')->insert([
                'matsxemay' => 'TS' . $maxemay,
            ]);

            DB::table('thongtinxe')->insert([
                'maxe' => $maxemay,
                'matsxemay' => 'TS' . $maxemay,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
                //'tinhtrang' => $request->tt
            ]);

            return redirect()->route('xedkthumua')->with('success-them-thongtinxe-thumua', 'Thông tin xe đã được thêm.');
        } elseif ($request->xe == 2) {
            $maxedap = $this->generateUniqueId_bike();

            DB::table('thongsokythuatxedapdien')->insert([
                'matsxedapdien' => 'TS' . $maxedap,
            ]);   
            DB::table('thongtinxe')->insert([
                'maxe' => $maxedap,
                'matsxedapdien' => 'TS' . $maxedap,
                'madx' => $request->dx,
                'tenxe' => $request->tx,
                'thoigiandasudung' => $request->tgsd,
                'tinhtrangxe' => $request->tinhtrangxe,
                'sokmdadi' => $request->sokmdadi,
            ]);

            return redirect()->route('xedkthumua')->with('success-them-thongtinxe-thumua', 'Thông tin xe đã được thêm.');
        } else {
            return redirect()->route('xedkthumua')->with('cross-them-thongtinxe-thumua', 'Thông tin xe chưa được thêm!');
        }
    }

    private function generateUniqueId_moto()
    {
        $lastCar = DB::table('thongtinxe')->where('maxe', 'like', 'XM%')->orderBy('maxe', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->maxe, 4));
            $newCarCode = 'XM-' . str_pad($lastCarCode + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'XM-0001';
        }

        return $newCarCode;
    }

    private function generateUniqueId_bike()
    {
        $lastCar = DB::table('thongtinxe')->where('maxe', 'like', 'XD%')->orderBy('maxe', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->maxe, 4));
            $newCarCode = 'XD-' . str_pad($lastCarCode + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'XD-0001';
        }

        return $newCarCode;
    }
}
