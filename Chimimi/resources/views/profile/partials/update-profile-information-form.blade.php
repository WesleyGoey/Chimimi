<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-3">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="username" class="form-label fw-bold" style="color:#ff6f61;">Username</label>
            <input id="username" name="username" type="text" class="form-control shadow-sm"
                value="{{ old('username', $user->username) }}" required autofocus autocomplete="username"
                style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('username')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold" style="color:#ff6f61;">Email</label>
            <input id="email" name="email" type="email" class="form-control shadow-sm"
                value="{{ old('email', $user->email) }}" required autocomplete="username"
                style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label fw-bold" style="color:#ff6f61;">Phone</label>
            <input id="phone" name="phone" type="text" class="form-control shadow-sm"
                value="{{ old('phone', $user->phone) }}" required autocomplete="tel"
                style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
            @error('phone')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-center mb-3">
            <a href="{{ route('password.change') }}" class="fw-bold"
               style="color:#f17807;text-decoration:underline;font-size:1rem;">
                Change Password
            </a>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <button type="submit" class="btn px-5 py-2"
                style="background:#ff6f61;color:#fff;font-weight:700;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.1rem;">
                Save Changes
            </button>
        </div>
        @if (session('status') === 'profile-updated')
            <div class="text-success text-center mt-3">Profile updated!</div>
        @endif
    </form>
</section>