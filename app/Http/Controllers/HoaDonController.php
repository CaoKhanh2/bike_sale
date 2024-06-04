<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    public function export_invoice_pdf(Request $request)
    {   
        $mand = Auth('guest')->user()->mand;

        $madh = $request->madh;

        //dd( $madh_string);

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
                


        $pdf = Pdf::loadView('guest-acc.invoice.export-invoice', compact('hoadon','chitiethoadon'));

        return $pdf->stream('myPDF.pdf');

        // return view('guest-acc.invoice.export-invoice');
    }
}
