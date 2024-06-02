<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NhanVienController extends Controller
{
    public function index()
    {
        $nhanvien = DB::select('SELECT nhanvien.*,chucvu.* FROM nhanvien INNER JOIN chucvu ON nhanvien.macv = chucvu.macv');
        $chucvu = DB::select('SELECT chucvu.* FROM chucvu');

        return view('dashboard.category.sales-agent.staff-infor', compact('nhanvien', 'chucvu'));
    }

    public function index2($id)
    {
        $nhanvien = DB::table('nhanvien')->select('nhanvien.*', 'taikhoan.*', 'chucvu.*')->join('chucvu', 'chucvu.macv', 'nhanvien.macv')->join('taikhoan', 'taikhoan.manv', 'nhanvien.manv')->where('nhanvien.manv', $id)->first();

        $chucvu = DB::select('SELECT chucvu.* FROM chucvu');

        $enumValues = $this->getEnumValues('taikhoan', 'phanquyen');

        $enumValues = array_filter($enumValues, function ($value) {
            return $value !== 'Quản trị viên'; // thay 'giatri_bi_loai_bo' bằng giá trị bạn muốn loại bỏ
        });

        return view('dashboard.category.sales-agent.detail-staff-infor', compact('nhanvien', 'chucvu', 'enumValues'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hovaten' => 'required|max:50',
                // 'chucvu' => 'required',
                'ngaysinh' => 'required',
                'sdt' => 'required|numeric|min:11',
                // 'email' => 'email|unique:nhanvien,email|max:35',
                'diachi' => 'required|max:150',
                'tentk' => 'required|max:32|min:8',
                'email' => 'required|email',
            ],
            [
                'hovaten.required' => 'Bạn chưa nhập thông tin họ tên!',
                'hovaten.max' => 'Số ký tự nhập vào không được vượt quá 50 ký tự.',

                // 'chucvu.required' => 'Bạn chưa lựa chọn thông tin chức vụ!',
                'ngaysinh.required' => 'Bạn chưa nhập thông tin ngày sinh!',

                'sdt.required' => 'Bạn chưa nhập thông tin số điện thoại!',
                'sdt.numeric' => 'Trường thông tin này chỉ được nhập số!',
                'sdt.max' => 'Số ký tự nhập vào không được vượt quá 11 ký tự.',
                'sdt.min' => 'Số ký tự nhập vào không được ít hơn 11 ký tự.',

                'diachi.required' => 'Bạn chưa nhập thông tin địa chỉ!',
                'diachi.max' => 'Số ký tự nhập vào không được vượt quá 150 ký tự.',

                'tentk.required' => 'Trường thông tin tên tài khoản không được để trống !',
                'tentk.max' => 'Tên tài khoản không vượt quá 32 ký tự !',
                'tentk.min' => 'Tên tài khoản không được ít hơn 8 ký tự !',

                'email.required' => 'Trường thông tin email không được để trống !',
                'email.email' => 'Địa chỉ email không hợp lệ !',
            ],
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator)->with('cross-them-nhanvien', 'Thông tin nhân viên chưa được cập nhật thành công.');
        } else {
            DB::table('nhanvien')
                ->where('manv', $request->manv)
                ->update([
                    'macv' => $request->chucvu,
                    'hovaten' => $request->hovaten,
                    'ngaysinh' => $request->ngaysinh,
                    'gioitinh' => $request->gioitinh,
                    'sodienthoai' => $request->sdt,
                    'diachi' => $request->diachi,
                    'ghichu' => $request->ghichu,
                ]);
            DB::table('taikhoan')
                ->where('matk', $request->matk)
                ->update([
                    'tentaikhoan' => $request->tentk,
                    'email' => $request->email,
                    'phanquyen' => $request->phanquyen,
                ]);
            return back()->with('success-capnhat-thongtinnhanvien', 'Đã cập nhật thông tin thành công!');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hovaten' => 'required|max:50',
                'chucvu' => 'required',
                'ngaysinh' => 'required',
                'sdt' => 'required|numeric|min:11',
                // 'email' => 'email|unique:nhanvien,email|max:35',
                'diachi' => 'required|max:150',
            ],
            [
                'hovaten.required' => 'Bạn chưa nhập thông tin họ tên!',
                'hovaten.max' => 'Số ký tự nhập vào không được vượt quá 50 ký tự.',

                'chucvu.required' => 'Bạn chưa lựa chọn thông tin chức vụ!',
                'ngaysinh.required' => 'Bạn chưa nhập thông tin ngày sinh!',

                'sdt.required' => 'Bạn chưa nhập thông tin số điện thoại!',
                'sdt.numeric' => 'Trường thông tin này chỉ được nhập số!',
                'sdt.max' => 'Số ký tự nhập vào không được vượt quá 11 ký tự.',
                'sdt.min' => 'Số ký tự nhập vào không được ít hơn 11 ký tự.',

                'diachi.required' => 'Bạn chưa nhập thông tin địa chỉ!',
                'diachi.max' => 'Số ký tự nhập vào không được vượt quá 150 ký tự.',
            ],
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator)->with('cross-them-nhanvien', 'Thông tin nhân viên chưa được thêm thành công.');
        }

        $manv = $this->generateUniqueId_staff();

        DB::table('nhanvien')->insert([
            'manv' => $manv,
            'macv' => $request->chucvu,
            'hovaten' => $request->hovaten,
            'gioitinh' => $request->gioitinh,
            'ngaysinh' => $request->ngaysinh,
            'sodienthoai' => $request->sdt,
            'diachi' => $request->diachi,
            'ghichu' => $request->ghichu,
        ]);

        return back()->with('success-them-nhanvien', 'Thông tin nhân viên đã được thêm thành công.');
    }

    public function destroy($id)
    {
        DB::table('nhanvien')->where('manv', $id)->delete();
        return back()->with('success-xoa-nhanvien', 'Thông tin nhân viên đã được xóa thành công.');
    }

    private function generateUniqueId_staff()
    {
        $lastCode = DB::table('nhanvien')->where('manv', 'like', 'MNV%')->orderBy('manv', 'desc')->first();

        if ($lastCode) {
            // Tăng mã xe lên 1
            $Code = intval(substr($lastCode->manv, 4));
            $newCode = 'MNV-' . str_pad($Code + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có xe nào trong bảng, khởi tạo mã đầu tiên
            $newCode = 'MNV-0001';
        }

        return $newCode;
    }

    private function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        return $enumValues;
    }

    public function data()
    {
        $nhanvien = [
            ['manv' => 'MNV-0001', 'macv' => 'CV-01', 'hovaten' => 'Ms. Cassandre Corkery', 'ngaysinh' => '1986-04-06', 'gioitinh' => 'Nữ', 'sodienthoai' => '02933348279', 'email' => 'flatley.lawrence@example.net', 'diachi' => '481 VonRueden Dale Apt. 727', 'ghichu' => 'Quia et voluptas officia dolorum est.'],
            ['manv' => 'MNV-0002', 'macv' => 'CV-01', 'hovaten' => 'Scarlett Jaskolski II', 'ngaysinh' => '1983-12-01', 'gioitinh' => 'Nữ', 'sodienthoai' => '01187119495', 'email' => 'jschultz@example.net', 'diachi' => '472 Reichel Ports', 'ghichu' => 'Ut non beatae iure enim atque.'],
            ['manv' => 'MNV-0003', 'macv' => 'CV-01', 'hovaten' => 'Leopoldo Connelly', 'ngaysinh' => '1994-08-29', 'gioitinh' => 'Nam', 'sodienthoai' => '06926184416', 'email' => 'laura49@example.net', 'diachi' => '42000 Eleonore Brook', 'ghichu' => 'Officia eos labore.'],
            ['manv' => 'MNV-0004', 'macv' => 'CV-01', 'hovaten' => 'Mckenzie Mills', 'ngaysinh' => '1992-01-14', 'gioitinh' => 'Nữ', 'sodienthoai' => '00695490373', 'email' => 'bryana96@example.net', 'diachi' => '1081 Antoinette Circles Suite 341', 'ghichu' => 'Qui reiciendis dolores impedit.'],
            ['manv' => 'MNV-0005', 'macv' => 'CV-01', 'hovaten' => 'Lyla Nolan PhD', 'ngaysinh' => '1971-07-04', 'gioitinh' => 'Nữ', 'sodienthoai' => '03919816770', 'email' => 'emmet53@example.net', 'diachi' => '969 Merlin Parkway', 'ghichu' => 'Perspiciatis praesentium magni est.'],
            ['manv' => 'MNV-0006', 'macv' => 'CV-01', 'hovaten' => 'Gregoria Cummerata', 'ngaysinh' => '1986-09-04', 'gioitinh' => 'Nữ', 'sodienthoai' => '04545394462', 'email' => 'zokon@example.org', 'diachi' => '31019 Eldridge Hollow Suite 533', 'ghichu' => 'Doloribus nostrum laudantium fuga.'],
            ['manv' => 'MNV-0007', 'macv' => 'CV-01', 'hovaten' => 'Mr. Maxwell Hamill', 'ngaysinh' => '1970-04-22', 'gioitinh' => 'Nữ', 'sodienthoai' => '05627814767', 'email' => 'upfeffer@example.net', 'diachi' => '1236 Conroy Island', 'ghichu' => 'Commodi consequatur odio vero neque.'],
            ['manv' => 'MNV-0008', 'macv' => 'CV-01', 'hovaten' => 'Kaleigh Johnson', 'ngaysinh' => '2009-11-28', 'gioitinh' => 'Nữ', 'sodienthoai' => '03882265168', 'email' => 'jmorar@example.net', 'diachi' => '5154 Terry Centers Suite 336', 'ghichu' => 'Reiciendis eveniet et ipsam veniam optio.'],
            ['manv' => 'MNV-0009', 'macv' => 'CV-01', 'hovaten' => 'Carrie Pfannerstill', 'ngaysinh' => '1994-10-14', 'gioitinh' => 'Nữ', 'sodienthoai' => '03046235605', 'email' => 'watson25@example.net', 'diachi' => '441 Goodwin Canyon Apt. 142', 'ghichu' => 'Quis expedita et perferendis.'],
            ['manv' => 'MNV-0010', 'macv' => 'CV-01', 'hovaten' => 'Russel Jakubowski', 'ngaysinh' => '1980-08-30', 'gioitinh' => 'Nam', 'sodienthoai' => '06954121245', 'email' => 'kraig37@example.net', 'diachi' => '106 Yundt Coves Apt. 773', 'ghichu' => 'Natus molestias molestiae sit sit.'],
        ];
        NhanVien::insert($nhanvien);
    }
}
