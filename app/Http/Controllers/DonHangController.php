<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class DonHangController extends Controller
{
    public function index_checkout()
    {
        $mand = Auth::guard('guest')->user()->mand;
        
        $trangthai = "Đang chờ xử lý";

        $giohang_items =DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? AND giohang.ghichu = ?',
            [$mand, $trangthai]
        );
        return view('guest-acc.orders.checkout', compact('giohang_items'));
    }

    public function dat_hang(Request $request)
    {
        $mand = Auth::guard('guest')->user()->mand;
        // $magh = $request->magh;

        $giohang_items =DB::select(
            'SELECT ctgiohang.maxedangban, giohang.*, xedangban.maxedangban, thongtinxe.maxe FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? ',
            [$mand]
        );

        // dd($giohang_items);

        $gh = DB::table('giohang')
            ->select('giohang.magh')
            ->join('nguoidung', 'giohang.mand', 'nguoidung.mand')
            ->where('giohang.mand', $mand)
            ->first();    
        
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

        if(Auth::guard('guest')->user()->diachi == NULL)
        {
            $user = NguoiDung::where('mand',Auth::guard('guest')->user()->mand)->first();
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
