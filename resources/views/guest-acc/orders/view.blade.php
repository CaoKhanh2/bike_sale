@extends('guest-acc.layout.content')

@section('title_ds', 'Đơn hàng')
@section('pg-hd-2', 'Chi tiết đơn hàng')
@section('title')
    Chi tiết đơn hàng
@endsection 
@include('guest-acc.layout.header')
@section('guest-content')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('dashboard.layout.page-header')
                    <div class="card-header ">
                        <h4 class="text">Chi tiết đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Thông tin vận chuyển</h4>
                                <hr>
                                <label for="">Họ và tên</label>
                                <div class="border">{{ $tt_nguoidung->hovaten }}</div>
                                <label for="">Số điện thoại</label>
                                <div class="border">{{ $tt_nguoidung->sodienthoai }}</div>
                                <label for="">Email</label>
                                <div class="border">{{ $tt_nguoidung->email }}</div>
                                <label for="">Địa chỉ nhận hàng</label>
                                <div class="border">
                                    {{ $tt_nguoidung->diachi }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Thông tin xe</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donhang_items as $item)
                                            <tr>
                                                <td>{{ $item->tenxe }}</td>
                                                <td>{{ number_format($item->giaban, 0, ',', '.') . ' đ' }}</td>
                                                <td>
                                                    @foreach (explode(',', $item->hinhanh) as $path)
                                                        @if ($loop->first && $path != '')
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                class="img-fluid"
                                                                style="max-height: 200px; max-width: 200px;">
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($donhang_items as $item)
                                    @if ($loop->first)
                                        <h4 class="px-2">Tổng tiền: <span class="float-end">{{ number_format($item->tongtien, 0, ',', '.') . ' đ' }}</span></h4>
                                    @endif
                                @endforeach
                                <div class="mt-5 px-2">
                                    <label for="">Trạng thái đơn hàng</label>
                                    @foreach ($donhang_items as $item)
                                        <form action="{{ route('capnhat-donhang', ['id' => $item->madh]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @if ($loop->first)
                                                <select class="form-select" name="order_status">
                                                    @if ($item->trangthai == "Đang xử lý")
                                                        <option {{ $item->trangthai == 'Đang xử lý' ? 'selected' : '' }} value="Đang xử lý" hidden>Đang xử lý</option> 
                                                        <option {{ $item->trangthai == 'Đã hoàn thành' ? 'selected' : '' }} value="Đã hoàn thành">Đã hoàn thành</option>
                                                        <option {{ $item->trangthai == 'Đã hủy' ? 'selected' : '' }} value="Đã hủy">Đã hủy</option>
                                                    @else 
                                                        <option {{ $item->trangthai == 'Đang xử lý' ? 'selected' : '' }} value="Đang xử lý" hidden>Đang xử lý</option> 
                                                        <option {{ $item->trangthai == 'Đã hoàn thành' ? 'selected' : '' }} value="Đã hoàn thành"hidden>Đã hoàn thành</option>
                                                        <option {{ $item->trangthai == 'Đã hủy' ? 'selected' : '' }} value="Đã hủy" hidden>Đã hủy</option>
                                                    @endif
                                                </select>   
                                            @endif
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
