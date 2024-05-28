
<style>
    .hidden {
        display: none;
    }
</style>
<div class="container my-auto">
    <div id="change-password-form" class="mt-3 hidden">
        <form method="POST" action="{{ route('thuchien-thaydoi-matkhu-Guest') }}" id="password-form">
            @csrf
            <div class="form-group mb-4 ">
                <div class="col-12 col-md-12">
                    <label for="current-password">Mật khẩu hiện tại:</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="current-password" name="current-password"
                            aria-describedby="toggle-password-visibility" autocomplete="current-password" required>
                        <span class="input-group-text" id="toggle-password-visibility">
                            <i class="bi bi-eye" id="toggle-password-icon"></i>
                        </span>
                    </div>
                    @error('current-password')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col-12 col-md-12">
                    <label for="new-password">Mật khẩu mới:</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="new-password" name="new-password"
                            aria-describedby="toggle-new-password-visibility" autocomplete="new-password" required>
                        <span class="input-group-text" id="toggle-new-password-visibility">
                            <i class="bi bi-eye" id="toggle-new-password-icon"></i>
                        </span>
                    </div>
                    @error('new-password')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </div>
            </div>

            <div class="form-row  mb-4">
                <div class="col-12 col-md-12">
                    <label for="confirm-password">Nhập lại mật khẩu mới:</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                            aria-describedby="toggle-confirm-password-visibility" autocomplete="new-password" required>
                        <span class="input-group-text" id="toggle-confirm-password-visibility">
                            <i class="bi bi-eye" id="toggle-confirm-password-icon"></i>
                        </span>
                    </div>
                    @error('confirm-password')
                        <small class="help-block">
                            <p class="text-danger">{{ $message }}</p>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success">Thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('toggle-password-visibility').addEventListener('click', function() {
        const passwordInput = document.getElementById('current-password');
        const icon = document.getElementById('toggle-password-icon');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !isPassword);
        icon.classList.toggle('bi-eye-slash', isPassword);
    });

    document.getElementById('toggle-new-password-visibility').addEventListener('click', function() {
        const passwordInput = document.getElementById('new-password');
        const icon = document.getElementById('toggle-new-password-icon');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !isPassword);
        icon.classList.toggle('bi-eye-slash', isPassword);
    });

    document.getElementById('toggle-confirm-password-visibility').addEventListener('click', function() {
        const passwordInput = document.getElementById('confirm-password');
        const icon = document.getElementById('toggle-confirm-password-icon');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !isPassword);
        icon.classList.toggle('bi-eye-slash', isPassword);
    });
</script>
