@extends('layout.mainlayout')

@section('title', 'Admin Orders')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding:4rem 0; min-height:100vh;">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 d-flex flex-column align-items-center">
        <span class="fw-bold"
            style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
            Pending Orders
        </span>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-end">
        <a href="{{ route('admin.orderHistory') }}" class="btn btn-warning fw-bold px-4 py-2"
           style="border-radius:18px;box-shadow:0 2px 8px rgba(255,111,97,0.10);font-size:1.1rem;">
           <i class="bi bi-clock-history me-2"></i> View Order History
        </a>
      </div>
    </div>

    @if ($orders->isEmpty())
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
                            No pending orders available
                        </div>
                    </div>
                </div>
            @else
      <div class="row">
        @foreach ($orders as $order)
          <div class="col-12 mb-4">
            <div class="card p-3" style="border-radius:18px;background:#fffbe6;border:2px solid #ff6f61;">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <div class="fw-bold" style="color:#ff6f61;">Order #{{ $order->id }}</div>
                  <div class="text-muted">By: {{ $order->user->username ?? $order->user->email ?? '—' }}</div>
                  <div class="text-muted">Placed: {{ $order->created_at->format('Y-m-d H:i') }}</div>
                </div>
                <div class="text-end d-flex flex-column align-items-end" style="gap:0.5rem;">
                  {{-- Jika belum paid, tampilkan tombol mark paid --}}
                  @if (!$order->isPaid)
                    <form method="POST" action="{{ route('admin.orders.pay', $order->id) }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-success fw-bold px-3 py-2" style="border-radius:12px;">
                        <i class="bi bi-cash-stack me-1"></i> Mark Paid
                      </button>
                    </form>
                  @else
                    <span class="badge rounded-pill px-3 py-2 fw-bold" style="background:#28a745;color:#fff;">Paid</span>
                  @endif
                </div>
              </div>

              <hr>

              <div>
                <h6 class="mb-2 fw-bold" style="color:#ff6f61;">Items</h6>
                @if ($order->products->isEmpty())
                  <div class="text-muted">No items</div>
                @else
                  <ul class="list-unstyled mb-0">
                    @foreach ($order->products as $product)
                      <li class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px dashed rgba(0,0,0,0.04);">
                        <div>
                          <div class="fw-bold">{{ $product->name }}</div>
                          <div class="text-muted small">{{ $product->pivot->product_type }} — Qty: {{ $product->pivot->quantity }}</div>
                        </div>
                        <div class="fw-bold">Rp. {{ number_format($product->pivot->price_at_order,0,',','.') }}</div>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>

              {{-- Total per order (moved below products) --}}
              <div class="mt-3 mb-2 d-flex justify-content-between align-items-center">
                <div class="small text-muted">Order Total</div>
                <div class="fw-bold" style="color:#ff6f61;">
                  Rp. {{ number_format($order->products->sum(function($p) { return $p->pivot->price_at_order * $p->pivot->quantity; }), 0, ',', '.') }}
                </div>
              </div>

              @if ($order->notes)
                <hr>
                <div><strong>Notes:</strong> {{ $order->notes }}</div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection