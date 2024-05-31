<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th rowspan="2" class="align-middle">Thời gian</th>
            <th colspan="2">Xe máy</th>
            <th colspan="2">Xe đạp điện</th>
        </tr>
        <tr>
            <th scope="col">Số lượng</th>
            <th scope="col">Chi phí</th>

            <th scope="col">Số lượng</th>
            <th scope="col">Chi phí</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($thongtinxethumua as $i)
            <tr>
                <td>{{ $i->year .' Quý ' .  $i->quarter }}</td>
                <td>{{ $i->total_xemay }}</td>
                <td>{{ number_format($i->total_giaban_xemay,'0','',','). ' đ' }}</td>
                <td>{{ $i->total_xedapdien }}</td>
                <td>{{ number_format($i->total_giaban_xedapdien,'0','',','). ' đ'}}</td>
            </tr>
        @endforeach
        
    </tbody>
</table>
