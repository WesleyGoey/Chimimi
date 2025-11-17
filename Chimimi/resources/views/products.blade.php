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
                @if ($products->count() > 0)
                    <span class="badge text-white mt-3" style="font-size:1.05rem;border-radius:16px;background:#f17807;min-width:120px;">1 pax / 5pcs</span>
                @endif
            </div>
            <div class="row justify-content-center">
                @if ($products->count() === 0)
                    <div class="row justify-content-center align-items-center" style="min-height:40vh;">
                        <div class="col-12 d-flex justify-content-center">
                            <div style="
                                background:#fffbe6;
                                border-radius:18px;
                                color:#ff6f61;
                                font-size:2rem;
                                font-weight:700;
                                padding:2rem 0;
                                width:100%;
                                max-width:700px;
                                text-align:center;
                                box-shadow:0 2px 12px rgba(255,111,97,0.10);
                            ">
                                No products available
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0"
                                style="background:#fffbe6;border-radius:18px;transition:transform .2s;">
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}"
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
                                    <div class="d-flex justify-content-center w-100">
                                        @auth
                                            <form method="POST" action="{{ route('cart.add') }}" class="w-100 d-flex justify-content-center">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="product_type" value="Frozen">
                                                <button type="submit" class="btn btn-lg px-4 py-2 w-75"
                                                    style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);transition:background .2s;">
                                                    <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-lg px-4 py-2 w-75 d-flex justify-content-center align-items-center"
                                                style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);transition:background .2s;">
                                                <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Pagination --}}
            @if ($products->lastPage() > 1)
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination" style="--bs-pagination-bg:#fffbe6;--bs-pagination-border-color:#ff6f61;gap:0.7rem;">
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</a>
                                </li>
                            @endif

                            @foreach ($products->links()->elements[0] as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link" style="color:#fff;background:#ff6f61;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>
@endsection
