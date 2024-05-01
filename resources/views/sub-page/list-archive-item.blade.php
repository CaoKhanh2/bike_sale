<div class="container">

    @php
        $url = url()->current();
        $arr = explode('/', $url);
        $res = end($arr);
    @endphp

    @if ($res == 'xemay')
        @foreach ($db_xemay as $i)
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
                                                        class="btn btn-outline-secondary"><i class="bi bi-eye-fill">
                                                        </i>
                                                        Xem chi tiết</a>
                                                </div>
                                            </div>
                                            <div class="col-3 mt-3">
                                                <div class="d-grid">
                                                    <a name="" id="" class="btn btn-primary btn-block"
                                                        href="#" role="button">Đặt mua</a>
                                                </div>
                                            </div>
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
    @elseif($res == 'xedapdien')
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
                                                        class="btn btn-outline-secondary"><i class="bi bi-eye-fill">
                                                        </i>
                                                        Xem chi tiết</a>
                                                </div>
                                            </div>
                                            <div class="col-3 mt-3">
                                                <div class="d-grid">
                                                    <a name="" id=""
                                                        class="btn btn-primary btn-block" href="#"
                                                        role="button">Đặt mua</a>
                                                </div>
                                            </div>
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
