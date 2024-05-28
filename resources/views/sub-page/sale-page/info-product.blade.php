@php
    use Carbon\Carbon;
    $ngayHienTai = Carbon::today();
@endphp
<div class="container">
    <div class="row g-5">
        @foreach ($ct_thongtin_xe as $i)
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
                        @if  ($i->giagoc==$i->giaban)
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
                        <a type="button"  href="{{ route('them-giohang-Guest', ['maxedangban' => $i->maxedangban]) }}" class="btn btn-primary">Đặt mua</a>
                    </div>
                </div>
                <div class="row">
                    <div class="product-title mt-3">
                        <h3>Thông số cơ bản</h3>
                    </div>
                    <div class="row">
                        @if ($i->loaixe === 'Xe máy')
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('Image/Icon/icons8-paper-roll-24.png') }}" alt="" class="me-2 align-self-center">
                                            <p class="mb-0 align-self-center">Hãng xe</p>
                                            <div class="ms-auto">{{ $i->tenhang }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-lightning fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Tình trạng xe</p>
                                            <div class="ms-auto">Second item</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-card-list fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center"> Dòng xe</p>
                                            <div class="ms-auto">{{ $i->tendongxe }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('Image/Icon/icons8-gear-stick-16.png') }}" width="24"
                                                height="24" alt="" class="me-2 align-self-center">
                                            <p class="mb-0 align-self-center">Loại xe</p>
                                            <div class="ms-auto">{{ $i->loaixe }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar2 fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center"> Năm sản xuất</p>
                                            <div class="ms-auto">{{ $i->namsx }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('Image/Icon/icons8-engine-oil-24.png') }}" width="24"
                                                height="24" alt="" class="me-2 align-self-center">
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
                                      @if($i->giagoc != $i->giaban)
                                      <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-percent fs-4 me-2 align-self-center"></i>
                                            <p class="mb-0 align-self-center">Khuyến mãi</p>
                                            <div class="ms-auto">{{ $i->tilegiamgia . '%'}} </div>
                                        </div>
                                    </li>
                                      @endif
                                </ul>
                            </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group mt-2">
                                <li class="list-group-item my-2 border-0 bg-light">
                                    <div class="hstack gap-3">
                                        <div class="p-2 d-flex align-items-center"><img
                                                src="{{ asset('Image\Icon\icons8-paper-roll-24.png') }}"
                                                alt=""><span>
                                                <p class="d-inline px-2">Hãng xe</p>
                                            </span></div>
                                        <div class="p-2 ms-auto">{{ $i->tenhang }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item my-2 border-0 bg-light">
                                    <div class="hstack gap-3">
                                        <div class="p-2 d-flex align-items-center"><i
                                                class="bi bi-lightning fs-4"></i><span>
                                                <p class="d-inline px-2"> Tình trạng xe</p>
                                            </span></div>
                                        <div class="p-2 ms-auto">Second item</div>
                                    </div>
                                </li>
                                <li class="list-group-item my-2 border-0 bg-light">
                                    <div class="hstack gap-3">
                                        <div class="p-2 d-flex align-items-center"><i
                                                class="bi bi-card-list fs-4"></i><span>
                                                <p class="d-inline px-2"> Dòng xe</p>
                                            </span></div>
                                        <div class="p-2 ms-auto">{{ $i->tendongxe }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item my-2 border-0 bg-light">
                                    <div class="hstack gap-3">
                                        <div class="p-2 d-flex align-items-center"><img
                                                src="{{ asset('Image\Icon\icons8-gear-stick-16.png') }}" width="24"
                                                height="24" alt=""><span>
                                                <p class="d-inline px-2">Loại xe</p>
                                            </span></div>
                                        <div class="p-2 ms-auto">{{ $i->loaixe }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-group mt-2">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="hstack gap-3">
                                            <div class="p-2 d-flex align-items-center"><i
                                                    class="bi bi-calendar2 fs-4"></i><span>
                                                    <p class="d-inline px-2"> Năm sản xuất</p>
                                                </span></div>
                                            <div class="p-2 ms-auto">{{ $i->namsx }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="hstack gap-3">
                                            <div class="p-2 d-flex align-items-center"><img
                                                    src="{{ asset('Image\Icon\icons8-engine-oil-24.png') }}"
                                                    width="24" height="24" alt=""><span>
                                                    <p class="d-inline px-2">---</p>
                                                </span></div>
                                            <div class="p-2 ms-auto"></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item my-2 border-0 bg-light">
                                        <div class="hstack gap-3">
                                            <div class="p-2 d-flex align-items-center"><i
                                                    class="bi bi-speedometer2 fs-4"></i><span>
                                                    <p class="d-inline px-2">----</p>
                                                </span></div>
                                            <div class="p-2 ms-auto"></div>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </div>
        @endif
    </div>
</div>
</div>
@endforeach
</div>
<div class="col-6 col-md-4"></div>

</div>
