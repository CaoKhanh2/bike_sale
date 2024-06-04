@php
    use Carbon\Carbon;
    $ngayHienTai = Carbon::today();
@endphp
<div class="container">
    <div class="row g-5">
        {{-- Thông tin chi tiết xe máy --}}
        @foreach ($ct_thongtin_xemay as $i)
            @php
                $ngayBan = Carbon::parse($i->ngayban);
                $soNgay = $ngayHienTai->diffInDays($ngayBan);
            @endphp
            <div class="col-sm-6 col-md-8 ms-4">
                <div class="row">
                    <div class="product-gap">
                        <h3>{{ $i->tenxe }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <div class="price-detail text-start">
                            @if ($i->giagoc == $i->giaban)
                                <span>
                                    <strong class="fs-3 text-danger">{{ number_format($i->giaban, 0, ',') . ' đ' }}</strong>
                                </span>
                            @else
                                <span>
                                    <strong class="h5 text-secondary">
                                        <s><em>{{ number_format($i->giagoc, 0, ',') . ' đ' }}</em></s>
                                    </strong>
                                    <strong class="text-danger fs-3">
                                        {{ number_format($i->giaban, 0, ',') . ' đ' }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="time-area text-end">
                            <span>
                                <p class="fs-6 fst-italic">Tin đăng {{ $soNgay }} ngày trước</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="d-grid col-12 col-lg-4 ms-lg-auto my-auto">
                        @if (Auth('guest')->user() == true)
                            <a type="button"
                                href="{{ route('them-giohang-Guest', ['maxedangban' => $i->maxedangban]) }}"
                                class="btn btn-primary">Đặt mua</a>
                        @else
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">
                                Đặt mua
                            </button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="product-title mt-3">
                        <h3>Thông số cơ bản</h3>
                    </div>
                    @if ($i->loaixe === 'Xe máy')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Hãng xe</p>
                                            <div class="ms-auto">{{ $i->tenhang }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-wrench fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Tình trạng xe</p>
                                            <div class="ms-auto">{{ $i->tinhtrangxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-card-list fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Dòng xe</p>
                                            <div class="ms-auto">{{ $i->tendongxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-motorcycle me-2"
                                                style="font-size: 1.5rem; line-height: 1;"></i>
                                            <p class="mb-0 align-self-center">Loại xe</p>
                                            <div class="ms-auto">{{ $i->loaixe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar2 fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Năm sản xuất</p>
                                            <div class="ms-auto">{{ $i->namsx }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-arrow-down-left fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Trọng lượng</p>
                                            <div class="ms-auto">{{ $i->khoiluong }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-arrows-fullscreen fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Dung tích xe</p>
                                            <div class="ms-auto">{{ $i->dungtichxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-speedometer2 fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Số km đã đi</p>
                                            <div class="ms-auto">{{ $i->sokmdadi }} km</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-fuel-pump fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Mức tiêu thụ nhiên liệu</p>
                                            <div class="ms-auto">{{ $i->muctieuthunhienlieu }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bezier fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Dung tích bình xăng</p>
                                            <div class="ms-auto">{{ $i->dungtichbinhxang }}</div>
                                        </div>
                                    </li>
                                    @if ($i->giagoc != $i->giaban)
                                        <li class="list-group-item my-2 border-0 bg-light">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-percent fs-4 me-2 align-self-center"></i>
                                                <p class="mb-0 align-self-center">Khuyến mãi</p>
                                                <div class="ms-auto">{{ $i->tilegiamgia . '%' }} </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Thông tin chi tiết xe đạp điện --}}
        @foreach ($ct_thongtin_xedapdien as $i)
            @php
                $ngayBan = Carbon::parse($i->ngayban);
                $soNgay = $ngayHienTai->diffInDays($ngayBan);
            @endphp

            <div class="col-sm-6 col-md-8 ms-4">
                <div class="row">
                    <div class="product-gap">
                        <h3>{{ $i->tenxe }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <div class="price-detail text-start">
                            @if ($i->giagoc == $i->giaban)
                                <span>
                                    <p class="fs-3">{{ number_format($i->giaban, 0, ',') . ' đ' }}</p>
                                </span>
                            @else
                                <span>
                                    <p class="h5 text-secondary">
                                        <s><em>{{ number_format($i->giagoc, 0, ',') . ' đ' }}</em></s>
                                    </p>
                                    <p class="text-danger fs-3">
                                        {{ number_format($i->giaban, 0, ',') . ' đ' }}</p>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="time-area text-end">
                            <span>
                                <p class="fs-6 fst-italic">Tin đăng {{ $soNgay }} ngày trước</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="d-grid col-12 col-lg-4 ms-lg-auto my-auto">
                        @if (Auth('guest')->user() == true)
                            <a type="button"
                                href="{{ route('them-giohang-Guest', ['maxedangban' => $i->maxedangban]) }}"
                                class="btn btn-primary">Đặt mua</a>
                        @else
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">
                                Đặt mua
                            </button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="product-title mt-3">
                        <h3>Thông số cơ bản</h3>
                    </div>
                    @if ($i->loaixe === 'Xe đạp điện')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Hãng xe</p>
                                            <div class="ms-auto">{{ $i->tenhang }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-wrench fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Tình trạng xe</p>
                                            <div class="ms-auto">{{ $i->tinhtrangxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-card-list fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Dòng xe</p>
                                            <div class="ms-auto">{{ $i->tendongxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bicycle fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Loại xe</p>
                                            <div class="ms-auto">{{ $i->loaixe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar3 fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Năm sản xuất</p>
                                            <div class="ms-auto">{{ $i->namsx }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-arrow-down-left fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Trọng lượng</p>
                                            <div class="ms-auto">{{ $i->trongluong }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-battery-half fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Số ắc quy</p>
                                            <div class="ms-auto">{{ $i->acquy }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-lightning-charge fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Động cơ điện</p>
                                            <div class="ms-auto">{{ $i->dongcodien }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-hourglass-split fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Thời gian sạc đầy điện</p>
                                            <div class="ms-auto">{{ $i->thoigiansacdien }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Phạm vi sử dụng</p>
                                            <div class="ms-auto">{{ $i->phamvisudung }}</div>
                                        </div>
                                    </li>
                                    @if ($i->giagoc != $i->giaban)
                                        <li class="list-group-item my-2 border-0 bg-light">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-tags fs-4 me-2 align-self-center"></i>
                                                <p class="mb-0 align-self-center">Khuyến mãi</p>
                                                <div class="ms-auto">{{ $i->tilegiamgia . '%' }} </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

    </div>


    @include('modal-webs.modal-login')


    {{-- <div class="col-6 col-md-4"></div> --}}

</div>
