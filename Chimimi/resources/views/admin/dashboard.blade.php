@extends('layout.mainlayout')

@section('title', 'Admin Dashboard')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column align-items-center">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;margin-bottom:3rem;">
                    Admin Dashboard
                </span>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <a href="{{ route('admin.products') }}" style="text-decoration:none;">
                    <div class="card text-center shadow-sm h-100" style="border-radius:18px;background:#fffbe6;border:2px solid #ff6f61;transition:box-shadow .2s;">
                        <div class="card-body py-5">
                            <h5 class="card-title" style="color:#ff6f61;font-weight:700;">Total Products</h5>
                            <p class="display-6 fw-bold" style="color:#f17807;">{{ $productsCount ?? 0 }}</p>
                            <p class="text-muted">Number of products available</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.orders') }}" style="text-decoration:none;">
                    <div class="card text-center shadow-sm h-100" style="border-radius:18px;background:#fffbe6;border:2px solid #ff6f61;transition:box-shadow .2s;">
                        <div class="card-body py-5">
                            <h5 class="card-title" style="color:#ff6f61;font-weight:700;">Total Orders</h5>
                            <p class="display-6 fw-bold" style="color:#f17807;">{{ $ordersCount ?? 0 }}</p>
                            <p class="text-muted">Number of orders placed</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.reviews') }}" style="text-decoration:none;">
                    <div class="card text-center shadow-sm h-100" style="border-radius:18px;background:#fffbe6;border:2px solid #ff6f61;transition:box-shadow .2s;">
                        <div class="card-body py-5">
                            <h5 class="card-title" style="color:#ff6f61;font-weight:700;">Total Reviews</h5>
                            <p class="display-6 fw-bold" style="color:#f17807;">{{ $reviewsCount ?? 0 }}</p>
                            <p class="text-muted">Number of customer reviews</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection