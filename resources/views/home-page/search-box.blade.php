{{-- <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css') }}"> --}}

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
<link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') }}"> --}}
<style>
    /* Viền mặc định cho radio button */
    .form-check-input[type="radio"] {
    border: 2.5px solid #ced4da; /* Màu viền mặc định */
    border-width: 2px
    }
</style>
<div class="card bg-light display-center" id="search-box">
    <div class="card-body box-search border-0">
        <form action="" method="">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Tìm tên, hãng, dòng xe, ..." aria-label="">
                </div>
                <div class="col">
                    <select id="inputState" class="form-select">
                        <option selected>Tỉnh, thành phố</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col">
                    <select id="inputState" class="form-select">
                        <option selected>Loại xe</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col">

                    <div class="input-group">
                        <input type="button" class="form-control" value="Bộ lọc" aria-label="Filter" data-toggle="modal" data-target="#filterModal">
                        <span class="input-group-text" type="button" data-toggle="modal" data-target="#filterModal"><i class="bi bi-funnel-fill"></i></span>
                    </div>
                </div>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <a name="" id="" class="btn btn-primary btn-block" href="#"
                        role="button">Tìm</a>
                </div>
            </div>
        </form>
        
    </div>
    
</div>
<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Filter Functionality
        $('#filterInput').on('keyup', function() {
            var filter = $(this).val().toUpperCase();
            $('#filterList li').each(function() {
                var text = $(this).text().toUpperCase();
                if (text.indexOf(filter) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#rangeSlider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 50000000,
            from: 0,
            to: 50000000,
            grid: true,
            // grid_num: 1000000,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: ",",
            force_edges: true,
            onChange: function(data) {
                // Log changed values to console
                console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
    });
</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}

