<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã xe</th>
            <th scope="col">Tên xe</th>
            <th scope="col">Ngày bán</th>
            <th scope="col">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp
        @foreach ($thongtintbanhang as $i)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $i->maxe }}</td>
                <td>{{ $i->tenxe }}</td>
                <td>{{ date('d/m/Y', strtotime($i->ngaytaodon)) }}</td>
                <td>{{ number_format($i->tongtien, 0, ',') . ' đ' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
