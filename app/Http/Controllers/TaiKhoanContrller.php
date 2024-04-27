<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaiKhoanContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $tk = DB::table('taikhoan')->get();
        return view('dashboard.sys.user_authorization', ['taikhoan' => $tk]);
    }

    public function index2()
    {
        $tk = DB::select('SELECT nhanvien.*, taikhoan.* FROM nhanvien INNER JOIN taikhoan ON nhanvien.manv = taikhoan.manv');

        return view('dashboard.sys.acc_management.employee_account', ['taikhoan2' => $tk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $currentTime = Carbon::now();
            DB::table('taikhoan')
                ->where('matk', $id)
                ->update([
                    'phanquyen' => $request->phanquyen,
                    'ngaycapnhat' => $currentTime
            ]);

            return redirect('/dashboard/sys/user_authorization')->with('success', 'Post created successfully!');
        } else {
            // Xử lý khi $id không tồn tại
            return redirect('/dashboard/sys/user_authorization')->with('error', 'Invalid ID!');
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
        //
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            $user = TaiKhoan::where('email', '=', $username)->first();
            //dd($user);
            Auth::login($user,true);
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function data()
    {
        $data = [
            //['matk' => '1', 'tentaikhoan' => 'nhanvien1', 'password' => bcrypt('12345678'), 'email' => 'nhanvien1@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai'=>1],
            //['matk' => '2', 'tentaikhoan' => 'nhanvien2', 'password' => bcrypt('12345678'), 'email' => 'nhanvien2@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai'=>1],
            //['matk' => '3', 'tentaikhoan' => 'nhanvien3', 'password' => bcrypt('12345678'), 'email' => 'nhanvien3@gmail.com', 'phanquyen' => 'Nhân viên', 'trangthai'=>1],
            // ['matk' => '4', 'tentaikhoan' => 'admin', 'password' => bcrypt('12345678'), 'email' => 'admin@gmail.com', 'phanquyen' => 'Quản trị viên', 'trangthai'=>1],
        ];

        TaiKhoan::insert($data);
    }
}
