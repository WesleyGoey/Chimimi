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
                    {{-- Cart Box --}}
                    <div class="card shadow-lg p-3 p-md-4"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        @if ($order && $order->products->isNotEmpty())
                            <div class="mb-4 pt-4">
                                @foreach ($order->products as $product)
                                    <div class="d-flex flex-wrap align-items-center mb-3 p-2 p-md-3"
                                        style="background:#fff;border-radius:18px;box-shadow:0 2px 8px rgba(255,111,97,0.07);">
                                        <img src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:18px;border:3px solid #ffe066;box-shadow:0 4px 16px rgba(255,111,97,0.10);margin-right:24px;">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold mb-2" style="color:#ff6f61;font-size:1.1rem;">
                                                {{ $product->name }}
                                            </div>
                                            <div class="mb-2 d-flex gap-2">
                                                <input type="radio" class="btn-check" name="type-{{ $product->id }}"
                                                    id="cart-frozen-{{ $product->id }}" value="Frozen" autocomplete="off"
                                                    {{ $product->pivot->product_type == 'Frozen' ? 'checked' : '' }}
                                                    onclick="updateCartPriceAndTotal({{ $product->id }}, {{ $product->price_frozen }}, {{ $product->price_cooked }})">
                                                <label class="btn btn-outline-warning fw-bold px-2 py-1"
                                                    for="cart-frozen-{{ $product->id }}"
                                                    style="border-radius:14px;font-size:0.95rem;">Frozen</label>
                                                <input type="radio" class="btn-check" name="type-{{ $product->id }}"
                                                    id="cart-cooked-{{ $product->id }}" value="Cooked" autocomplete="off"
                                                    {{ $product->pivot->product_type == 'Cooked' ? 'checked' : '' }}
                                                    onclick="updateCartPriceAndTotal({{ $product->id }}, {{ $product->price_frozen }}, {{ $product->price_cooked }})">
                                                <label class="btn btn-outline-danger fw-bold px-2 py-1"
                                                    for="cart-cooked-{{ $product->id }}"
                                                    style="border-radius:14px;font-size:0.95rem;">Cooked</label>
                                            </div>
                                            <div class="fw-bold mt-1 mb-2" style="color:#f17807;">
                                                Price: Rp. <span id="cart-price-{{ $product->id }}">
                                                    {{ number_format(
                                                        $product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked,
                                                        0, ',', '.'
                                                    ) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end ms-auto">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <button type="button" class="btn btn-light p-2 d-flex align-items-center justify-content-center"
                                                    style="border-radius:50%;width:36px;height:36px;"
                                                    onclick="changeQty({{ $product->id }}, -1, {{ $product->price_frozen }}, {{ $product->price_cooked }})">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <span class="fw-bold"
                                                    style="color:#f17807;min-width:28px;text-align:center;"
                                                    id="qty-{{ $product->id }}">{{ $product->pivot->quantity ?? 1 }}</span>
                                                <button type="button" class="btn btn-light p-2 d-flex align-items-center justify-content-center"
                                                    style="border-radius:50%;width:36px;height:36px;"
                                                    onclick="changeQty({{ $product->id }}, 1, {{ $product->price_frozen }}, {{ $product->price_cooked }})">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                                <form method="POST" action="{{ route('cart.remove', $product->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger p-2 d-flex align-items-center justify-content-center"
                                                        style="border-radius:50%;width:36px;height:36px;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="fw-bold mt-4 text-end" style="color:#ff6f61;font-size:1.15rem;">
                                    Total: Rp. <span id="cart-total">
                                        {{ number_format($order->products->sum(function($product) {
                                            return ($product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked) * $product->pivot->quantity;
                                        }), 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <form method="POST" action="{{ route('order.checkout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-lg px-5 py-2 fw-bold"
                                            style="background:#ff6f61;color:#fff;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.15rem;">
                                            Order Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="text-center text-muted py-5" style="font-size:1.3rem;">
                                No cart items found.
                            </div>
                        @endif
                    </div>

                    {{-- Order History Box --}}
                    <div class="card shadow-lg p-3 p-md-4"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        <h4 class="fw-bold mb-3" style="color:#ff6f61;">Order History</h4>
                        @if($orderHistory->isEmpty())
                            <div class="text-center text-muted py-3" style="font-size:1.1rem;">
                                No history found.
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach($orderHistory as $history)
                                    <div class="col-12">
                                        <div class="card p-3" style="border-radius:18px;background:#fff;border:2px solid #ff6f61;">
                                            <div class="mb-2">
                                                <strong>Status:</strong>
                                                <span class="{{ $history->isPaid ? 'text-success' : 'text-danger' }}">
                                                    {{ $history->isPaid ? 'Paid' : 'Unpaid' }}
                                                </span>
                                            </div>
                                            <div class="mb-2"><strong>Total:</strong> Rp. {{ number_format($history->amount, 0, ',', '.') }}</div>
                                            <div class="mb-2"><strong>Products:</strong></div>
                                            <ul>
                                                @foreach($history->products as $item)
                                                    <li>
                                                        {{ $item->name }} ({{ $item->pivot->product_type }}) &times; {{ $item->pivot->quantity }} — Rp. {{ number_format($item->pivot->price_at_order, 0, ',', '.') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="small text-muted mt-2">Order Date: {{ $history->created_at->format('Y-m-d H:i') }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function changeQty(productId, delta, priceFrozen, priceCooked) {
            let qtySpan = document.getElementById('qty-' + productId);
            let qty = parseInt(qtySpan.innerText) + delta;
            if (qty < 1) qty = 1;
            qtySpan.innerText = qty;

            // Update price per product
            let type = document.querySelector('input[name="type-' + productId + '"]:checked').value;
            let price = type === 'Frozen' ? priceFrozen : priceCooked;
            document.getElementById('cart-price-' + productId).innerText = price.toLocaleString('id-ID');

            // Update total
            let total = 0;
            @if ($order)
                @foreach ($order->products as $product)
                    let t = document.querySelector('input[name="type-{{ $product->id }}"]:checked').value;
                    let q = parseInt(document.getElementById('qty-{{ $product->id }}').innerText);
                    let p = t === 'Frozen' ? {{ $product->price_frozen }} : {{ $product->price_cooked }};
                    total += p * q;
                @endforeach
            @endif
            document.getElementById('cart-total').innerText = total.toLocaleString('id-ID');
        }

        function updateCartPriceAndTotal(productId, priceFrozen, priceCooked) {
            let qty = parseInt(document.getElementById('qty-' + productId).innerText);
            let type = document.querySelector('input[name="type-' + productId + '"]:checked').value;
            let price = type === 'Frozen' ? priceFrozen : priceCooked;
            document.getElementById('cart-price-' + productId).innerText = price.toLocaleString('id-ID');

            // Update total
            let total = 0;
            @if ($order)
                @foreach ($order->products as $product)
                    let t = document.querySelector('input[name="type-{{ $product->id }}"]:checked').value;
                    let q = parseInt(document.getElementById('qty-{{ $product->id }}').innerText);
                    let p = t === 'Frozen' ? {{ $product->price_frozen }} : {{ $product->price_cooked }};
                    total += p * q;
                @endforeach
            @endif
            document.getElementById('cart-total').innerText = total.toLocaleString('id-ID');
        }
    </script>
@endsection
