<style>
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 122px;
        align-self: center;
    }
</style>
@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);
@endphp
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-8">
            @if ($res == 'motorbike')
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @php $chunks = array_chunk($hangxemay, 4); @endphp
                        @foreach ($chunks as $key => $chunk)
                            {{-- duyệt các phần tử (mảng chuck) của mảng chucks với key là chỉ mục phần tử trong mảng chucks --}}
                            <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                                    @foreach ($chunk as $i)
                                        <div class="card border-0 text-center">
                                            <a href="" class="text-decoration-none">
                                                @foreach (explode(',', $i->logo) as $path)
                                                    @if ($loop->first)
                                                        <a href="{{ route('timkiem-theohangxe', ['id' => $i->mahx]) }}">
                                                            <img src="{{ asset('storage/' . $path) }}"
                                                                class="object-fit-contain border rounded" alt="..."
                                                                width="50" height="50">
                                                        </a>
                                                    @endif
                                                @endforeach
                                                <span>
                                                    <p class="text-dark">{{ $i->tenhang }}</p>
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @elseif($res == 'electric-bicycles')
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @php $chunks = array_chunk($hangxedapdien, 4); @endphp
                        @foreach ($chunks as $key => $chunk)
                            {{-- duyệt các phần tử (mảng chuck) của mảng chucks với key là chỉ mục phần tử trong mảng chucks --}}
                            <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                                    @foreach ($chunk as $i)
                                        <div class="card border-0 text-center">
                                            <a href="" class="text-decoration-none">
                                                @foreach (explode(',', $i->logo) as $path)
                                                    @if ($loop->first)
                                                        <a href="{{ route('timkiem-theohangxe', ['id' => $i->mahx]) }}">
                                                            <img src="{{ asset('storage/' . $path) }}"
                                                                class="object-fit-contain border rounded" alt="..."
                                                                width="50" height="50">
                                                        </a>
                                                    @endif
                                                @endforeach
                                                <span>
                                                    <p class="text-dark">{{ $i->tenhang }}</p>
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif

        </div>
        <div class="col-6 col-md-4"></div>
    </div>
</div>
