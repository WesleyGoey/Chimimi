{{-- filepath: Chimimi/resources/views/admin/order-history.blade.php --}}
@extends('layout.mainlayout')

@section('title', 'Order History (Admin)')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column align-items-center">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
                    Order History
                </span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                <div class="card shadow-lg p-3 p-md-4"
                    style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                    @if ($orders->isEmpty())
                        <div class="text-center text-muted py-3" style="font-size:1.1rem;">
                            No history found.
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach ($orders as $history)
                                <div class="col-12">
                                    <div class="card p-3"
                                        style="border-radius:18px;background:#fff;border:2px solid #ff6f61;">
                                        <div class="mb-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="fw-bold" style="color:#ff6f61;">Order #{{ $history->id }}</span>
                                                <span class="ms-2 small text-muted">{{ $history->created_at->format('d M Y H:i') }}</span>
                                                <span class="ms-2 small text-muted">by {{ $history->user->username ?? $history->user->email ?? '-' }}</span>
                                            </div>
                                            <span class="badge rounded-pill px-3 py-2 fw-bold"
                                                style="{{ $history->isPaid ? 'background:#28a745;color:#fff;' : 'background:#ffe066;color:#212529;' }}font-size:1rem;">
                                                {{ $history->isPaid ? 'Paid' : 'Unpaid' }}
                                            </span>
                                        </div>

                                        <div class="mb-2"><strong>Products:</strong></div>
                                        <ul class="mb-2 ps-1">
                                            @foreach ($history->products as $item)
                                                <li class="mb-2 d-flex align-items-center">
                                                    <span class="fw-bold" style="color:#ff6f61;">{{ $item->name }}</span>
                                                    <span class="badge rounded-pill ms-2 px-3 py-1 fw-bold"
                                                        style="background:{{ $item->pivot->product_type == 'Frozen' ? '#ffe066' : '#ff6f61' }};
                                                               color:{{ $item->pivot->product_type == 'Frozen' ? '#212529' : '#fff' }};
                                                               font-size:0.95rem;">
                                                        {{ $item->pivot->product_type }}
                                                    </span>
                                                    <span class="ms-3" style="color:#f17807;font-weight:500;">
                                                        Qty: <span class="fw-bold" style="color:#ff6f61;">{{ $item->pivot->quantity }}</span>
                                                    </span>
                                                    <span class="ms-3" style="color:#606060;">
                                                        Rp. {{ number_format($item->pivot->price_at_order, 0, ',', '.') }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>

                                        {{-- total below products (same layout as member history) --}}
                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div class="small text-muted">Order Total</div>
                                            <div class="fw-bold" style="color:#ff6f61;">
                                                Rp. {{ number_format($history->products->sum(function($p) { return $p->pivot->price_at_order * $p->pivot->quantity; }), 0, ',', '.') }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($orders->lastPage() > 1)
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection