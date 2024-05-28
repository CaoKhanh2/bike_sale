<style>
    /* Thiết lập kích thước của thẻ div */
    .a4-container {
        width: 21cm;
        /* Chiều rộng giấy A4 */
        height: 29.7cm;
        /* Chiều cao giấy A4 */
        background-color: #ffffff;
        /* Màu nền */
        border: 1px solid #000000;
        /* Viền đen */
        padding: 1cm;
        /* Khoảng cách lề */
        margin: 0 auto;
        /* Canh giữa trang */
        box-sizing: border-box;
        /* Không tính toán border vào kích thước */
        font-family: 'Times New Roman', Times, serif;
        font-size: 16px;
    }

    /* Định dạng in ấn */
    @media print {
        .a4-container {
            margin: 0;
            box-shadow: none;
        }
    }

    /* Định dạng cho bảng biểu */
    .word-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Times New Roman', Times, serif;
        text-align: center;
        /* Căn giữa toàn bộ nội dung */
    }

    .word-table th,
    .word-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
        /* Căn giữa theo chiều dọc */
    }

    .word-table thead th {
        background-color: #f2f2f2;
    }

    .word-table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }
</style>

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
@endphp 

<div class="row my-3">
    <div class="col-auto">
        <form action="{{ route('thuchien-xuatkho') }}" method="POST">
            @csrf
                <input type="hidden" name="maphieuxuat" id="data" value="{{ $phieuxuat->maphieuxuat }}">
            <button type="submit" class="btn btn-primary">Thực hiện xuất</button>
        </form>
    </div>
    {{-- <div class="col-auto">
        <form action="{{ route('xuatfile-pdf-phieuxuatkho') }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">Xuất file pdf</button>
        </form>
    </div> --}}
    <div class="col-auto">
        <a href="{{ route('thongtinkhohang') }}" class="btn btn-primary">Quay về trang trước</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-9">
        <!-- Thẻ div với kích thước giấy A4 -->
        <div class="a4-container">
            <div class="row">
                <div class="col-8">
                    <p class="font-weight-bold mb-1">Đơn vị: Công ty TNHH TM dịch vụ kỹ thuật Toàn Phương</p>
                    <p class="font-weight-bold mb-1">Bộ phận: </p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-4">
                <div class="col-auto">
                    <h3 class="text-dark"><strong>PHIẾU XUẤT KHO</strong></h3>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2">
                <div class="col-auto">
                    <p class="text-dark">Ngày {{ $currentDate->day }} tháng {{ $currentDate->month }} năm
                        {{ $currentDate->year }}</p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-auto">
                    <p class="text-dark">Mã số: {{ $phieuxuat->maphieuxuat }}</p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2 mx-2">
                <div class="col-9">
                    <p class="text-dark mb-1">- Họ và tên người nhận hàng: </p>
                    <p class="text-dark mb-1">- Lý do xuất hàng: </p>
                    <div class="row">
                        <div class="col">
                            <p class="text-dark mb-1">- Xuất tại kho:
                                @foreach ($ttkho as $i)
                                    {{ $i->tenkhohang }}
                                @endforeach
                            </p>
                        </div>
                        <div class="col">
                            <p class="text-dark mb-1">Địa điểm:
                                @foreach ($ttkho as $i)
                                    {{ $i->diachi }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-auto">
                    <table class="word-table ">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="2">STT</th>
                                <th rowspan="2">Tên hàng hóa</th>
                                <th rowspan="2">Mã xe</th>
                                <th rowspan="2">Đơn vị tính</th>
                                <th rowspan="2">Số lượng</th>
                                <th rowspan="2">Đơn giá</th>
                                <th rowspan="2">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count=1; @endphp
                            @foreach ($ctphieuxuat as $i)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <td>{{ $i->tenxe }}</td>
                                    <td>{{ $i->maxe }}</td>
                                    <td>Chiếc</td>
                                    <td>
                                        <form action="{{ route('capnhat-mutil-thongtinxuatkho') }}" method="GET"
                                            id="form-{{ $i->machitietphieuxuat }}">
                                            @csrf
                                            <input type="text" value="{{ $i->machitietphieuxuat }}"
                                                name="mactphieuxuat" hidden>
                                            <input type="number" name="soluong" class="form-control text-center"
                                                value="{{ $i->soluong }}" id="soluong-{{ $i->machitietphieuxuat }}"
                                                onblur="autoSubmit('form-{{ $i->machitietphieuxuat }}')" min=1>
                                        </form>
                                        @if ($errors->has('soluong'))
                                            <small class="help-block">
                                                <p class="text-danger">{{ $errors->first('soluong') }}</p>
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ number_format($i->dongia, 0, ',', '.') }}</td>
                                    <td>
                                        {{ number_format($i->dongia * $i->soluong, 0, ',', '.') }}
                                    </td>
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
            <div class="row justify-content-center align-items-center mt-4 mx-2">
                <div class="col-9">
                    <p class="text-dark mb-1">- Tổng số tiền: </p>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mt-2 mx-2">
                <div class="col-8">
                </div>
                <div class="col-4">
                    <p class="text-dark">Ngày {{ $currentDate->day }} tháng {{ $currentDate->month }} năm
                        {{ $currentDate->year }}</p>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mt-3 mx-2">
                <div class="col-9">
                </div>
                <div class="col-3">
                    <p class="text-dark"><strong>Người lập đơn</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function autoSubmit(formId) {
        document.getElementById(formId).submit();
    }
</script>
