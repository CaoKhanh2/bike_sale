@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin nhân viên')
@section('pg-hd-1', 'Trang chủ')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin nhân viên')

@section('main')

    @if (Session::has('success-them-nhanvien'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-them-nhanvien') }}",
            });
        </script>
    @endif

    @if (Session::has('cross-them-nhanvien'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-them-nhanvien') }}",
            });
        </script>
    @endif

    @if (Session::has('success-xoa-nhanvien'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-xoa-nhanvien') }}",
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
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table" role="tab"
                                        aria-selected="true">Thông tin bảng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="false">Thêm dữ liệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="table-responsive pt-20">
                                        <table class="table hover multiple-select-row nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã nhân viên</th>
                                                    <th>Chức vụ</th>
                                                    <th>Họ và tên</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Giới tính</th>
                                                    <th>Số điện thoại</th>
                                                    {{-- <th>Email</th> --}}
                                                    <th>Địa chỉ</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nhanvien as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ $i->manv }}</td>
                                                        <td>{{ $i->tencv }}</td>
                                                        <td>{{ $i->hovaten }}</td>
                                                        <td>
                                                            @php
                                                                $formattedDate = date('d/m/Y', strtotime($i->ngaysinh));
                                                                echo $formattedDate;
                                                            @endphp
                                                        </td>
                                                        <td>{{ $i->gioitinh }}</td>
                                                        <td>{{ $i->sodienthoai }}</td>
                                                        {{-- <td>{{ $i->email }}</td> --}}
                                                        <td>{{ $i->diachi }}</td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary" href="{{ route('chitiet-thongtinnhanvien',['id'=>$i->manv]) }}">
                                                                <i class="bi bi-eye"></i> Xem
                                                            </a>
                                                            <a type="button" class="btn btn-danger"
                                                                href="{{ route('xoa-thongtinnhanvien', ['id' => $i->manv]) }}">
                                                                <i class="bi bi-trash3"></i> Xóa
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        <form action="{{ route('them-thongtinnhanvien') }}" method="POST"
                                            class="form mt-2">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="hovaten">Họ và
                                                    tên</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="hovaten" id="hovaten"
                                                        value="{{ old('hovaten') }}" required />
                                                    @error('hovaten')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="chucvu">Chức
                                                    vụ</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="chucvu" name="chucvu"
                                                        required>
                                                        <option selected hidden>Choose...</option>
                                                        @foreach ($chucvu as $i)
                                                            <option value="{{ $i->macv }}">{{ $i->tencv }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('chucvu')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="gioitinh">Giới
                                                    tính</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="gioitinh" name="gioitinh"
                                                        required>
                                                        <option selected hidden>Choose...</option>
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                    @error('gioitinh')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="ngaysinh">Ngày
                                                    sinh</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="date" name="ngaysinh"
                                                        id="ngaysinh" value="{{ old('ngaysinh') }}" required />
                                                    @error('ngaysinh')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="sdt">Số điện
                                                    thoại</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="number" name="sdt" id="sdt"
                                                        value="{{ old('sdt') }}" oninput="limitLength(this, 11)"
                                                        required />
                                                    @error('sdt')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="diachi">Địa
                                                    chỉ</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="diachi" id="diachi"
                                                        value="{{ old('diachi') }}" required />
                                                    @error('diachi')
                                                        <small class="help-block">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="ghichu">Ghi
                                                    chú</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <textarea name="ghichu" class="form-control" id="ghichu" cols="30" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>

    <script>
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }
    </script>
@endsection
