<div class="card border-0 rounded-3">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-2 text-center">{{ __('Ubah Password') }}</h5>
        <p class="card-text text-muted small mb-4 text-center">
            {{ __('Perbarui passwrod untuk keamanan akun anda.') }}
        </p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="update_password_current_password" class="form-label fw-bold">{{ __('Password Lama') }}</label>
                <input type="password" id="update_password_current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password" class="form-label fw-bold">{{ __('Password Baru') }}</label>
                <input type="password" id="update_password_password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password_confirmation" class="form-label fw-bold">{{ __('Konfirmasi Password') }}</label>
                <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3 align-items-center">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
                    <p class="text-success small mb-0">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>
