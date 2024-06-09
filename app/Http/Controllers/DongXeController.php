<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DongXe;
use Illuminate\Support\Facades\DB;

class DongXeController extends Controller
{

    public function index()
    {
        $dx = DB::select('SELECT dongxe.*,hangxe.tenhang FROM dongxe INNER JOIN hangxe ON dongxe.mahx = hangxe.mahx');
        $hx = DB::table('hangxe')->get();
        $madongxe = $this->generateUniqueId();
        return view('dashboard.category.vehicle.vehicle-line.vehicle-line-infor',['dongxe'=>$dx, 'hangxe'=>$hx, 'madongxe'=>$madongxe]);
    }

    public function update ($id){

        $dongxe = DB::table('dongxe')
                ->select('dongxe.*','hangxe.tenhang')
                ->join('hangxe','hangxe.mahx','dongxe.mahx')
                ->where('madx',$id)->first();
        $hangxe = DB::table('hangxe')->get();

        return view('dashboard.category.vehicle.vehicle-line.detail-vehicle-line-infor', compact('dongxe','hangxe'));
    }

    public function act_update(Request $request, $id){
        
        $request->validate(
            [
                'tendongxe' => 'required|max:50',
                'mota' => 'max:50',
            ],
            [
                'tendongxe.required' => 'Trường thông tin tên dòng xe không được để trống!',
                'tendongxe.max' => 'Trường thông tin tên dòng xe không được vượt quá 50 ký tự!',

                'mota.max' => 'Trường thông tin mô tả không được vượt quá 50 ký tự!',
            ]
        );
        
        DB::table('dongxe')->where('madx',$id)
            ->update([
                'loaixe' => $request->loaixe,
                'mahx' => $request->hangxe,
                'tendongxe' => $request->tendongxe,
                'mota' => $request->mota,
            ]);
        
        
        return redirect()->route('thongtindongxe')->with('success-update-dongxe','Thông tin dòng xe được cập nhật thành công.');

    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'hx' => 'required',
                'lx' => 'required',
                'tdx' => 'required|max:50',
                'mt' => 'max:50',
            ],
            [

                'hx.required' => 'Trường thông tin hãng xe không được để trống!',

                'lx.required' => 'Trường thông tin loại xe không được để trống!',

                'tdx.required' => 'Trường thông tin tên dòng xe không được để trống!',
                'tdx.max' => 'Trường thông tin tên dòng xe không được vượt quá 50 ký tự!',

                'mt.max' => 'Trường thông tin mô tả không được vượt quá 50 ký tự!',
            ]
        );

        DB::table('dongxe')->insert([
            'madx' => $request->mdx,
            'mahx' => $request->hx,
            'loaixe' => $request->lx,
            'tendongxe' => $request->tdx,
            'mota' => $request->mt,
        ]);

        return redirect('dashboard/category/vehicle/vehicle-line-infor')->with('success-add-dongxe', 'Dòng xe mới đã được thêm.');
    }


    public function destroy($id)
    {
        DB::table('dongxe')->where('madx', $id)->delete();
        return redirect('dashboard/category/vehicle/vehicle-line-infor')->with('success-xoa-dongxe', 'Thông tin dòng xe đã được xóa thành công!');
    }

    public function data(){
        $dongxe = array(
            array('madx' => 'DX001','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Airblade','mota' => NULL),
            array('madx' => 'DX002','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Lead','mota' => NULL),
            array('madx' => 'DX003','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Vision','mota' => NULL),
            array('madx' => 'DX004','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Wave','mota' => NULL),
            array('madx' => 'DX005','mahx' => 'HX01','loaixe' => 'Xe máy','tendongxe' => 'Honda Winner','mota' => NULL),
            array('madx' => 'DX006','mahx' => 'HX05','loaixe' => 'Xe máy','tendongxe' => 'Piaggio Liberty','mota' => NULL),
            array('madx' => 'DX007','mahx' => 'HX03','loaixe' => 'Xe máy','tendongxe' => 'Suzuki Raider','mota' => NULL),
            array('madx' => 'DX008','mahx' => 'HX02','loaixe' => 'Xe máy','tendongxe' => 'Yamaha Exciter','mota' => NULL),
            array('madx' => 'DX009','mahx' => 'HX02','loaixe' => 'Xe máy','tendongxe' => 'Yamaha Grande','mota' => NULL),
            array('madx' => 'DX010','mahx' => 'HX07','loaixe' => 'Xe đạp điện','tendongxe' => 'Dibao CREER E','mota' => NULL),
            array('madx' => 'DX011','mahx' => 'HX07','loaixe' => 'Xe đạp điện','tendongxe' => 'Dibao Ninja','mota' => NULL),
            array('madx' => 'DX012','mahx' => 'HX10','loaixe' => 'Xe đạp điện','tendongxe' => 'Nijia Cap A','mota' => NULL),
            array('madx' => 'DX013','mahx' => 'HX11','loaixe' => 'Xe đạp điện','tendongxe' => 'Xiaomi Himo','mota' => NULL),
            array('madx' => 'DX014','mahx' => 'HX11','loaixe' => 'Xe đạp điện','tendongxe' => 'Xiaomi Ninebot','mota' => NULL),
            array('madx' => 'DX015','mahx' => 'HX09','loaixe' => 'Xe đạp điện','tendongxe' => 'Espero M133','mota' => NULL)
        );
        DongXe::insert($dongxe);
    }
    private function generateUniqueId()
    {
        $lastCar = DB::table('dongxe')->where('madx', 'like', 'DX%')->orderBy('madx', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->madx, 3));
            $newCarCode = 'DX' . str_pad($lastCarCode + 1, 2, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'DX001';
        }

        return $newCarCode;
    }
}
