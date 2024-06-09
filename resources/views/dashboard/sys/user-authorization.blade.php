@extends('dashboard.layout.content')

@section('title_ds', 'Phân quyền người dùng')
@section('pg-card-title', 'Phân quyền người dùng')
@section('pg-hd-2', 'Hệ thống')
@section('pg-hd-3', 'Phân quyền người dùng') @section('act3', 'active')
@section('st4', 'false')

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="table-responsive pb-20">
                        <table class="table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Phân quyền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taikhoan as $i)
                                    <tr>
                                        <td>{{ $i->matk }}</td>
                                        <td>{{ $i->tentaikhoan }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>
                                            {{ $i->ngaytao == '' ? '' : date('d/m/Y - H:m:i', strtotime($i->ngaytao)) }}
                                        </td>
                                        <td>
                                            {{ $i->ngaycapnhat == '' ? '' : date('d/m/Y - H:m:i', strtotime($i->ngaytao)) }}
                                        </td>
                                        <td>
                                            <form id="myForm_{{ $i->matk }}"
                                                action="{{ url('/dashboard/sys/user-authorization/' . $i->matk) }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                @method('PATCH')
                                                <select name="phanquyen" id="phanquyen_{{ $i->matk }}"
                                                    class="custom-select"
                                                    {{ $i->phanquyen == 'Quản trị viên' ? 'disabled' : '' }}>
                                                    <option value="Quản trị viên" disabled
                                                        {{ $i->phanquyen == 'Quản trị viên' ? 'selected' : '' }}>Quản trị
                                                        viên</option>
                                                    <option value="Quản lý"
                                                        {{ $i->phanquyen == 'Quản lý' ? 'selected' : '' }}>Quản lý</option>
                                                    <option value="Nhân viên"
                                                        {{ $i->phanquyen == 'Nhân viên' ? 'selected' : '' }}>Nhân viên
                                                    </option>
                                                </select>

                                            </form>
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
        document.querySelectorAll('select[name="phanquyen"]').forEach(function(select) {
            select.addEventListener('change', function() {
                // Gửi form tương ứng khi dropdown thay đổi giá trị
                this.closest('form').submit();
            });
        });
    </script>


@endsection
