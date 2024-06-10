<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th>STT</th>
            <th>Mã xe</th>
            <th>Tên xe</th>
            <th>Đơn vị tính</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
        </tr>
    </thead>
    <tbody class="text-center">
        {{-- @dd(isset($tonkho)); --}}
        @if (isset($tonkho))
            @php
                $count = 1;
            @endphp
            @foreach ($tonkho as $i)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $i->maxe }}</td>
                    <td>{{ $i->tenxe }}</td>
                    <td>chiếc</td>
                    <td>{{ $i->soluong }}</td>
                    <td>{{ number_format($i->gianhapkho,'0','',','). ' đ' }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
