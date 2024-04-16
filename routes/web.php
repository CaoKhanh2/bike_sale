<?php

use App\Http\Controllers\DkBanXeController;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\HangXeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\VanChuyenController;
use App\Http\Controllers\XeController;
use App\Http\Controllers\XeDapDienController;
use App\Http\Controllers\XeMayController;
use Database\Seeders\DkBanXeSeeder;

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

// Danh muc xe ----------

Route::get('/dashboard/category/vehicle/automaker_info',[HangXeController::class,'index']);
Route::post('/dashboard/category/vehicle/automaker_info', [HangXeController::class, 'store'])->name('themhangxe');
Route::get('/dashboard/category/vehicle/automaker_info/{id}',[HangXeController::class,'destroy'])->name('xoahangxe');

Route::get('/dashboard/category/vehicle/detail_automaker_info', function () {
    return view('dashboard.category.automaker.vehicle.detail_automaker_info');
});


Route::get('/dashboard/category/vehicle/vehicle_line_infor', function () {
    return view('dashboard.category.vehicle.vehicle_line.vehicle_line_infor');
});

Route::get('/dashboard/category/vehicle/vehicle_line_infor',[DongXeController::class,'index']);
Route::post('/dashboard/category/vehicle/vehicle_line_infor', [DongXeController::class, 'store'])->name('themdongxe');
Route::get('/dashboard/category/vehicle/vehicle_line_infor/{id}',[DongXeController::class,'destroy'])->name('xoadongxe');


Route::get('/dashboard/category/vehicle/vehicle_infor', function () {
    return view('dashboard.category.vehicle.vehicle_infor');
});

Route::get('/dashboard/category/vehicle/detail_vehicle_infor', function () {
    return view('dashboard.category.vehicle.detail_vehicle_infor');
});


Route::get('/dashboard/category/vehicle/vehicle_infor', [XeController::class, 'index']);

Route::post('/dashboard/category/vehicle/vehicle_infor', [XeController::class, 'store'])->name('themthongtinxe');
// Route::post('/dashboard/category/vehicle/vehicle_infor', [XeDapDienController::class, 'store'])->name('themthongtinxedapien');
//Route::post('/dashboard/category/customer/customer_info/data', [XeDapDienController::class, 'store'])->name('themthongtinxe');

// ----------

// Danh muc khach hang ----------

Route::get('/dashboard/category/customer/customer_info', function () {
    return view('dashboard.category.customer.customer_info');
});
Route::get('/dashboard/category/customer/customer_info',[KhachHangController::class,'index']);

Route::get('/customer/detail_customer_info', function () {
    return view('dashboard.category.customer.detail_customer_info');
});

Route::post('/dashboard/category/customer/customer_info', [KhachHangController::class, 'store'])->name('themthongtinkhachhang');
Route::get('/dashboard/category/customer/customer_info/{id}',[KhachHangController::class,'destroy'])->name('xoathongtinkhachhang');
Route::get('/dashboard/category/customer/detail_customer_info/{makh}',[KhachHangController::class,'edit'])->name('ctthongtinkhachhang');
Route::patch('/dashboard/category/customer/detail_customer_info/{makh}',[KhachHangController::class,'update']);

//----------

// Danh muc van chuyen ----------
Route::get('/dashboard/category/shipping/ship_infor', function () {
    return view('dashboard.category.shipping.ship_infor');
});

Route::get('/dashboard/category/shipping/ship_infor',[VanChuyenController::class,'index']);
//  ----------

// Danh muc nhan vien ----------
Route::get('/dashboard/category/sales_agent/staff_infor', function () {
    return view('dashboard.category.sales_agent.staff_infor');
});

Route::get('/dashboard/category/sales_agent/staff_infor',[NhanVienController::class,'index']);

// ----------




// Quan ly giao dich ----------

// Route::get('/dashboard/transaction/purchasing_manage', function () {
//     return view('dashboard.transaction.purchasing.purchasing_manage');
// });

Route::get('/dashboard/transaction/purchasing_manage',[DkBanXeController::class,'index']);


Route::get('/selling_item', function(){
    return view('/user.selling_item');
});

Route::get('/dashboard/transaction/selling', function () {
    return view('dashboard.transaction.selling.sell_manage');
});

 Route::get('/cart_index', function(){
    return view('/cart_index');
 });

//  ----------

// Bao cao thong ke ----------
Route::get('/dashboard/report/best-selling-items', function () {
    return view('dashboard.report.best-selling-items');
});

Route::get('/dashboard/report/inventory', function () {
    return view('dashboard.report.inventory');
});

// ----------


// Add data
Route::get('/data1', [HangXeController::class,'index']);
// Route::get('/data2', [LoaiXeController::class,'index']);