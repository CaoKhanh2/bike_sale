<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BaoCaoThongKeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ChucVuContrller;
use App\Http\Controllers\CleanImagesController;
use App\Http\Controllers\DataContrller;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\HangXeController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\KhoHangController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SearchContrller;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThongSoKyThuatXeDapDienContrller;
use App\Http\Controllers\ThongSoKyThuatXeMayContrller;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\ThongTinXeController;
use App\Http\Controllers\XeDangBanController;
use App\Http\Controllers\XeDangKyThuMuaController;
use App\Http\Controllers\RuiRoController;


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

    //Đăng ký tài khoản
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
    })
        ->middleware(['roleGuest'])
        ->name('thongtin-Guest');

    Route::post('/profile/change-infor', [NguoiDungController::class, 'update_infor_Guest'])
        ->middleware(['roleGuest'])
        ->name('thuchien-thaydoi-thongtin-Guest');

    Route::post('/profile/change-pass', [NguoiDungController::class, 'change_password_guest'])
        ->middleware(['roleGuest'])
        ->name('thuchien-thaydoi-matkhau-Guest');

    // ----------
});


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


Route::get('/', [XeDangBanController::class, 'showdata2'])->name('indexWeb');

Route::get('/purchasing-form', [XeDangKyThuMuaController::class, 'index2'])->name('gui-form-thumua-Guest');

Route::middleware(['roleGuest'])->group(function () {
    Route::post('/purchasing-form/sending', [XeDangKyThuMuaController::class, 'store'])->name('thuchien-dangkythumua-Guest');

    // Giỏ hàng ----------
    Route::get('/cart-index', [GioHangController::class, 'show_cart'])->name('hienthi-giohang-Guest');

    Route::get('/cart-index/add/{maxedangban}', [GioHangController::class, 'add_cart'])->name('them-giohang-Guest');

    Route::post('/cart-index', [GioHangController::class, 'destroy_cart'])->name('xoa-giohang-Guest');

    // ----------

    // Đơn hàng ----------
    Route::get('/checkout/{id}', [DonHangController::class, 'index_checkout'])->name('xacnhan-giohang-Guest');
    Route::post('/place-order/1', [DonHangController::class, 'dat_hang1'])->name('dathang-Guest');
    Route::post('/place-order/2', [DonHangController::class, 'dat_hang2'])->name('dathang-vnpay-Guest');

    Route::get('/make-payments', [DonHangController::class, 'add_vnpay']);

    Route::get('/thanhs1', [DonHangController::class, 'show_thank1'])->name('thanks1');
    Route::get('/thanks2', [DonHangController::class, 'show_thank2'])->name('thanks2');

    
    
    // Route::post('/online-checkout',[DonHangController::class, 'dat_hang'])->name('thanhtoan-onl');
    // Route::post('/online-checkout',[OnlineCheckoutController::class, 'online_checkout'])->name('thanhtoan-onl');;
    // Route::get('/thanks',[OnlineCheckoutController::class, 'thanks']);

    // Lịch sử bán xe
    Route::get('/sold-history', [NguoiDungController::class, 'purchasehistory'])->name('khach-banxe'); // Xem đơn hàng
    // Lịch sử đơn hàng ----------
    Route::get('/my-order', [NguoiDungController::class, 'orderhistory'])->name('khach-donhang'); // Xem đơn hàng
    Route::get('/my-order/view-order', [NguoiDungController::class, 'view'])->name('khach-ctdonhang'); // Xem chi tiết đơn hàng

    Route::post('/my-order/view-order/export-invoice', [HoaDonController::class,'export_invoice_pdf'])->name('xuatfile-pdf-hoadon');
    
    // Hiển thị sản phẩm trong giỏ
    Route::get('load-cart-data', [GioHangController::class, 'cartcount']); // Xem chi tiết đơn hàng


    // ----------
});

// Tìm kiếm ----------

Route::post('/sub-index/search', [SearchContrller::class, 'searchData1'])->name('timkiem');

// Route::post('/sub-index/search', [SearchContrller::class, 'search_subData1'])->name('sub-timkiem');

Route::get('/sub-index/search-automaker/{id}', [SearchContrller::class, 'searchData2'])->name('timkiem-theohangxe');

// ----------

// Trang hiển thị sản phẩm ----------

Route::get('/sub-index', function () {
    return view('sub-index');
})->name('hienthi-thongtinxe');

Route::get('/sub-index/motorbike', [XeDangBanController::class, 'showData'])->name('hienthi-thongtinxemay-Guest');

Route::get('/sub-index/electric-bicycles', [XeDangBanController::class, 'showData'])->name('hienthi-thongtinxedapdien-Guest');

// ----------

// Trang hiển thị chi tiết thông tin sản phẩm ----------

Route::get('sub-index/motorbike/sale-page/{maxe}', [XeDangBanController::class, 'show_Detail_Data'])->name('hienthi-chitietthongtinxemay-Guest');
Route::get('sub-index/electric-bicycles/sale-page/{maxe}', [XeDangBanController::class, 'show_Detail_Data'])->name('hienthi-chitietthongtinxedapdien-Guest');

// ----------

/**
 *
 * -------------- EndWebsite --------------
 *
 */

/**
 *
 * -------------- AccountDashboard --------------
 *
 */

Route::get('/login', function () {
    return view('dashboard.auth.login');
});
Route::post('/login', [TaiKhoanController::class, 'login'])->name('login');

Route::post('/logout', [TaiKhoanController::class, 'logout'])->name('logout');

Route::get('/profile', [TaiKhoanController::class, 'profile_account'])->middleware(['auth', 'roleDash'])->name('thongtin-taikhoan');
Route::patch('/profile', [TaiKhoanController::class, 'update_profile_account'])->middleware(['auth', 'roleDash'])->name('capnhat-thongtin-taikhoan');

Route::post('/profile/change-password', [TaiKhoanController::class, 'change_password'])
        ->middleware(['roleGuest'])
        ->name('thuchien-thaydoi-matkhau');

// Route::get('/dasboard', function () {
//     return view('dashboard.index');
// })->middleware(['roleAcc']);

// Route::post('/password/confirm', function () {
//     return view('dashboard.auth.login');
// })->name('password.confirm');

/**
 *
 * -------------- End AccountDashboard --------------
 *
 */

/**
 *
 * -------------- Dashboard --------------
 *
 */

Route::middleware(['auth', 'roleDash'])->group(function () {
    Route::get('/dashboard', [IndexController::class,'index'])->name('dash.index');

    /**
     *
     * ---------- Quản lý hệ thống ----------
     *
     */

    Route::middleware('permission:Quản trị viên')->group(function () {
        Route::get('/dashboard/sys/user-authorization', [TaiKhoanController::class, 'index1']);
        Route::patch('/dashboard/sys/user-authorization/{id}', [TaiKhoanController::class, 'update1'])->name('capnhattrangthai');

        Route::get('/dashboard/sys/management-acc/employee-account', [TaiKhoanController::class, 'index2'])->name('thongtintaikhoannhanvien');
        Route::patch('/dashboard/sys/management-acc/employee-account/{id}', [TaiKhoanController::class, 'update2']);
        Route::get('/dashboard/sys/management-acc/employee-account/add-employee-account', [TaiKhoanController::class, 'add_acc_employee'])->name('them-taikhoannhanvien');
        Route::post('/dashboard/sys/management-acc/employee-account/add-employee-account', [TaiKhoanController::class, 'store1'])->name('thuchien-them-taikhoannhanvien');
        Route::get('/dashboard/sys/management-acc/employee-account/delete-employee-account/{id}', [TaiKhoanController::class, 'destroy'])->name('xoa-taikhoan-nhanvien');
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
    Route::get('/dashboard/category/vehicle/automaker-info', [HangXeController::class, 'index'])->name('thongtinhangxe');
    Route::post('/dashboard/category/vehicle/automaker-info', [HangXeController::class, 'store'])->name('themhangxe');
    Route::get('/dashboard/category/vehicle/automaker-info/detail-automaker-info/{id}', [HangXeController::class, 'update'])->name('capnhathangxe');
    Route::patch('/dashboard/category/vehicle/automaker-info/detail-automaker-info/{id}', [HangXeController::class, 'act_update'])->name('thuchien-capnhathangxe');
    Route::get('/dashboard/category/vehicle/automaker-info/{id}', [HangXeController::class, 'destroy'])->name('xoahangxe');


    // ---------- **** ----------

    // ---------- Dòng xe ----------

    Route::get('/dashboard/category/vehicle/vehicle-line-infor', [DongXeController::class, 'index'])->name('thongtindongxe');
    Route::post('/dashboard/category/vehicle/vehicle-line-infor', [DongXeController::class, 'store'])->name('themdongxe');
    Route::get('/dashboard/category/vehicle/vehicle-line-infor/detail-line-infor/{id}', [DongXeController::class, 'update'])->name('capnhatdongxe');
    Route::patch('/dashboard/category/vehicle/vehicle-line-infor/detail-line-infor/{id}', [DongXeController::class, 'act_update'])->name('thuchien-capnhatdongxe');

    Route::get('/dashboard/category/vehicle/vehicle-line-infor/{id}', [DongXeController::class, 'destroy'])->name('xoadongxe');

    // ---------- **** ----------

    // ---------- Thông tin xe ----------
    Route::get('/dashboard/category/vehicle/vehicle-infor', [ThongTinXeController::class, 'index'])->name('thongtinxe-index');
    Route::post('/dashboard/category/vehicle/vehicle-infor', [ThongTinXeController::class, 'store'])->name('themthongtinxe');
    Route::get('/dashboard/category/vehicle/vehicle-infor/{maxemay}', [ThongTinXeController::class, 'del_xemay'])->name('xoathongtinxemay');
    Route::get('/dashboard/category/vehicle/vehicle-infor/{maxedapdien}', [ThongTinXeController::class, 'del_xedapdien'])->name('xoathongtinxedapdien');

    Route::post('/dashboard/category/vehicle/vehicle-infor/export', [ThongTinXeController::class, 'exporrt_excel_report_infor_motorbike'])->name('xuatfile-excel-thongtinxemay');

    Route::get('/dashboard/category/vehicle/detail-vehicle-infor/{maxe}', [ThongTinXeController::class, 'detail_vehicle_infor'])->name('ctthongtinxe');

    Route::get('/dashboard/category/vehicle/detail-vehicle-infor/delete_image/{id}/{index}', [ThongTinXeController::class, 'delete_image'])->name('xoaanh');

    Route::post('/dashboard/category/vehicle/vehicle-infor/update/{maxe}', [ThongTinXeController::class, 'update_xe'])->name('capnhat-thongtinxe');

    // ---------- **** ----------

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý danh mục khách hàng ----------
     */

    Route::get('/dashboard/category/customer/customer-info', [NguoiDungController::class, 'index'])->name('thongtinkhachang');
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
    // Route::get('/dashboard/category/shipping/ship-infor', function () {
    //     return view('dashboard.category.shipping.ship-infor');
    // });

    //Route::get('/dashboard/category/shipping/ship-infor', [VanChuyenController::class, 'index']);

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý danh mục nhân viên ----------
     */

    Route::get('/dashboard/category/sales-agent/staff-infor', [NhanVienController::class, 'index']);
    Route::post('/dashboard/category/sales-agent/staff-infor/add-staff-infor', [NhanVienController::class, 'store'])->name('them-thongtinnhanvien');
    Route::get('/dashboard/category/sales-agent/staff-infor/delete-staff-infor/{id}', [NhanVienController::class, 'destroy'])->name('xoa-thongtinnhanvien');
    
    Route::get('/dashboard/category/sales-agent/staff-infor/detail-staff-infor/{id}', [NhanVienController::class, 'index2'])->name('chitiet-thongtinnhanvien');
    Route::post('/dashboard/category/sales-agent/staff-infor/detail-staff-infor/reset-password', [TaiKhoanController::class, 'reset_password'])->name('datlai-matkhau-taikhoannhanvien');
    Route::post('/dashboard/category/sales-agent/staff-infor/detail-staff-infor/update-staff-infor', [NhanVienController::class, 'update'])->name('capnhat-thongtinnhanvien');

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý kho hàng ----------
     */

    Route::get('/dashboard/category/warehouse', [KhoHangController::class, 'index'])->name('thongtinkhohang');
    Route::post('/dashboard/category/warehouse/warehouse-export', [KhoHangController::class, 'perform_export'])->name('thuchien-xuatkho');

    Route::get('/dashboard/category/warehouse/mutil-export-item', [KhoHangController::class, 'mutil_index_export'])->name('mutil-thongtinxuatkho');
    Route::get('/dashboard/category/warehouse/mutil-export-item/update', [KhoHangController::class, 'update_export_detail'])->name('capnhat-mutil-thongtinxuatkho');
    Route::post('/dashboard/category/warehouse/mutil-export-item/export-pdf', [KhoHangController::class, 'warehouse_export_pdf'])->name('xuatfile-pdf-phieuxuatkho');

    Route::get('/dashboard/category/warehouse/warehouse-export/view-detail', [KhoHangController::class, 'show_export_detail'])->name('chitietphieuxuat');
    Route::post('/dashboard/category/warehouse/warehouse-export/view-detail/update', [KhoHangController::class, 'update_export_detail'])->name('capnhatchitietphieuxuat');
    Route::get('/dashboard/category/warehouse/warehouse-export/{maphieuxuat}', [KhoHangController::class, 'destroy_export_detail'])->name('xoa-chitietphieuxuat');

    Route::get('/dashboard/category/warehouse/warehouse-receipt/mutil-receipt-item', [KhoHangController::class, 'mutil_index_receipt'])->name('mutil-thongtinnhapkho');

    Route::post('/dashboard/category/warehouse/warehouse-receipt/mutil-receipt-item/add', [KhoHangController::class, 'mutil_store_receipt'])->name('them-mutil-thongtinnhapkho');

    Route::get('/dashboard/category/warehouse/warehouse-receipt/view-detail', [KhoHangController::class, 'show_receipt_detail'])->name('chitietphieunhap');

    Route::post('/dashboard/category/warehouse/mutil-receipt-item/receipt-pdf', [KhoHangController::class, 'warehouse_receipt_pdf'])->name('xuatfile-pdf-phieunhapkho');

    Route::get('/dashboard/category/warehouse/add-warehouse', [KhoHangController::class, 'index_add_warehouse'])->name('them-khohang');

    Route::post('/dashboard/category/warehouse/add', [KhoHangController::class, 'add_warehouse'])->name('thuchien-them-khohang');

    /**
     * ---------- **** ----------
     */

    /**
     *
     * ---------- **End** ----------
     *
     */

    /**
     *
     * ---------- Quản lý giao dịch ----------
     *
     */

    /**
     * ---------- Quản lý tiến trình ----------
     */
    // ---------- Tiến trình thu mua xe ----------

    // Route::get('/dashboard/transaction/purchasing/purchasing-manage', [XeDangKyThuMuaController::class, 'index'])->name('xedkthumua');
    // Route::get('/dashboard/transaction/purchasing/purchasing-manage/{id}', [XeDangKyThuMuaController::class, 'updatedon'])->name('duyetdon');

            Route::get('/dashboard/transaction/purchasing/purchasing-manage', [XeDangKyThuMuaController::class, 'index'])->name('xedkthumua'); //Hiện bảng ds xe thu mua
            Route::get('/dashboard/transaction/purchasing/{id}', [XeDangKyThuMuaController::class, 'huydon'])->name('huydonthumua'); // Hủy đơn thu mua
            Route::get('/dashboard/transaction/purchasing/purchasing-manage/{id}', [XeDangKyThuMuaController::class, 'duyetdon'])->name('duyetdonthumua'); // Duyệt đơn thu mua
            Route::get('/dashboard/transaction/purchasing/purchasing-bike-detail/{id}', [XeDangKyThuMuaController::class, 'show'])->name('ctthongtinmua'); // Xem chi tiết đơn thu mua
            Route::get('/dashboard/transaction/purchasing/purchasing-bike-detail/add/{id}', [XeDangKyThuMuaController::class, 'add_bike'])->name('themxe-xethumua'); // Xem chi tiết đơn thu mua
            Route::post('/dashboard/transaction/purchasing/purchasing-bike-detail/add/accepted/{id}', [XeDangKyThuMuaController::class,'store2'])->name('themxe-xethumua-accepted'); // Xem chi tiết đơn thu mua

    // ---------- **** ----------

    // ---------- Tiến trình bán xe ----------

    // Route::get('/dashboard/transaction/selling', function () {
    //     return view('dashboard.transaction.selling.sell-manage');
    // });

    Route::get('/dashboard/transaction/selling/sell-manage', [DonHangController::class, 'index'])->name('danhsach-donhang-dangbanxe');
    Route::get('/dashboard/transaction/selling/sell-manage/order/view-order/{id}', [DonHangController::class, 'view'])->name('xem-ctdonhang'); // Xem chi tiết từng đơn hàng
    Route::put('/dashboard/transaction/selling/sell-manage/order/update-order/{id}', [DonHangController::class, 'updateorder'])->name('capnhat-donhang'); // Cập nhật trạng thái đơn hàng
    Route::get('/dashboard/transaction/selling/sell-manage/order/order-history', [DonHangController::class, 'orderhistory'])->name('lichsu-donhang'); // Xem lịch sử đơn hàng

    Route::get('/dashboard/transaction/selling/sell-manage/vehicle-infor-sale/{maxe}', [XeDangBanController::class, 'index_post_sale_1'])->name('xedangban1-thongtinxe');
    Route::get('/dashboard/transaction/selling/sell-manage/vehicle-directly', [XeDangBanController::class, 'index_post_sale_2'])->name('xedangban2-thongtinxe');

    Route::post('/dashboard/transaction/selling/sell-manage/add', [XeDangBanController::class, 'add_post_sale'])->name('them-xedangban-thongtinxe');
    Route::get('/dashboard/transaction/selling/sell-manage/delete/{id}', [XeDangBanController::class, 'destroy_post_sale'])->name('xoa-xedangban-thongtinxe');

    Route::get('/dashboard/transaction/selling/sell-manage/edit-post-sale/{maxedangban}', [XeDangBanController::class, 'update_post_sale'])->name('capnhat-thongtin-xedangban');
    Route::patch('/dashboard/transaction/selling/sell-manage/edit-post-sale', [XeDangBanController::class, 'act_update_post_sale'])->name('thuchien-capnhat-thongtin-xedangban');

    // ---------- **** ----------

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý thanh toán ----------
     */

        Route::get('/dashboard/transaction/payment-management', [HoaDonController::class, 'index'])->name('thongtin-thanhtoan');
        Route::get('/dashboard/transaction/payment-management/detail-payment/{madonhang}/{mand}', [DonHangController::class, 'detail_infor_payment_1'])->name('chitiet-thongtin-thanhtoan1');

        Route::get('/dashboard/transaction/payment-management/make-invoice', [HoaDonController::class, 'make_invoice_customer'])->name('thuchien-lap-hoadon');
        Route::post('/dashboard/transaction/payment-management/make-invoice/add-vehicle', [HoaDonController::class, 'add_vehicle_invoice'])->name('thuchien-themxe-hoadon');
        
        
        //? Thực hiện tạo một thông tin cho người dùng mới trong khi lập hóa đơn
            Route::get('/dashboard/transaction/payment-management/make-invoice/create-customer', [NguoiDungController::class, 'create_for_invoice'])->name('taomoi-nguoidung-hoadon');

            Route::get('/dashboard/transaction/payment-management/make-invoice/create-customer/{id}', [NguoiDungController::class, 'show_for_invoice'])->name('hienthi-thongtin-nd-hoadon'); 

            Route::post('/dashboard/transaction/payment-management/make-invoice/act-create-customer/{id}', [NguoiDungController::class, 'update_for_invoice'])->name('thuchien-taomoi-nguoidung-hoadon');

            Route::post('/dashboard/transaction/payment-management/make-invoice/add-customer', [HoaDonController::class, 'add_customer_invoice'])->name('thuchien-them-nguoidung');
        //?



        Route::post('/dashboard/transaction/payment-management/confirm-invoice/{id}', [HoaDonController::class, 'confirm_invoice_customer'])->name('thuchien-xacnhan-hoadon');

        Route::post('/dashboard/transaction/payment-management/destroy-invoice/{id}', [HoaDonController::class, 'destroy_invoice_customer'])->name('thuchien-huy-hoadon');

        Route::post('/dashboard/transaction/payment-management/update-payment/{madonhang}/{mand}', [DonHangController::class, 'check_oder_customer'])->name('thuchien-kiemtra-donhang');
        Route::post('/dashboard/transaction/payment-management/cancel-order/{madonhang}', [DonHangController::class, 'destroy_oder_customer'])->name('thuchien-huy-donhang');

        Route::post('/dashboard/transaction/payment-management/export-invoice', [HoaDonController::class,'export_invoice_pdf_dashboard'])->name('xuatfile-pdf-hoadon-dash');

    /**
     * ---------- **** ----------
     */

    /**
     * ---------- Quản lý khuyến mãi ----------
     */

    Route::get('/dashboard/category/saling-events/saling-manage', [KhuyenMaiController::class, 'index'])->name('danhmuckhuyenmai');
    Route::post('/dashboard/category/saling-events/saling-manage', [KhuyenMaiController::class, 'store'])->name('themskkhuyenmai');
    Route::get('/dashboard/category/saling-events/saling-manage/delete{id}', [KhuyenMaiController::class, 'xoa_khuyenmai'])->name('xoakhuyemai');

    /**
     * ---------- **** ----------
     */

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

        Route::get('/dashboard/report/sales-situation', [BaoCaoThongKeController::class, 'data_sales_situation'])->name('tinhhinhbanhang');
        Route::post('/dashboard/report/sales-situation/data', [BaoCaoThongKeController::class, 'data_sales_situation'])->name('bieudo-tinhhinhbanhang');
        Route::post('/dashboard/report/sales-situation/export', [BaoCaoThongKeController::class, 'export_report_sales_situation'])->name('xuatfile-excel-thongtintinhhinhbanhang');

        /**
         * ---------- **** ----------
         */

        /**
         * ---------- Báo cáo tình hình thu mua ----------
         */

        Route::get('/dashboard/report/purchasing-situation', [BaoCaoThongKeController::class, 'data_purchasing_situation'])->name('tinhhinhthumua');
        Route::post('/dashboard/report/purchasing-situation/data', [BaoCaoThongKeController::class, 'data_purchasing_situation'])->name('bieudo-tinhhinhthumua');
        Route::post('/dashboard/report/purchasing-situation/export', [BaoCaoThongKeController::class, 'export_report_purchasing_situation'])->name('xuatfile-excel-thongtintinhhinhthumua');

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

Route::get('/support', [RuiRoController::class, 'index'])->name('ruiro-index');

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
Route::get('/data5', [TaiKhoanController::class, 'data']);
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

