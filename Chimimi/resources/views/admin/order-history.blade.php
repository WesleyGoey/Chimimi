{{-- filepath: Chimimi/resources/views/admin/order-history.blade.php --}}
@extends('layout.mainlayout')

@section('title', 'Paid Order History (Admin)')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column align-items-center">
                <span class="fw-bold"
                      style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
                    Paid Order History
                </span>
                <div class="text-muted mt-2" style="font-size:1.05rem;">
                    Showing only orders that are <span class="fw-bold" style="color:#28a745;">Paid</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
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
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <div class="fw-bold" style="color:#ff6f61;">Order #{{ $history->id }}</div>
                                                <div class="small text-muted">
                                                    {{ $history->created_at->format('d M Y H:i') }}
                                                    · by {{ $history->user->username ?? $history->user->email ?? '-' }}
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge rounded-pill px-3 py-2 fw-bold"
                                                      style="background:#28a745;color:#fff;font-size:0.95rem;">
                                                    Paid
                                                </span>
                                            </div>
                                        </div>

                                        <hr style="margin:0 0 12px 0;border-top:1px dashed rgba(0,0,0,0.06)">

                                        <div class="mb-2"><strong>Products</strong></div>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($history->products as $item)
                                                <li class="d-flex justify-content-between align-items-center py-2"
                                                    style="border-bottom:1px dashed rgba(0,0,0,0.04);">
                                                    <div>
                                                        <div class="fw-bold" style="color:#ff6f61;">{{ $item->name }}</div>
                                                        <div class="small text-muted">
                                                            <span class="me-2">{{ $item->pivot->product_type }}</span>
                                                            · Qty: <span class="fw-bold" style="color:#ff6f61;">{{ $item->pivot->quantity }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="small text-muted">Unit</div>
                                                        <div class="fw-bold">Rp. {{ number_format($item->pivot->price_at_order, 0, ',', '.') }}</div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div class="small text-muted">Order Total</div>
                                            <div class="fw-bold" style="color:#ff6f61;">
                                                Rp. {{ number_format($history->products->sum(function($p) {
                                                    return $p->pivot->price_at_order * $p->pivot->quantity;
                                                }), 0, ',', '.') }}
                                            </div>
                                        </div>

                                        @if ($history->notes)
                                            <hr style="margin:12px 0 0 0;border-top:1px dashed rgba(0,0,0,0.06)">
                                            <div class="mt-2 small text-muted"><strong>Notes:</strong> {{ $history->notes }}</div>
                                        @endif
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