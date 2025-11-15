@extends('layout.mainlayout')

@section('title', 'Add Product')

@section('content')
<section style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); min-height:100vh; padding: 4rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-lg p-4"
                    style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                    <h2 class="fw-bold mb-4 text-center" style="color:#ff6f61;">Add New Product</h2>
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Name</label>
                            <input type="text" name="name" class="form-control" required style="border-radius:16px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Category</label>
                            <input type="text" name="category" class="form-control" required style="border-radius:16px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Ingredients</label>
                            <textarea name="ingredients" class="form-control" rows="2" required style="border-radius:16px;"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Price Frozen</label>
                            <input type="number" name="price_frozen" class="form-control" required min="0" step="1000" style="border-radius:16px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Price Cooked</label>
                            <input type="number" name="price_cooked" class="form-control" required min="0" step="1000" style="border-radius:16px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color:#ff6f61;">Image</label>
                            <input type="file" name="image" class="form-control" required style="border-radius:16px;">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn px-5 py-2"
                                style="background:#ff6f61;color:#fff;font-weight:600;border-radius:24px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection