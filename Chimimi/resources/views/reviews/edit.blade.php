@extends('layout.mainlayout')

@section('title', 'Edit Review')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); min-height:100vh; padding: 4rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-lg p-4"
                    style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                    <h2 class="fw-bold mb-4 text-center" style="color:#ff6f61;">Edit Your Review</h2>
                    <form method="POST" action="{{ route('reviews.update', $review->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Rating</label>
                            <div id="star-rating" class="d-flex gap-2 justify-content-center" style="font-size:2rem;cursor:pointer;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star" data-value="{{ $i }}">
                                        <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}" style="color:{{ $i <= $review->rating ? '#f17807' : '#ffe066' }};"></i>
                                    </span>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="{{ $review->rating }}" required>
                            @error('rating')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label fw-bold" style="color:#ff6f61;">Your Review</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="255" required style="border-radius:16px;">{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn px-5 py-2"
                                style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, idx) => {
        star.addEventListener('click', function () {
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