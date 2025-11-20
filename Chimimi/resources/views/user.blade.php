@extends('layout.mainlayout')

@section('title', 'Chimimi - Profile')

@section('content')
    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
        <div class="container">
            <div class="d-flex justify-content-center mb-5">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.7em 2.2em;border-radius:36px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:2rem;letter-spacing:1px;">
                    My Profile
                </span>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card shadow-lg p-4"
                        style="background:#fffbe6;border-radius:32px; border: 2.5px solid #ff6f61;">
                        <div class="d-flex flex-column align-items-center mb-3">
                            <span
                                style="background:#fff;border-radius:50%;width:100px;height:100px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 16px rgba(255,111,97,0.12);margin-bottom:1rem;">
                                <i class="bi bi-person-circle" style="color:#ff6f61;font-size:3.5rem;"></i>
                            </span>
                            <h2 class="fw-bold mb-0" style="color:#ff6f61;font-size:1.6rem;">{{ $user->username }}</h2>
                        </div>
                        <div class="mb-3 px-3 py-3"
                            style="background:#fff;border-radius:18px;box-shadow:0 2px 8px rgba(255,111,97,0.07);">
                            <div class="row mb-2 align-items-center">
                                <div class="col-4 text-end fw-bold" style="color:#f17807;">Email</div>
                                <div class="col-8" style="color:#ff6f61;word-break:break-all;">{{ $user->email }}</div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-4 text-end fw-bold" style="color:#f17807;">Phone</div>
                                <div class="col-8" style="color:#ff6f61;">{{ $user->phone }}</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2 mt-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning px-4 py-2 w-100"
                                style="font-weight:600;border-radius:28px;box-shadow:0 2px 8px rgba(255,111,97,0.10);">
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary px-4 py-2 w-100"
                                    style="font-weight:600;border-radius:28px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                                    Log Out
                                </button>
                            </form>
                        </div>
                        <div class="mt-3">
                            <form method="POST" action="{{ route('profile.destroy') }}"
                                onsubmit="return confirm('Are you sure you want to delete your account?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger px-4 py-2 w-100"
                                    style="font-weight:600;border-radius:28px;box-shadow:0 2px 8px rgba(255,111,97,0.10);border-width:2px;">
                                    Delete My Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
