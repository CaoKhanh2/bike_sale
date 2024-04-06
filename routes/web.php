<?php

use App\Http\Controllers\HangXeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangController;

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

Route::get('/dashboard/category/vehicle/vehicle_infor', function () {
    return view('dashboard.category.vehicle.vehicle_infor');
});


Route::get('/dashboard/category/vehicle/type_vehicle_infor', function () {
    return view('dashboard.category.vehicle.type_vehicle_infor');
});


Route::get('/dashboard/category/vehicle/detail_vehicle_infor', function () {
    return view('dashboard.category.vehicle.detail_vehicle_infor');
});

// 

// Danh muc khach hang
Route::get('/dashboard/customer', function () {
    return view('dashboard.category.customer.customer_info');
});
Route::get('/dashboard/customer',[KhachHangController::class,'index']);

Route::get('/customer/detail_customer_info', function () {
    return view('dashboard.category.customer.detail_customer_info');
});
// 


Route::get('/dashboard/shipping', function () {
    return view('dashboard.category.shipping.ship_infor');
});

Route::get('/dashboard/staff', function () {
    return view('dashboard.category.sales_agent.staff_infor');
});

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
Route::get('/data', [HangXeController::class,'index']);