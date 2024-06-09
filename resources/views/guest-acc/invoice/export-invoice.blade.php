<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px
        }

        .invoice-wrap {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 10px;
        }

        .invoice-box {
            padding: 10px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .weight-600 {
            font-weight: 600;
        }

        .font-14 {
            font-size: 14px;
        }

        .font-20 {
            font-size: 20px;
        }

        .font-24 {
            font-size: 24px;
        }

        .text-danger {
            color: red;
        }

        .pb-30 {
            padding-bottom: 30px;
        }

        .pb-20 {
            padding-bottom: 20px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .word-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 30px;
        }

        .bordered-table th,
        .bordered-table td {
            border: 0px solid #000;
            padding: 8px;
            text-align: center;
        }

        .bordered-table th {
            background: rgb(212, 209, 209);
        }

        .invoice-desc-footer {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-wrap">
        <div class="invoice-box">
            <div class="invoice-header">
                <div class="logo text-left">
                    <img src="{{ public_path('Image/logo/logo.png') }}" alt="Logo" height="100" width="100" />
                    <h2 class="text-left mb-30" style="color: gray">Hóa đơn {{ $hoadon->mahoadon }}</h2>
                </div>
            </div>
            <div class="row pb-30">
                <div class="col-md-6">
                    <h3>Bên mua</h3>
                    <p>Tên khách hàng: {{ $hoadon->hovaten }}</p>
                    <p>Địa chỉ: {{ $hoadon->diachi }}</p>
                    <p>Ngày tạo: {{ date('d/m/Y', strtotime($hoadon->ngaytaohoadon)) }}</p>
                </div>
                <div class="col-md-6">
                    <h3>Bên bán</h3>
                    <p>Công ty TNHH thương mại dịch vụ kỹ thuật Toàn Phương</p>
                    <p>Địa chỉ: Số 1/115 đường Máng Nước, thôn Cái Tắt, Xã An Đồng, Huyện An Dương, Thành phố Hải Phòng.
                    </p>
                    <p>Mã số thuế: 020162448</p>
                    <p>Số điện thoại: 0225 359 3816</p>
                </div>
            </div>
            <div class="invoice-desc pb-30">
                <p class="font-14 mb-5">
                    Trạng thái: <strong>Đã thanh toán</strong>
                </p>
                <table class="word-table bordered-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Khuyến mãi</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chitiethoadon as $i)
                            <tr>
                                <td>{{ $i->tenxe }}</td>
                                <td>{{ number_format($i->giaban, 0, '', ',') . ' VND' }}</td>
                                <td>1</td>
                                <td>{{ number_format($i->tilegiamgia, 0, '', ',') . '%' }}</td>
                                <td>{{ number_format($i->dongia, 0, '', ',') . ' VND' }}</td>
                            </tr>
                        @endforeach
                        <tr style="background:rgb(212, 209, 209);">
                            <td colspan="3"><strong>Tổng tiền</strong></td>
                            <td colspan="2">
                                <span
                                    class="weight-600 font-20">{{ number_format($hoadon->tonggiatrihoadon, 0, '', ',') . ' VND' }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="invoice-desc-body">
                <p class="font-14 mb-5">
                    Ngày giao dịch:
                    <strong class="">06/06/2024</strong>
                </p>
                <table class="word-table bordered-table">
                    <thead>
                        <tr>
                            <th>Hính thức thanh toán</th>
                            <th>Mã giao dịch</th>
                            <th>Số tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $giaodich->vnp_CardType == "ATM" ? 'Thanh toán qua chuyển khoản' : 'Thanh toán bằng tiền mặt' }}</td>
                            <td>{{ $giaodich->vnp_TransactionNo }}</td>
                            <td>{{ number_format($giaodich->vnp_Amount, 0, '', ',') . ' VND' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
