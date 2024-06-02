<?php

namespace App\Http\Controllers;

use App\Models\ChiTietGioHang;
use App\Models\GioHang;
use App\Models\NguoiDung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function show_cart()
    {
        $mand = Auth::guard('guest')->user()->mand;
        
        $trangthai = "Đang chờ xử lý";

        $magh = $this->generateUniqueNumericId_cart(7);

        $cre_cart = DB::table('giohang')->where('ghichu',$trangthai)->where('mand', $mand)->exists();

        if($cre_cart == false){
            DB::table('giohang')->insert([
                'magh' => 'GH-'.$magh,
                'mand' => $mand,
                'ngaytao' => Carbon::now(),
                'tonggiatien' => 0,
                'ghichu' => $trangthai,
            ]);
        }

        $gh = DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* ,
                        CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                            ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                            END AS giaban
                        FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        LEFT JOIN khuyenmai ON khuyenmai.makhuyenmai = xedangban.makhuyenmai
                        WHERE giohang.mand = ? AND giohang.ghichu = ?',
            [$mand, $trangthai]
        );

        $tongtien = ChiTietGioHang::selectRaw('SUM(dongia) as tonggiatien, magh')->groupBy('magh')->orderBy('magh')->get();

        //dd($tongtien);

        foreach ($tongtien as $i) {
            DB::table('giohang')
                ->where('magh', $i->magh)
                ->update([
                    'tonggiatien' => $i->tonggiatien,
                ]);
        }

        return view('guest-acc.cart.cart-index', compact('gh', 'tongtien'));
    }

    public function add_cart(Request $request, $id)
    {
        $mand = Auth::guard('guest')->user()->mand;

        $gh = DB::table('giohang')->where('mand', $mand)->where('ghichu','Đang chờ xử lý')->first();

        $ctgh = DB::table('xedangban')->select('maxe', 
                                            DB::raw('CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                                                    ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                                                    END AS giaban'))
                                        ->leftJoin('khuyenmai', 'xedangban.makhuyenmai', 'khuyenmai.makhuyenmai')
                                        ->where('maxedangban', $id)->first();

        $check = DB::table('ctgiohang')
                            ->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')
                            ->join('giohang', 'giohang.magh', 'ctgiohang.magh')
                            ->select('maxedangban.*', 'giohang.mand', 'ctgiohang.*')
                            ->where('ctgiohang.maxedangban', $id)
                            ->where('giohang.mand', $mand)
                            ->count();
        //dd($check);

        $randomString = Str::random(15);

        if (substr($ctgh->maxe, 0, 2) == 'XM' && $check < 1) {
            DB::table('ctgiohang')->insert([
                'mactgh' => $randomString,
                'magh' => $gh->magh,
                'maxedangban' => $request->maxedangban,
                'dongia' => $ctgh->giaban,
            ]);
            return redirect()->route('hienthi-thongtinxemay-Guest')->with('success-themvaogiohang-Guest', 'Sản phẩm đã được thêm vào giỏ hàng.');
        }else{
            return redirect()->route('hienthi-thongtinxemay-Guest')->with('cross-themvaogiohang-Guest', 'Sản phẩm này đã có trong giỏ hàng !');
        }
        if(substr($ctgh->maxe, 0, 2) == 'XDD') {
            DB::table('ctgiohang')->insert([
                'mactgh' => $randomString,
                'magh' => $gh->magh,
                'maxedangban' => $request->maxedangban,
                'dongia' => $ctgh->giaban,
            ]);
            return redirect()->route('hienthi-thongtinxedapdien-Guest')->with('success-themvaogiohang-Guest', 'Sản phẩm đã được thêm vào giỏ hàng.');
        }

        
    }

    public function destroy_cart(Request $request){
        $mactgh = $request->mactgh;
        DB::table('ctgiohang')->where('mactgh', $mactgh)->delete();

        return redirect()->route('hienthi-giohang-Guest')->with('success-xoa-sp-giohang-Guest', 'Sản phẩm đã được xóa khỏi giỏ hàng !');

    }

    public function cartcount()
    {   
        $cartcount = DB::table('ctgiohang')
                ->join('giohang', 'giohang.magh', 'ctgiohang.magh')
                ->where('ghichu','Đang chờ xử lý')
                ->where('mand', Auth::guard('guest')->user()->mand)
                ->count();
        return response()->json(['count' => $cartcount]);
        // return view('layout.header',compact('cartcount'));
    }

    private function generateUniqueNumericId_cart($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (GioHang::where('magh', $id)->exists()) {
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
