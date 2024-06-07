<?php

namespace App\Http\Controllers;

use App\Mail\DatLaiMatKhauMail;
use App\Mail\XacNhanMail;
use App\Models\DatLaiMatKhauNguoiDung;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Mailable;

use App\Exports\NguoiDungExport;
use App\Models\GioHang;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class NguoiDungController extends Controller
{
    public function index()
    {
        $nd = DB::table('nguoidung')->get();
        return view('dashboard.category.customer.customer-info', ['nguoidung' => $nd]);
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $mand = $this->generateUniqueNumericId_guest(7);
        $magh = $this->generateUniqueNumericId_cart(7);
        $trangthai = 'Đang chờ xử lý';

        DB::table('nguoidung')->insert([
            'mand' => $mand,
            'hovaten' => $request->hoten,
            'ngaysinh' => $request->ngsinh,
            'cccd' => $request->cccd,
            'gioitinh' => $request->gt,
            'sodienthoai' => $request->sdt,
            'email' => $request->email,
            'diachi' => $request->dc,
            // 'tinhtrang' => $request->tt
        ]);

        DB::table('giohang')->insert([
            'magh' => 'GH-' . $magh,
            'mand' => $mand,
            'ngaytao' => Carbon::now(),
            'tonggiatien' => 0,
            'ghichu' => $trangthai,
        ]);

        return redirect()->route('thongtinkhachang')->with('success-dash-customer', 'Post created successfully!');
    }

    public function store2(Request $request)
    {
        $email = $request->email;
        $trangthai = 'Đang chờ xử lý';

        // Kiểm tra xem địa chỉ email đã tồn tại trong cơ sở dữ liệu hay không
        $user = DB::table('nguoidung')->where('email', $email)->first();

        // Nếu địa chỉ email đã tồn tại, trả về thông báo
        if ($user) {
            return redirect()->back()->with('cross-dangky-Guest', 'Đăng ký không thành công!');
        } else {
            $mand = $this->generateUniqueNumericId_guest(7);
            $magh = $this->generateUniqueNumericId_cart(7);

            DB::table('nguoidung')->insert([
                'mand' => $mand,
                'hovaten' => $request->hovaten,
                'ngaysinh' => $request->ngaysinh,
                'sodienthoai' => $request->sodienthoai,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::table('giohang')->insert([
                'magh' => 'GH-' . $magh,
                'mand' => $mand,
                'ngaytao' => Carbon::now(),
                'tonggiatien' => 0,
                'ghichu' => $trangthai,
            ]);

            $acc = DB::table('nguoidung')->where('mand', $mand)->first();
            Mail::to($acc->email)->send(new XacNhanMail($acc));

            return redirect()->route('dangnhap-Guest')->with('success-dangky-Guest', 'Đăng ký thành công!');
        }
    }

    public function verify_acc(Request $request, $id)
    {
        if (!$request->hasValidSignature() || Carbon::now()->gt($request->expires_verify)) {
            abort(403, 'Link xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        $acc = NguoiDung::where('mand', $id)->whereNull('email_verified_at')->firstOrFail();
        $acc->update(['email_verified_at' => Carbon::now()]);

        DB::table('nguoidung')
            ->where('mand', $id)
            ->update([
                'email_verified_at' => Carbon::now(),
            ]);

        return redirect()->route('dangnhap-Guest')->with('success-xacnhanmail-Guest', 'Xác nhận tài khoản email thành công!');
    }

    public function forgot_password(Request $request)
    {
        $rs = Validator::make($request->all(), [
            'email' => 'required|exists:nguoidung',
        ]);

        $token = str::random(40);
        $tokenData = [
            'email' => $request->email,
            'token' => $token,
        ];

        if ($rs->passes()) {
            if (DatLaiMatKhauNguoiDung::create($tokenData)) {
                Mail::to($request->email)->send(new DatLaiMatKhauMail($rs, $token));
                return redirect()->back()->with('success-quen-matkhau-Guest', 'Đã gửi yêu cầu đặt lại mật khẩu đến email của bạn, vui lòng kiểm tra emai!');
            }
        } else {
            return redirect()->back()->with('cross-quen-matkhau-Guest', 'Tài khoản chưa được đăng ký!');
        }
    }
    public function reset_password(Request $request)
    {
        if (!$request->hasValidSignature() || Carbon::now()->gt($request->expires_reset_pass)) {
            abort(403, 'Link xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        return view('guest-acc.auth.reset-password');
    }
    public function check_reset_password(Request $request, $token)
    {
        request()->validate(
            [
                'password' => ['required', 'min:8', 'max:32', 'regex:/[A-Z]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
                'confirm-password' => 'required|same:password',
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
                'password.max' => 'Mật khẩu không được quá 32 ký tự.',
                'password.regex' => 'Mật khẩu mới phải có ít nhất 1 ký tự đặc biệt và 1 ký tự viết hoa!',
                'confirm-password.required' => 'Vui lòng nhập xác nhận mật khẩu.',
                'confirm-password.same' => 'Mật khẩu xác nhận phải khớp với mật khẩu đã nhập.',
            ],
        );

        // $tokenData = DatLaiMatKhauNguoiDung::checkToken($token);
        // $customer = $tokenData->customer;

        $tokenData = DatLaiMatKhauNguoiDung::where('token', $token)->firstOrFail();
        $customer = NguoiDung::where('email', $tokenData->email)->firstOrFail();

        $data = [
            'password' => bcrypt(request('password')),
        ];

        $check = $customer->update($data);

        if ($check) {
            return redirect()->route('dangnhap-Guest')->with('success-datlai-matkhau-Guest', 'Mật khẩu đã được đặt lại!');
        } else {
            return redirect()->route('nhap-matkhau-moi-Guest')->with('cross-datlai-matkhau-Guest', 'Mật khẩu của bạn chưa được đặt lại!');
        }
    }

    public function show($id)
    {
        $nd = DB::table('nguoidung')->where('mand', $id)->first();
        return view('/dashboard/category/customer/detail-customer-info', ['nd' => $nd]);
    }


    public function update(Request $request, $id)
    {
        if ($id) {
            DB::table('nguoidung')
                ->where('mand', $id)
                ->update([
                    'hovaten' => $request->hoten,
                    'ngaysinh' => $request->ngsinh,
                    'cccd' => $request->cccd,
                    'gioitinh' => $request->gt,
                    'sodienthoai' => $request->sdt,
                    'email' => $request->email,
                    'tentk' => $request->tentk,
                    'diachi' => $request->dc,
                    'tinhtrang' => $request->tt ? 1 : 0,
                ]);

            return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');
        }
    }

    public function update_infor_Guest(Request $request)
    {
        $rs = Validator::make(
            $request->all(),
            [
                'hovaten' => 'required|max:50',
                'ngaysinh' => 'required',
                'gioitinh' => 'required',
                'tentaikhoan' => 'required',
                'cccd' => 'required|min:12|max:12',
                'sodienthoai' => 'required|numeric|digits_between:10,11',
                'diachi' => 'required|max:150',
                
            ],
            [
                'hovaten.required' => 'Bạn chưa nhập thông tin họ và tên.',
                'ngaysinh.required' => 'Bạn chưa nhập thông tin ngày sinh.',
                'gioitinh.required' => 'Bạn chưa chọn thông tin giới tính.',
                'tentaikhoan.required' => 'Bạn chưa nhập tên tài khoản.',
                'cccd.required' => 'Bạn chưa nhập số căn cước công dân.',
                'sodienthoai.required' => 'Bạn chưa nhập số điện thoại.',
                'diachi.required' => 'Bạn chưa nhập thông tin địa chỉ.',

                
                'hovaten.max' => 'Họ và tên không được vượt quá 50 ký tự.',
                'cccd.max' => 'Số căn cước công dân của bạn phải bao gồm 11 ký tự!',
                'sodienthoai.max' => 'Số điện thoại của bạn không vượt quá 11 ký tự!',
                'diachi.max' => 'Địa chỉ của bạn không vượt quá 100 ký tự!',
                
                'cccd.min' => 'Số căn cước công dân của bạn tối thiểu phải bao gồm 12 ký tự!',
                'sodienthoai.min' => 'Số điện thoại của bạn tối thiểu phải gồm 11 ký tự!',
                
                'sodienthoai.numeric' => 'Số điện thoại phải là định dạng số!',
                'sodienthoai.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số!',

            ],
        );

        if ($rs->fails()) {
            return back()->withErrors($rs)->with('cross-thaydoi-thongtin-Guest', 'Thông tin của bạn chưa được cập nhật đầy đủ.');
        }

        $guest = Auth::guard('guest')->user();
        DB::table('nguoidung')
            ->where('mand', $guest->mand)
            ->update([
                'hovaten' => $request->hovaten,
                'ngaysinh' => $request->ngaysinh,
                'cccd' => $request->cccd,
                'gioitinh' => $request->gioitinh,
                'sodienthoai' => $request->sodienthoai,
                'tentk' => $request->tentaikhoan,
                'diachi' => $request->diachi,
            ]);

        return back()->with('success-thaydoi-thongtin-Guest', 'Thông tin được cập nhật thành công!');
    }

    public function change_password_guest(Request $request)
    {
        $rs = Validator::make(
            $request->all(),
            [
                'current-password' => 'required|min:8|max:32',
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
            return back()->withErrors($rs)->with('cross-thaydoi-matkhau-Guest', 'Mật khẩu chưa được đặt lại!');
        }

        $guest = Auth::guard('guest')->user();

        // Check if the provided current password matches the stored password
        if (!Hash::check($request->input('current-password'), $guest->password)) {
            //return response()->json(['error' => 'Current password is incorrect'], 400);
            return back()->with('cross-thaydoi-matkhau-Guest', 'Mật khẩu hiện tại không đúng!');
        }

        DB::table('nguoidung')
            ->where('mand', $guest->mand)
            ->update([
                'password' => Hash::make($request->input('new-password')),
            ]);
        return back()->with('success-thaydoi-matkhau-Guest', 'Mật khẩu đã được thay đổi thành công!');
    }

    public function destroy($id)
    {
        //Sử dụng Query Builder:
        DB::table('nguoidung')->where('mand', $id)->delete();
        return redirect('/dashboard/category/customer/customer-info')->with('success', 'Post created successfully!');
    }

    public function loginGuest(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::guard('guest')->attempt(['email' => $username, 'password' => $password]) || Auth::guard('guest')->attempt(['tentk' => $username, 'password' => $password])) {
            $guest = NguoiDung::Where('email', '=', $username)->orWhere('tentk', '=', $username)->first();
            Auth::guard('guest')->login($guest, true);
            if (Auth::guard('guest')->user()->email_verified_at == null) {
                return redirect()->route('dangnhap-Guest')->with('cross-dangnhap-Guest', 'Tài khoản chưa được xác nhận! Vui lòng kiểm tra lại email.');
            } else {
                return redirect()->route('indexWeb')->with('success-dangnhap-Guest', 'Đăng nhập thành công!');
            }
        } else {
            return redirect()->route('dangnhap-Guest')->with('cross-dangnhap-Guest', 'Tài khoản hoặc mặt khẩu không đúng!');
        }
    }
    public function logoutGuest()
    {
        Auth::guard('guest')->logout();
        return redirect()->route('dangnhap-Guest');
    }

    public function data()
    {
        $mand = $this->generateUniqueNumericId_guest(7);

        $data = [['mand' => $mand, 'hovaten' => 'CoTrungKien', 'tentk' => 'kienco', 'password' => bcrypt('12345678'), 'email' => 'kienco@gmail.com'], ['mand' => 'KH0002', 'hovaten' => 'Huy', 'tentk' => 'huy', 'password' => bcrypt('12345678'), 'email' => 'huy@gmail.com']];

        NguoiDung::insert($data);
    }

    private function generateUniqueNumericId_guest($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (NguoiDung::where('mand', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
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

    // public function sendmail(){
    //     $email = "khanh85969@st.vimaru.edu.vn";
    //     Mail::to($email)->send(new XacNhanMail());
    // }

    public function orderhistory()
    {
        $mand = Auth::guard('guest')->user()->mand;
        $donhang = DB::table('donhang')
                ->select('donhang.*')
                ->join('giohang', 'giohang.magh', 'donhang.magh')
                ->where('giohang.mand', $mand)
                ->where('donhang.trangthai', "Đã hoàn thành")
                ->where('giohang.mand', $mand)
                ->get();

        return view('guest-acc.orders.index', compact('donhang'));
    }
    public function purchasehistory()
    {
        $mand = Auth::guard('guest')->user()->mand;
        $db = DB::table('xedangkythumua')->where('mand',$mand)->where('trangthaipheduyet','Duyệt')->get();
        return view('guest-acc.purchasing.purchasing-history', compact('db'));
    }


    // Lịch sử mua hàng của khách
    public function view(Request $request)
    {
        $donhang_items = DB::table('donhang')
                    ->select('thongtinxe.*', 'xedangban.giaban', 'donhang.*')
                    ->join('giohang', 'giohang.magh', 'donhang.magh')->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')
                    ->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')
                    ->where('donhang.madh', $request->madonhang)
                    ->get();

        $tt_nguoidung = DB::table('nguoidung')->select('nguoidung.*')->join('giohang', 'giohang.mand', 'nguoidung.mand')->join('donhang', 'donhang.magh', 'giohang.magh')->where('donhang.madh', $request->madonhang)->first();

        $donhang_infor = DB::table('donhang')->select('*')->where('madh', $request->madonhang)->first();

        return view('guest-acc.orders.view', compact('donhang_items', 'tt_nguoidung', 'donhang_infor'));
    }

}
