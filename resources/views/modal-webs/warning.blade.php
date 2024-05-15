<h1>
    Bạn không đủ quyền hạn truy cập
</h1>

<form method="POST" action="{{ route('thuchien-dangnhap-Guest') }}">
    @csrf
    <button class="dropdown-item"type="submit">Đăng xuất</button>
</form>