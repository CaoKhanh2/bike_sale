<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class DonHangController extends Controller
{
    //Dashboard

    public function index()
    {
        $trangthai = 'Đã hoàn thành';

        $donhang = DB::table('donhang')->where('donhang.trangthai', $trangthai)->get();
        $xedangban = DB::table('xedangban')->select('xedangban.*', 'thongtinxe.tenxe')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->get();

        // dd($donhang);
        return view('dashboard.transaction.selling.index', compact('donhang', 'xedangban'));
    }

    // public function view($id)
    // {
    //     $donhang_items = DB::table('donhang')->select('thongtinxe.*', 'xedangban.giaban', 'donhang.*')->join('giohang', 'giohang.magh', 'donhang.magh')->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->where('donhang.madh', $id)->get();

    //     $tt_nguoidung = DB::table('nguoidung')->select('nguoidung.*')->join('giohang', 'giohang.mand', 'nguoidung.mand')->join('donhang', 'donhang.magh', 'giohang.magh')->where('donhang.madh', $id)->first();

    //     return view('dashboard.transaction.selling.order.view', compact('donhang_items', 'tt_nguoidung'));
    // }

    // public function updateorder(Request $request, $id)
    // {
    //     $trangthai = $request->input('order_status');
    //     DB::table('donhang')
    //         ->where('donhang.madh', $id)
    //         ->update(['trangthai' => $trangthai]);

    //     return redirect()->route('danhsach-donhang-dangbanxe')->with('success-capnhat-donhang', 'Sản phẩm đã được thêm vào giỏ hàng.');
    // }

    // public function orderhistory()
    // {
    //     $donhang = DB::table('donhang')->where('donhang.trangthai', 'Đã hoàn thành')->orWhere('donhang.trangthai', 'Đã hủy')->get();

    //     return view('dashboard.transaction.selling.order.history', compact('donhang'));
    // }

    public function detail_infor_payment_1(Request $request, $id)
    {
        $chitiet_donhang_chuathanhtoan = DB::table('donhang')
            ->select('donhang.*', 'donhang.ngaytaodon', 'nguoidung.*', 'thongtinxe.tenxe', 'ctgiohang.dongia', 'xedangban.giaban')
            ->join('giohang', 'giohang.magh', 'donhang.magh')
            ->join('nguoidung', 'nguoidung.mand', 'giohang.mand')
            ->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')
            ->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')
            ->join('thongtinxe', 'thongtinxe.maxe', 'xedangban.maxe')
            ->where('nguoidung.mand', $request->mand)
            ->where('donhang.madh', $request->madonhang)
            ->first();

        $thongtinxe_donhang = DB::table('donhang')
            ->select('thongtinxe.tenxe', 'ctgiohang.dongia')
            ->join('giohang', 'giohang.magh', 'donhang.magh')
            ->join('nguoidung', 'nguoidung.mand', 'giohang.mand')
            ->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')
            ->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')
            ->join('thongtinxe', 'thongtinxe.maxe', 'xedangban.maxe')
            ->where('donhang.madh', $request->madonhang)
            ->where('nguoidung.mand', $request->mand)
            ->get();

        $ghichuArray = $this->array_ghichu($request->madonhang);

        $trangthai = DB::table('donhang')
            ->select('trangthai')
            ->where('donhang.madh', $request->madonhang)
            ->first();

        // dd($ghichuArray);

        return view('dashboard.transaction.payment.detail-payment-infor', compact('chitiet_donhang_chuathanhtoan', 'thongtinxe_donhang', 'ghichuArray', 'trangthai'));
    }

    public function check_oder_customer(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'tientra' => 'required|max:10',
            ],
            [
                'tientra.required' => 'Trường thông tin này không được để trống!',
                'tientra.max' => 'Số tiền nhập vào không được quá 100,000,000 VND!',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('cross-kiemtra-donhang', 'Thông tin đơn hàng chưa được cập nhật!');
        }
        
        $tientra = $request->tientra;
        $manv = Auth::user()->manv;
        $tientra = str_replace(',', '', $tientra);

        $donhang = DB::table('donhang')
            ->select('tongtien', 'ghichu','magh')
            ->where('madh', $request->madonhang)
            ->first();
        
        $chitietgiohang = DB::table('ctgiohang')
            ->select('xedangban.maxe', 'ctgiohang.dongia')
            ->join('xedangban', 'ctgiohang.maxedangban', 'xedangban.maxedangban')
            ->join('thongtinxe', 'thongtinxe.maxe', 'xedangban.maxe')
            ->where('ctgiohang.magh', $donhang->magh)
            ->get();

        // Kiểm tra giá tiền nhập vào so với số tiền cần trả
        if ($tientra == $donhang->tongtien && $donhang->ghichu == null) {
            $newGhichu = 'Đã thu: ' . $tientra . ', Ngày thu: ' . Carbon::now() . ', Đã hoàn thành';
            DB::table('donhang')
                ->where('madh', $request->madonhang)
                ->update([
                    'trangthai' => 'Đã hoàn thành',
                    'ghichu' => $newGhichu,
                ]);

            // Thực hiện insert thêm hóa đơn
            $this->insert_invoice($request->madonhang, $request->mand, $manv, $chitietgiohang);

            return back()->with('success-kiemtra-donhang', 'Đơn hàng số ' . $request->madonhang . ' đã được thanh toán.');
        } elseif ($tientra < $donhang->tongtien) {
            if ($donhang->ghichu == null) {
                DB::table('donhang')
                    ->where('madh', $request->madonhang)
                    ->update([
                        'trangthai' => 'Đang chờ xử lý',
                        'ghichu' => 'Đã thu: ' . $tientra . ', Ngày thu: ' . Carbon::now(),
                    ]);

                $tienconthieu = (int) $donhang->tongtien - (int) $tientra;
                $tienconthieu = number_format($tienconthieu, 0, '.', ',') . ' VND';
                $tientra = number_format($tientra, 0, '.', ',') . ' VND';

                return back()->with('infor-kiemtra-donhang', 'Đã thanh toán ' . $tientra . ' cho đơn hàng mã số ' . $request->madonhang . ' số tiền chưa thanh toán còn ' . $tienconthieu . '.');
            } else {

                // Thực hiện truy vấn dữ liệu trong ghi chú và đưa vào 1 mảng
                $sum = 0;
                $ghichuArray = $this->array_ghichu($request->madonhang);

                foreach ($ghichuArray as $key => $value) {
                    $sum = $value['tienthu'] + $sum;
                }
                if ($sum + $tientra <= $donhang->tongtien) {
                    $newGhichu = $donhang->ghichu . ' | ' . 'Đã thu: ' . $tientra . ', Ngày thu: ' . Carbon::now();

                    DB::table('donhang')
                        ->where('madh', $request->madonhang)
                        ->update([
                            'trangthai' => 'Đang chờ xử lý',
                            'ghichu' => $newGhichu,
                        ]);
                    
                    // Thực hiện truy vấn dữ liệu trong ghi chú và đưa vào 1 mảng
                    $sum = 0;
                    $ghichuArray = $this->array_ghichu($request->madonhang);

                    foreach ($ghichuArray as $key => $value) {
                        $sum = $value['tienthu'] + $sum;
                        if ($sum == $donhang->tongtien) {
                            DB::table('donhang')
                                ->where('madh', $request->madonhang)
                                ->update([
                                    'trangthai' => 'Đã hoàn thành',
                                ]);
                            
                            // Thực hiện insert thêm hóa đơn
                            $this->insert_invoice($request->madonhang, $request->mand, $manv, $chitietgiohang);
                            
                            return back()->with('success-kiemtra-donhang', 'Đơn hàng số ' . $request->madonhang . ' đã được thanh toán.');
                        }
                    }
                    $tienconthieu = (int) $donhang->tongtien - (int) $tientra;
                    $tienconthieu = number_format($tienconthieu, 0, '.', ',') . ' VND';
                    $tientra = number_format($tientra, 0, '.', ',') . ' VND';

                    return back()->with('infor-kiemtra-donhang', 'Đã thanh toán ' . $tientra . ' cho đơn hàng mã số ' . $request->madonhang . ' số tiền chưa thanh toán còn ' . $tienconthieu . '.');
                } else {
                    return back()->with('cross-kiemtra-donhang', 'Số tiền nhập vào lớn hơn số tiền cần được thanh toán!');
                }
            }
        }else{
            return back()->with('cross-kiemtra-donhang', 'Số tiền nhập vào lớn hơn số tiền cần được thanh toán!');
        }
    }

    public function destroy_oder_customer(Request $request)
    {
        DB::table('donhang')
            ->where('madh', $request->madonhang)
            ->update([
                'trangthai' => 'Đã hủy',
            ]);
        return redirect()->route('thongtin-thanhtoan')->with('success-huy-donhang', 'Đơn hàng số ' . $request->madonhang . ' đã bị hủy!');
    }

    //Khách hàng

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($data)]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function index_checkout(Request $request, $id)
    {
        $mand = Auth::guard('guest')->user()->mand;

        $trangthai = 'Đang chờ xử lý';

        $giohang_items = DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.*, xedangban.giaban as giagoc, khuyenmai.tilegiamgia ,CASE WHEN xedangban.makhuyenmai IS NULL OR khuyenmai.thoigianbatdau > now() OR khuyenmai.thoigianketthuc < now() THEN xedangban.giaban
                        ELSE xedangban.giaban - (xedangban.giaban * tilegiamgia / 100)
                        END AS giaban
                        FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        LEFT JOIN khuyenmai ON xedangban.makhuyenmai = khuyenmai.makhuyenmai
                        WHERE giohang.mand = ? AND giohang.ghichu = ? AND giohang.magh = ?',
            [$mand, $trangthai, $id],
        );

        return view('guest-acc.orders.checkout', compact('giohang_items'));
    }

    public function dat_hang(Request $request)
    {
        $mand = Auth::guard('guest')->user()->mand;
        $magh = $request->magh;

        $giohang_items = DB::select(
            'SELECT ctgiohang.maxedangban, giohang.*, xedangban.maxedangban, thongtinxe.maxe FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? AND giohang.magh = ?',
            [$mand, $magh],
        );

        $madonhang_random = $this->generateUniqueNumericId_order(4);

        DB::table('donhang')->insert([
            'madh' => $madonhang_random,
            'ngaytaodon' => Carbon::now(),
            'trangthai' => 'Đang chờ xử lý',
        ]);

        foreach ($giohang_items as $item) {
            DB::table('donhang')
                ->where('madh', $madonhang_random)
                ->update([
                    'magh' => $item->magh,
                    'tongtien' => $item->tonggiatien,
                ]);
            DB::table('xedangban')
                ->where('maxedangban', $item->maxedangban)
                ->update([
                    'trangthai' => 'Đang xử lý',
                ]);
        }

        DB::table('giohang')
            ->where('magh', $magh)
            ->update([
                'ghichu' => 'Chờ thanh toán',
            ]);

        // Tạo một giỏ hàng mới
        $magh_random = $this->generateUniqueNumericId_cart(7);

        $cre_cart = DB::table('giohang')->where('ghichu', 'Đang chờ xử lý')->where('mand', $mand)->exists();

        if ($cre_cart == false) {
            DB::table('giohang')->insert([
                'magh' => 'GH-' . $magh_random,
                'mand' => $mand,
                'ngaytao' => Carbon::now(),
                'tonggiatien' => 0,
                'ghichu' => 'Đang chờ xử lý',
            ]);
        }
        //

        if (Auth::guard('guest')->user()->diachi == null) {
            $user = NguoiDung::where('mand', Auth::guard('guest')->user()->mand)->first();
            $user->hovaten = $request->input('hovaten');
            $user->gioitinh = $request->input('gioitinh');
            $user->sodienthoai = $request->input('sdt');
            $user->diachi = $request->input('diachi');
            $user->update();
        }

        // Thanh toán

        $giatien = DB::table('donhang')->select('donhang.tongtien')->join('giohang', 'giohang.magh', 'donhang.magh')->join('nguoidung', 'giohang.mand', 'nguoidung.mand')->where('giohang.mand', $mand)->first();

        if (isset($_POST['cod'])) {
            return view('guest-acc.orders.thank2');
        } elseif (isset($_POST['payUrl'])) {
            $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = 'Thanh toán qua MoMo';
            $amount = intval($giatien->tongtien);
            $orderId = $madonhang_random;
            $redirectUrl = 'http://127.0.0.1:8000/thanks';
            $ipnUrl = 'http://127.0.0.1:8000/thanks';
            $extraData = '';

            $requestId = time() . '';
            $requestType = 'payWithATM';

            //before sign HMAC SHA256 signature
            $rawHash = 'accessKey=' . $accessKey . '&amount=' . $amount . '&extraData=' . $extraData . '&ipnUrl=' . $ipnUrl . '&orderId=' . $orderId . '&orderInfo=' . $orderInfo . '&partnerCode=' . $partnerCode . '&redirectUrl=' . $redirectUrl . '&requestId=' . $requestId . '&requestType=' . $requestType;
            $signature = hash_hmac('sha256', $rawHash, $secretKey);
            $data = ['partnerCode' => $partnerCode, 'partnerName' => 'Test', 'storeId' => 'MomoTestStore', 'requestId' => $requestId, 'amount' => $amount, 'orderId' => $orderId, 'orderInfo' => $orderInfo, 'redirectUrl' => $redirectUrl, 'ipnUrl' => $ipnUrl, 'lang' => 'vi', 'extraData' => $extraData, 'requestType' => $requestType, 'signature' => $signature];
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); // decode json

            if (isset($jsonResult['payUrl'])) {
                header('Location: ' . $jsonResult['payUrl']);
                exit(); // Đảm bảo không có mã nào khác chạy sau header
            } else {
                echo 'Không tìm thấy URL thanh toán trong phản hồi.';
                // Ghi log phản hồi để kiểm tra lỗi
                error_log('Phản hồi: ' . json_encode($jsonResult));
            }
        } elseif (isset($_POST['redirect'])) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
            $vnp_Returnurl = 'http://127.0.0.1:8000/thanks';
            $vnp_TmnCode = 'CH2VBH65'; //Mã website tại VNPAY
            $vnp_HashSecret = 'WTF0OLLF2ZR9MTQB7XU3BEYNM8IENE9J'; //Chuỗi bí mật

            //$vnp_TxnRef = $madonhang_random; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Noi dung thanh toan';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = intval($giatien->tongtien) * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = [
                'vnp_Version' => '2.1.0',
                'vnp_TmnCode' => $vnp_TmnCode,
                'vnp_Amount' => $vnp_Amount,
                'vnp_Command' => 'pay',
                'vnp_CreateDate' => date('YmdHis'),
                'vnp_CurrCode' => 'VND',
                'vnp_IpAddr' => $vnp_IpAddr,
                'vnp_Locale' => $vnp_Locale,
                'vnp_OrderInfo' => $vnp_OrderInfo,
                'vnp_OrderType' => $vnp_OrderType,
                'vnp_ReturnUrl' => $vnp_Returnurl,
                'vnp_TxnRef' => $madonhang_random,
            ];

            if (isset($vnp_BankCode) && $vnp_BankCode != '') {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = '';
            $i = 0;
            $hashdata = '';
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . '=' . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . '=' . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . '?' . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = ['code' => '00', 'message' => 'success', 'data' => $vnp_Url];
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demoP
        }
    }

    public function thanks()
    {
        if (isset($_GET['partnerCode'])) {
            $data_momo = [
                'partnerCode' => $_GET['partnerCode'],
                'orderId' => $_GET['orderId'],
                'requestId' => $_GET['requestId'],
                'amount' => $_GET['amount'],
                'orderInfo' => $_GET['orderInfo'],
                'orderType' => $_GET['orderType'],
                'transId' => $_GET['transId'],
                'payType' => $_GET['payType'],
                'signature' => $_GET['signature'],
            ];
            $result = DB::table('momo')->insert($data_momo);
        } elseif (isset($_GET['vnp_Amount'])) {
            $data_vnpay = [
                'vnp_Amount' => $_GET['vnp_Amount'],
                'vnp_BankCode' => $_GET['vnp_BankCode'],
                //'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
                'vnp_CardType' => $_GET['vnp_CardType'],
                'vnp_OrderInfo' => $_GET['vnp_OrderInfo'],
                'vnp_PayDate' => $_GET['vnp_PayDate'],
                'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
                'vnp_TmnCode' => $_GET['vnp_TmnCode'],
                'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
                'vnp_TransactionStatus' => $_GET['vnp_TransactionStatus'],
                'vnp_TxnRef' => $_GET['vnp_TxnRef'],
                'vnp_SecureHash' => $_GET['vnp_SecureHash'],
            ];
            DB::table('vnpay')->insert($data_vnpay);

            $madh = DB::table('donhang')
                ->select('donhang.madh', 'donhang.tongtien', 'donhang.trangthai')
                ->join('vnpay', 'vnpay.vnp_TxnRef', 'donhang.madh')
                ->where('vnpay.vnp_ResponseCode', '00')
                ->where('donhang.madh', $_GET['vnp_TxnRef'])
                ->first();

            $magh = DB::table('giohang')
                ->select('donhang.magh')
                ->join('donhang', 'donhang.magh', 'giohang.magh')
                ->where('donhang.madh', $_GET['vnp_TxnRef'])
                ->first();

            $maxedangban = DB::table('donhang')
                ->select('ctgiohang.maxedangban')
                ->join('giohang', 'donhang.magh', 'giohang.magh')
                ->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')
                ->where('donhang.madh', $_GET['vnp_TxnRef'])
                ->get();

            $chitietgiohang = DB::table('ctgiohang')
                ->select('xedangban.maxe', 'ctgiohang.dongia')
                ->join('xedangban', 'ctgiohang.maxedangban', 'xedangban.maxedangban')
                ->join('thongtinxe', 'thongtinxe.maxe', 'xedangban.maxe')
                ->where('ctgiohang.magh', $magh->magh)
                ->get();

            $check_payment = DB::table('donhang')->join('vnpay', 'vnpay.vnp_TxnRef', 'donhang.madh')->where('vnpay.vnp_ResponseCode', '00')->exists();

            if ($check_payment == true) {
                DB::table('donhang')
                    ->where('madh', $madh->madh)
                    ->update([
                        'trangthai' => 'Đã hoàn thành',
                    ]);
                DB::table('giohang')
                    ->where('magh', $magh->magh)
                    ->update([
                        'ghichu' => 'Đã thanh toán',
                    ]);
                foreach ($maxedangban as $i) {
                    DB::table('xedangban')
                        ->where('maxedangban', $i->maxedangban)
                        ->update([
                            'trangthai' => 'Đã bán xe',
                        ]);
                }

                $mahoadon = $this->generateUniqueNumericId_invoice(10);
                $mand = Auth('guest')->user()->mand;

                DB::table('hoadon')->insert([
                    'mahoadon' => $mahoadon,
                    'mand' => $mand,
                    'madh' => $madh->madh,
                    'tonggiatrihoadon' => $madh->tongtien,
                    'ghichu' => 'Đã hoàn thành',
                ]);

                foreach ($chitietgiohang as $i) {
                    DB::table('cthoadon')->insert([
                        'macthoadon' => Str::random(15),
                        'mahoadon' => $mahoadon,
                        'maxe' => $i->maxe,
                        'soluong' => '1',
                        'dongia' => $i->dongia,
                    ]);
                }
            } else {
                DB::table('donhang')
                    ->where('madh', $_GET['vnp_TxnRef'])
                    ->delete();

                DB::table('giohang')
                    ->where('magh', $magh->magh)
                    ->update([
                        'ghichu' => 'Đang chờ xử lý',
                    ]);
                foreach ($maxedangban as $i) {
                    DB::table('xedangban')
                        ->where('maxedangban', $i->maxedangban)
                        ->update([
                            'trangthai' => 'Còn xe',
                        ]);
                }
            }
        }

        return view('guest-acc.orders.thanks');
    }


    private function array_ghichu($madonhang)
    {
        $donhang_ghichu = DB::table('donhang')->select('ghichu')->where('donhang.madh', $madonhang)->first();

        $ghichuArray = [];

        // Tách chuỗi ghichu bằng dấu |
        $sections = explode('|', $donhang_ghichu->ghichu);

        foreach ($sections as $section) {
            // Tạo một mảng để lưu trữ các giá trị "Đã thu" và "Ngày thu"
            $data = [];

            // Tách từng phần tử trong mỗi phần bằng dấu ,
            $parts = explode(',', $section);

            foreach ($parts as $part) {
                // Tìm kiếm xem phần tử có chứa 'Đã thu' hay 'Ngày thu' không
                if (strpos($part, 'Đã thu') !== false) {
                    $data['tienthu'] = trim(str_replace('Đã thu:', '', $part));
                }
                if (strpos($part, 'Ngày thu') !== false) {
                    $data['ngaythu'] = trim(str_replace('Ngày thu:', '', $part));
                }
            }

            // Thêm dữ liệu vào mảng
            $ghichuArray[] = $data;
        }

        return $ghichuArray;
    }

    private function insert_invoice($madonhang, $mand, $manv, $chitietgiohang){
        $mahoadon = $this->generateUniqueNumericId_invoice(10);
        $donhang = DB::table('donhang')->select('tongtien')->where('madh', $madonhang)->first();
        
        DB::table('hoadon')->insert([
            'mahoadon' => $mahoadon,
            'mand' => $mand,
            'manv' => $manv,
            'madh' => $madonhang,
            'tonggiatrihoadon' => $donhang->tongtien,
        ]);

        foreach ($chitietgiohang as $i) {
            DB::table('cthoadon')->insert([
                'macthoadon' => Str::random(15),
                'mahoadon' => $mahoadon,
                'maxe' => $i->maxe,
                'soluong' => '1',
                'dongia' => $i->dongia,
            ]);
        }
    }

    private function generateUniqueNumericId_invoice($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (HoaDon::where('mahoadon', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }
    private function generateUniqueNumericId_cart($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (GioHang::where('magh', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }

    private function generateUniqueNumericId_order($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (DonHang::where('madh', $id)->exists()) {
            // Nếu ID đã tồn tại, tạo lại một ID mới
            $id = $this->generateRandomNumber($length);
        }

        return $id;
    }

    private function generateRandomNumber($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return str_pad(rand($min, $max), $length, '0', STR_PAD_LEFT);
    }
}
