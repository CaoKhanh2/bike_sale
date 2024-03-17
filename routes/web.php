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

Route::get('/car_catalog', function () {
    return view('dashboard.category.car.car_catalog');
});

Route::get('/car_catalog/detail_inforcar', function () {
    return view('dashboard.category.car.detail_inforcar');
});

Route::get('/customer', function () {
    return view('dashboard.category.customer.customer_info');
});

// Route::get('/customer/detail_customer_info', function () {
//     return view('dashboard.category.customer.detail_customer_info');
// });
Route::get('/customer',[KhachHangController::class,'index']);

Route::get('/shipping', function () {
    return view('dashboard.category.shipping.ship_infor');
});

