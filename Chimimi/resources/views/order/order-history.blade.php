@extends('layout.mainlayout')

@section('title', 'Order History')

@section('content')
    <section style="background: linear-gradient(135deg,#ffe066 0%,#ff6f61 100%); padding:4rem 0; min-height:100vh;">
        <div class="container">
            <div class="d-flex flex-column align-items-center mb-4">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;margin-bottom:2.5rem;">
                    Order History
                </span>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    <div class="card p-3" style="background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">
                        @if ($orderHistory->isEmpty())
                            <div class="text-center text-muted py-4" style="font-size:1.05rem;">No history found.</div>
                        @else
                            <div class="d-flex flex-column gap-3">
                                @foreach ($orderHistory as $history)
                                    @php
                                        $grouped = $history->products->groupBy(function ($p) {
                                            return $p->pivot->product_type;
                                        });
                                        $orderTotal = $history->products->sum(
                                            fn($p) => ($p->pivot->price_at_order ?? 0) * ($p->pivot->quantity ?? 0),
                                        );
                                    @endphp

                                    <div class="card shadow-sm p-3"
                                        style="border-radius:12px;border:1px solid rgba(255,111,97,0.08);background:#fff;">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <div class="fw-bold" style="color:#ff6f61;font-size:1.05rem;">Order
                                                    #{{ $history->id }}</div>
                                                <div class="small text-muted">
                                                    {{ $history->created_at->format('d M Y H:i') }}</div>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge rounded-pill px-3 py-2 fw-bold"
                                                    style="{{ $history->isPaid ? 'background:#28a745;color:#fff;' : 'background:#ffe066;color:#212529;' }}font-size:0.9rem;">
                                                    {{ $history->isPaid ? 'Paid' : 'Unpaid' }}
                                                </span>
                                            </div>
                                        </div>

                                        <hr style="margin:8px 0;border-top:1px dashed rgba(0,0,0,0.06)">

                                        {{-- Products (flat list; no categories, no "1 item(s)", no "Subtotal" label) --}}
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($history->products as $item)
                                                <li class="d-flex justify-content-between align-items-center py-2"
                                                    style="border-bottom:1px dashed rgba(0,0,0,0.04);">
                                                    <div style="min-width:0;">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="fw-bold text-truncate" style="color:#ff6f61;">
                                                                {{ $item->name }}</div>
                                                            <span class="badge rounded-pill px-2 py-1"
                                                                style="{{ $item->pivot->product_type == 'Frozen' ? 'background:#ffe066;color:#212529;' : 'background:#ff6f61;color:#fff;' }} font-size:0.82rem;">
                                                                {{ $item->pivot->product_type }}
                                                            </span>
                                                        </div>
                                                        <div class="small text-muted mt-1">
                                                            Unit: Rp. <span
                                                                class="fw-bold">{{ number_format($item->pivot->price_at_order, 0, ',', '.') }}</span>
                                                            &nbsp;·&nbsp;
                                                            Qty: <span class="fw-bold"
                                                                style="color:#ff6f61;">{{ $item->pivot->quantity }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="fw-bold">Rp.
                                                        {{ number_format($item->pivot->price_at_order * $item->pivot->quantity, 0, ',', '.') }}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div class="small text-muted">Order Total</div>
                                            <div class="fw-bold" style="color:#ff6f61;font-size:1.03rem;">Rp.
                                                {{ number_format($orderTotal, 0, ',', '.') }}</div>
                                        </div>

                                        @if (!empty($history->notes))
                                            <hr style="margin:10px 0;border-top:1px dashed rgba(0,0,0,0.06)">
                                            <div class="small text-muted"><strong>Notes</strong></div>
                                            <div class="mt-1" style="white-space:pre-wrap;color:#333;">
                                                {{ $history->notes }}</div>
                                        @endif

                                    </div>
                                @endforeach
                            </div>

                            @if ($orderHistory->lastPage() > 1)
                                <div class="d-flex justify-content-center mt-4">
                                    <nav>
                                        <ul class="pagination"
                                            style="--bs-pagination-bg:#fffbe6;--bs-pagination-border-color:#ff6f61;gap:0.7rem;">
                                            @if ($orderHistory->onFirstPage())
                                                <li class="page-item disabled">
                                                    <span class="page-link"
                                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $orderHistory->previousPageUrl() }}"
                                                        rel="prev"
                                                        style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</a>
                                                </li>
                                            @endif

                                            @foreach ($orderHistory->links()->elements[0] as $page => $url)
                                                @if ($page == $orderHistory->currentPage())
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

                                            @if ($orderHistory->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $orderHistory->nextPageUrl() }}"
                                                        rel="next"
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
