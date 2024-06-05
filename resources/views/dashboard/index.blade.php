@extends('dashboard.layout.content')
@section('title_ds', 'Dashboard')

@section('main')

    <div class="main-container">
        @include('dashboard.modal-dash.success-login')
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('dashboard_src/vendors/images/banner-img.png') }}" alt="" />
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Welcome back
                            <div class="weight-600 font-30 text-blue">{{ Auth::user()->tentaikhoan }}</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{$sl_kh}}</div>
                                <div class="font-14 text-dark weight-500">
                                   Khách hàng
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="icon-copy bi bi-person-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{$sl_dtm}}</div>
                                <div class="font-14 text-dark weight-500">
                                    Đơn thu mua chưa duyệt
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <span class="icon-copy bi bi-clipboard"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">400+</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total Doctor
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon">
                                    <i
                                        class="icon-copy fa fa-stethoscope"
                                        aria-hidden="true"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{number_format($tt, 0, '', ',') . ' đ' }}</div>
                                <div class="font-14 text-dark weight-500">Doanh thu tháng này</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#09cc06">
                                    <i class="icon-copy bi bi-currency-dollar" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="text-center">
                            <a href="{{ route('thongtinxe-index')}}"> <button class="btn btn-outline-dark mb-3 col-12">Thêm thông tin xe </button></a>
                            <a href="{{ route('xedangban2-thongtinxe')}}"> <button class="btn btn-outline-dark mb-3 col-12">Đăng bán xe</button></a>
                            <a href="{{ route('xedkthumua')}}"> <button class="btn btn-outline-dark mb-3 col-12">Duyệt đơn thu mua</button></a>
                            <a href="{{ route('thongtinkhohang')}}"> <button class="btn btn-outline-dark mb-3 col-12">Kiểm tra kho hàng</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="text-center mb-3">
                            <h4> Xe mới được thêm gần đây </h4>
                        </div>
                        <table class="table table-bordered table-striped border-dark">
                            <thead class="text-center">
                                <th>Mã xe</th>
                              
                                <th>Tên xe</th>
                                <th>Giá bán</th>
                            </thead>
                            <tbody class="text-center">
                                @foreach($xe as $i)
                                <tr>
                                <td>{{$i->maxe}}</td>
                            
                                <td>{{$i->tenxe}}</td>
                                <td>{{$i->giaban}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection
