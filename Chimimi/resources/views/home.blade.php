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
                    <div
                        style="width:400px;height:400px;background:#fffbe6;border-radius:50%;border:10px solid #ff6f61;box-shadow:0 2px 16px rgba(0,0,0,0.10);display:flex;align-items:center;justify-content:center;">
                        <img src="{{ asset('images/1_risoles.jpeg') }}" alt="About Chimimi"
                            style="width:92%;height:92%;object-fit:cover;border-radius:50%;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card border-1 shadow-lg p-5"
                        style="background:#fffbe6;border-radius:24px; border: 2.5px solid #ff6f61;">
                        <h2 class="fw-bold mb-3" style="color:#ff6f61;">About Us</h2>
                        <p class="mb-0" style="font-size:1.15rem;">Chimimi is dedicated to serving the finest risoles,
                            crafted with premium ingredients and a passion for flavor. Our mission is to bring joy to every
                            bite and create memorable experiences for our customers. Discover the taste that makes us
                            special!<br><br>
                            Established with a love for culinary excellence, Chimimi strives to innovate traditional recipes
                            while keeping authentic flavors. Every risoles should be a delightful
                            experience, from the crispy exterior to the rich filling—savory or sweet. Our team is committed to
                            quality, ensuring each product is made fresh daily and delivered with care.<br><br>
                        </p>
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
