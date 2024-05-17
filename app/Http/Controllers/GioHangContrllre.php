<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\CtGioHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GioHangContrllre extends Controller
{
    public function showGiohang()
    {
        $mand = Auth::guard('guest')->user()->mand;
        $gh = DB::select('SELECT ctgiohang.*,giohang.*,nguoidung.*, xedangban.*, thongtinxe.*
                        FROM giohang 
                        INNER JOIN ctgiohang ON giohang.magh = ctgiohang.magh 
                        INNER JOIN nguoidung ON giohang.mand = nguoidung.mand 
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban 
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ?', [$mand]);
        return view('guest-acc.cart.cart-index', compact('gh'));
    }

    public function addXedangban(Request $request, $id)
    {
        $giohangItem = new CtGioHang();
        $giohangItem->maxedangban = $id;
        $giohangItem->magh = 'GH'.Auth::guard('guest')->id();
        $giohangItem->save();
        return view('sub-index/xemay');
        // $xedangban_id = $request->input('xedangban_id');
        // if (Auth::check()) {
            // $xedang_check = CtGioHang::where('maxedangban', $xedangban_id)->first();

        //if ($xedang_check) {
        //where('maxe', $xedangban_id)->
        // if (GioHang::where('mand', Auth::guard('guest')->id())->exists()) {
        //     return response()->json(['status' => $xedang_check->maxedangban . ' Already Add to Cart']);
        // } else {
            // $giohangItem->mand = Auth::guard('guest')->id();
            // $giohangItem->mactgh = '4';

            // return response()->json(['status' => $xedang_check->maxedangban . ' Add to Cart']);
        // }
        //}
        // }
        // else
        // {
        //     return response()->json(['status' => 'Login to Continue']);
        // }
    }

    public function viewgiohang()
    {
        $giohangitems = GioHang::where('mand', Auth::id())->get();
        return view('guest-acc.cart.cart-index', compact('giohangitems'));
    }

    public function giohangcount()
    {
        $giohangcount = CtGioHang::where('mand', Auth::guard('guest')->user()->mand)->count();
        return response()->json(['count' => $giohangcount]);
    }
}
