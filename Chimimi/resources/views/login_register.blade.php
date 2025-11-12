@extends('layout.mainlayout')

@section('title', 'Login & Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg" style="border-radius:24px;">
                <div class="card-body p-4">
                    <ul class="nav nav-tabs mb-4 justify-content-center" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                                type="button" role="tab" aria-controls="login" aria-selected="true"
                                style="font-weight:600;color:#ff6f61;">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                                type="button" role="tab" aria-controls="register" aria-selected="false"
                                style="font-weight:600;color:#ff6f61;">Register</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="authTabContent">
                        {{-- Login Tab --}}
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label fw-bold" style="color:#ff6f61;">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label fw-bold" style="color:#ff6f61;">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn px-5 py-2"
                                        style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;">Login</button>
                                </div>
                            </form>
                        </div>
                        {{-- Register Tab --}}
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="registerUsername" class="form-label fw-bold" style="color:#ff6f61;">Username</label>
                                    <input type="text" class="form-control" id="registerUsername" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerEmail" class="form-label fw-bold" style="color:#ff6f61;">Email</label>
                                    <input type="email" class="form-control" id="registerEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerPassword" class="form-label fw-bold" style="color:#ff6f61;">Password</label>
                                    <input type="password" class="form-control" id="registerPassword" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerPasswordConfirm" class="form-label fw-bold" style="color:#ff6f61;">Confirm Password</label>
                                    <input type="password" class="form-control" id="registerPasswordConfirm" name="password_confirmation" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn px-5 py-2"
                                        style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection