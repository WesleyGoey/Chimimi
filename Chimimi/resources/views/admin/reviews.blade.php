@extends('layout.mainlayout')

@section('title', 'Admin Reviews')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding:4rem 0; min-height:100vh;">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 d-flex flex-column align-items-center">
        <span class="fw-bold"
              style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.7rem;letter-spacing:1px;">
            Customer Reviews
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
                  <div class="text-muted small">Posted: {{ $review->created_at->format('d M Y H:i') }}</div>
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
              <div class="d-flex justify-content-end mt-3">
                <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm fw-bold"
                    style="border-radius:14px;background:#ff6f61;color:#fff;border:2px solid #ff6f61;font-size:1rem;padding:0.5rem 1.2rem;">
                    <i class="bi bi-trash me-1"></i> Delete
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if ($reviews->lastPage() > 1)
        <div class="d-flex justify-content-center mt-4">
          <nav>
            <ul class="pagination" style="--bs-pagination-bg:#fffbe6;--bs-pagination-border-color:#ff6f61;gap:0.7rem;">
              @if ($reviews->onFirstPage())
                <li class="page-item disabled">
                  <span class="page-link" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link" href="{{ $reviews->previousPageUrl() }}" rel="prev" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&laquo;</a>
                </li>
              @endif

              @foreach ($reviews->links()->elements[0] as $page => $url)
                @if ($page == $reviews->currentPage())
                  <li class="page-item active">
                    <span class="page-link" style="color:#fff;background:#ff6f61;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</span>
                  </li>
                @else
                  <li class="page-item">
                    <a class="page-link" href="{{ $url }}" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">{{ $page }}</a>
                  </li>
                @endif
              @endforeach

              @if ($reviews->hasMorePages())
                <li class="page-item">
                  <a class="page-link" href="{{ $reviews->nextPageUrl() }}" rel="next" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</a>
                </li>
              @else
                <li class="page-item disabled">
                  <span class="page-link" style="color:#ff6f61;background:#fffbe6;border-radius:18px;border:2px solid #ff6f61;">&raquo;</span>
                </li>
              @endif
            </ul>
          </nav>
        </div>
      @endif
    @endif
  </div>
</section>
@endsection