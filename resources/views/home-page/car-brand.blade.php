<style>
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 248px;
        align-self: center;
    }
</style>
<div id="car-brand">
    <h3 class="mt-4 mb-4">Hãng xe</h3>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                $chunks = array_chunk($hangxe, 8); // Split into groups of 8
            @endphp
            @foreach ($chunks as $key => $chunk)
                <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                    <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                        @foreach (array_slice($chunk, 0, 4) as $i)
                            <div class="card border-0 text-center">
                                <a href="" class="text-decoration-none">
                                    @foreach (explode(',', $i->logo) as $path)
                                        @if ($loop->first)
                                            <a href="{{ route('timkiem-theohangxe',['id'=>$i->mahx]) }}">
                                                <img src="{{ asset('storage/' . $path) }}"
                                                    class="object-fit-contain border rounded" alt="..."
                                                    width="125" height="100">
                                            </a>
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                        @foreach (array_slice($chunk, 4, 4) as $i)
                            <div class="card border-0 text-center">
                                <a href="" class="text-decoration-none">
                                    @foreach (explode(',', $i->logo) as $path)
                                        @if ($loop->first)
                                            <a href="{{ route('timkiem-theohangxe',['id'=>$i->mahx]) }}">
                                                <img src="{{ asset('storage/' . $path) }}"
                                                    class="object-fit-contain border rounded" alt="..."
                                                    width="125" height="100">
                                            </a>
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
