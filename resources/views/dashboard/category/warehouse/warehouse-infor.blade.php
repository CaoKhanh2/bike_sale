@extends('dashboard.layout.content')

@section('title_ds', 'Kho hàng')
@section('pg-card-title', 'Quản lý kho hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Kho hàng') @section('act3', 'active')
@section('st4', 'false')

@php
    Session::forget('visited');
@endphp

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
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table1" role="tab"
                                        aria-selected="true">Kho hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#table2" role="tab"
                                        aria-selected="false">Nhập kho</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#table3" role="tab"
                                        aria-selected="false">Xuất kho</a>
                                </li>
                            </ul>
                            {{-- Quản lý kho hàng --}}
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table1" role="tabpanel">
                                    {{-- <div class="pd-20">
                                        <h4 class="text-blue h4">Quản lý kho hàng</h4>
                                    </div> --}}
                                    <div class="pt-20">
                                        <div class="col-md-12 mb-30">
                                            <form action="{{ route('thongtinkhohang') }}" method="GET">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Kho hàng</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <select class="custom-select col-12" id="select-khohang"
                                                            name="makho">
                                                            {{-- Hiển thị lựa chọn hiện tại --}}
                                                            <option selected hidden>Chọn kho hàng</option>
                                                            @foreach ($kho as $i)
                                                                @if (request()->query('makho') == $i->makho)
                                                                    <option selected hidden>{{ $i->tenkhohang }}</option>
                                                                @endif
                                                            @endforeach
                                                            <option value="all">Tất cả</option>
                                                            @foreach ($kho as $i)
                                                                <option value="{{ $i->makho }}">{{ $i->tenkhohang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('mutil-thongtinnhapkho') }}"
                                                        class="btn btn-primary"><i class="fa-solid fa-file-import"></i> Lập
                                                        phiếu nhập</a>
                                                </div>
                                                <div class="col text-right">
                                                    <a href="{{ route('them-khohang') }}" class="btn btn-info"><i class="fa-solid fa-warehouse"></i> Thêm kho hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive pt-20">
                                        <div class="col-md-12 mb-30">
                                            <table class="table hover multiple-select-row nowrap dtr-inline">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Mã kho</th>
                                                        <th>Tên kho</th>
                                                        <th>Tên mặt hàng</th>
                                                        <th>Giá nhập kho</th>
                                                        <th>Ngày nhập</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ttkho as $i)
                                                        @if ($i->makho)
                                                            <tr class="table-row">
                                                                <td>
                                                                    <form action="{{ route('mutil-thongtinxuatkho') }}"
                                                                        method="GET" id="mainForm"
                                                                        class="multi-export-form">
                                                                        @csrf
                                                                        <input type="text" value="{{ $i->machitietkho }}"
                                                                            name="mactkho" hidden>
                                                                        <input type="text" value="{{ $maphieuxuat }}"
                                                                            name="maphieuxuat" hidden>
                                                                        <input type="checkbox" class="export-checkbox"
                                                                            disabled>
                                                                        {{-- <input type="hidden" name="data[]" id="data1"
                                                                            value=""> --}}
                                                                    </form>
                                                                </td>
                                                                <td>{{ $i->makho }}</td>
                                                                <td>{{ $i->tenkhohang }}</td>
                                                                <td>{{ $i->tenxe }}</td>
                                                                <td>{{ number_format($i->gianhapkho, 0, ',') . ' đ' }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($i->ngaynhapkho)) }}</td>
                                                                {{-- <td>
                                                                    <form action="{{ route('thongtinxuatkho') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="text"
                                                                            value="{{ $i->machitietkho }}" name="mactkho"
                                                                            hidden>
                                                                        <input type="text" value="{{ $maphieuxuat }}"
                                                                            name="maphieuxuat" hidden>
                                                                        <button class="btn btn-info" type="submit"> <i
                                                                                class="fa-solid fa-file-export fs-3"></i>
                                                                            Xuất kho</button>
                                                                    </form>
                                                                </td> --}}
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button onclick="submitCheckedForms()" class="btn btn-primary"><i
                                                            class="fa-solid fa-file-export fs-3"></i> Lập phiếu
                                                        xuất</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Quản lý mục nhập --}}
                                <div class="tab-pane fade" id="table2" role="tabpanel">
                                    <div class="pd-20">
                                        <h4 class="text-blue h4">Danh sách phiếu nhập</h4>
                                    </div>
                                    <div class="table-responsive pd-20">
                                        <table class="table multiple-select-row table-striped nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã phiếu nhập</th>
                                                    <th>Nhân viên thực hiện</th>
                                                    <th>Ngày nhập</th>
                                                    <th>Kho hàng</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($thongtinphieunhap as $i)
                                                    <tr>
                                                        <td>{{ $i->maphieunhap }}</td>
                                                        <td>{{ $i->manv }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->ngaynhap)) }}</td>
                                                        <td>{{ $i->tenkhohang }}</td>
                                                        <td>{{ number_format($i->thanhtien, 0, ',', '.') . ' đ' }}</td>
                                                        <td>{{ $i->trangthai }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('chitietphieunhap', ['maphieunhap' => $i->maphieunhap]) }}"
                                                                    class="btn btn-primary mx-1"><i class="bi bi-eye"></i>
                                                                    Xem</a>
                                                                @if (Auth()->user()->phanquyen == 'Quản lý' || Auth()->user()->phanquyen == 'Quản trị viên')
                                                                    {{-- {{ route('xoa-chitietphieunhap', ['maphieunhap' => $i->maphieunhap]) }} --}}
                                                                    <a href="" class="btn btn-danger mx-1"><i
                                                                            class="bi bi-trash"></i>
                                                                        Xóa</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- Quản lý mục xuất --}}
                                <div class="tab-pane fade" id="table3" role="tabpanel">
                                    <div class="pd-20">
                                        <h4 class="text-blue h4">Danh sách phiếu xuất</h4>
                                    </div>
                                    <div class="table-responsive pd-20">
                                        <table class="table multiple-select-row table-striped nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã phiếu xuất</th>
                                                    <th>Nhân viên thực hiện</th>
                                                    <th>Ngày xuất</th>
                                                    <th>Kho hàng</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($thongtinphieuxuat as $i)
                                                    <tr>
                                                        <td>{{ $i->maphieuxuat }}</td>
                                                        <td>{{ $i->manv }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->ngayxuat)) }}</td>
                                                        <td>{{ $i->tenkhohang }}</td>
                                                        <td>{{ number_format($i->tongtien, 0, ',', '.') . ' đ' }}</td>
                                                        <td>{{ $i->trangthai }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('chitietphieuxuat', ['maphieuxuat' => $i->maphieuxuat]) }}"
                                                                    class="btn btn-primary mx-1"><i class="bi bi-eye"></i>
                                                                    Xem</a>
                                                                @if (Auth()->user()->phanquyen == 'Quản lý' || Auth()->user()->phanquyen == 'Quản trị viên')
                                                                    <a href="{{ route('xoa-chitietphieuxuat', ['maphieuxuat' => $i->maphieuxuat]) }}"
                                                                        class="btn btn-danger mx-1"><i
                                                                            class="bi bi-trash"></i>
                                                                        Xóa</a>
                                                                @endif
                                                            </div>
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
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-khohang').addEventListener('change', function() {
            this.form.submit();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.table-row');

            tableRows.forEach(row => {
                row.addEventListener('click', function(event) {
                    const checkbox = row.querySelector('.export-checkbox');
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked; // Toggle checkbox state
                    }
                });
            });
        });
    </script>

    <script>
        function submitCheckedForms() {

            //Chọn tất cả các phần tử biểu mẫu (<multi-export-form>).
            const forms = document.querySelectorAll('.multi-export-form');

            const mainForm = document.getElementById('mainForm');

            // Xóa các thẻ input ẩn được tạo trước đó
            mainForm.querySelectorAll('input[name="data[]"]').forEach(input => input.remove());

            // Tạo mảng lưu trữ dữ liệu
            const formData = [];
            let checkedCount = 0;

            // Thực hiện lập qua từng form
            forms.forEach(form => {
                // Tìm các thẻ input ẩn ở trong các form hiện tại
                const mactkhoInput = form.querySelector('[name="mactkho"]');
                const maphieuxuatInput = form.querySelector('[name="maphieuxuat"]');

                // Tìm các ô checkbox có trong form đang được checked
                const checkbox = form.querySelector('.export-checkbox:checked');

                // Nếu tìm ô checkbox được checked và thẻ input có tồn tại giá trị
                if (checkbox && mactkhoInput && maphieuxuatInput) {
                    checkedCount++;

                    // Lấy dữ liệu từ các thẻ input
                    const mactkho = mactkhoInput.value;
                    const maphieuxuat = maphieuxuatInput.value;

                    // Đẩy dữ liệu vào mảng formData
                    formData.push({
                        mactkho,
                        maphieuxuat
                    });
                }
            });

            // Thực hiện lập lại từng phần tử trong formData và đẩy dữ liệu vào thẻ input mới được tạo tương ứng
            formData.forEach((value, index) => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'data[]';
                hiddenInput.value = JSON.stringify(value); // Chuyển dữ liệu sang kiểu chuỗi JSON

                // Thực hiện thêm thẻ input vào mainForm
                mainForm.appendChild(hiddenInput);
            });

            // Kiểm tra số lượng hàng được xuất ra khỏi kho hàng
            if (checkedCount < 5) {
                // Thực hiện submit
                mainForm.submit();
            } else {
                //alert('Bạn không được chọn quá 5 mục.');
                Swal.fire({
                    icon: "info",
                    title: "Thông báo",
                    position: "center",
                    text: "Bạn không được chọn quá 5 mục!"
                });
            }
        }
    </script>


@endsection
