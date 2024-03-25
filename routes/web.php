<?php

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

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/dashboard/car_catalog', function () {
    return view('dashboard.category.car.car_catalog');
});

Route::get('/dashboard/car_catalog/detail_inforcar', function () {
    return view('dashboard.category.car.detail_inforcar');
});

Route::get('/dashboard/customer', function () {
    return view('dashboard.category.customer.customer_info');
});

// Route::get('/customer/detail_customer_info', function () {
//     return view('dashboard.category.customer.detail_customer_info');
// });
Route::get('/dashboard/customer',[KhachHangController::class,'index']);

Route::get('/dashboard/shipping', function () {
    return view('dashboard.category.shipping.ship_infor');
});

Route::get('/dashboard/staff', function () {
    return view('dashboard.category.sales_agent.staff_infor');
});

Route::get('/dashboard/waiting_list', function () {
    return view('dashboard.waiting_list.waiting_list_info');
});

Route::get('/user', function(){
    return view('/user.index');
});

Route::get('/selling_item', function(){
    return view('/user.selling_item');
});