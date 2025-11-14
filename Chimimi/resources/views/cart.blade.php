@extends('layout.mainlayout')

@section('title', 'Chimimi - Cart')

@section('content')
    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
        <div class="container">
            <div class="d-flex justify-content-center mb-5">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
                    My Cart
                </span>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-7">
                    <div class="card shadow-lg p-3 p-md-4"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        @if ($order)
                            <div class="mb-4 pt-4">
                                @if (isset($order->products) && count($order->products))
                                    @foreach ($order->products as $product)
                                        <div class="d-flex flex-wrap align-items-center mb-3 p-2 p-md-3"
                                            style="background:#fff;border-radius:18px;box-shadow:0 2px 8px rgba(255,111,97,0.07);">
                                            <img src="{{ $product->image_path ?? 'https://via.placeholder.com/80x80?text=Product' }}"
                                                alt="{{ $product->name }}"
                                                style="width:70px;height:70px;object-fit:cover;border-radius:16px;border:2px solid #ffe066;">
                                            <div class="ms-2 ms-md-3 flex-grow-1" style="min-width:120px;">
                                                <div class="fw-bold" style="color:#ff6f61;font-size:1.1rem;">
                                                    {{ $product->name }}</div>
                                                <div class="text-muted" style="font-size:0.92rem;">
                                                    {{ $product->pivot->product_type }} - Rp.
                                                    {{ number_format($product->pivot->price_at_order, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                                                <span
                                                    class="btn btn-light p-2 d-flex align-items-center justify-content-center"
                                                    style="border-radius:50%;width:36px;height:36px;"><i
                                                        class="bi bi-dash"></i></span>
                                                <span class="fw-bold"
                                                    style="color:#f17807;min-width:28px;text-align:center;">{{ $product->pivot->quantity ?? 1 }}</span>
                                                <span
                                                    class="btn btn-light p-2 d-flex align-items-center justify-content-center"
                                                    style="border-radius:50%;width:36px;height:36px;"><i
                                                        class="bi bi-plus"></i></span>
                                            </div>
                                            <span
                                                class="btn btn-outline-danger ms-2 ms-md-3 p-2 d-flex align-items-center justify-content-center"
                                                style="border-radius:50%;width:36px;height:36px;"><i
                                                    class="bi bi-trash"></i></span>
                                        </div>
                                    @endforeach
                                    <div class="fw-bold mt-4 text-end" style="color:#ff6f61;font-size:1.15rem;">Total: Rp.
                                        {{ number_format($order->amount, 0, ',', '.') }}</div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button type="button" class="btn btn-lg px-5 py-2"
                                            style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.1rem;">
                                            <i class="bi bi-bag-check me-2"></i> Order Now
                                        </button>
                                    </div>
                                @else
                                    <div class="text-center text-muted">No product data available.</div>
                                @endif
                            </div>
                        @else
                            <div class="text-center text-muted">No order data available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
