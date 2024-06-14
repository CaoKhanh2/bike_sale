@extends('dashboard.layout.content')

@section('title_ds', 'Tài khoản nhân viên')
@section('pg-card-title', 'Tài khoản nhân viên')
@section('pg-hd-2', 'Hệ thống')
@section('pg-hd-3', 'Quản lý tài khoản')
@section('pg-hd-4', 'Tài khoản nhân viên') @section('act4', 'active')
@section('st4', 'true')

@section('main')
    @if (Session::has('success-xoa-taikhoan'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-xoa-taikhoan') }}",
            });
        </script>
    @endif
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="card-box mb-30">
                    <div class="table-responsive pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="table-responsive pb-20">
                        <div class="col-md-12 mb-30">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('them-taikhoannhanvien') }}" class="btn btn-primary"> <i
                                            class="fa-solid fa-user-plus"></i> Tạo tài khoản nhân viên</a>
                                </div>
                            </div>
                        </div>
                        <table class="table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Giới tính</th>
                                    <th>Email</th>
                                    <th>Tên tài khoản</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taikhoan2 as $i)
                                    <tr>
                                        <td>{{ $i->manv }}</td>
                                        <td>{{ $i->hovaten }}</td>
                                        <td>{{ $i->gioitinh }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>{{ $i->tentaikhoan }}</td>
                                        <td>{{ $i->sodienthoai }}</td>
                                        <td>
                                            <form action="{{ route('kiemsoattaikhoan') }}" method="post" id="myForm">
                                                @csrf
                                                @method('PATCH')
                                                <input type="checkbox" class="switch-btn" data-size="small"
                                                    data-color="#28a745" data-secondary-color="#dc3545"
                                                    {{ $i->trangthai == 1 ? 'checked' : '' }}
                                                    onchange="document.getElementById('hidden-value-{{ $i->matk }}').value = this.checked ? 1 : 0; document.getElementById('form-{{ $i->matk }}').submit();" />
                                                <input type="text" name="matk" value="{{ $i->matk }}" hidden>
                                                <input type="hidden" id="hidden-value-{{ $i->matk }}"
                                                    name="trangthai" value="{{ $i->trangthai }}">
                                            </form>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-primary"
                                                href="{{ route('chitiet-thongtinnhanvien', ['id' => $i->manv]) }}">
                                                <i class="bi bi-eye"></i> Xem
                                            </a>
                                            <a class="btn btn-danger"
                                                href="{{ route('xoa-taikhoan-nhanvien', ['id' => $i->matk]) }}">
                                                <i class="bi bi-trash3"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Bắt sự kiện thay đổi của checkbox
            $('.switch-btn').change(function() {
                // Lấy checkbox hiện tại
                var $checkbox = $(this);
                // Lấy giá trị hiện tại của checkbox
                var isChecked = $checkbox.is(':checked');
                // Cập nhật giá trị của input hidden tương ứng
                var $form = $checkbox.closest('form');
                $form.find('.hidden-value').val(isChecked ? 1 : 0);
                // Submit form tương ứng
                $form.submit();
            });
        });
    </script>


@endsection
