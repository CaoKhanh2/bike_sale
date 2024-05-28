<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DonHangController extends Controller
{
    //Dashboard

    public function index()
    {
        $trangthai = 'Đang chờ xử lý';
        // $mand = Auth::guard('guest')->user()->mand;
        // $gh = DB::table('giohang')->where('mand', $mand)->first();

        // $donhang =DB::select(
        //     'SELECT
        //             -- ctgiohang.*
        //             giohang.*
        //             , donhang.ngaytaodon
        //             , donhang.trangthai
        //             ,donhang.madh
        //             ,donhang.magh
        //                 FROM giohang
        //                 -- INNER JOIN ctgiohang ON ctgiohang.magh = donhang.magh
        //                 INNER JOIN donhang ON giohang.magh = donhang.magh
        //                 WHERE giohang.ghichu = ?',
        //     [$trangthai]
        // );

        $donhang = DB::table('donhang')->where('donhang.trangthai', $trangthai)->get();
        $xedangban = DB::table('xedangban')->select('xedangban.*', 'thongtinxe.tenxe')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->get();

        // dd($donhang);
        return view('dashboard.transaction.selling.index', compact('donhang','xedangban'));
    }

    public function view($id)
    {
        $trangthai = '0';

        // $donhang_items =DB::select(
        //     'SELECT
        //             -- ctgiohang.*
        //             giohang.*
        //             , donhang.ngaytaodon
        //             , donhang.trangthai
        //             ,donhang.madh
        //             ,donhang.tongtien
        //                 FROM donhang
        //                 -- INNER JOIN ctgiohang ON ctgiohang.magh = donhang.magh
        //                 INNER JOIN giohang ON giohang.magh = donhang.magh
        //                 WHERE donhang.trangthai = ?',
        //     [$trangthai]
        // );

        $donhang_items = DB::table('donhang')->select('thongtinxe.*', 'xedangban.giaban', 'donhang.*')->join('giohang', 'giohang.magh', 'donhang.magh')->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->where('donhang.madh', $id)->get();

        $tt_nguoidung = DB::table('nguoidung')->select('nguoidung.*')->join('giohang', 'giohang.mand', 'nguoidung.mand')->join('donhang', 'donhang.magh', 'giohang.magh')->where('donhang.madh', $id)->first();

        // dd($tt_nguoidung);

        // dd($donhang_items);
        return view('dashboard.transaction.selling.order.view', compact('donhang_items', 'tt_nguoidung'));
    }

    public function updateorder(Request $request, $id)
    {
        $trangthai = $request->input('order_status');
        DB::table('donhang')
            ->where('donhang.madh', $id)
            ->update(['trangthai' => $trangthai]);

        return redirect()->route('danhsach-donhang-dangbanxe')->with('success-capnhat-donhang', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function orderhistory()
    {
        $donhang = DB::table('donhang')->where('donhang.trangthai', 'Đã hoàn thành')->orWhere('donhang.trangthai', 'Đã hủy')->get();

        // dd($donhang);
        return view('dashboard.transaction.selling.order.history', compact('donhang'));
    }

    //Khách hàng

    public function index_checkout()
    {
        $mand = Auth::guard('guest')->user()->mand;

        $trangthai = 'Đang chờ xử lý';

        $giohang_items = DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? AND giohang.ghichu = ?',
            [$mand, $trangthai],
        );

        return view('guest-acc.orders.checkout', compact('giohang_items'));
    }

    public function dat_hang(Request $request)
    {
        $mand = Auth::guard('guest')->user()->mand;
        // $magh = $request->magh;

        $giohang_items = DB::select(
            'SELECT ctgiohang.maxedangban, giohang.*, xedangban.maxedangban, thongtinxe.maxe FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? ',
            [$mand],
        );

        // dd($giohang_items);

        $gh = DB::table('giohang')->select('giohang.magh')->join('nguoidung', 'giohang.mand', 'nguoidung.mand')->where('giohang.mand', $mand)->first();

        // dd($gh);

        foreach ($giohang_items as $item) {
            DB::table('donhang')->insert([
                'magh' => $gh->magh,
                'maxedangban' => $item->maxedangban,
                'mand' => $mand,
                'tongtien' => $item->tonggiatien,
                'ngaytaodon' => Carbon::now(),
            ]);
        }

        if (Auth::guard('guest')->user()->diachi == null) {
            $user = NguoiDung::where('mand', Auth::guard('guest')->user()->mand)->first();
            $user->hovaten = $request->input('hovaten');
            $user->gioitinh = $request->input('gioitinh');
            // $user->email = $request->input('email');
            $user->sodienthoai = $request->input('sdt');
            $user->diachi = $request->input('diachi');
            $user->update();
        }

        return redirect('/')->with('success-dathang-Guest', 'Đặt hàng thành công');
    }
}
