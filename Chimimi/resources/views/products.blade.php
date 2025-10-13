@extends('layout.mainlayout')

@section('title', 'Chimimi - Products')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">

    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
        <div class="container">
            <div class="d-flex flex-column align-items-center mb-4">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">Our
                    Menu</span>
                <span class="badge text-white mt-3" style="font-size:1.05rem;border-radius:16px;background:#f17807;min-width:120px;">1 pax / 5pcs</span>
            </div>
            <div class="row justify-content-center">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0"
                            style="background:#fffbe6;border-radius:18px;transition:transform .2s;">
                            <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="height:220px; object-fit:cover; border-radius:18px 18px 0 0;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title mb-2" style="color:#ff6f61;font-weight:600;">{{ $product->name }}</h5>
                                <div class="mb-2" style="color:#f17807;font-size:1rem;font-weight:500;">
                                    {{ $product->category }}</div>
                                <div class="mb-2" style="color:#ff6f61;font-size:0.95rem;">{{ $product->ingredients }}
                                </div>
                                <div class="mt-auto mb-3">
                                    <span class="badge bg-warning text-dark me-2"
                                        style="font-size:1rem;border-radius:16px;">Frozen:
                                        {{ $product->price_frozen / 1000 }}K / pax</span>
                                    <span class="badge bg-danger" style="font-size:1rem;border-radius:16px;">Cooked:
                                        {{ $product->price_cooked / 1000 }}K / pax</span>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-lg px-4 py-2 w-50"
                                        style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);transition:background .2s;">
                                        <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
