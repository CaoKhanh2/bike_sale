<?php
use App\Http\Controllers\ChucVuContrller;
use App\Http\Controllers\CleanImagesController;
use App\Http\Controllers\DataContrller;
use App\Http\Controllers\XeDangBan;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\HangXeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\nguoidungController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SearchContrller;
use App\Http\Controllers\SubIndexContrller;
use App\Http\Controllers\TaiKhoanContrller;
use App\Http\Controllers\ThongSoKyThuatXeDapDienContrller;
use App\Http\Controllers\ThongSoKyThuatXeMayContrller;
use App\Http\Controllers\VanChuyenController;
use App\Http\Controllers\ThongTinXeController;
use App\Http\Controllers\XeDangBanController;
use App\Http\Controllers\XeMayController;
use App\Http\Controllers\XeDangKyThuMuaController;
use App\Models\ThongSoKyThuatXeDapDien;
use App\Models\ThongSoKyThuatXeMay;

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


// Route::get('/welcome', function () {
//     return view('welcome');
// });


/**
 * 
 * -------------- Website --------------
 * 
 */

    Route::get('/', function () {
        return view('index');
    });

    // Tìm kiếm ----------

    Route::get('/sub_index',[SearchContrller::class, 'searchData'])->name('timkiem');

    // ----------

    // Trang hiển thị sản phẩm ----------
    Route::get('/sub_index/xemay', [SubIndexContrller::class, 'getData']);


    Route::get('/sub_index/xedapdien', [SubIndexContrller::class, 'getData']);

    // ----------

    Route::get('sub_page/sale_page', function () {
        return view('sale_page');
    });

    // Route::get('/index', function () {
    //     return view('auth.index');
    // });


/**
 * 
 * -------------- EndWebsite --------------
 * 
 */



/**
 * 
 * -------------- Add data --------------
 * 
 */
    Route::get('/all_data', [DataContrller::class, 'getData'])->name('all_data');

    Route::get('/data1', [HangXeController::class, 'data']);
    Route::get('/data2', [DongXeController::class, 'data']);
    Route::get('/data3', [ChucVuContrller::class, 'data']);
    Route::get('/data4', [NhanVienController::class, 'data']);
    Route::get('/data5', [TaiKhoanContrller::class, 'data']);
    Route::get('/data6', [ThongSoKyThuatXeMayContrller::class, 'data']);
    Route::get('/data7', [ThongSoKyThuatXeDapDienContrller::class, 'data']);
    Route::get('/data8', [ThongTinXeController::class, 'data']);
    Route::get('/data9', [XeDangBanController::class, 'data']);

/**
 * 
 * -------------- End Add data --------------
 * 
 */


/**
 * 
 * -------------- Clean Image --------------
 * 
 */
    
    Route::get('/clean',[CleanImagesController::class,'cleanIndex']);
    Route::get('/clean/clean_img_logo',[CleanImagesController::class,'cleanImgLogo']);
    Route::get('/clean/clean_img_vehicle',[CleanImagesController::class,'cleanImgVehicle']);
    Route::get('/clean/clean_img_posted',[CleanImagesController::class,'cleanImgPosted']);

/**
 * 
 * -------------- End Clean Image --------------
 * 
 */



/**
 * 
 * -------------- LoginDashboard --------------
 * 
 */

    Route::get('/login', function () {
        return view('dashboard.auth.login');
    });
    Route::post('/login', [TaiKhoanContrller::class, 'login'])->name('login');

    Route::post('/logout', [TaiKhoanContrller::class, 'logout'])->name('logout');

    // Route::get('/dasboard', function () {
    //     return view('dashboard.index');
    // })->middleware(['roleAcc']);

/**
 * 
 * -------------- End LoginDashboard --------------
 * 
 */

Route::middleware(['auth', 'role'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dash.index');


    /**
     * 
     * ---------- Quản lý hệ thống ----------
     * 
     */

    // Route::get('/dashboard/sys', function () {
    //     return view('dashboard.sys.user-authorization');
    // })->middleware('permission:Quản trị viên');

        Route::middleware('permission:Quản trị viên')->group(function () {
            Route::get('/dashboard/sys/user_authorization', [TaiKhoanContrller::class, 'index1']);
            Route::patch('/dashboard/sys/user_authorization/{id}', [TaiKhoanContrller::class, 'update1'])->name('capnhattrangthai');

            Route::get('/dashboard/sys/acc_management/employee_account', [TaiKhoanContrller::class, 'index2']);
            Route::patch('/dashboard/sys/acc_management/employee_account/{id}', [TaiKhoanContrller::class, 'update2']);
        });

    /**
     * 
     * ---------- **End** ----------
     *
     */

    

    /**
     * 
     * ---------- Quản lý danh mục ----------
     * 
     */

        /**
         * ---------- Quản lý danh mục xe ----------
         */

            // ---------- Hãng xe ----------
            Route::get('/dashboard/category/vehicle/automaker_info', [HangXeController::class, 'index']);
            Route::post('/dashboard/category/vehicle/automaker_info', [HangXeController::class, 'store'])->name('themhangxe');
            Route::get('/dashboard/category/vehicle/automaker_info/{id}', [HangXeController::class, 'destroy'])->name('xoahangxe');

            Route::get('/dashboard/category/vehicle/detail_automaker_info', function () {
                return view('dashboard.category.automaker.vehicle.detail_automaker_info');
            });

            // ---------- **** ----------

            // ---------- Dòng xe ----------
            Route::get('/dashboard/category/vehicle/vehicle_line_infor', function () {
                return view('dashboard.category.vehicle.vehicle_line.vehicle_line_infor');
            });

            Route::get('/dashboard/category/vehicle/vehicle_line_infor', [DongXeController::class, 'index']);
            Route::post('/dashboard/category/vehicle/vehicle_line_infor', [DongXeController::class, 'store'])->name('themdongxe');
            Route::get('/dashboard/category/vehicle/vehicle_line_infor/{id}', [DongXeController::class, 'destroy'])->name('xoadongxe');

            // ---------- **** ----------

            // ---------- Thông tin xe ----------
            Route::get('/dashboard/category/vehicle/vehicle_infor', [ThongTinXeController::class, 'index']);
            Route::post('/dashboard/category/vehicle/vehicle_infor', [ThongTinXeController::class, 'store'])->name('themthongtinxe');
            Route::get('/dashboard/category/vehicle/vehicle_infor/{maxemay}', [ThongTinXeController::class, 'del_xemay'])->name('xoathongtinxemay');
            Route::get('/dashboard/category/vehicle/vehicle_infor/{maxedapdien}', [ThongTinXeController::class, 'del_Xedapdien'])->name('xoathongtinxedapdien');
            
            Route::get('/dashboard/category/vehicle/detail_vehicle_infor/{maxemay}', [XeMayController::class, 'show'])->name('ctthongtinxemay');
            Route::get('/dashboard/category/vehicle/detail_vehicle_infor/{maxedapdien}', [XeMayController::class, 'show'])->name('ctthongtinxedapdien');
            Route::get('/dashboard/category/vehicle/detail_vehicle_infor/delete_image/{id}/{index}', [ThongTinXeController::class, 'delete_image'])->name('xoaanh');

            // Route::post('/dashboard/category/vehicle/vehicle_infor', [XeDapDienController::class, 'store'])->name('themthongtinxedapien');
            //Route::post('/dashboard/category/customer/customer_info/data', [XeDapDienController::class, 'store'])->name('themthongtinxe');

            // ---------- **** ----------

        /**
         * ---------- **** ----------
         */

        /**
         * ---------- Quản lý danh mục khách hàng ----------
         */
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

        /**
         * ---------- **** ----------
         */

        /**
         * ---------- Quản lý danh mục vận chuyển ----------
         */
            Route::get('/dashboard/category/shipping/ship_infor', function () {
                return view('dashboard.category.shipping.ship_infor');
            });

            Route::get('/dashboard/category/shipping/ship_infor', [VanChuyenController::class, 'index']);

        /**
         * ---------- **** ----------
         */

        /**
         * ---------- Quản lý danh mục nhân viên ----------
         */
            Route::get('/dashboard/category/sales_agent/staff_infor', function () {
                return view('dashboard.category.sales_agent.staff_infor');
            });

            Route::get('/dashboard/category/sales_agent/staff_infor', [NhanVienController::class, 'index']);

    // ----------

    // Quan ly giao dich ----------

    Route::get('/dashboard/transaction/purchasing_manage', [XeDangKyThuMuaController::class, 'index'])->name('xedkthumua');
    Route::get('/dashboard/tranction/purchasing_manage/{id}', [XeDangKyThuMuaController::class, 'updatedon'])->name('duyetdon');
    Route::post('/sending_bike',[XeDangKyThuMuaController::class,'store'])->name('dangkythumua');
    Route::get('/selling_item',[XeDangKyThuMuaController::class,'create'])->name('nhapxethumua');

    Route::get('/dashboard/transaction/selling', function () {
        return view('dashboard.transaction.selling.sell_manage');
    });

    /**
     * 
     * ---------- **End** ----------
     * 
     */


    /**
     * 
     * ---------- Báo cáo thống kê ----------
     * 
     */
        Route::middleware('permission:Quản lý')->group(function () {
            Route::get('dashboard/report/sales_situation', function () {
                return view('dashboard.report.sales_situation');
            });

            Route::get('/dashboard/report/inventory', function () {
                return view('dashboard.report.inventory');
            });
        });

    /**
     * 
     * ---------- **End** ----------
     *
     */
});


Route::get('/dashboard/transaction/purchasing_manage', [XeDangKyThuMuaController::class, 'index'])->name('xedkthumua');
Route::get('/dashboard/tranction/purchasing_manage/{id}', [XeDangKyThuMuaController::class, 'updatedon'])->name('duyetdon');

Route::get('/selling_item', function () {
    return view('guest_acc.selling_item');
});
Route::post('/sending_bike',[XeDangKyThuMuaController::class,'store'])->name('dangkythumua');


Route::get('/cart_index', function () {
    return view('cart.cart_index');
});


Route::get('/warning', function () {
    return view('notification.warning');
})->name('warning');




