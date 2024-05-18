<?php

namespace App\Http\Controllers;

use App\Models\ChiTietGioHang;
use App\Models\GioHang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function show_cart()
    {
        $mand = Auth::guard('guest')->user()->mand;
        $gh = DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ?',
            [$mand],
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

        $gh = DB::table('giohang')->where('mand', $mand)->first();

        $ctgh = DB::table('xedangban')->select('maxe', 'giaban')->where('maxedangban', $id)->first();

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
}
