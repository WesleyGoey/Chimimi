@extends('layout.mainlayout')

@section('title', 'Chimimi - Home')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div class="position-relative"
        style="background: url('{{ asset('images/all_risoles.jpeg') }}') center/cover no-repeat; min-height: 100vh; height: 100vh; border-radius: 0;">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white"
            style="background: #fffbe6; border-radius:48px; box-shadow: 0 4px 32px rgba(0,0,0,0.12); padding:2.2rem 3.2rem; border: 2px solid #ff6f61; display:inline-block;">
            <h1 class="display-4 fw-bold mb-3" style="color:#ff6f61;text-shadow:0 2px 12px rgba(255,224,102,0.18);">Discover
                the Joy of
                Risoles!</h1>
            <p class="lead mb-0" style="color:#ff6f61;text-shadow:0 2px 12px rgba(255,111,97,0.12);font-weight:500;">Indulge
                in crispy, golden bites filled with irresistible flavors. Elevate your snacking experience with Chimimi!</p>
        </div>
    </div>

    <section
        style="background: linear-gradient(135deg, #ffe066 0%, #ff6f61 100%); padding: 5rem 0; border-top: 2.5px solid #ff6f61;">
        <div class="container">
             <div class="row justify-content-center align-items-center mb-5">
                <div class="col-lg-5 mb-4 mb-lg-0 d-flex justify-content-center align-items-center">
                    <div class="position-relative"
                        style="width:420px;max-width:90%;height:420px;background:linear-gradient(135deg,#fffbe6 0%, #fff 60%);border-radius:50%;border:12px solid #ff6f61;box-shadow:0 6px 28px rgba(0,0,0,0.12);display:flex;align-items:center;justify-content:center;">
                        <img src="{{ asset('images/1_risoles.jpeg') }}" alt="Risoles Chimimi"
                            style="width:88%;height:88%;object-fit:cover;border-radius:50%;box-shadow:0 8px 20px rgba(0,0,0,0.08);">
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-lg p-4 p-md-5" style="background:#fffbe6;border-radius:20px;border: 2.5px solid #ff6f61;">
                        <h1 class="fw-bold mb-3" style="color:#ff6f61;font-size:2.1rem;letter-spacing:0.6px;">Chimimi Risoles</h1>
                        <p class="mb-3" style="font-size:1.05rem;color:#333;">
                            Crispy outside, flavorful inside — handcrafted risoles made fresh daily. Choose your style:
                            savory or sweet, perfect for sharing.
                        </p>

                        <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center me-2">
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background:#fff4ee;color:#ff6f61;font-weight:600;">Savory</span>
                                <span class="badge rounded-pill px-3 py-2 ms-2"
                                    style="background:#fff7fb;color:#ff6f61;font-weight:600;">Sweet</span>
                            </div>

                            <div class="ms-auto d-flex align-items-center gap-2">
                                <div class="text-muted" style="font-size:0.95rem;color:#6b6b6b;">1 pax /</div>
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background:#fff7e6;color:#f17807;font-weight:700;">5 pcs</span>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-6">
                                <div class="p-3"
                                    style="background:#fff9f4;border-radius:12px;border:1px solid #ffe6c9;">
                                    <div style="font-size:0.85rem;color:#6b6b6b;">Frozen</div>
                                    <div class="fw-bold" style="color:#ff6f61;font-size:1.1rem;">Rp50.000</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="p-3"
                                    style="background:#fffafc;border-radius:12px;border:1px solid #ffe6f0;">
                                    <div style="font-size:0.85rem;color:#6b6b6b;">Cooked</div>
                                    <div class="fw-bold" style="color:#ff6f61;font-size:1.1rem;">Rp55.000</div>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted mb-4" style="font-size:0.95rem;">
                            Made with premium ingredients and a touch of love — perfect as a snack or party bites. Try our most-loved flavors below.
                        </p>

                         <div class="d-flex flex-wrap gap-2">
                            <a href="/products"
                               class="btn px-4 py-2"
                               style="border-radius:28px;font-weight:600;background:#ff6f61;color:#fff;box-shadow:0 2px 8px rgba(255,111,97,0.13);display:flex;align-items:center;gap:0.5rem;">
                                <i class="bi bi-bag-fill" style="font-size:1.3rem;"></i>
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 my-5 d-flex justify-content-center"></div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div
                        style="background:#fffbe6; border:2.5px solid #ff6f61; border-radius:32px; box-shadow:0 4px 24px rgba(0,0,0,0.08); padding:2.5rem 2rem;">
                        <h2 class="text-center mb-4" style="font-weight:700;color:#ff6f61;letter-spacing:1px;">Most Loved
                            Risoles</h2>
                        <p class="text-center mb-5" style="color:#ff6f61;font-size:1.15rem;font-weight:500;">Our customers’
                            favorites, chosen for their irresistible taste and crispy perfection. Try one and find your new
                            obsession!</p>
                        <div class="row justify-content-center">
                            @foreach ($bestSellers as $product)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0"
                                        style="background:#fff;border-radius:18px;transition:transform .2s;">
                                        <img src="{{ asset($product->image_path) }}" class="card-img-top"
                                            alt="{{ $product->name }}"
                                            style="height:220px; object-fit:cover; border-radius:18px 18px 0 0;">
                                        <div class="card-body text-center d-flex flex-column">
                                            <h5 class="card-title mb-2" style="color:#ff6f61;font-weight:600;">
                                                {{ $product->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="/products" class="btn btn-lg btn-warning px-5 py-3"
                                style="font-weight:600;border-radius:32px;box-shadow:0 2px 12px rgba(255,111,97,0.10);">View
                                All
                                Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
