<?php

use App\Http\Controllers\BaoCaoThongKeController;
use App\Http\Controllers\ChucVuContrller;
use App\Http\Controllers\CleanImagesController;
use App\Http\Controllers\DataContrller;
use App\Http\Controllers\XeDangBan;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\DoThiController;
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


/**
 *
 * -------------- Acount --------------
 *
 */

    Route::group(['prefix' => 'account'], function () {

        Route::get('/guest/login', function () {
            return view('guest-acc.auth.login');
        })->name('dangnhap-Guest');
    
        Route::post('/guest/login', [NguoiDungController::class, 'loginGuest'])->name('thuchien-dangnhap-Guest');
    
        Route::post('/guest/logout', [NguoiDungController::class, 'logoutGuest'])->name('thuchien-dangxuat-Guest');
    
        Route::get('/guest/register', function () {
            return view('guest-acc.auth.register');
        })->name('dangky-Guest');
    
        Route::post('/guest/register', [NguoiDungController::class, 'store2'])->name('thuchien-dangky-Guest');

        //Xác thực email tài khoản

            Route::get('/guest/verify-acc/{id}', [NguoiDungController::class, 'verify_acc'])->name('thuchien-xacnhan-mail-Guest');
        
        // ----------
        
        //Xử lý quên mật khẩu
            //? Hiển thị trang cấp email khôi phục
            Route::get('/guest/forgot-password', function () {
                return view('guest-acc.auth.forgot-password');
            })->name('quen-matkhau-Guest');
            //? Gửi yêu cầu thực hiện việc đặt lại mật khẩu
            Route::post('/guest/forgot-password', [NguoiDungController::class, 'forgot_password'])->name('yeucau-datlai-matkhau-Guest');
            //? Hiển thị trang đặt lại mật khẩu mới
            Route::get('/guest/reset-password/{token}', [NguoiDungController::class, 'reset_password'])->name('datlai-matkhau-Guest');
            //? Gửi yêu cầu thực hiện việc đặt lại mật khẩu mới
            Route::post('/guest/reset-password/{token}', [NguoiDungController::class, 'check_reset_password'])->name('thuchien-datlai-matkhau-Guest');

        // ----------

        //Thông tin tài khoản khách hàng người dùng     
            Route::get('/profile', function () {
                return view('guest-acc.auth.profile-acc');
            })->middleware(['roleGuest'])->name('thongtin-Guest');
        // ----------

    });

    // Route::get('/success', function() {
    //     return view('modal-webs.inform-success-login');
    // });

    Route::get('/mail', function () {
        return view('mail.forgot-password-mail');
    });
    
    // Route::get('/mail', [NguoiDungController::class, 'sendmail']);


/**
 *
 * -------------- End Account --------------
 *
 */

/**
 *
 * -------------- Website --------------
 *
 */

    Route::get('/', function () {
        return view('index');
    })->name('indexWeb');

    Route::get('/selling-item', [XeDangKyThuMuaController::class, 'index2']);

    Route::middleware(['roleGuest'])->group(function () {

        Route::post('/selling-item/sending-item', [XeDangKyThuMuaController::class, 'store'])->name('themdldangkythumua');

        Route::get('/cart-index', function () {
            return view('guest-acc.cart.cart-index');
        });
    });

    // Tìm kiếm ----------

    Route::get('/sub-index', [SearchContrller::class, 'searchData'])->name('timkiem');

    // ----------

    // Trang hiển thị sản phẩm ----------
    Route::get('/sub-index/xemay', [SubIndexContrller::class, 'getData']);

    Route::get('/sub-index/xedapdien', [SubIndexContrller::class, 'getData']);

    // ----------

    Route::get('sub-page/sale-page', function () {
        return view('sale-page');
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



/**
 *
 * -------------- Dashboard --------------
 *
 */


Route::middleware(['auth', 'roleDash'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dash.index');

    /**
     *
     * ---------- Quản lý hệ thống ----------
     *
     */

    Route::middleware('permission:Quản trị viên')->group(function () {
        Route::get('/dashboard/sys/user-authorization', [TaiKhoanContrller::class, 'index1']);
        Route::patch('/dashboard/sys/user-authorization/{id}', [TaiKhoanContrller::class, 'update1'])->name('capnhattrangthai');

        Route::get('/dashboard/sys/management-acc/employee-account', [TaiKhoanContrller::class, 'index2'])->name('thongtintaikhoannhanvien');
        Route::patch('/dashboard/sys/management-acc/employee-account/{id}', [TaiKhoanContrller::class, 'update2']);
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
    Route::get('/dashboard/category/vehicle/automaker-info', [HangXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/automaker-info', [HangXeController::class, 'store'])->name('themhangxe');
    Route::get('/dashboard/category/vehicle/automaker-info/{id}', [HangXeController::class, 'destroy'])->name('xoahangxe');

    Route::get('/dashboard/category/vehicle/detail-automaker-info', function () {
        return view('dashboard.category.automaker.vehicle.detail-automaker-info');
    });

    // ---------- **** ----------

    // ---------- Dòng xe ----------
    Route::get('/dashboard/category/vehicle/vehicle-line-infor', function () {
        return view('dashboard.category.vehicle.vehicle-line.vehicle-line-infor');
    });

    Route::get('/dashboard/category/vehicle/vehicle-line-infor', [DongXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/vehicle-line-infor', [DongXeController::class, 'store'])->name('themdongxe');
    Route::get('/dashboard/category/vehicle/vehicle-line-infor/{id}', [DongXeController::class, 'destroy'])->name('xoadongxe');

    // ---------- **** ----------

    // ---------- Thông tin xe ----------
    Route::get('/dashboard/category/vehicle/vehicle-infor', [ThongTinXeController::class, 'index']);
    Route::post('/dashboard/category/vehicle/vehicle-infor', [ThongTinXeController::class, 'store'])->name('themthongtinxe');
    Route::get('/dashboard/category/vehicle/vehicle-infor/{maxemay}', [ThongTinXeController::class, 'del_xemay'])->name('xoathongtinxemay');
    Route::get('/dashboard/category/vehicle/vehicle-infor/{maxedapdien}', [ThongTinXeController::class, 'del_Xedapdien'])->name('xoathongtinxedapdien');

    Route::post('/dashboard/category/vehicle/vehicle-infor/export', [ThongTinXeController::class, 'exporrt_excel_report_infor_motorbike'])->name('xuatfile-excel-thongtinxemay');

    Route::get('/dashboard/category/vehicle/detail-vehicle-infor/{maxemay}', [ThongTinXeController::class, 'show'])->name('ctthongtinxemay');
    Route::get('/dashboard/category/vehicle/detail-vehicle-infor/{maxedapdien}', [ThongTinXeController::class, 'show'])->name('ctthongtinxedapdien');
    Route::get('/dashboard/category/vehicle/detail-vehicle-infor/delete_image/{id}/{index}', [ThongTinXeController::class, 'delete_image'])->name('xoaanh');

    // Route::post('/dashboard/category/vehicle/vehicle-infor', [XeDapDienController::class, 'store'])->name('themthongtinxedapien');
    //Route::post('/dashboard/category/customer/customer-info/data', [XeDapDienController::class, 'store'])->name('themthongtinxe');

    // ---------- **** ----------

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý danh mục khách hàng ----------
     */
    // Route::get('/dashboard/category/customer/customer-info', function () {
    //     return view('dashboard.category.customer.customer-info');
    // });
    Route::get('/dashboard/category/customer/customer-info', [NguoiDungController::class, 'index']);

    Route::get('/customer/detail_customer-info', function () {
        return view('dashboard.category.customer.detail_customer-info');
    });

    Route::post('/dashboard/category/customer/customer-info', [NguoiDungController::class, 'store'])->name('themthongtinkhachhang');
    Route::get('/dashboard/category/customer/customer-info/{id}', [NguoiDungController::class, 'destroy'])->name('xoathongtinkhachhang');
    Route::get('/dashboard/category/customer/detail-customer-info/{id}', [NguoiDungController::class, 'show'])->name('ctthongtinkhachhang');
    Route::patch('/dashboard/category/customer/detail-customer-info/{id}', [NguoiDungController::class, 'update'])->name('capnhatthongtinkhachhang');

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý danh mục vận chuyển ----------
     */
    Route::get('/dashboard/category/shipping/ship-infor', function () {
        return view('dashboard.category.shipping.ship-infor');
    });

    Route::get('/dashboard/category/shipping/ship-infor', [VanChuyenController::class, 'index']);

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý danh mục nhân viên ----------
     */
    Route::get('/dashboard/category/sales-agent/staff-infor', function () {
        return view('dashboard.category.sales-agent.staff-infor');
    });

    Route::get('/dashboard/category/sales-agent/staff-infor', [NhanVienController::class, 'index']);

    // ----------

    // Quan ly giao dich ----------

    Route::get('/dashboard/transaction/purchasing-manage', [XeDangKyThuMuaController::class, 'index'])->name('xedkthumua');
    Route::get('/dashboard/tranction/purchasing-manage/{id}', [XeDangKyThuMuaController::class, 'updatedon'])->name('duyetdon');

    Route::get('/dashboard/transaction/selling', function () {
        return view('dashboard.transaction.selling.sell-manage');
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
    Route::middleware('permission:Quản trị viên|Quản lý')->group(function () {
    
    /**
     * ---------- Báo cáo tình hình bán hàng ----------
     */

        // Route::get('/dashboard/report/sales-situation', function () {
        //     return view('dashboard.report.sales-situation');
        // })->name('baocaothongke');

        Route::get('/dashboard/report/sales-situation', [BaoCaoThongKeController::class, 'data_sales_situation'])->name('hienthithongtinbanhang');
        
        Route::post('/dashboard/report/sales-situation', [BaoCaoThongKeController::class, 'data_sales_situation'])->name('bieudo-tinhhinhbanhang');

        Route::post('/dashboard/report/sales-situation/export', [BaoCaoThongKeController::class, 'exporrt_report_sales_situation'])->name('xuatfile-excel-thongtintinhhinhbanhang');
        
    /**
     * ---------- **** ----------
     */

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


/**
 *
 * -------------- End Dashboard --------------
 *
 */


// Route::get('/chart', [DoThiController::class, 'salesChart']);

/**
 *
 * -------------- Add data --------------
 *
 */
Route::get('/all-data', [DataContrller::class, 'getData'])->name('all-data');

Route::get('/data1', [HangXeController::class, 'data']);
Route::get('/data2', [DongXeController::class, 'data']);
Route::get('/data3', [ChucVuContrller::class, 'data']);
Route::get('/data4', [NhanVienController::class, 'data']);
Route::get('/data5', [TaiKhoanContrller::class, 'data']);
Route::get('/data6', [ThongSoKyThuatXeMayContrller::class, 'data']);
Route::get('/data7', [ThongSoKyThuatXeDapDienContrller::class, 'data']);
Route::get('/data8', [ThongTinXeController::class, 'data']);
Route::get('/data9', [XeDangBanController::class, 'data']);
Route::get('/data10', [NguoiDungController::class, 'data']);

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

Route::get('/clean', [CleanImagesController::class, 'cleanIndex']);
Route::get('/clean/clean_img_logo', [CleanImagesController::class, 'cleanImgLogo']);
Route::get('/clean/clean_img_vehicle', [CleanImagesController::class, 'cleanImgVehicle']);
Route::get('/clean/clean_img_posted', [CleanImagesController::class, 'cleanImgPosted']);

/**
 *
 * -------------- End Clean Image --------------
 *
 */
