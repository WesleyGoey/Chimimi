@extends('layout.mainlayout')

@section('title', 'Chimimi - Reviews')

@section('content')
    <section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 4rem 0; min-height:100vh;">
        <div class="container">
            <div class="d-flex justify-content-center mb-5">
                <span class="fw-bold"
                    style="color:#fff;background:#ff6f61;padding:0.6em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.5rem;letter-spacing:1px;">Share
                    Your Review</span>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-7">
                    <div class="card shadow-lg p-4"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        @auth
                            <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold" style="color:#ff6f61;">Rating</label>
                                    <div id="star-rating" class="d-flex gap-2 justify-content-center"
                                        style="font-size:2rem;cursor:pointer;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">
                                                <i class="bi bi-star" style="color:#ffe066;"></i>
                                            </span>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="rating" required>
                                    @error('rating')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label fw-bold" style="color:#ff6f61;">Your Review</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="255" required
                                        style="border-radius:16px;"></textarea>
                                    @error('comment')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn px-5 py-2"
                                        style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">Submit</button>
                                </div>
                            </form>
                        @else
                            <div class="text-center py-4">
                                <span class="fw-bold" style="color:#ff6f61;font-size:1.1rem;">
                                    Please <a href="{{ route('login') }}"
                                        style="color:#f17807;text-decoration:underline;">login</a> to submit a review.
                                </span>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <span class="fw-bold"
                    style="color:#ff6f61;background:#fffbe6;padding:0.5em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.25rem;letter-spacing:1px;">
                    Customer Reviews
                </span>
            </div>
            <div class="row justify-content-center">
                @if ($reviews->count() === 0)
                    <div class="row justify-content-center align-items-center" style="min-height:20vh;">
                        <div class="col-12 d-flex justify-content-center">
                            <div style="
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
                                No reviews available
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($reviews as $review)
                        <div class="d-flex justify-content-center mb-4">
                            <div class="card shadow-sm"
                                style="background:#fffbe6;border-radius:32px;border:2px solid #fffbe6;max-width:750px;width:100%;
                                    @if (auth()->check() && auth()->id() === $review->user_id) border: 2px solid #ff6f61;
                                        box-shadow:0 0 0 4px #ffe066; @endif
                             ">
                                <div class="card-body px-4 py-4 position-relative">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="fw-bold"
                                            style="@if (auth()->check() && auth()->id() === $review->user_id) color:#ff6f61;background:#fffbe6;padding:0.18em 0.7em;border-radius:18px;border:2px solid #ff6f61;@else color:#ff6f61; @endif font-size:1rem;">
                                            {{ auth()->check() && auth()->id() === $review->user_id ? 'You' : $review->user->username ?? 'Member' }}
                                        </span>
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="bi bi-star-fill"
                                                        style="color:#f17807;font-size:1rem;"></i>
                                                @else
                                                    <i class="bi bi-star" style="color:#ffe066;font-size:1rem;"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                    <div style="color:#f17807;font-size:1rem;">
                                        {{ $review->comment }}
                                    </div>
                                    @if (auth()->check() && auth()->id() === $review->user_id)
                                        <div
                                            class="position-absolute top-50 end-0 translate-middle-y me-4 d-flex gap-2">
                                            <a href="{{ route('reviews.edit', $review->id) }}"
                                                class="btn btn-sm btn-light" title="Edit"
                                                style="border-radius:50%;padding:8px 10px;">
                                                <i class="bi bi-pencil" style="color:#ff6f61;font-size:1.3rem;"></i>
                                            </a>
                                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light" title="Delete"
                                                    style="border-radius:50%;padding:8px 10px;">
                                                    <i class="bi bi-trash" style="color:#f17807;font-size:1.3rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('#star-rating .star');
            const ratingInput = document.getElementById('rating');

            stars.forEach((star, idx) => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;

                    stars.forEach((s, i) => {
                        if (i < value) {
                            s.querySelector('i').classList.remove('bi-star');
                            s.querySelector('i').classList.add('bi-star-fill');
                            s.querySelector('i').style.color = '#f17807';
                        } else {
                            s.querySelector('i').classList.remove('bi-star-fill');
                            s.querySelector('i').classList.add('bi-star');
                            s.querySelector('i').style.color = '#ffe066';
                        }
                    });
                });
            });
        });
    </script>
@endsection
