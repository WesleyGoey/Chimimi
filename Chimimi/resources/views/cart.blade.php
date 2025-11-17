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
                <div class="col-12 col-md-7 d-flex flex-column gap-4">
                    <div class="card shadow-lg p-3 p-md-4"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        @if (!$order || $order->products->isEmpty())
                            <div class="text-center text-muted py-3" style="font-size:1.1rem;">
                                No cart items found.
                            </div>
                        @else
                            <div class="mb-4 pt-4">
                                @foreach ($order->products as $product)
                                    <div class="d-flex align-items-center mb-4 p-3"
                                        style="background:#fff;border-radius:20px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:16px;border:3px solid #ffe066;box-shadow:0 2px 8px rgba(255,224,102,0.10);margin-right:22px;">
                                        <div class="flex-grow-1 ms-2">
                                            <div class="fw-bold d-flex align-items-center mb-2"
                                                style="font-size:1.25rem;color:#ff6f61;">
                                                {{ $product->name }}
                                                @if ($product->pivot->product_type == 'Frozen')
                                                    <span class="badge rounded-pill ms-3 px-4 py-2 fw-bold"
                                                        style="background:#ffe066;color:#212529;font-size:1.05rem;box-shadow:0 2px 8px rgba(255,224,102,0.10);">
                                                        Frozen
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill ms-3 px-4 py-2 fw-bold"
                                                        style="background:#ff6f61;color:#fff;font-size:1.05rem;box-shadow:0 2px 8px rgba(255,111,97,0.10);">
                                                        Cooked
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="mb-1" style="color:#f17807;font-size:1.1rem;">
                                                Price: <span class="fw-bold" style="color:#f17807;">
                                                    Rp.
                                                    {{ number_format(
                                                        $product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked,
                                                        0,
                                                        ',',
                                                        '.',
                                                    ) }}
                                                </span>
                                            </div>
                                            <div style="font-size:1.08rem;">
                                                Quantity: <span class="fw-bold"
                                                    style="color:#ff6f61;">{{ $product->pivot->quantity }}</span>
                                            </div>
                                        </div>

                                       {{-- Subtotal per product --}}
                                       <div class="text-end me-3" style="min-width:120px;">
                                           @php
                                               $unit = $product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked;
                                               $subtotal = $unit * $product->pivot->quantity;
                                           @endphp
                                           <div class="small text-muted">Subtotal</div>
                                           <div class="fw-bold" style="color:#ff6f61;">Rp. {{ number_format($subtotal, 0, ',', '.') }}</div>
                                       </div>

                                        <div class="ms-auto d-flex align-items-center gap-2">
                                            <a href="{{ route('cart.edit', [$product->id, $product->pivot->product_type]) }}"
                                                class="btn btn-outline-warning p-2 d-flex align-items-center justify-content-center"
                                                style="border-radius:50%;width:45px;height:45px;font-size:1.2rem;">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('cart.remove', [$product->id, $product->pivot->product_type]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger p-2 d-flex align-items-center justify-content-center"
                                                    style="border-radius:50%;width:45px;height:45px;font-size:1.2rem;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="fw-bold mt-4 text-end" style="color:#ff6f61;font-size:1.15rem;">
                                    Total: Rp. <span>
                                        {{ number_format(
                                            $order->products->sum(function ($product) {
                                                return ($product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked) *
                                                    $product->pivot->quantity;
                                            }),
                                            0,
                                            ',',
                                            '.',
                                        ) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <form method="POST" action="{{ route('order.checkout') }}" style="width:100%;max-width:680px;">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold" style="color:#f17807;">Notes (optional)</label>
                                            <textarea name="notes" class="form-control" rows="3"
                                                placeholder="Add order notes or special instructions..."
                                                style="border-radius:12px;border:2px solid #ffe066;background:#fff;padding:0.8rem;resize:vertical;"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-center mt-2">
                                            <button type="submit" class="btn btn-lg px-5 py-2 fw-bold"
                                                style="background:#ff6f61;color:#fff;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.15rem;">
                                                <i class="bi bi-bag-fill" style="font-size:1.3rem; margin-right:0.5rem;"></i>
                                                Order Now
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-5">
                        <a href="{{ route('order.history') }}" class="btn fw-bold px-4 py-2"
                            style="background:#fffbe6;color:#ff6f61;border-radius:28px;box-shadow:0 2px 8px rgba(255,111,97,0.10);font-size:1.1rem;border:2px solid #ff6f61;">
                            <i class="bi bi-clock-history me-2"></i>
                            View Order History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
