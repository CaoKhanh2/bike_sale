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
{{-- ** Xe máy ** --}}
<div id="list-car">
    <h3 class="mt-4 mb-5">Xe máy</h3>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($db_xemay as $i)
            <div class="col">
                <div class="shadow rounded row g-0">
                    <div class="col-md-4 position-relative product-img">
                        @foreach (explode(',', $i->hinhanh) as $path)
                            @if ($loop->first)
                                <img src="{{ asset('storage/' . $path) }}" class="img-fluid rounded-start me-1"
                                    alt="...">
                                @if ($i->giagoc != $i->giaban)
                                    <div class="overlay">{{ number_format($i->tilegiamgia, '0', ',') . '%' }}</div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mx-2">{{ $i->tenxe }}</h5>
                            <div class="row justify-content-center align-items-center g-2 ms-auto my-2">
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-bookmark large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->tenhang }}</p>
                                </div>
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-card-list large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->tendongxe }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2 ms-auto">
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-calendar2 large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->namsx }}</p>
                                </div>
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <img class="img-fluid me-2" src="{{ asset('Image/Icon/motorbike.png') }}"
                                        alt="" width="27px" height="27px">
                                    <p class="mb-0">{{ $i->loaixe }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2 mx-2 my-4">
                                <div class="col mt-3">
                                    <h4><span>
                                            <p class="ms-auto mb-0">{{ number_format($i->giaban, 0, '', ',') . ' đ' }}
                                            </p>
                                        </span></h4>
                                </div>
                                <div class="col mt-3">
                                    <div class="d-grid col mx-auto">
                                        <a name="" id="" class="btn btn-primary btn-block"
                                            href="#" role="button">Đặt mua</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-6 center-column text-center fs-5"><a href="{{ route('hienthi-thongtinxemay-Guest') }}"
                class="link-underline link-underline-opacity-0">XEM TẤT CẢ ></a></div>
    </div>
</div>

{{-- ** End ** --}}


{{-- ** Xe đạp điện ** --}}

<div id="list-car">
    <h3 class="mt-4 mb-5">Xe đạp điện</h3>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($db_xedapdien as $i)
            <div class="col">
                <div class="shadow rounded row g-0">
                    <div class="col-md-4 position-relative product-img">
                        @foreach (explode(',', $i->hinhanh) as $path)
                            @if ($loop->first)
                                <img src="{{ asset('storage/' . $path) }}" class="img-fluid rounded-start me-1"
                                    alt="...">
                                @if ($i->giagoc != $i->giaban)
                                    <div class="overlay">{{ number_format($i->tilegiamgia, '0', ',') . '%' }}</div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mx-2">{{ $i->tenxe }}</h5>
                            <div class="row justify-content-center align-items-center g-2 ms-auto my-2">
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-bookmark large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->tenhang }}</p>
                                </div>
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-card-list large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->tendongxe }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2 ms-auto">
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <i class="bi bi-calendar2 large-icon me-2"></i>
                                    <p class="mb-0">{{ $i->namsx }}</p>
                                </div>
                                <div class="col mt-3 d-flex align-items-center icon-text">
                                    <img class="img-fluid me-2" src="{{ asset('Image/Icon/motorbike.png') }}"
                                        alt="" width="27px" height="27px">
                                    <p class="mb-0">{{ $i->loaixe }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2 mx-2 my-4">
                                <div class="col mt-3">
                                    <h4><span>
                                            <p class="ms-auto mb-0">{{ number_format($i->giaban, 0, '', ',') . ' đ' }}
                                            </p>
                                        </span></h4>
                                </div>
                                <div class="col mt-3">
                                    <div class="d-grid col mx-auto">
                                        <a name="" id="" class="btn btn-primary btn-block"
                                            href="#" role="button">Đặt mua</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-6 center-column text-center fs-5"><a href="{{ route('hienthi-thongtinxedapdien-Guest') }}"
                class="link-underline link-underline-opacity-0">XEM TẤT CẢ ></a></div>
    </div>
</div>
{{-- ** End ** --}}
