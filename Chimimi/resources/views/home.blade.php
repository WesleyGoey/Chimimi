@extends('layout.mainlayout')

@section('title', 'Chimimi - Home')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div class="position-relative"
        style="background: url('{{ asset('images/all_risoles.jpeg') }}') center/cover no-repeat; min-height: 100vh; height: 100vh; border-radius: 0;">
       <div class="position-absolute start-50" 
             style="top:12%; left:50%; transform: translateX(-50%); z-index:3; display:flex; flex-direction:column; align-items:center; gap:0.6rem; width:auto;">
          <span style="background:#fff;border-radius:50%;padding:8px;display:inline-block;box-shadow:0 10px 36px rgba(0,0,0,0.16);">
             <img src="{{ asset('images/logo.png') }}" alt="Chimimi Logo"
                 style="height:200px;width:200px;object-fit:contain;display:block;max-width:calc(92vw);">
          </span>

            <div class="text-center text-white"
                 style="background: #fffbe6; border-radius:48px; box-shadow: 0 4px 32px rgba(0,0,0,0.12); padding:2.2rem 3.2rem; border: 2px solid #ff6f61; display:inline-block; width: min(900px, 90%);">
                <h1 class="display-4 fw-bold mb-3" style="color:#ff6f61;text-shadow:0 2px 12px rgba(255,224,102,0.18);">Discover
                    the Joy of
                    Risoles!</h1>
                <p class="lead mb-0" style="color:#ff6f61;text-shadow:0 2px 12px rgba(255,111,97,0.12);font-weight:500;">Indulge
                    in crispy, golden bites filled with irresistible flavors. Elevate your snacking experience with Chimimi!</p>
            </div>
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
                        <p class="text-muted mb-4" style="font-size:0.95rem;">
                            Made with premium ingredients and a touch of love — perfect as a snack or party bites. Try our most-loved flavors below.
                        </p>

                         <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('products') }}"
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
                    
                </div>
            </div>
        </div>
    </section>
@endsection
