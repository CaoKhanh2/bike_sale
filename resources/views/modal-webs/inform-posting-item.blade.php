@if (Auth::guard('guest')->check() == false)
    <style>
        .custom-size {
            font-size: 4rem;
        }
    </style>
    <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4" id="exampleModalLabel">Thông báo</h5>
                </div>
                <div class="modal-body text-center">
                    <div class="my-2"><i class="bi bi-exclamation-triangle custom-size text-warning"></i></div>
                    <span>
                        <p class="fs-5">Bạn cần đăng nhập để sử dụng chức năng này !</p>
                    </span>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('dangnhap-Guest') }}">Đăng nhập</a>
                    <a class="btn btn-secondary" href="{{ route('indexWeb') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap-tool\js\bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#modal').modal('show');
        });
    </script>
@endif

