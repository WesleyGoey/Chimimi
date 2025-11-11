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
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const stars = document.querySelectorAll('#star-rating .star');
                                const ratingInput = document.getElementById('rating');
                                stars.forEach(star => {
                                    star.addEventListener('click', function() {
                                        const val = this.getAttribute('data-value');
                                        ratingInput.value = val;
                                        stars.forEach((s, idx) => {
                                            if (idx < val) {
                                                s.innerHTML =
                                                    '<i class="bi bi-star-fill" style="color:#ffe066;"></i>';
                                            } else {
                                                s.innerHTML =
                                                    '<i class="bi bi-star" style="color:#ffe066;"></i>';
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                        <div class="mb-3">
                            <label for="comment" class="form-label fw-bold" style="color:#ff6f61;">Your Review</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="255" required
                                style="border-radius:16px;"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn px-5 py-2"
                                style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <span class="fw-bold"
                    style="color:#ff6f61;background:#fffbe6;padding:0.5em 2em;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);font-size:1.25rem;letter-spacing:1px;">Your Reviews</span>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        @foreach ($reviews as $review)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm border-0" style="background:#fff;border-radius:18px;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fw-bold me-2" style="color:#ff6f61;">
                                                {{ $review->profile->username }}
                                            </span>
                                            <span style="font-size:1.25rem;">
                                                @for ($star = 1; $star <= 5; $star++)
                                                    @if ($star <= $review->rating)
                                                        <i class="bi bi-star-fill" style="color:#ffe066;"></i>
                                                    @else
                                                        <i class="bi bi-star" style="color:#ffe066;"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </div>
                                        <div style="color:#f17807;font-size:1.05rem;">{{ $review->comment }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
