<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-3">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="current_password" class="form-label fw-bold" style="color:#f17807;">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="form-control shadow-sm"
                autocomplete="current-password" style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('current_password', 'updatePassword')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-bold" style="color:#f17807;">New Password</label>
            <input id="password" name="password" type="password" class="form-control shadow-sm"
                autocomplete="new-password" style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('password', 'updatePassword')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold" style="color:#f17807;">Confirm
                Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="form-control shadow-sm" autocomplete="new-password"
                style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn px-5 py-2"
                style="background:#f17807;color:#fff;font-weight:700;border-radius:24px;box-shadow:0 2px 12px rgba(241,120,7,0.10);font-size:1.1rem;">
                Change Password
            </button>
        </div>
        @if (session('status') === 'password-updated')
            <div class="text-success text-center mt-3">Password updated!</div>
        @endif
    </form>
</section>
