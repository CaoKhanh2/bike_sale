<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $email = $request->input('email');

        // Kiểm tra xem địa chỉ email đã tồn tại trong cơ sở dữ liệu hay không
        $user = DB::table('nguoidung')->where('email', $email)->first();

        // Nếu địa chỉ email đã tồn tại, trả về thông báo
        if ($user) {
            //return response()->json(['message' => 'Địa chỉ email đã tồn tại'], 200);
            return redirect()->intended('/guest/register')->with('cross-register-guest', 'Đăng ký không thành công !');
        } else {
            $mand = $this->generateUniqueNumericId(7);

            DB::table('nguoidung')->insert([
                'mand' => $mand,
                'hovaten' => $request->hovaten,
                'ngaysinh' => $request->ngaysinh,
                'sodienthoai' => $request->sodienthoai,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                // 'tinhtrang' => $request->tt
            ]);

            return redirect()->route('indexWeb')->with('success-register-guest', 'Đăng ký thành công !');
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
            return redirect()->route('indexWeb')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->route('login-Guest')->with('cross', 'Tài khoản hoặc mặt khẩu không đúng!');
        }
    }
    public function logoutGuest()
    {
        Auth::guard('guest')->logout();
        return redirect()->route('indexWeb');
    }

    public function data()
    {
        $data = [['mand' => 'KH0001', 'hovaten' => 'CoTrungKien', 'tentk' => 'kienco', 'password' => bcrypt('12345678'), 'email' => 'kienco@gmail.com'], ['mand' => 'KH0002', 'hovaten' => 'Huy', 'tentk' => 'huy', 'password' => bcrypt('12345678'), 'email' => 'huy@gmail.com']];

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
}
