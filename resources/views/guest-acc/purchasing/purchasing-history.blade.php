@extends('guest-acc.layout.content')

@section('title_ds', 'Lịch sử bán xe')
@section('pg-hd-2', 'Lịch sử bán xe')

@section('title')
    Lịch sử bán xe
@endsection
{{-- @include('guest-acc.layout.header') --}}
@section('guest-content')
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Lịch sử bán xe</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead  class="text-center">
                                <tr>
                                    <th>Mã đăng ký</th>
                                    <th>Ngày gửi</th>
                                    <th>Giá bán</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($db as $item)
                                    <tr>
                                        <td>{{ $item->madkthumua }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->ngaydk)) }}</td>
                                        <td>{{ number_format($item->giaban, 0, ',', '.') . ' đ' }}</td>
                                        <td class="h5">
                                            <div class="badge badge-pill bg-success">
                                            {{ $item->trangthaipheduyet == 'Duyệt' ? 'Đã duyệt' : 'Chờ duyệt' }}
                                            </div>
                                        </td>             
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <a href="/"><button class="btn btn-outline-primary"><i class="bi bi-house"></i> Quay lại trang chủ</button></a>
            </div>
        </div>
    </div>
@endsection
