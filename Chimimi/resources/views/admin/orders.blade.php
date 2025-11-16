@extends('layout.mainlayout')

@section('title', 'Admin Orders')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding:4rem 0; min-height:100vh;">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column align-items-center w-100">
                    <span class="fw-bold"
                        style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
                        Admin Orders
                    </span>
                </div>
      </div>
    </div>

    @if ($orders->isEmpty())
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card p-4 text-center" style="background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">
            No orders found.
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
                <div class="text-end">
                  <div class="fw-bold" style="color:#f17807;font-size:1.1rem;">Rp. {{ number_format($order->amount,0,',','.') }}</div>
                  <div class="small text-{{ $order->isPaid ? 'success' : 'danger' }}">{{ $order->isPaid ? 'Paid' : 'Unpaid' }}</div>
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