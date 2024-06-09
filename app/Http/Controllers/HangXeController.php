<?php

namespace App\Http\Controllers;

use App\Models\HangXe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HangXeController extends Controller
{

    public function index()
    {
        $hx = DB::table('hangxe')->get();

        $mahx = $this->generateUniqueId();

        return view('dashboard.category.vehicle.automaker.automaker-info', ['hangxe' => $hx, 'mahx' => $mahx]);
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'tenhang' => 'required|max:50',
                'xuatxu' => 'required|max:20',
            ],
            [
                'tenhang.required' => 'Trường thông tin tên hãng xe không được để trống!',
                'tenhang.max' => 'Trường thông tin tên hãng xe không được vượt quá 50 ký tự!',

                'xuatxu.required' => 'Trường thông tin xuất xứ không được để trống!',
                'xuatxu.max' => 'Trường thông tin xuất xứ không được vượt quá 50 ký tự!',
            ]
        );

        $logo = $request->file('logo');
        $path = $logo->store('logo', 'public');

        // Sau đó, chèn đường dẫn của từng tập tin vào cơ sở dữ liệu
        DB::table('hangxe')->insert([
            'mahx' => $request->mahx,
            'tenhang' => $request->tenhang,
            'logo' => $path,
            'xuatxu' => $request->xs,
        ]);

        return redirect('dashboard/category/vehicle/automaker-info')->with('success-add-hangxe', 'Hãng xe mới đã được thêm.');
    }

    public function update($id)
    {
        $hangxe = DB::table('hangxe')->where('mahx',$id)->first();

        return view('dashboard.category.vehicle.automaker.detail-automaker-info', compact('hangxe'));
    }

    public function act_update(Request $request, $id){
        
        $logo = $request->file('logo');
        
        if(isset($logo)){
            $path = $logo->store('logo', 'public');

            DB::table('hangxe')->where('mahx',$id)
                ->update([
                    'tenhang' => $request->tenhang,
                    'xuatxu' => $request->xuatxu,
                    'logo' =>  $path,
                ]);
        }else{
            DB::table('hangxe')->where('mahx',$id)
                ->update([
                    'tenhang' => $request->tenhang,
                    'xuatxu' => $request->xuatxu,
                ]);
        }
        
        return redirect()->route('thongtinhangxe')->with('success-update-hangxe','Thông tin hãng xe được cập nhật thành công.');

    }

    public function destroy($id)
    {
        DB::table('hangxe')->where('mahx', $id)->delete();
        return redirect('dashboard/category/vehicle/automaker-info')->with('success-xoa-hangxe', 'Thông tin hãng xe đã được xóa thành công!');
    }
    public function data()
    {
        $hangxe = array(
            array('mahx' => 'HX01','tenhang' => 'Honda','logo' => 'logo/2IHtzazFp1GjqQ5PFsdorq67k5Gcp8Zhb6E4Q7Nj.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX02','tenhang' => 'Yamaha','logo' => 'logo/JTyfQd2xxYDqFfY66sWi5uiCzblFp81q4r3N4CTV.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX03','tenhang' => 'Suzuki','logo' => 'logo/0hxl1IG3eGZwneO99tDe8VLt4W2waiNnxR9C4JTN.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX04','tenhang' => 'Sym','logo' => 'logo/jdnnfzEoSkP1r4l9C2tIYBTQ67BmkjpM8aBktqqT.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX05','tenhang' => 'Piaggio','logo' => 'logo/rOs1aW53cnuDOedURUaVk6S8sqYl5L27ocBXDH1D.png','xuatxu' => 'Ý'),
            array('mahx' => 'HX06','tenhang' => 'Kawasaki','logo' => 'logo/86hye9WVlDwMlDuSKdD2CmyeFPsGWSyRT1UMn0cQ.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX07','tenhang' => 'Dibao','logo' => 'logo/roHL0ccJ7HZPUguSE2MxKehghmo9xpoZxLad4sum.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX08','tenhang' => 'Asama','logo' => 'logo/ivu7FJgdPnfHzlKuxRvguP16DnH0ectwkKlAyxiw.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX09','tenhang' => 'Espero','logo' => 'logo/40AOE1AbJPidg9zm8edYWI00TRc594FXt6G38D8T.jpg','xuatxu' => 'Việt Nam'),
            array('mahx' => 'HX10','tenhang' => 'Nijia','logo' => 'logo/SwaOxEwSCwTkWTvo5mxPHHArEaQPgOkPHuZPXE6n.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX11','tenhang' => 'Xiaomi','logo' => 'logo/Fuaz8KwifNLknB46q9Pk7wYbHPptME5GwOFSiDAI.png','xuatxu' => 'Trung Quốc')
        );

        HangXe::insert($hangxe);
    }

    private function generateUniqueId()
    {
        $lastCar = DB::table('hangxe')->where('mahx', 'like', 'HX%')->orderBy('mahx', 'desc')->first();

        if ($lastCar) {
            // Tăng mã xe lên 1
            $lastCarCode = intval(substr($lastCar->mahx, 2));
            $newCarCode = 'HX' . str_pad($lastCarCode + 1, 1, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCarCode = 'HX01';
        }

        return $newCarCode;
    }
}
