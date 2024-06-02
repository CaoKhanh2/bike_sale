<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KhuyenMaiController extends Controller
{
    public function index()
    {
        $hxm = DB::table('hangxe')->select('hangxe.tenhang', 'hangxe.mahx')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->where('loaixe', 'Xe máy')->distinct()->get();
        $hxd = DB::table('hangxe')->select('hangxe.tenhang', 'hangxe.mahx')->join('dongxe', 'hangxe.mahx', 'dongxe.mahx')->where('loaixe', 'Xe đạp điện')->distinct()->get();
        $dxdd = DB::table('dongxe')->select('dongxe.madx', 'dongxe.mahx', 'dongxe.tendongxe')->where('loaixe', 'Xe đạp điện')->distinct()->get();
        $dxm = DB::table('dongxe')->select('dongxe.madx', 'dongxe.mahx', 'dongxe.tendongxe')->where('loaixe', 'Xe máy')->distinct()->get();
        $km = DB::table('khuyenmai')->where('hieuluc', 'Hết hạn')->get();
        $km_active = DB::table('khuyenmai')
            ->selectRaw(
                '*,
                                        CASE WHEN DATEDIFF(thoigianketthuc,CURDATE()) > 0 THEN DATEDIFF(thoigianketthuc,CURDATE())
                                             WHEN DATEDIFF(thoigianketthuc,CURDATE()) <= 0 THEN "Hết hạn"
                                        END AS thoigianconlai',
            )
            ->where('hieuluc', 'Còn hiệu lực')
            ->orderBy('thoigianconlai', 'desc')
            ->get();
        return view('dashboard.category.saling-events.saling-manage', compact('km', 'km_active', 'hxm', 'hxd', 'dxdd', 'dxm'));
    }
    public function store(Request $request)
    {
        if (!empty($request->xemay) || !empty($request->xedapdien)) {
            $query = DB::table('xedangban')->select('xedangban.maxedangban')->join('thongtinxe', 'thongtinxe.maxe', 'xedangban.maxe')->join('dongxe', 'thongtinxe.madx', 'dongxe.madx');

            $query->where(function ($query) use ($request) {
                if (!empty($request->xemay)) {
                    $query->where('dongxe.loaixe', 'Xe máy');

                    if (!empty($request->hangxemay)) {
                        $query->whereIn('dongxe.mahx', $request->hangxemay);
                    }

                    if (!empty($request->dongxemay)) {
                        $query->whereIn('dongxe.madx', $request->dongxemay);
                    }
                }
            });
            $query->orWhere(function ($query) use ($request) {
                if (!empty($request->xedapdien)) {
                    $query->where('dongxe.loaixe', 'Xe đạp điện');

                    if (!empty($request->hangxedapdien)) {
                        $query->whereIn('dongxe.mahx', $request->hangxedapdien);
                    }

                    if (!empty($request->dongxedapdien)) {
                        $query->whereIn('dongxe.madx', $request->dongxedapdien);
                    }
                }
            });
            $maxedangban = $query->pluck('maxedangban')->toArray();
            //dd($maxedangban);

            DB::table('khuyenmai')->insert([
                'makhuyenmai' => $request->makhuyemai,
                'tenkhuyenmai' => $request->tenkhuyenmai,
                //'dieukienapdung' => $maxedangban,
                'tilegiamgia' => $request->tile,
                'motakhuyenmai' => $request->mota,
                'thoigianbatdau' => $request->ngaybatdau,
                'thoigianketthuc' => $request->ngayketthuc,
            ]);
            DB::table('xedangban')
                ->whereIn('maxedangban', $maxedangban)
                ->whereNull('makhuyenmai')
                ->update([
                    'makhuyenmai' => $request->makhuyemai,
                ]);

            return redirect()->back()->with('success', 'Post created successfully!');
        } else {
            return redirect('dashboard/category/saling-events/saling-manage')->with('error', 'Chưa chọn điều kiện áp dụng');
        }
    }

    public function xoa_khuyenmai($id)
    {
        $makm = $id;
        DB::table('khuyenmai')
            ->where('makhuyenmai', $makm)
            ->update(['hieuluc' => 'Hết hạn']);
        DB::table('xedangban')
            ->where('makhuyenmai', $makm)
            ->update(['makhuyenmai' => null]);
        return redirect()->back();
    }
}
