<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class HoaDonController extends Controller
{

    public function index(){

        $donhang_chuathanhtoan = DB::table('donhang')
            ->select('donhang.*','nguoidung.hovaten','nguoidung.mand')
            ->join('giohang','giohang.magh','donhang.magh')
            ->join('nguoidung','nguoidung.mand','giohang.mand')
            ->where('donhang.trangthai','Đang chờ xử lý')
            ->get();

        $donhang_dathanhtoan = DB::table('donhang')
            ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
            ->join('giohang','giohang.magh','donhang.magh')
            ->join('nguoidung','nguoidung.mand','giohang.mand')
            ->join('hoadon','donhang.madh','hoadon.madh')
            ->where('donhang.trangthai','Đã hoàn thành')
            ->get();
        
        $donhang_dahuy = DB::table('donhang')
        ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
        ->join('giohang','giohang.magh','donhang.magh')
        ->join('nguoidung','nguoidung.mand','giohang.mand')
        ->join('hoadon','donhang.madh','hoadon.madh')
        ->where('donhang.trangthai','Đã hủy')
        ->get();

        return view('dashboard.transaction.payment.pay-infor', compact('donhang_chuathanhtoan','donhang_dathanhtoan','donhang_dahuy'));

    }

    public function make_invoice_customer(Request $request){

        // $sessions = Session::all();
        // // Hiển thị thông tin session
        // dd($sessions);

        $manv = Auth::user()->manv;

        if (!Session::has('check')) {
            $mahoadon = $this->generateUniqueNumericId_invoice(10);
            DB::table('hoadon')->insert([
                'mahoadon' => $mahoadon,
                'manv' => $manv,
                ]);
            Session::put('check', true);
            Session::put('mahoadon',$mahoadon);
        }
            
        $thongtin_nguoidung = DB::table('hoadon')->select('nguoidung.*')
                    ->join('nguoidung','nguoidung.mand','hoadon.mand')
                    ->where('hoadon.mahoadon', Session::get('mahoadon'))->first();

        $thongtinxe = DB::table('xedangban')
                    ->select('xedangban.*','thongtinxe.maxe','thongtinxe.tenxe')
                    ->join('thongtinxe','thongtinxe.maxe','xedangban.maxe')
                    ->where('xedangban.trangthai','Còn xe')->get();
        
        $nguoidung = DB::table('nguoidung')->select('nguoidung.*')->get();
        
        $cthoadon = DB::table('cthoadon')->select('cthoadon.*','thongtinxe.maxe','thongtinxe.tenxe')
                        ->join('hoadon','hoadon.mahoadon','cthoadon.mahoadon')
                        ->join('thongtinxe','thongtinxe.maxe','cthoadon.maxe')
                        ->join('xedangban','xedangban.maxe','thongtinxe.maxe')
                        ->where('hoadon.mahoadon',Session::get('mahoadon'))
                        ->get();

        $tongtien = DB::table('cthoadon')->selectRaw('(sum(dongia)*soluong) as tongtien')
                        ->where('mahoadon',Session::get('mahoadon'))
                        ->groupBy('dongia','soluong')->first();

        if (!isset($tongtien)) {
            $tongtiencantra = DB::table('hoadon')->select('tonggiatrihoadon')->where('mahoadon',Session::get('mahoadon'))->first();
        } else {
            DB::table('hoadon')
                ->where('mahoadon', Session::get('mahoadon'))
                ->update([
                    'tonggiatrihoadon' => $tongtien->tongtien,
                ]);
            $tongtiencantra = DB::table('hoadon')->select('tonggiatrihoadon')->where('mahoadon',Session::get('mahoadon'))->first();
        }
        
        
        return view('dashboard.transaction.payment.make-invoice',compact('thongtinxe','thongtin_nguoidung', 'nguoidung','cthoadon','tongtiencantra'));

    }

    public function add_vehicle_invoice(Request $request){

        $maxe = $request->maxe;
        $macthoadon = Str::random(15);

        $xedangban = DB::table('xedangban')
                        ->select('xedangban.giaban')
                        ->join('thongtinxe','thongtinxe.maxe','xedangban.maxe')
                        ->where('xedangban.maxe',$maxe)->first();

        DB::table('cthoadon')->insert([
            'macthoadon' => $macthoadon,
            'mahoadon' => Session::get('mahoadon'),
            'maxe' => $maxe,
            'soluong' => '1',
            'dongia' => $xedangban->giaban,
        ]);

        $tongtien = DB::table('cthoadon')->selectRaw('(sum(dongia)*soluong) as tongtien')
            ->where('mahoadon',Session::get('mahoadon'))
            ->groupBy('dongia','soluong')->first();

            DB::table('hoadon')
                    ->where('mahoadon', Session::get('mahoadon'))
                    ->update([
                        'tonggiatrihoadon' => $tongtien->tongtien,
                    ]);

        return back();

    }

    public function add_customer_invoice(Request $request){

        $mand = $request->nguoidung;
        DB::table('hoadon')->where('mahoadon', Session::get('mahoadon'))
                ->update([
                    'mand' => $mand,
                ]);

        return back();
    }   

    public function confirm_invoice_customer(Request $request, $id){

        $validator = Validator::make(
            $request->all(),
            [
                'maxe' => 'required',
                'nguoidung' => 'required',
                'tientra' => 'required',
            ],
            [
                'maxe.required' => 'Trường thông tin này không được để trống!',
                'nguoidung.required' => 'Trường thông tin này không được để trống!',
                'tientra.required' => 'Bạn chưa nhập số tiền phải trả!',

                // 'tientra.required' => 'Số tiền nhập vào không được quá 100,000,000 VND!',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('cross-kiemtra-donhang', 'Thông tin đơn hàng chưa được cập nhật!');
        }

        $manv = Auth::user()->manv;

        $donhang_chuathanhtoan = DB::table('donhang')
        ->select('donhang.*','nguoidung.hovaten','nguoidung.mand')
        ->join('giohang','giohang.magh','donhang.magh')
        ->join('nguoidung','nguoidung.mand','giohang.mand')
        ->where('donhang.trangthai','Đang chờ xử lý')
        ->get();

        $donhang_dathanhtoan = DB::table('donhang')
            ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
            ->join('giohang','giohang.magh','donhang.magh')
            ->join('nguoidung','nguoidung.mand','giohang.mand')
            ->join('hoadon','donhang.madh','hoadon.madh')
            ->where('donhang.trangthai','Đã hoàn thành')
            ->get();
        
        $donhang_dahuy = DB::table('donhang')
        ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
        ->join('giohang','giohang.magh','donhang.magh')
        ->join('nguoidung','nguoidung.mand','giohang.mand')
        ->join('hoadon','donhang.madh','hoadon.madh')
        ->where('donhang.trangthai','Đã hủy')
        ->get();

        Session::forget('check');
        Session::forget('mahoadon');

        $hoadon = DB::table('hoadon')->select('tonggiatrihoadon')->where('mahoadon', $id)->first();

        if($request->tientra == $hoadon->tonggiatrihoadon){
            DB::table('hoadon')->where('mahoadon',$id)
                    ->update([
                        'ghichu' => 'Đã thanh toán',
                    ]);
                    return redirect()->route('thongtin-thanhtoan',compact('donhang_chuathanhtoan','donhang_dathanhtoan','donhang_dahuy'))
                    ->with('success-thanhtoan-hoadon', 'Thanh toán thành công!');
        }


    }

    public function destroy_invoice_customer($id){

        $manv = Auth::user()->manv;

        $donhang_chuathanhtoan = DB::table('donhang')
        ->select('donhang.*','nguoidung.hovaten','nguoidung.mand')
        ->join('giohang','giohang.magh','donhang.magh')
        ->join('nguoidung','nguoidung.mand','giohang.mand')
        ->where('donhang.trangthai','Đang chờ xử lý')
        ->get();

        $donhang_dathanhtoan = DB::table('donhang')
            ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
            ->join('giohang','giohang.magh','donhang.magh')
            ->join('nguoidung','nguoidung.mand','giohang.mand')
            ->join('hoadon','donhang.madh','hoadon.madh')
            ->where('donhang.trangthai','Đã hoàn thành')
            ->get();
        
        $donhang_dahuy = DB::table('donhang')
        ->select('donhang.*','nguoidung.hovaten','nguoidung.mand','hoadon.mahoadon')
        ->join('giohang','giohang.magh','donhang.magh')
        ->join('nguoidung','nguoidung.mand','giohang.mand')
        ->join('hoadon','donhang.madh','hoadon.madh')
        ->where('donhang.trangthai','Đã hủy')
        ->get();

        Session::forget('check');
        Session::forget('mahoadon');
        // $hoadon = DB::table('hoadon')->select('mahoadon')->where('manv', $manv)->where('ghichu', null)->first();

        DB::table('hoadon')->select('mahoadon')->where('mahoadon',$id)->delete();

        return redirect()->route('thongtin-thanhtoan',compact('donhang_chuathanhtoan','donhang_dathanhtoan','donhang_dahuy'))
                    ->with('success-huy-hoadon', 'Hóa đơn đã được hủy thành công!');

    }

    public function export_invoice_pdf(Request $request)
    {   
        $mand = Auth('guest')->user()->mand;
        $madh = $request->madh;

        $hoadon = DB::table('hoadon')
                ->select('hoadon.*', 'nguoidung.*', 'donhang.trangthai')
                    ->join('nguoidung', 'nguoidung.mand', 'hoadon.mand')
                    ->join('donhang', 'donhang.madh', 'hoadon.madh')
                    ->where('hoadon.madh', $madh)
                    ->where('hoadon.mand', $mand)
                    ->first();
        
        $chitiethoadon = DB::table('cthoadon')
        ->select('cthoadon.*','thongtinxe.*','xedangban.giaban','cthoadon.dongia', 'khuyenmai.tilegiamgia')
        ->join('hoadon', 'hoadon.mahoadon', '=', 'cthoadon.mahoadon')
        ->join('thongtinxe', 'thongtinxe.maxe', '=', 'cthoadon.maxe')
        ->join('xedangban', 'xedangban.maxe', '=', 'thongtinxe.maxe')
        ->where('hoadon.madh', $madh);
        
        $khuyenmai = clone $chitiethoadon;
        $khuyenmai = $khuyenmai->leftJoin('khuyenmai', 'khuyenmai.makhuyenmai', '=', 'xedangban.makhuyenmai');
        
        $chitiethoadon = $chitiethoadon->rightJoin('khuyenmai', 'khuyenmai.makhuyenmai', '=', 'xedangban.makhuyenmai')
            ->union($khuyenmai)
            ->get();
                
            $data = [
                'title' => 'Hóa đơn',
                'hoadon' => $hoadon,
                'chitiethoadon' => $chitiethoadon,
            ];
            
            $pdf = PDF::loadView('dashboard.transaction.payment.invoice.export-invoice', $data);
    
            return $pdf->stream('export-invoice.pdf');

        // return view('guest-acc.invoice.export-invoice');
    }

    public function export_invoice_pdf_dashboard(Request $request)
    {   
        $mand = $request->mand;
        $madh = $request->madh;

        $hoadon = DB::table('hoadon')
                ->select('hoadon.*', 'nguoidung.*', 'donhang.trangthai')
                    ->join('nguoidung', 'nguoidung.mand', 'hoadon.mand')
                    ->join('donhang', 'donhang.madh', 'hoadon.madh')
                    ->where('hoadon.madh', $madh)
                    ->where('hoadon.mand', $mand)
                    ->first();
        
        $chitiethoadon = DB::table('cthoadon')
        ->select('cthoadon.*','thongtinxe.*','xedangban.giaban','cthoadon.dongia', 'khuyenmai.tilegiamgia')
        ->join('hoadon', 'hoadon.mahoadon', '=', 'cthoadon.mahoadon')
        ->join('thongtinxe', 'thongtinxe.maxe', '=', 'cthoadon.maxe')
        ->join('xedangban', 'xedangban.maxe', '=', 'thongtinxe.maxe')
        ->where('hoadon.madh', $madh);
        
        $khuyenmai = clone $chitiethoadon;
        $khuyenmai = $khuyenmai->leftJoin('khuyenmai', 'khuyenmai.makhuyenmai', '=', 'xedangban.makhuyenmai');
        
        $chitiethoadon = $chitiethoadon->rightJoin('khuyenmai', 'khuyenmai.makhuyenmai', '=', 'xedangban.makhuyenmai')
            ->union($khuyenmai)
            ->get();
        
        $data = [
            'title' => 'Hóa đơn',
            'hoadon' => $hoadon,
            'chitiethoadon' => $chitiethoadon,
        ];
        
        $pdf = PDF::loadView('dashboard.transaction.payment.invoice.export-invoice', $data);

        return $pdf->stream('export-invoice.pdf');
        // return $pdf->download('invoice.pdf');

        // return view('guest-acc.invoice.export-invoice');
    }

    private function generateUniqueNumericId_invoice($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (HoaDon::where('mahoadon', $id)->exists()) {
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
