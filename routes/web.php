<?php
use App\Http\Controllers\ChucVuContrller;
use App\Http\Controllers\DkBanXeController;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\HangXeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\nguoidungController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\TaiKhoanContrller;
use App\Http\Controllers\VanChuyenController;
use App\Http\Controllers\ThongTinXeController;
use App\Http\Controllers\XeDapDienController;
use App\Http\Controllers\XeMayController;
use App\Http\Controllers\XeDangKyThuMuaController;
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

// Route::get('/success', function () {
//     return view('dashboard.modal.success');
// });

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

// Route::get('/sub-index/xemay', function () {
//     return view('sub-index');
// });

Route::get('/sub-index/xemay', [ThongTinXeController::class, 'index2']);
Route::get('/sub-index/xedapdien', [ThongTinXeController::class, 'index2']);


Route::get('/sale-page', function () {
    return view('sale-page');
});

Route::get('/index', function () {
    return view('auth.index');
});

// ----------

// Add data ----------
Route::get('/data1', [HangXeController::class,'data']);
Route::get('/data2', [DongXeController::class,'data']);
Route::get('/data3', [TaiKhoanContrller::class, 'data']);
Route::get('/data4', [ChucVuContrller::class, 'data']);
// ----------

// Route::post('/login',function(){
//     return view ('dashboard.auth.login');
// });

Route::get('/login', function () {
    return view('dashboard.auth.login');
})->name('login');

Route::post('/login', [TaiKhoanContrller::class, 'login']);

Route::post('/logout', [TaiKhoanContrller::class, 'logout'])->name('logout');

// Route::get('/dasboard', function () {
//     return view('dashboard.index');
// })->middleware(['roleAcc']);



Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dash.index');

    // Quản lý hệ thống ----------

    // Route::get('/dashboard/sys', function () {
    //     return view('dashboard.sys.user-authorization');
    // })->middleware('permission:Quản trị viên');

    Route::middleware('permission:Quản trị viên')->group(function () {

        Route::get('/dashboard/sys/user_authorization', [TaiKhoanContrller::class, 'index1']);
        Route::patch('/dashboard/sys/user_authorization/{id}', [TaiKhoanContrller::class, 'update1'])->name('capnhattrangthai');

        Route::get('/dashboard/sys/acc_management/employee_account', [TaiKhoanContrller::class, 'index2']);
        Route::patch('/dashboard/sys/acc_management/employee_account/{id}', [TaiKhoanContrller::class, 'update2']);

    });
    // ----------

    // Danh muc xe ----------

    Route::get('/dashboard/category/vehicle/automaker_info', [HangXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/automaker_info', [HangXeController::class, 'store'])->name('themhangxe');
    Route::get('/dashboard/category/vehicle/automaker_info/{id}', [HangXeController::class, 'destroy'])->name('xoahangxe');

    Route::get('/dashboard/category/vehicle/detail_automaker_info', function () {
        return view('dashboard.category.automaker.vehicle.detail_automaker_info');
    });

    Route::get('/dashboard/category/vehicle/vehicle_line_infor', function () {
        return view('dashboard.category.vehicle.vehicle_line.vehicle_line_infor');
    });

    Route::get('/dashboard/category/vehicle/vehicle_line_infor', [DongXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/vehicle_line_infor', [DongXeController::class, 'store'])->name('themdongxe');
    Route::get('/dashboard/category/vehicle/vehicle_line_infor/{id}', [DongXeController::class, 'destroy'])->name('xoadongxe');

    Route::get('/dashboard/category/vehicle/vehicle_infor', function () {
        return view('dashboard.category.vehicle.vehicle_infor');
    });

    // Route::get('/dashboard/category/vehicle/detail_vehicle_infor', function () {
    //     return view('dashboard.category.vehicle.detail_vehicle_infor');
    // });
    Route::get('/dashboard/category/vehicle/detail_vehicle_infor/{maxemay}', [XeMayController::class, 'show'])->name('ctthongtinxemay');

    Route::get('/dashboard/category/vehicle/vehicle_infor', [ThongTinXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/vehicle_infor', [ThongTinXeController::class, 'store'])->name('themthongtinxe');
    Route::post('/dashboard/category/vehicle/vehicle_infor', [ThongTinXeController::class, 'store'])->name('themthongtinxe');
    Route::get('/dashboard/category/vehicle/vehicle_infor/{maxemay}', [ThongTinXeController::class, 'destroy_Xemay'])->name('xoathongtinxemay');

    // Route::post('/dashboard/category/vehicle/vehicle_infor', [XeDapDienController::class, 'store'])->name('themthongtinxedapien');
    //Route::post('/dashboard/category/customer/customer_info/data', [XeDapDienController::class, 'store'])->name('themthongtinxe');

    // ----------

    // Danh muc khach hang ----------

    Route::get('/dashboard/category/customer/customer_info', function () {
        return view('dashboard.category.customer.customer_info');
    });
    Route::get('/dashboard/category/customer/customer_info', [NguoiDungController::class, 'index']);

    Route::get('/customer/detail_customer_info', function () {
        return view('dashboard.category.customer.detail_customer_info');
    });

    Route::post('/dashboard/category/customer/customer_info', [NguoiDungController::class, 'store'])->name('themthongtinkhachhang');
    Route::get('/dashboard/category/customer/customer_info/{id}', [NguoiDungController::class, 'destroy'])->name('xoathongtinkhachhang');
    Route::get('/dashboard/category/customer/detail_customer_info/{id}', [NguoiDungController::class, 'show'])->name('ctthongtinkhachhang');
    Route::patch('/dashboard/category/customer/detail_customer_info/{id}', [NguoiDungController::class, 'update'])->name('capnhatthongtinkhachhang');

    //----------

    // Danh muc van chuyen ----------
    Route::get('/dashboard/category/shipping/ship_infor', function () {
        return view('dashboard.category.shipping.ship_infor');
    });

    Route::get('/dashboard/category/shipping/ship_infor', [VanChuyenController::class, 'index']);
    //  ----------

    // Danh muc nhan vien ----------
    Route::get('/dashboard/category/sales_agent/staff_infor', function () {
        return view('dashboard.category.sales_agent.staff_infor');
    });

    Route::get('/dashboard/category/sales_agent/staff_infor', [NhanVienController::class, 'index']);

    // ----------

    // Quan ly giao dich ----------

    Route::get('/dashboard/transaction/purchasing_manage',[XeDangKyThuMuaController::class,'index'])->name('xedkthumua');
    Route::get('/dashboard/tranction/purchasing_manage/{id}',[XeDangKyThuMuaController::class,'updatedon'])->name('duyetdon');
    Route::get('/selling_item', function () {
        return view('/user.selling_item');
    });

    Route::get('/dashboard/transaction/selling', function () {
        return view('dashboard.transaction.selling.sell_manage');
    });

    Route::get('/cart_index', function () {
        return view('cart.cart_index');
    });

    //  ----------

    // Bao cao thong ke ----------
    Route::middleware('permission:Quản lý')->group(function () {
        Route::get('/dashboard/report/best-selling-items', function () {
            return view('dashboard.report.best-selling-items');
        });

        Route::get('/dashboard/report/inventory', function () {
            return view('dashboard.report.inventory');
        });
    });
});

Route::get('/warning', function () {
    return view('notification.warning');
})->name('warning');
