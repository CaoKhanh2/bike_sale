@if (Session::has('success'))
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Thông báo !</h3>
                    <div class="mb-30 text-center">
                        <img src="{{ asset('/dashboard_src/vendors/images/success.png') }}" />
                    </div>
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#modal').modal('show');
    });
</script>
