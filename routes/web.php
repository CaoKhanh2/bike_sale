<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard.car.car_catalog');
});

Route::get('/car_catalog/detail_inforcar', function () {
    return view('dashboard.car.detail_inforcar');
});

Route::get('/customer', function () {
    return view('dashboard.customer.customer_info');
});

Route::get('/customer/detail_customer_info', function () {
    return view('dashboard.customer.detail_customer_info');
});

Route::get('/shipping/ship_infor', function () {
    return view('dashboard.shipping.ship_infor');
});

