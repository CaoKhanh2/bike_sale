<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Xuất Kho</title>
    <style>
        body {
            font-family: 'DejaVu Serif';
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-dark {
            color: #000;
        }

        .word-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .bordered-table th,
        .bordered-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .mx-2 {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .inline-p {
            display: inline-block;
        }

        .col-custom-25 {
            flex: 0 0 25%;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

@php
    $ngaynhap = new DateTime($phieunhap->ngaynhap);
    $day = $ngaynhap->format('d'); // Day
    $month = $ngaynhap->format('m'); // Month
    $year = $ngaynhap->format('Y'); // Year
@endphp

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="font-weight-bold mb-1">Đơn vị: Công ty TNHH TM dịch vụ kỹ thuật Toàn Phương</p>
                <p class="font-weight-bold mb-1">Bộ phận: __________________________</p>
            </div>
        </div>
        <div class="row text-center">
            <h3 class="text-dark"><strong>PHIẾU NHẬP KHO</strong></h3>
        </div>
        <div class="row text-center">
            <p class="text-dark">Ngày {{ $day }} tháng
                {{ $month }} năm
                {{ $year }}</p>
        </div>
        <div class="row text-center">
            <p class="text-dark">Mã số: {{ $phieunhap->maphieunhap }}</p>
        </div>
        <div class="row mx-2 mb-2">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <p class="text-dark mb-1">- Họ và tên người giao:
                            ..............................................................................</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="inline-p">
                            <p class="text-dark mb-1">- Nhập tại kho:
                                @foreach ($ttkho as $i)
                                    @if ($loop->first)
                                        {{ $i->tenkhohang }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inline-p">
                            <p class="text-dark mb-1">- Địa điểm:
                                @foreach ($ttkho as $i)
                                    @if ($loop->first)
                                        {{ $i->diachi }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-auto">
                <table class="word-table bordered-table" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên hàng hóa</th>
                            <th>Mã xe</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count=1; @endphp
                        @foreach ($ctphieunhap as $i)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $i->tenxe }}</td>
                                <td>{{ $i->maxe }}</td>
                                <td>Chiếc</td>
                                <td>{{ $i->soluong }}</td>
                                <td>{{ number_format($i->dongia, 0, ',', '.') }}</td>
                                <td>{{ number_format($i->dongia * $i->soluong, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row"></th>
                            <td colspan="3"><strong>Tổng tiền</strong></td>
                            <td></td>
                            <td></td>
                            <td><strong>{{ number_format($tongtien_px->tongtien, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="display: flex; margin-top: 1rem; margin-left: 0.5rem;">
            <div style="width: 75%;">
                <p style="color: #000; margin-bottom: 0.25rem;"><strong>Tổng số tiền:</strong>
                    ..............................................................................</p>
            </div>
        </div>

        <div class="col-custom-25 text-right">
            <p class="text-dark">Ngày {{ $day }} tháng {{ $month }} năm {{ $year }}</p>
        </div>

        <div class="col-custom-25 text-right" style="margin-right: 27px">
            <p style="color: #000;"><strong>Người lập đơn</strong></p>
        </div>

    </div>
</body>

</html>
