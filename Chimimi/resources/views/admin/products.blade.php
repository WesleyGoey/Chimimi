@extends('layout.mainlayout')

@section('title', 'Admin Chimimi - Products')

@section('content')
    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 d-flex flex-column align-items-center">
                    <span class="fw-bold"
                        style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
                        Admin Products
                    </span>
                    <span class="badge text-white mt-3" style="font-size:1.05rem;border-radius:16px;background:#f17807;min-width:120px;">1 pax / 5pcs</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-center">
                    <form method="GET" action="{{ route('admin.products') }}" class="d-flex align-items-center"
                        style="gap:0.75rem;width:100%;max-width:920px;">
                        <div style="flex:1;min-width:260px;">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search products by name, category, or ingredients..."
                                style="border-radius:20px;border:2px solid #ffe066;padding:0.6rem 0.9rem;box-shadow:0 4px 18px rgba(0,0,0,0.03);">
                        </div>
                        <button type="submit" class="btn"
                            style="background:#ffd400;color:#212529;border-radius:18px;font-weight:700;padding:.5rem 1rem;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-warning fw-bold px-4 py-2"
                        style="border-radius:18px;box-shadow:0 2px 8px rgba(255,111,97,0.12);">
                        + Add Product
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                @if ($products->isEmpty())
                    <div class="row justify-content-center align-items-center" style="min-height:40vh;">
                        <div class="col-12 d-flex justify-content-center">
                            <div
                                style="
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
                            <div class="card h-100 shadow-sm border-0" style="background:#fffbe6;border-radius:18px;">
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top"
                                    alt="{{ $product->name }}"
                                    style="height:180px; object-fit:cover; border-radius:18px 18px 0 0;">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title mb-2" style="color:#ff6f61;font-weight:600;">{{ $product->name }}
                                    </h5>
                                    <div class="mb-2" style="color:#f17807;font-size:1rem;font-weight:500;">
                                        {{ $product->category }}
                                    </div>
                                    <div class="mb-2" style="color:#ff6f61;font-size:0.95rem;">{{ $product->ingredients }}
                                    </div>
                                    <div class="mt-auto mb-3">
                                        <span class="badge bg-warning text-dark me-2"
                                            style="font-size:1rem;border-radius:16px;">Frozen:
                                            {{ $product->price_frozen / 1000 }}K / pax</span>
                                        <span class="badge bg-danger" style="font-size:1rem;border-radius:16px;">Cooked:
                                            {{ $product->price_cooked / 1000 }}K / pax</span>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn fw-bold px-4 py-2"
                                            style="border-radius:18px;background:#fff;color:#ff6f61;border:2px solid #ff6f61;">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn fw-bold px-4 py-2"
                                                style="border-radius:18px;background:#fff;color:#ff6f61;border:2px solid #ff6f61;">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($products->lastPage() > 1)
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination"
                            style="--bs-pagination-bg:#fffbe6;--bs-pagination-border-color:#ff6f61;gap:0.7rem;">
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"
                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev"
                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</a>
                                </li>
                            @endif

                            @foreach ($products->links()->elements[0] as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link"
                                            style="color:#fff;background:#ff6f61;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}"
                                            style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next"
                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"
                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>
@endsection
