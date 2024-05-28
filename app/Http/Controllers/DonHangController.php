<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DonHangController extends Controller
{
    //Dashboard

    public function index()
    {
        $trangthai = 'Đang xử lý';
        // $mand = Auth::guard('guest')->user()->mand;
        // $gh = DB::table('giohang')->where('mand', $mand)->first();

        // $donhang =DB::select(
        //     'SELECT
        //             -- ctgiohang.*
        //             giohang.*
        //             , donhang.ngaytaodon
        //             , donhang.trangthai
        //             ,donhang.madh
        //             ,donhang.magh
        //                 FROM giohang
        //                 -- INNER JOIN ctgiohang ON ctgiohang.magh = donhang.magh
        //                 INNER JOIN donhang ON giohang.magh = donhang.magh
        //                 WHERE giohang.ghichu = ?',
        //     [$trangthai]
        // );

        $donhang = DB::table('donhang')->where('donhang.trangthai', $trangthai)->get();
        $xedangban = DB::table('xedangban')->select('xedangban.*', 'thongtinxe.tenxe')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->get();

        // dd($donhang);
        return view('dashboard.transaction.selling.index', compact('donhang','xedangban'));
    }

    public function view($id)
    {
        $trangthai = '0';

        // $donhang_items =DB::select(
        //     'SELECT
        //             -- ctgiohang.*
        //             giohang.*
        //             , donhang.ngaytaodon
        //             , donhang.trangthai
        //             ,donhang.madh
        //             ,donhang.tongtien
        //                 FROM donhang
        //                 -- INNER JOIN ctgiohang ON ctgiohang.magh = donhang.magh
        //                 INNER JOIN giohang ON giohang.magh = donhang.magh
        //                 WHERE donhang.trangthai = ?',
        //     [$trangthai]
        // );

        $donhang_items = DB::table('donhang')->select('thongtinxe.*', 'xedangban.giaban', 'donhang.*')->join('giohang', 'giohang.magh', 'donhang.magh')->join('ctgiohang', 'giohang.magh', 'ctgiohang.magh')->join('xedangban', 'xedangban.maxedangban', 'ctgiohang.maxedangban')->join('thongtinxe', 'xedangban.maxe', 'thongtinxe.maxe')->where('donhang.madh', $id)->get();

        $tt_nguoidung = DB::table('nguoidung')->select('nguoidung.*')->join('giohang', 'giohang.mand', 'nguoidung.mand')->join('donhang', 'donhang.magh', 'giohang.magh')->where('donhang.madh', $id)->first();

        // dd($tt_nguoidung);

        // dd($donhang_items);
        return view('dashboard.transaction.selling.order.view', compact('donhang_items', 'tt_nguoidung'));
    }

    public function updateorder(Request $request, $id)
    {
        $trangthai = $request->input('order_status');
        DB::table('donhang')
            ->where('donhang.madh', $id)
            ->update(['trangthai' => $trangthai]);

        return redirect()->route('danhsach-donhang-dangbanxe')->with('success-capnhat-donhang', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function orderhistory()
    {
        $donhang = DB::table('donhang')->where('donhang.trangthai', 'Đã hoàn thành')->orWhere('donhang.trangthai', 'Đã hủy')->get();

        // dd($donhang);
        return view('dashboard.transaction.selling.order.history', compact('donhang'));
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
    private function generateUniqueNumericId_momo($length)
    {
        $id = $this->generateRandomNumber($length);

        // Kiểm tra xem ID đã tồn tại trong cơ sở dữ liệu chưa
        while (DB::table('momo')->where('orderId', $id)->exists()) {
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

    public function index_checkout()
    {
        $mand = Auth::guard('guest')->user()->mand;

        $trangthai = 'Đang chờ xử lý';

        $giohang_items = DB::select(
            'SELECT ctgiohang.*, giohang.*, xedangban.*, thongtinxe.* FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? AND giohang.ghichu = ?',
            [$mand, $trangthai],
        );
        // dd($giohang_items);
        return view('guest-acc.orders.checkout', compact('giohang_items'));
    }

    public function thanks()
    {
        $data = [];
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
            // Thực thi truy vấn SQL
            // try {
            //     // lưu data momo
            //     $result = DB::table('momo')->insert($data_momo);
            //     // Tùy chọn: xử lý kết quả trả về
            //     if (!$result) {
            //         // Xử lý nếu chèn dữ liệu thất bại (ghi log, thông báo lỗi, v.v.)
            //         error_log('Failed to insert data into momo table.');
            //     }
            // } catch (PDOException $e) {
            //     // Xử lý ngoại lệ PDO nếu có lỗi xảy ra trong quá trình thực thi truy vấn
            //     // Ghi log lỗi hoặc thông báo lỗi
            //     error_log('Database error: ' . $e->getMessage());
            // }
        } elseif (isset($_GET['vnp_Amount'])) {
            $data_vnpay = [
                'vnp_Amount' => $_GET['vnp_Amount'],
                'vnp_BankCode' => $_GET['vnp_BankCode'],
                'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
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
            $result = DB::table('vnpay')->insert($data_vnpay);
        }
        // $data = DB::table('momo')->insert($data_momo);; // Thay thế bằng dữ liệu thực tế
        // dd($data);
        return view('guest-acc.orders.thanks', $data);
    }

    public function dat_hang(Request $request)
    {
        $mand = Auth::guard('guest')->user()->mand;
        // $magh = $request->magh;

        $giohang_items = DB::select(
            'SELECT ctgiohang.maxedangban, giohang.*, xedangban.maxedangban, thongtinxe.maxe FROM ctgiohang
                        INNER JOIN giohang ON giohang.magh = ctgiohang.magh
                        INNER JOIN xedangban ON xedangban.maxedangban = ctgiohang.maxedangban
                        INNER JOIN thongtinxe ON thongtinxe.maxe = xedangban.maxe
                        WHERE giohang.mand = ? ',
            [$mand],
        );

        // dd($giohang_items);

        $gh = DB::table('giohang')->select('giohang.magh')->join('nguoidung', 'giohang.mand', 'nguoidung.mand')->where('giohang.mand', $mand)->first();

        // dd($gh);

        foreach ($giohang_items as $item) {
            DB::table('donhang')->insert([
                'magh' => $gh->magh,
                // 'maxedangban' => $item->maxedangban,
                // 'mand' => $mand,
                'tongtien' => $item->tonggiatien,
                'ngaytaodon' => Carbon::now(),
            ]);
        }

        if (Auth::guard('guest')->user()->diachi == null) {
            $user = NguoiDung::where('mand', Auth::guard('guest')->user()->mand)->first();
            $user->hovaten = $request->input('hovaten');
            $user->gioitinh = $request->input('gioitinh');
            // $user->email = $request->input('email');
            $user->sodienthoai = $request->input('sdt');
            $user->diachi = $request->input('diachi');
            $user->update();
        }

        // Thanh toán 

        $giatien = DB::table('donhang')
        ->select('donhang.tongtien')
        ->join('giohang', 'giohang.magh', 'donhang.magh')
        ->join('nguoidung', 'giohang.mand', 'nguoidung.mand')
        ->where('giohang.mand', $mand)->first();

        if (isset($_POST['cod'])) {
            return view('index');
        } elseif (isset($_POST['payUrl'])) {
            $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = 'Thanh toán qua MoMo';
            $amount = intval($giatien->tongtien);
            $orderId = $this->generateUniqueNumericId_momo(4);
            $redirectUrl = 'http://127.0.0.1:8000/thanks';
            $ipnUrl = 'http://127.0.0.1:8000/thanks';
            $extraData = '';

            $partnerCode = $partnerCode;
            $accessKey = $accessKey;
            $serectkey = $secretKey;
            $orderId = $orderId; // Mã đơn hàng
            $orderInfo = $orderInfo;
            $amount = $amount;
            $ipnUrl = $ipnUrl;
            $redirectUrl = $redirectUrl;
            $extraData = $extraData;

            $requestId = time() . '';
            $requestType = 'payWithATM';
            // $extraData = $_POST['extraData'] ? $_POST['extraData'] : '';
            //before sign HMAC SHA256 signature
            $rawHash = 'accessKey=' . $accessKey . '&amount=' . $amount . '&extraData=' . $extraData . '&ipnUrl=' . $ipnUrl . '&orderId=' . $orderId . '&orderInfo=' . $orderInfo . '&partnerCode=' . $partnerCode . '&redirectUrl=' . $redirectUrl . '&requestId=' . $requestId . '&requestType=' . $requestType;
            $signature = hash_hmac('sha256', $rawHash, $serectkey);
            $data = ['partnerCode' => $partnerCode, 'partnerName' => 'Test', 'storeId' => 'MomoTestStore', 'requestId' => $requestId, 'amount' => $amount, 'orderId' => $orderId, 'orderInfo' => $orderInfo, 'redirectUrl' => $redirectUrl, 'ipnUrl' => $ipnUrl, 'lang' => 'vi', 'extraData' => $extraData, 'requestType' => $requestType, 'signature' => $signature];
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); // decode json

            // dd($jsonResult);
            //Just a example, please check more in there
            // $h=header('Location: ' . $jsonResult['payUrl']);
            // dd($h);
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

            $vnp_TxnRef = $this->generateRandomNumber(4); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Noi dung thanh toan';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = intval($giatien->tongtien) *100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            // dd($vnp_Amount);
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
            // $vnp_Bill_Email = $_POST['txt_billing_email'];
            // $fullName = trim($_POST['txt_billing_fullname']);
            // if (isset($fullName) && trim($fullName) != '') {
            //     $name = explode(' ', $fullName);
            //     $vnp_Bill_FirstName = array_shift($name);
            //     $vnp_Bill_LastName = array_pop($name);
            // }
            // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
            // $vnp_Bill_City=$_POST['txt_bill_city'];
            // $vnp_Bill_Country=$_POST['txt_bill_country'];
            // $vnp_Bill_State=$_POST['txt_bill_state'];
            // // Invoice
            // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
            // $vnp_Inv_Email=$_POST['txt_inv_email'];
            // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
            // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
            // $vnp_Inv_Company=$_POST['txt_inv_company'];
            // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
            // $vnp_Inv_Type=$_POST['cbo_inv_type'];
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
                'vnp_TxnRef' => $vnp_TxnRef,

                // "vnp_ExpireDate"=>$vnp_ExpireDate,
                // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
                // "vnp_Bill_Email"=>$vnp_Bill_Email,
                // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
                // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
                // "vnp_Bill_Address"=>$vnp_Bill_Address,
                // "vnp_Bill_City"=>$vnp_Bill_City,
                // "vnp_Bill_Country"=>$vnp_Bill_Country,
                // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
                // "vnp_Inv_Email"=>$vnp_Inv_Email,
                // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
                // "vnp_Inv_Address"=>$vnp_Inv_Address,
                // "vnp_Inv_Company"=>$vnp_Inv_Company,
                // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
                // "vnp_Inv_Type"=>$vnp_Inv_Type
            ];

            if (isset($vnp_BankCode) && $vnp_BankCode != '') {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            // }

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
}
