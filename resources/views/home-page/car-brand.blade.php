<style>
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px; 
        height: 248px;
        align-self: center;    
    }
</style>
<div id="car-brand">
    <h3 class="mt-4 mb-4">Tìm nhanh theo hãng xe</h3>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Honda_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Yamaha_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Suzuki_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Kawasaki_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                </div>
                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Piaggio_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Dibao_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Sym_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Vespa_Logo.png') }}" class="object-fit-contain border rounded " alt="..." width="125" height="100"></a>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Honda_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Yamaha_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Suzuki_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Kawasaki_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                </div>
                <div class="card-group d-flex justify-content-center align-items-center mt-3 mb-3">
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Piaggio_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Dibao_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Sym_Logo.png') }}" class="object-fit-contain border rounded" alt="..." width="125" height="100"></a>
                    </div>
                    <div class="card border-0 text-center">
                        <a href=""><img src="{{ asset('Image\logo_xe\Vespa_Logo.png') }}" class="object-fit-contain border rounded " alt="..." width="125" height="100"></a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
