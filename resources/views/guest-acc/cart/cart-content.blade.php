<div class="container my-5">
    <div class="card shadow">
        @php $magh = "";@endphp
        @if (!empty($gh))
            <div class="card-body">
                @foreach ($gh as $i)
                    @php $magh = $i->magh @endphp
                    <div class="row align-items-center mb-3">
                        <div class="col text-center">
                            @foreach (explode(',', $i->hinhanh) as $path)
                                @if ($loop->first && $path != '')
                                    <img src="{{ asset('storage/' . $path) }}" alt="Ảnh" class="img-fluid"
                                        style="max-height: 200px; max-width: 200px;">
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <h6 class="m-0">{{ $i->tenxe }}</h6>
                        </div>
                        <div class="col">
                            <h6 class="m-0">{{ number_format($i->giaban, 0, ',', '.') . ' đ' }}</h6>
                        </div>
                        <div class="col">
                            <h6 class="m-0">{{ $i->trangthai }}</h6>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <form action="{{ route('xoa-giohang-Guest') }}" method="POST">
                                @csrf
                                <input type="text" name="mactgh" value="{{ $i->mactgh }}" hidden>
                                <button class="btn btn-danger" type="submit"> <i class="bi bi-trash3"> Xóa </i> </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center my-3">
                    <h6 class="mb-3 mb-md-0">
                        @foreach ($tongtien as $k)
                            @if ($k->magh == $magh)
                                <span><strong class="fs-4">Tổng giá tiền:
                                        {{ number_format($k->tonggiatien, 0, ',', '.') . ' đồng' }}</strong></span>
                            @endif
                        @endforeach
                    </h6>
                    <a href="" class="btn btn-outline-success">Proceed to Checkout</a>
                </div>
            </div>
        @else
            <div class="card-body text-center">
                {{-- {{ Auth::guard('guest')->user()->hovaten}} --}}
                <h2><i class="fa fa-shopping-cart"> Giỏ hàng của bạn trống.</i></h2>
                <a href="{{ route('indexWeb') }}" class="btn btn-outline-primary float-end">Tiếp tục mua hàng</a>
            </div>
        @endif
    </div>
</div>
