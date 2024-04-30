<table class="table hover data-table-export">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dòng xe</th>
            <th>Hãng xe</th>
            <th>Tên xe</th>
            {{-- <th>Giá bán</th>
            <th>Tình trạng</th> --}}
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($thongtinxemay as $i)
            <tr>
                <td>{{ $i->maxe }}</td>
                <td>{{ $i->tendongxe }}</td>
                <td>{{ $i->tenhang }}</td>
                <td>{{ $i->tenxe }}</td>
                {{-- <td>
                    @foreach (explode(',', $i->hinhanh) as $path)
                        <img src="{{ asset('storage/'.$path) }}" alt="Ảnh">
                    @endforeach
                </td> --}}
                {{-- <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td> --}}
                {{-- <td>
                    @php
                        $rs = strval($i->tinhtrang);
                        if ($rs == '1') {
                            echo '<img src="' .
                                asset('Image/Icon/check.png') .
                                '" alt="" srcset="" width="25" height=215">';
                        } else {
                            echo '<img src="' .
                                asset('Image/Icon/remove.png') .
                                '" alt="" srcset="" width="25" height="25">';
                        }

                    @endphp
                </td> --}}
                <td>
                    @foreach (explode(',', $i->hinhanh) as $path)
                        @if ($loop->first)
                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh" height="200" width="200">
                        @endif
                    @endforeach
                </td>
                <td>
                    <a type="button" class="btn btn-primary"
                        href="{{ route('ctthongtinxemay', ['maxemay' => $i->maxe]) }}">
                        <i class="bi bi-eye"></i> Xem
                    </a>
                    <a type="button" class="btn btn-danger" href="{{ route('xoathongtinxemay', ['maxemay' => $i->maxe]) }}">
                        <i class="bi bi-trash3"></i> Xóa
                    </a>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
