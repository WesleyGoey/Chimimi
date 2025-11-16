@extends('layout.mainlayout')

@section('title', 'Admin Reviews')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding:4rem 0; min-height:100vh;">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 d-flex flex-column align-items-center">
        <span class="fw-bold"
              style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
            Admin Reviews
        </span>
      </div>
    </div>

    @if ($reviews->isEmpty())
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card p-4 text-center" style="background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">
            No reviews found.
          </div>
        </div>
      </div>
    @else
      <div class="row">
        @foreach ($reviews as $review)
          <div class="col-12 mb-4">
            <div class="card p-3" style="border-radius:18px;background:#fffbe6;border:2px solid #ff6f61;">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <div class="fw-bold" style="color:#ff6f61;">
                    {{ $review->user->username ?? $review->user->email ?? 'Member' }}
                  </div>
                  <div class="text-muted small">Posted: {{ $review->created_at->format('Y-m-d H:i') }}</div>
                </div>
                <div class="text-end">
                  <div class="fw-bold" style="color:#f17807;font-size:1rem;">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= $review->rating)
                        <i class="bi bi-star-fill" style="color:#f17807;"></i>
                      @else
                        <i class="bi bi-star" style="color:#ffe066;"></i>
                      @endif
                    @endfor
                  </div>
                </div>
              </div>

              <hr>

              <div>
                <p class="mb-0" style="color:#333;">{{ $review->comment }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection