<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
        }

        .invoice-wrap {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
        }

        .invoice-box {
            padding: 30px;
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

        .word-table{
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .invoice-desc {
            margin-top: 30px;
        }

        .bordered-table th,
        .bordered-table td {
            border: 0px solid #ffffff;
            padding: 8px;
            text-align: center;
        }

        .bordered-table th {
            border: 0px solid #ffffff;
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
                <div class="logo text-center">
                    <img src="{{ public_path('Image/logo/logo.png') }}" alt="Logo" height="150" width="150" />
                </div>
            </div>
            <h2 class="text-center mb-30">HÓA ĐƠN</h2>
            <div class="row pb-30">
                <div class="col-md-6">
                    <h5 class="mb-15">Tên khách hàng</h5>
                    <p class="font-14 mb-5">
                        <strong> Ngày tạo: </strong> {{ date('d/m/Y', strtotime($hoadon->ngaytaohoadon)) }}
                    </p>
                    <p class="font-14 mb-5">
                        <strong class="">Mã số hóa đơn:</strong> {{ $hoadon->mahoadon }}
                    </p>
                </div>
                <div class="col-md-6 text-right">
                    <p class="font-14 mb-5">{{ $hoadon->hovaten }}</p>
                    <p class="font-14 mb-5"><strong>Địa chỉ: </strong> {{ $hoadon->diachi }}</p>
                </div>
            </div>
            <div class="invoice-desc pb-30">
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
                                <td>{{ number_format($i->giaban,0,'',','). ' VND' }}</td>
                                <td>1</td>
                                <td>{{ number_format($i->tilegiamgia,0,'',','). '%' }}</td>
                                <td>{{ number_format($i->dongia,0,'',','). ' VND' }}</td>
                            </tr>
                        @endforeach
                        <tr style="background:rgb(212, 209, 209);">
                            <td colspan="3"><strong>Tổng tiền</strong></td>

                            <td colspan="2">
                                <span class="weight-600 font-24 text-danger">{{ number_format($hoadon->tonggiatrihoadon,0,'',','). ' VND' }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="invoice-desc-body">
                <ul>
                    <li class="clearfix">
                        <div class="invoice-sub">
                            <p class="font-14 mb-5">
                                Ngày giao dịch:
                                <strong class="">{{ date('d/m/Y', strtotime($hoadon->ngaytaohoadon)) }}</strong>
                            </p>
                            <p class="font-14 mb-5">
                                Trạng thái: <strong>{{ $hoadon->trangthai == "Đã hoàn thành" ? "Đã thanh toán" : "Chưa thanh toán" }}</strong>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <h4 class="text-center font-20">Cảm ơn!!</h4>
        </div>
    </div>
</body>

</html>
