@extends('layout.mainlayout')

@section('title', 'Change Password')

@section('content')
    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); min-height:100vh; padding: 4rem 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-lg p-4"
                        style="border-radius:32px; background:#fffbe6; border:2.5px solid #ff6f61;">
                        <h2 class="fw-bold mb-4 text-center" style="color:#ff6f61; font-size:1.6rem;">Change Password</h2>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
