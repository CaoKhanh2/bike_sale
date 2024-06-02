@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
@endphp

@if (Session::has('success-tao-phieunhap'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Thông báo",
            position: "center",
            text: "{{ Session::get('success-tao-phieunhap') }}",
        });
    </script>
@endif

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-blue h4">Phiếu nhập kho</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('thongtinkhohang') }}" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <select name="selectRowCount" id="selectRowCount" class="form-control">
                    <option value="" selected hidden>Chọn số lượng xe muốn nhập</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="khohang" class="form-control" id="khohang" required>
                    <option value="" selected hidden>Chọn kho</option>
                    @foreach ($khohang as $item)
                        <option value="{{ $item->makho }}">{{ $item->tenkhohang }}</option>
                    @endforeach
                </select>
                @error('khohang')
                    <small class="help-block">
                        <p class="text-danger">{{ $message }}</p>
                    </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="table-responsive pb-20">
        <form action="{{ route('them-mutil-thongtinnhapkho') }}" id="mainForm" method="POST">
            @csrf
            <input type="hidden" name="khohang" id="selected_khohang" value="" hidden>
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">STT</th>
                        <th colspan="2" class="align-middle">Thông tin mặt hàng</th>
                        <th colspan="4">Thông tin phiếu nhập</th>
                        {{-- <th colspan="2">Thông tin kho</th> --}}
                    </tr>
                    <tr>
                        <th>Mã xe</th>
                        <th class="col-md-3">Tên xe</th>
                        <th>Số lượng</th>
                        <th class="col-md-2">Giá nhập kho</th>
                        <th class="">Thành tiền</th>
                        {{-- <th class="col-md-2">Tên kho</th> --}}
                        <th>Ngày nhập</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Dòng sẽ được thêm theo số lượng được chọn -->
                </tbody>
            </table>
            <div class="">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="submitCheckedForms()">Tạo phiếu
                        nhập</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        function initializeSelect2() {
            $('select.thongtinxe').select2({
                placeholder: "Chọn xe",
                allowClear: true
            }).on('change', function() {
                var selectedValue = $(this).val();
                $(this).closest('tr').find('input[name="maxe[]"]').val(selectedValue);
                // Loại bỏ lựa chọn đã được chọn từ các select khác
                $('select.thongtinxe').not(this).find('option[value="' + selectedValue + '"]').remove();
            });
        }

        $('#selectRowCount').on('change', function() {
            var rowCount = $(this).val();
            generateRows(rowCount);
        });

        function generateRows(rowCount) {
            var tableBody = $('#tableBody');
            tableBody.empty();

            for (var i = 1; i <= rowCount; i++) {
                var newRow = `
            <tr>
                <td>${i}</td>
                <td><input type="text" class="form-control text-center" name="maxe[]" disabled></td>
                <td>
                    <div class="row justify-content-center">
                        <div class="col-md">
                            <select name="thongtinxe[]" class="form-control thongtinxe" required>
                                <option value="" selected hidden>Chọn xe</option>
                                @foreach ($thongtinxe as $item)
                                    <option value="{{ $item->maxe }}">{{ $item->tenxe }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('thongtinxe.*')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </td>
                <td>
                    <input type="number" class="form-control text-center soluong" name="soluong[]" min=1>
                    @error('soluong.*')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </td>
                <td>
                    <input type="number" class="form-control text-center gianhapkho" name="gianhapkho[]">
                    @error('gianhapkho.*')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </td>
                <td>
                    <input type="text" class="form-control text-center tong" name="tong[]" disabled>
                </td>
                <td>{{ $currentDate->format('d/m/Y') }}</td>
            </tr>`;
                tableBody.append(newRow);
            }

            function calculateTotal(row) {
                var soluong = row.querySelector('.soluong').value;
                var gianhapkho = row.querySelector('.gianhapkho').value;
                var tong = row.querySelector('.tong');

                var total = soluong * gianhapkho;
                tong.value = formatCurrency(total);
            }

            function formatCurrency(value) {
                if (!value) return '';
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' đ';
            }

            $('#tableBody').on('input', '.soluong, .gianhapkho', function() {
                var row = $(this).closest('tr')[0];
                calculateTotal(row);
            });

            initializeSelect2();
        }

        initializeSelect2();

        $('#khohang').on('change', function() {
            var selectedValue = $(this).val();
            $('#selected_khohang').val(selectedValue);
        });

        window.submitCheckedForms = function() {
            document.getElementById('mainForm').submit();
        }
    });
</script>
