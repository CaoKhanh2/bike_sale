<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TaiKhoanController extends Controller
{
    public function index1()
    {
        $taikhoan = DB::table('taikhoan')->get();
        return view('dashboard.sys.user-authorization', compact('taikhoan'));
    }

    public function index2()
    {
        $taikhoan2 = DB::select('SELECT nhanvien.*, taikhoan.* FROM nhanvien INNER JOIN taikhoan ON nhanvien.manv = taikhoan.manv');

        return view('dashboard.sys.management-acc.employee-account', compact('taikhoan2'));
    }

    public function profile_account()
    {
        $matk = Auth::user()->matk;
        $taikhoan = DB::table('taikhoan')->select('taikhoan.*', 'nhanvien.*')->join('nhanvien', 'nhanvien.manv', 'taikhoan.manv')->where('matk', $matk)->first();

        return view('dashboard.auth.profile', compact('taikhoan'));
    }

    public function update_profile_account(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hovaten' => 'required|max:50',
                'tentk' => 'required|max:32|min:8',
                'email' => 'required|email',
                'ngaysinh' => 'required|date',
                'sodienthoai' => 'required|numeric|digits_between:10,11',
                'diachi' => 'required|max:150',
            ],
            [
                'hovaten.required' => 'Trường thông tin họ và tên không được để trống!',
                'hovaten.max' => 'Họ và tên không được vượt quá 32 ký tự!',

                'tentk.required' => 'Trường thông tin tên tài khoản không được để trống!',
                'tentk.max' => 'Tên tài khoản không được vượt quá 32 ký tự!',
                'tentk.min' => 'Tên tài khoản không được ít hơn 8 ký tự!',

                'email.required' => 'Trường thông tin email không được để trống!',
                'email.email' => 'Địa chỉ email không hợp lệ!',

                'ngaysinh.required' => 'Trường thông tin ngày sinh không được để trống!',
                'ngaysinh.date' => 'Ngày sinh phải là định dạng dd/MM/yyy.',

                'sodienthoai.required' => 'Bạn chưa nhập số điện thoại.',
                'sodienthoai.numeric' => 'Số điện thoại phải là định dạng số!',
                'sodienthoai.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số!',

                'diachi.required' => 'Bạn chưa nhập thông tin địa chỉ.',
                'diachi.max' => 'Địa chỉ của bạn không vượt quá 100 ký tự!',
            ],
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator)->with('cross-capnhat-thongtintaikhoan', 'Thông tin chưa được cập nhật mới!');
        }

        $matk = Auth::user()->matk;

        $taikhoan = DB::table('taikhoan')->select('taikhoan.*', 'nhanvien.*')->join('nhanvien', 'nhanvien.manv', 'taikhoan.manv')->where('matk', $matk)->first();

        DB::table('taikhoan')
            ->where('matk', $matk)
            ->update([
                'tentaikhoan' => $request->tentk,
                'email' => $request->email,
                'ngaycapnhat' => Carbon::now(),
            ]);

        DB::table('nhanvien')
            ->where('manv', $taikhoan->manv)
            ->update([
                'hovaten' => $request->hovaten,
                'ngaysinh' => $request->ngaysinh,
                'gioitinh' => $request->gioitinh,
                'sodienthoai' => $request->sodienthoai,
                'diachi' => $request->diachi,
            ]);

        return back()->with('success-capnhat-thongtintaikhoan', 'Tài khoản đã được cập nhật thông tin.');
    }

    public function change_password(Request $request)
    {
        $rs = Validator::make(
            $request->all(),
            [
                'current-password' => ['required', 'min:8', 'max:32', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Mật khẩu hiện tại không đúng!');
                    }
                }],
                'new-password' => ['required', 'min:8', 'max:32', 'regex:/[A-Z]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
                'confirm-password' => 'required|same:new-password',
            ],
            [
                'current-password.required' => 'Bạn chưa nhập mật khẩu hiện tại!',
                'new-password.required' => 'Bạn chưa nhập mật khẩu mới!',
                'confirm-password.required' => 'Bạn chưa nhập mật khẩu xác nhận!',

                'current-password.min' => 'Mật khẩu hiện tại phải có ít nhất 8 ký tự!',
                'new-password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự!',
                'confirm-password.min' => 'Mật khẩu xác nhận phải có ít nhất 8 ký tự!',

                'current-password.max' => 'Mật khẩu hiện tại không được quá 32 ký tự!',
                'new-password.max' => 'Mật khẩu mới không được quá 32 ký tự!',
                'confirm-password.max' => 'Mật khẩu xác nhận không được quá 32 ký tự!',

                'new-password.regex' => 'Mật khẩu mới phải có ít nhất 1 ký tự đặc biệt và 1 ký tự viết hoa!',
                'confirm-password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới!',
            ],
        );

        if ($rs->fails()) {
            return back()->withErrors($rs)->with('cross-thaydoi-matkhau', 'Mật khẩu chưa được đặt lại!');
        }

        $guest = Auth::user();

        // Check if the provided current password matches the stored password
        // if (!Hash::check($request->input('current-password'), $guest->password)) {
        //     return back()->with('cross-thaydoi-matkhau', 'Mật khẩu hiện tại không đúng!');
        // }

        DB::table('taikhoan')
            ->where('matk', $guest->matk)
            ->update([
                'password' => Hash::make($request->input('new-password')),
            ]);
        return back()->with('success-thaydoi-matkhau', 'Mật khẩu đã được thay đổi thành công!');
    }

    public function add_acc_employee()
    {
        $manv = DB::table('nhanvien')->select('nhanvien.manv')->leftJoin('taikhoan', 'taikhoan.manv', 'nhanvien.manv')->whereNull('taikhoan.manv')->get();

        $enumValues = $this->getEnumValues('taikhoan', 'phanquyen');

        $enumValues = array_filter($enumValues, function ($value) {
            return $value !== 'Quản trị viên'; // thay 'giatri_bi_loai_bo' bằng giá trị bạn muốn loại bỏ
        });

        return view('dashboard.sys.management-acc.add-employee-account', compact('manv', 'enumValues'));
    }

    public function store1(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tentk' => 'required|max:32|min:8',
                'email' => 'required|email',
                // 'matkhau' => 'required|min:8|max:32',
            ],
            [
                'tentk.required' => 'Trường thông tin tên tài khoản không được để trống!',
                'tentk.max' => 'Tên tài khoản không được vượt quá 32 ký tự!',
                'tentk.min' => 'Tên tài khoản không được ít hơn 8 ký tự!',

                'email.required' => 'Trường thông tin email không được để trống!',
                'email.email' => 'Địa chỉ email không hợp lệ!',

                // 'matkhau.required' => 'Trường mật khẩu không được để trống !',
                // 'matkhau.max' => 'Mật khẩu không vượt quá 32 ký tự !',
                // 'matkhau.min' => 'Mật khẩu không được ít hơn 8 ký tự !',
            ],
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator)->with('cross-them-taikhoannhanvien', 'Tài khoản nhân viên chưa được thêm thành công.');
        }

        if (empty($request->matkhau)) {
            $nhanvien = DB::table('nhanvien')
                ->select('sodienthoai')
                ->where('manv', $request->manv)
                ->first();

            $matkhau = $nhanvien->sodienthoai . '@';
            DB::table('taikhoan')->insert([
                'manv' => $request->manv,
                'tentaikhoan' => $request->tentk,
                'email' => $request->email,
                'password' => bcrypt($matkhau),
                'phanquyen' => $request->phanquyen,
                'trangthai' => '1',
            ]);

            return back()->with('success-tao-taikhoan-nhanvien', 'Tài khoản nhân viên được tạo thành công!');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'matkhau' => ['required', 'min:8', 'max:32', 'regex:/[A-Z]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
                ],
                [
                    'matkhau.required' => 'Trường mật khẩu không được để trống!',
                    'matkhau.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
                    'matkhau.min' => 'Mật khẩu không được ít hơn 8 ký tự!',
                    'matkhau.regex' => 'Mật khẩu phải có ít nhất 1 ký tự đặc biệt và 1 ký tự viết hoa!',
                ],
            );

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator)->with('cross-them-taikhoannhanvien', 'Tài khoản nhân viên chưa được thêm thành công.');
            }
        }

        DB::table('taikhoan')->insert([
            'manv' => $request->manv,
            'tentaikhoan' => $request->tentk,
            'email' => $request->email,
            'password' => bcrypt($request->matkhau),
            'phanquyen' => $request->phanquyen,
            'trangthai' => '1',
        ]);

        return back()->with('success-tao-taikhoan-nhanvien', 'Tài khoản nhân viên được tạo thành công!');
    }

    public function update1(Request $request, $id)
    {
        if ($id) {
            $currentTime = Carbon::now();
            DB::table('taikhoan')
                ->where('matk', $id)
                ->update([
                    'phanquyen' => $request->phanquyen,
                    'ngaycapnhat' => $currentTime,
                ]);

            return redirect('/dashboard/sys/user-authorization')->with('success', 'Post created successfully!');
        } else {
            // Xử lý khi $id không tồn tại
            return redirect('/dashboard/sys/user-authorization')->with('error', 'Invalid ID!');
        }
    }

    public function update2(Request $request, $id)
    {
        if ($id) {
            $currentTime = Carbon::now();
            DB::table('taikhoan')
                ->where('matk', $id)
                ->update([
                    'trangthai' => $request->trangthai,
                    'ngaycapnhat' => $currentTime,
                ]);

            return redirect()->route('thongtintaikhoannhanvien')->with('success', 'Post created successfully!');
        } else {
            // Xử lý khi $id không tồn tại
            return redirect()->route('thongtintaikhoannhanvien')->with('error', 'Invalid ID!');
        }
    }

    public function reset_password(Request $request)
    {
        $currentTime = Carbon::now();
        $password = DB::table('nhanvien')
            ->select('nhanvien.sodienthoai')
            ->join('taikhoan', 'taikhoan.manv', 'nhanvien.manv')
            ->where('taikhoan.matk', $request->matk)
            ->first();

        DB::table('taikhoan')
            ->where('matk', $request->matk)
            ->update([
                'password' => bcrypt($password->sodienthoai . '@'),
                'ngaycapnhat' => $currentTime,
            ]);

        return back()->with('success-datlai-matkhau', 'Đặt lại mật khẩu thành công!');
    }

    public function destroy($id)
    {
        DB::table('taikhoan')->where('matk', $id)->delete();
        return back()->with('success-xoa-taikhoan', 'Tài khoản ID: ' . $id . ' đã bị xóa!');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $username, 'password' => $password]) || Auth::attempt(['tentaikhoan' => $username, 'password' => $password])) {
            $user = TaiKhoan::where('email', '=', $username)->orWhere('tentaikhoan', '=', $username)->first();
            Auth::login($user, true);
            // Session::flash('success', 'Đăng nhập thành công !');
            // return redirect('/dashboard');
            return redirect()->intended('/dashboard')->with('success', 'Đăng nhập thành công!');
        } else {
            // Session::flash('cross', 'Đăng nhập không thành công !');
            // return redirect('/login');
            return redirect()->intended('/login')->with('cross', 'Tài khoản hoặc mặt khẩu không đúng!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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
        $data = [['matk' => '1', 'tentaikhoan' => 'nhanvien1', 'password' => bcrypt('12345678'), 'email' => 'nhanvien1@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai' => 1], ['matk' => '2', 'tentaikhoan' => 'nhanvien2', 'password' => bcrypt('12345678'), 'email' => 'nhanvien2@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai' => 1], ['matk' => '3', 'tentaikhoan' => 'nhanvien3', 'password' => bcrypt('12345678'), 'email' => 'nhanvien3@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai' => 1], ['matk' => '4', 'tentaikhoan' => 'admin', 'password' => bcrypt('12345678'), 'email' => 'admin@gmail.com', 'phanquyen' => 'Quản trị viên', 'trangthai' => 1]];

        TaiKhoan::insert($data);
    }
}
