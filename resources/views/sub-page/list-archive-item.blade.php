<style>
    .product-img {
        position: relative;
    }

    .product-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .product-img .overlay {
        border-radius: 40px;
        background: red;
        display: inline-block;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 15%;
        right: 70%;
        transform: translate(-50%, -50%);
        line-height: 50px;
        text-align: center;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<div class="container">
    @php
        $url = url()->current();
        $arr = explode('/', $url);
        $res = end($arr);
    @endphp

    @if ($res == 'motorbike')
        @include('modal-webs.inform-add-cart')
        @foreach ($db_xemay as $i)
            <div class="item-list">
                <div class="item">
                    <div class="row g-0 mt-4 mb-4">
                        <div class="col-12 col-md-8">
                            <div class="row g-0 mt-3 mb-4">
                                <div class="col-12 col-sm-4 mb-3 mb-sm-0 product-img">
                                    @foreach (explode(',', $i->hinhanh) as $path)
                                        @if ($loop->first)
                                            <img src="{{ asset('storage/' . $path) }}"
                                                class="object-fit-contain border rounded img-fluid" alt="..."
                                                style="height: 180px; width: 100%;">
                                                @if ($i->giagoc != $i->giaban)
                                                <div class="overlay">{{number_format($i->tilegiamgia,'0',',') . '%'}}</div>
                                                @endif
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-12 col-sm-8 px-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">{{ $i->tenxe }}</h4>
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <i class="bi bi-bookmark fs-4"></i>
                                                <p class="d-inline mb-0 ms-2">{{ $i->tenhang }}</p>
                                            </div>
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <i class="bi bi-card-list fs-4"></i>
                                                <p class="d-inline mb-0 ms-2">{{ $i->tendongxe }}</p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <i class="bi bi-calendar2 fs-4"></i>
                                                <p class="d-inline mb-0 ms-2">{{ $i->namsx }}</p>
                                            </div>
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <img width="30" height="30"
                                                    src="{{ asset('Image\Icon\icons8-moto-50.png') }}"
                                                    alt="motorcycle" />
                                                <p class="d-inline mb-0 ms-2">{{ $i->loaixe }}</p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <i class="bi bi-check-square fs-4"></i>
                                                <p class="d-inline mb-0 ms-2">{{ $i->tinhtrangxe }}</p>
                                            </div>
                                            <div class="col-6 col-md-6 mt-3 d-flex align-items-center">
                                                <i class="bi bi-speedometer2 fs-4"></i>
                                                <p class="d-inline mb-0 ms-2">{{ $i->sokmdadi . ' Km' }}</p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center align-items-center g-2 mt-4">
                                            @if ($i->giagoc == $i->giaban)
                                                <div class="col-12 col-md-4 mt-3">
                                                    <h4>
                                                        <span>
                                                            <p class="d-inline">
                                                                {{ number_format($i->giaban, 0, ',') . ' đ' }}</p>
                                                        </span>
                                                    </h4>
                                                </div>
                                            @else
                                                <div class="col-12 col-md-4 mt-3">
                                                    <h4>
                                                        <span>
                                                            <p class="h6 text-secondary">
                                                                <span><s><em>{{ number_format($i->giagoc, 0, ',') . ' đ' }}</em></s></span>
                                                            </p>
                                                            <p class="d-inline text-danger">
                                                                {{ number_format($i->giaban, 0, ',') . ' đ' }}</p>
                                                        </span>
                                                    </h4>
                                                </div>
                                            @endif
                                            {{-- Nút thực hiện chức năng --}}
                                            <div class="col-12 col-md-4 mt-3">
                                                <div class="d-grid">
                                                    <a href="{{ route('hienthi-chitietthongtinxemay-Guest', ['maxe' => $i->maxe]) }}"
                                                        class="btn btn-primary">
                                                        <i class="bi bi-eye-fill"></i> Xem chi tiết
                                                    </a>
                                                </div>
                                            </div>
                                            @if (Auth::guard('guest')->check())
                                                <div class="col-12 col-md-4 mt-3">
                                                    <div class="d-grid">
                                                        <a class="btn btn-primary btn-block"
                                                            href="{{ route('them-giohang-Guest', ['maxedangban' => $i->maxedangban]) }}"
                                                            role="button">
                                                            Thêm giỏ hàng
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                        <div class="col-12 col-md-4"></div>
                    </div>
                </div>
            </div>
        @endforeach
    @elseif($res == 'electric-bicycles')
        @foreach ($db_xedapdien as $i)
            <div class="item-list">
                <div class="item">
                    <div class="row g-0 mt-4 mb-4">
                        <div class="col-sm-6 col-md-8">
                            <div class="row">
                                <div class="col-4">
                                    {{-- <img src="{{ asset('Image\Xe\XeDien\LX 150i JVC\xe-may-dien-vespa-lx-150i-jvc-ghi.png') }}"
                                    class="object-fit-contain border rounded" alt="..." height="190px"
                                    width="100%"> --}}
                                    @foreach (explode(',', $i->hinhanh) as $path)
                                        @if ($loop->first)
                                            <img src="{{ asset('storage/' . $path) }}"
                                                cclass="object-fit-contain border rounded" alt="..." height="190px"
                                                width="100%">
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col-8">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">{{ $i->tenxe }}</h4>
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col mt-3"><i class="bi bi-bookmark fs-4"> </i>
                                                <p class="d-inline">{{ $i->tenhang }}</p>
                                            </div>
                                            <div class="col mt-3"><i class="bi bi-card-list fs-4"> </i>
                                                <p class="d-inline">{{ $i->tendongxe }}</p>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col mt-3"><i class="bi bi-calendar2 fs-4"> </i>
                                                <p class="d-inline">{{ $i->namsx }}</p>
                                            </div>
                                            <div class="col mt-3">
                                                {{-- <img 
                                            src="{{ asset('Image\Icon\motorbike.png') }}" alt="" width="24px"
                                            height="24px"> --}}
                                                <img class="" width="30" height="30"
                                                    src="{{ asset('Image\Icon\icons8-moto-50.png') }}"
                                                    alt="motorcycle" />
                                                <p class="d-inline">{{ $i->loaixe }}</p>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col mt-3"><i class="bi bi-check-square fs-4"> </i>
                                                <p class="d-inline">{{ $i->tinhtrangxe }}</p>
                                            </div>
                                            <div class="col mt-3"><i class="bi bi-speedometer2 fs-4"> </i>
                                                <p class="d-inline">{{ $i->sokmdadi . ' Km' }}</p>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center align-items-center g-2 mt-4">
                                            <div class="col-6 mt-3">
                                                <h4><span>
                                                        <p class="d-inline">
                                                            {{ number_format($i->giaban, 0, ',') . ' đ' }}
                                                        </p>
                                                    </span></h4>
                                            </div>
                                            <div class="col-3 mt-3 ">
                                                <div class="d-grid">
                                                    <a name="" id="" type="button"
                                                        class="btn btn-primary"><i class="bi bi-eye-fill">
                                                        </i>
                                                        Xem chi tiết</a>
                                                </div>
                                            </div>
                                            @if (Auth::guard('guest')->check())
                                                <div class="col-3 mt-3">
                                                    <div class="d-grid">
                                                        <a name="" id=""
                                                            class="btn btn-primary btn-block" href="#"
                                                            role="button">Thêm giỏ hàng</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                        <div class="col-6 col-md-4"></div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row g-0 mt-4 mb-4">
        <div class="col-sm-6 col-md-8">
            <div class="pagination justify-content-center"></div>
        </div>
        <div class="col-6 col-md-4"></div>
    </div>


    <script src="{{ asset('home_src\js\pagination.js') }}"></script>
</div>
