<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Chimimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); min-height:100vh; display:flex; align-items:center; justify-content:center;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg border-0" style="border-radius:32px;background:#fffbe6;">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <span class="fw-bold d-inline-block"
                                style="color:#ff6f61;background:transparent;padding:0.7em 2.2em;border-radius:36px;font-size:2.4rem;letter-spacing:1.5px;font-family:inherit;">
                                Register
                            </span>
                        </div>
                        <form method="POST" action="/register">
                            @csrf

                            <div class="mb-4">
                                <label for="username" class="form-label fw-bold" style="color:#ff6f61;">Username</label>
                                <input id="username" class="form-control shadow-sm" type="text" name="username" value="{{ old('username') }}" required autofocus
                                    style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
                                @error('username')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold" style="color:#ff6f61;">Email</label>
                                <input id="email" class="form-control shadow-sm" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                    style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-bold" style="color:#ff6f61;">Phone</label>
                                <input id="phone" class="form-control shadow-sm" type="text" name="phone" value="{{ old('phone') }}" required
                                    style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold" style="color:#ff6f61;">Password</label>
                                <input id="password" class="form-control shadow-sm" type="password" name="password" required autocomplete="new-password"
                                    style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold" style="color:#ff6f61;">Confirm Password</label>
                                <input id="password_confirmation" class="form-control shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password"
                                    style="border-radius:18px;border:2px solid #ffe066;background:#fff;">
                            </div>

                            <div class="d-flex justify-content-center mb-3">
                                <button type="submit" class="btn px-5 py-2"
                                    style="background:#ff6f61;color:#fff;font-weight:700;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.13);font-size:1.1rem;transition:background .2s;">
                                    Register
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <span style="color:#6b6b6b;">Already have an account?</span>
                            <a href="{{ route('login') }}" style="color:#ff6f61;font-weight:700;text-decoration:underline;">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
