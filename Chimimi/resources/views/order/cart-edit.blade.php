@extends('layout.mainlayout')

@section('title', 'Edit Cart Item')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); min-height:100vh; padding: 4rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-lg p-4" style="background:#fffbe6;border-radius:24px; border:2.5px solid #ff6f61;">
                    <h2 class="fw-bold mb-4 text-center" style="color:#ff6f61;">Edit Cart Item</h2>
                    <form method="POST" action="{{ route('cart.update', [$product->id, $productType]) }}">
                        @csrf
                        <div class="mb-4">
                            <div class="fw-bold mb-2" style="color:#ff6f61;font-size:1.1rem;">
                                {{ $product->name }}
                            </div>
                            <div class="mb-1" style="color:#f17807;font-size:1.05rem;font-weight:500;">
                                Category: {{ $product->category }}
                            </div>
                            <div class="text-muted" style="font-size:1rem;">Ingredients: {{ $product->ingredients }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3" style="color:#f17807;font-size:1.3rem;">Type</label>
                            <div class="d-flex gap-4 justify-content-center">
                                <div class="form-check">
                                    <input class="btn-check" type="radio" name="product_type" id="type-frozen" value="Frozen" {{ $productType == 'Frozen' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning fw-bold px-4 py-2" for="type-frozen" style="border-radius:28px;border-width:2.5px;white-space:nowrap;">
                                        Frozen - Rp. {{ number_format($product->price_frozen, 0, ',', '.') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="btn-check" type="radio" name="product_type" id="type-cooked" value="Cooked" {{ $productType == 'Cooked' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger fw-bold px-4 py-2" for="type-cooked" style="border-radius:28px;border-width:2.5px;white-space:nowrap;">
                                        Cooked - Rp. {{ number_format($product->price_cooked, 0, ',', '.') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2" style="color:#f17807;font-size:1.1rem;">Quantity</label>
                            <input type="number" name="quantity" class="form-control form-control-lg" min="1" value="{{ $quantity }}"
                                style="border-radius:12px;width:150px;border-width:2px;border-color:#ffe066;">
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-lg fw-bold px-5 py-3"
                                style="border-radius:32px;font-size:1.15rem;background:#ff6f61;color:#fff;">
                                <i class="bi bi-pencil me-2" style="font-size:1.3rem;"></i>
                                Update Cart Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection