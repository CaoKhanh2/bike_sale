<table class="table hover multiple-select-row nowrap dtr-inline">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dòng xe</th>
            <th>Hãng xe</th>
            <th>Tên xe</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($thongtinxedapdien as $i)
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
                            <img src="{{ asset('storage/' . $path) }}" alt="Empty image" height="200" width="200">
                        @endif
                    @endforeach
                </td>
                <td>
                    <a type="button" class="btn btn-primary" href="{{ route('ctthongtinxe', ['maxe' => $i->maxe]) }}">
                        <i class="bi bi-eye"></i> Xem
                    </a>
                    <a type="button" class="btn btn-danger"
                        href="{{ route('xoathongtinxedapdien', ['maxedapdien' => $i->maxe]) }}">
                        <i class="bi bi-trash3"></i> Xóa
                    </a>

                    @php
                        $check_xedangban = DB::table('xedangban')
                            ->select('xedangban.maxe')
                            ->where('xedangban.maxe', $i->maxe)
                            ->exists();
                        $check_ctkho = DB::table('ctkhohang')
                            ->where('maxe', $i->maxe)
                            ->exists();
                    @endphp
                    @if ($check_xedangban == false && $check_ctkho == true)
                        <a type="button" class="btn btn-info"
                            href="{{ route('xedangban1-thongtinxe', ['maxe' => $i->maxe]) }}" aria-disabled="true">
                            <i class="bi bi-postcard"></i> Đăng bán
                        </a>
                    @endif

                    @if ($check_xedangban == true)
                        <a type="button" class="btn btn btn-secondary disabled"
                            href="{{ route('xedangban1-thongtinxe', ['maxe' => $i->maxe]) }}" aria-disabled="true">
                            <i class="bi bi-postcard"></i> Đăng bán
                        </a>
                    @endif
                    {{-- @foreach ($xedangban as $k)
                        @if ($k->maxe == $i->maxe)
                            <a type="button" class="btn btn-info"
                                href="{{ route('xedangban1-thongtinxe', ['maxe' => $i->maxe]) }}" aria-disabled="true">
                                <i class="bi bi-postcard"></i> Đăng bán
                            </a>
                        @endif

                        @if ($k->maxe != $i->maxe)
                            <a type="button" class="btn btn-info disabled"
                                href="{{ route('xedangban1-thongtinxe', ['maxe' => $i->maxe]) }}" aria-disabled="true">
                                <i class="bi bi-postcard"></i> Đăng bán
                            </a>
                        @endif
                    @endforeach --}}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
