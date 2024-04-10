<?php

use App\Http\Controllers\DongXeController;
use App\Http\Controllers\HangXeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\VanChuyenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/success', function () {
    return view('dashboard.modal.success');
});


Route::get('/', function () {
    return view('index');
});

Route::get('/xe', function () {
    return view('sub-index');
});

Route::get('/ban-xe', function () {
    return view('sale-page');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/dashboard/sys', function () {
    return view('dashboard.sys.user-authorization');
});

// Danh muc xe
Route::get('/dashboard/category/vehicle/automaker_info', function () {
    return view('dashboard.category.vehicle.automaker_info');
});

Route::get('/dashboard/category/vehicle/automaker_info',[HangXeController::class,'index']);

Route::get('/dashboard/category/vehicle/detail_automaker_info', function () {
    return view('dashboard.category.vehicle.detail_automaker_info');
});


Route::get('/dashboard/category/vehicle/vehicle_infor', function () {
    return view('dashboard.category.vehicle.vehicle_infor');
});


Route::get('/dashboard/category/vehicle/type_vehicle_infor', function () {
    return view('dashboard.category.vehicle.type_vehicle_infor');
});

Route::get('/dashboard/category/vehicle/type_vehicle_infor',[DongXeController::class,'index']);

Route::get('/dashboard/category/vehicle/detail_type_vehicle_infor', function () {
    return view('dashboard.category.vehicle.detail_type_vehicle_infor');
});


Route::get('/dashboard/category/vehicle/detail_vehicle_infor', function () {
    return view('dashboard.category.vehicle.detail_vehicle_infor');
});

// 

// Danh muc khach hang

Route::get('/dashboard/category/customer/customer_info', function () {
    return view('dashboard.category.customer.customer_info');
});
Route::get('/dashboard/category/customer/customer_info',[KhachHangController::class,'index']);

Route::get('/customer/detail_customer_info', function () {
    return view('dashboard.category.customer.detail_customer_info');
});

Route::post('/dashboard/category/customer/customer_info/data', [KhachHangController::class, 'store'])->name('themthongtinkhachhang');
Route::get('/dashboard/category/customer/customer_info/{id}',[KhachHangController::class,'destroy'])->name('xoathongtinkhachhang');
Route::get('/dashboard/category/customer/detail_customer_info/{makh}',[KhachHangController::class,'edit'])->name('ctthongtinkhachhang');
Route::patch('/dashboard/category/customer/detail_customer_info/{makh}',[KhachHangController::class,'update']);

//

// Danh muc van chuyen
Route::get('/dashboard/category/shipping/ship_infor', function () {
    return view('dashboard.category.shipping.ship_infor');
});

Route::get('/dashboard/category/shipping/ship_infor',[VanChuyenController::class,'index']);
// 

// Danh muc nhan vien
Route::get('/dashboard/category/sales_agent/staff_infor', function () {
    return view('dashboard.category.sales_agent.staff_infor');
});

Route::get('/dashboard/category/sales_agent/staff_infor',[NhanVienController::class,'index']);
//





Route::get('/dashboard/transaction/purchasing_manage', function () {
    return view('dashboard.transaction.purchasing.purchasing_manage');
});

Route::get('/user', function(){
    return view('/user.index');
});

Route::get('/selling_item', function(){
    return view('/user.selling_item');
});

Route::get('/dashboard/transaction/selling', function () {
    return view('dashboard.transaction.selling.sell_manage');
});

Route::get('/dashboard/report/best-selling-items', function () {
    return view('dashboard.report.best-selling-items');
});


// Add data
Route::get('/data1', [HangXeController::class,'index']);
// Route::get('/data2', [LoaiXeController::class,'index']);