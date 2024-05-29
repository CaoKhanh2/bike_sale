<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $dstm_check = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd', 'nhanvien.hovaten as tennv')->join('nguoidung', 'xedangkythumua.mand', 'nguoidung.mand')->join('nhanvien', 'xedangkythumua.manv', 'nhanvien.manv')->where('trangthaipheduyet', 'Đang kiểm tra')->get();
        //
        $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten as tennd', 'nhanvien.hovaten as tennv')->join('nguoidung', 'xedangkythumua.mand', 'nguoidung.mand')->join('nhanvien', 'xedangkythumua.manv', 'nhanvien.manv')->where('trangthaipheduyet', 'Không duyệt')->get();
        //
        return view('dashboard.transaction.purchasing.purchasing-manage', [
            'xedangkythumua_check' => $dstm_check,
            'xedangkythumua_uncheck' => $dstm_uncheck,
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
        $dongxe = DB::table('dongxe')
            ->select('madx', 'tendongxe')
            ->where('madx', $request->dongxe)
            ->first();
        $mota = 'Loại xe: ' . $request->loaixe . ', Tên hãng: ' . $hangxe->mahx . '-' . $hangxe->tenhang . ', Dòng xe: ' . $dongxe->madx . '-' . $dongxe->tendongxe . ', Tên xe: ' . $request->tenxe . ', Số km đã đi: ' . $request->kmdadi . ', Năm đăng ký: ' . $request->namdangky . ', Xuất xứ:  ' . $request->xuatxu . ', Thời gian sử dụng: '. $request->tgsd .', Mô tả: ' . $request->mota;
        $imagePathsString = implode(',', $imagePaths);
        $mand = Auth::guard('guest')->user()->mand;

        DB::table('xedangkythumua')->insert([
            'madkthumua' => $id,
            'mand' => $mand,
            'ngaydk' => $ngaydk,
            'hinhanh' => $imagePathsString,
            'giaban' => $request->giaban,
            'mota' => $mota,
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
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => 'Đang kiểm tra', 'manv' => $manv]);

        return redirect()->route('xedkthumua');
    }
    public function huydon(Request $request, $id)
    {
        $manv = Auth::user()->manv;
        DB::table('xedangkythumua')
            ->where('madkthumua', $id)
            ->update(['trangthaipheduyet' => 'Không duyệt', 'manv' => $manv]);

        return redirect()->route('xedkthumua');
    }
    public function dondep()
    {
        $del = DB::table('xedangkythumua')->where('ngaydk')->delete();
    }
    public function add_bike($id)
    {
        $dtm = $dstm_uncheck = DB::table('xedangkythumua')->select('*', 'nguoidung.hovaten')->join('nguoidung', 'xedangkythumua.mand', '=', 'nguoidung.mand')->where('madkthumua', $id)->first();
        $str = $dtm->mota;
        //
        $parts = explode(',', $str);
        $info = [
            'Loai xe' => null,
            'Ten hang' => null,
            'Dong xe' => null,
            'Nam dang ky' => null,
            'tgsd' => null,
            'Xuat xu' => null,
            'Ten xe' => null,
            'Dia chi' => null,
            'sdt' => null,
            'kmdadi' => null,
        ];
        $hangxe = [
            'mahx' => null,
            'tenhang' => null,
        ];
        $dongxe = [
            'madx' => null,
            'tendongxe' => null,
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
                case 'Năm đăng ký':
                    $info['Nam dang ky'] = $value;
                    break;
                case 'Xuất xứ':
                    $info['Xuat xu'] = $value;
                    break;
                case 'Thời gian sử dụng':
                    $info['tgsd'] = $value;
                    break;
                case 'Dòng xe':
                    $info['Dong xe'] = $value;
                    break;
                case 'Tên xe':
                    $info['Ten xe'] = $value;
                    break;
                case 'Số km đã đi':
                    $info['kmdadi'] = $value;
                    break;
            }
        }
        $hx = explode('-', $info['Ten hang']);
        $hangxe['mahx'] = trim($hx[0]);
        $hangxe['tenhang'] = trim($hx[1]);
        $dx = explode('-', $info['Dong xe']);
        $dongxe['madx'] = trim($dx[0]);
        $dongxe['tendongxe'] = trim($dx[1]);
        //DB::table('xedangkythumua')->where('madkthumua',$id)->update(['trangthaipheduyet' => "Duyệt"]);
        return view('dashboard.transaction.purchasing.purchasing-submit-form', [
            'tt' => $info,
            'hangxe' => $hangxe,
            'dongxe' => $dongxe,
        ]);
    }
}
