{{-- filepath: Chimimi/resources/views/order-history.blade.php --}}
@extends('layout.mainlayout')

@section('title', 'Order History')

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
                    @if ($orderHistory->isEmpty())
                        <div class="text-center text-muted py-3" style="font-size:1.1rem;">
                            No history found.
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach ($orderHistory as $history)
                                <div class="col-12">
                                    <div class="card p-3"
                                        style="border-radius:18px;background:#fff;border:2px solid #ff6f61;">
                                        <div class="mb-2">
                                            <strong>Status:</strong>
                                            <span class="{{ $history->isPaid ? 'text-success' : 'text-danger' }}">
                                                {{ $history->isPaid ? 'Paid' : 'Unpaid' }}
                                            </span>
                                        </div>
                                        <div class="mb-2"><strong>Total:</strong> Rp.
                                            {{ number_format($history->amount, 0, ',', '.') }}</div>
                                        <div class="mb-2"><strong>Products:</strong></div>
                                        <ul>
                                            @foreach ($history->products as $item)
                                                <li>
                                                    {{ $item->name }} ({{ $item->pivot->product_type }}) &times;
                                                    {{ $item->pivot->quantity }} — Rp.
                                                    {{ number_format($item->pivot->price_at_order, 0, ',', '.') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="small text-muted mt-2">Order Date:
                                            {{ $history->created_at->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($orderHistory->lastPage() > 1)
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orderHistory->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection