<nav class="navbar navbar-expand-lg" style="background-color: #f17807; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
    <div class="container-fluid position-relative" style="min-height:70px;">
        <div class="d-flex align-items-center" style="height:70px;">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="margin-left:18px;">
                <span
                    style="background:#fff;border-radius:50%;width:52px;height:52px;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        style="height:50px;width:50px;object-fit:contain;">
                </span>
            </a>
            <button class="navbar-toggler me-auto border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#chimimiNavbar" aria-controls="chimimiNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="chimimiNavbar">
            <div class="w-100 d-flex flex-column align-items-lg-center justify-content-lg-center">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto d-flex flex-row" style="gap:2rem;">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('/') ? 'active' : '' }}"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('product*') ? 'active' : '' }}"
                            href="/products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('reviews*') ? 'active' : '' }}"
                            href="/reviews">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end"
            style="height:70px;position:absolute;top:0;right:0;z-index:2;margin-right:32px;">
            <ul class="navbar-nav flex-row" style="gap:1.5rem;">
                <li class="nav-item">
                    <a class="fs-4" href="{{ route('cart') }}" title="Cart" style="color:#ff6f61;">
                        <span
                            style="background:#fff;border-radius:50%;width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <i class="bi bi-cart"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="fs-4" href="/user" title="Profile" style="color:#ff6f61;">
                        <span
                            style="background:#fff;border-radius:50%;width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <i class="bi bi-person-circle"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <div style="height:12px;background:#ff6f61;border-radius:0 0 8px 8px;"></div>
</nav>
