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
use Maatwebsite\Excel\Facades\Excel;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nd = DB::table('nguoidung')->get();
        return view('dashboard.category.customer.customer-info', ['nguoidung' => $nd]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mand = $this->generateUniqueNumericId(7);

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

        return redirect('/dashboard/category/customer/customer-info')->with('success-dash-customer', 'Post created successfully!');
    }

    public function store2(Request $request)
    {
        $email = $request->email;
        // Kiểm tra xem địa chỉ email đã tồn tại trong cơ sở dữ liệu hay không
        $user = DB::table('nguoidung')->where('email', $email)->first();

        // Nếu địa chỉ email đã tồn tại, trả về thông báo
        if ($user) {
            return redirect()->route('dangky-Guest')->with('cross-dangky-Guest', 'Đăng ký không thành công!');
        } else {
            $mand = $this->generateUniqueNumericId(7);

            DB::table('nguoidung')->insert([
                'mand' => $mand,
                'hovaten' => $request->hovaten,
                'ngaysinh' => $request->ngaysinh,
                'sodienthoai' => $request->sodienthoai,
                'email' => $request->email,
                'password' => bcrypt($request->password),
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
                return redirect()->route('quen-matkhau-Guest')->with('success-quen-matkhau-Guest', 'Đã gửi yêu cầu đặt lại mật khẩu đến email của bạn, vui lòng kiểm tra emai!');
            }
        } else {
            return redirect()->route('quen-matkhau-Guest')->with('cross-quen-matkhau-Guest', 'Tài khoản chưa được đăng ký!');
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
                'password' => 'required|min:8|max:32',
                'confirm-password' => 'required|same:password',
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
                'password.max' => 'Mật khẩu không được quá 32 ký tự.',
                'confirm-password.required' => 'Vui lòng nhập xác nhận mật khẩu.',
                'confirm-password.same' => 'Mật khẩu xác nhận phải khớp với mật khẩu đã nhập.',
            ],
        );

        // $tokenData = DatLaiMatKhauNguoiDung::checkToken($token);
        // $customer = $tokenData->customer;

        $tokenData = DatLaiMatKhauNguoiDung::where('token',$token)->firstOrFail();
        $customer = NguoiDung::where('email',$tokenData->email)->firstOrFail();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nd = DB::table('nguoidung')->where('mand', $id)->first();
        return view('/dashboard/category/customer/detail-customer-info', ['nd' => $nd]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $mand = $this->generateUniqueNumericId(7);

        $data = [['mand' => $mand, 'hovaten' => 'CoTrungKien', 'tentk' => 'kienco', 'password' => bcrypt('12345678'), 'email' => 'kienco@gmail.com'], ['mand' => 'KH0002', 'hovaten' => 'Huy', 'tentk' => 'huy', 'password' => bcrypt('12345678'), 'email' => 'huy@gmail.com']];

        NguoiDung::insert($data);
    }

    private function generateUniqueNumericId($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (NguoiDung::where('mand', $id)->exists()) {
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

}
