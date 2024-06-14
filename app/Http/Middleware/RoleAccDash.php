<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class RoleAccDash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->phanquyen == 'Quản trị viên' || Auth::user()->phanquyen == 'Nhân viên' || Auth::user()->phanquyen == 'Quản lý') && Auth::user()->trangthai == 1) {
            return $next($request);
        }else{
            Session::flash('cross-dangnhap-dash', 'Đăng nhập không thành công !');
            return redirect('/login')->with('cross-dangnhap-dash', 'Tài khoản của bạn đã bị khóa !');
        }     
    }
}
