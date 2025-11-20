<nav class="navbar navbar-expand-lg" style="background-color: #f17807; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
    <div class="container-fluid position-relative" style="min-height:70px;max-width:100vw;overflow-x:hidden;">
        <div class="d-flex align-items-center" style="height:70px;">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}"
                style="margin-left:12px;color:#ffffff;font-size:1.7rem;">
                Admin
            </a>
            <button class="navbar-toggler me-auto border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <div class="w-100 d-flex flex-column align-items-lg-center justify-content-lg-center"
                style="margin-right:100px">
                <ul class="navbar-nav mb-2 mb-lg-0 d-flex flex-row justify-content-center" style="gap:2.5rem;">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/products*') ? 'active' : '' }}"
                            href="{{ route('admin.products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/orders*') ? 'active' : '' }}"
                            href="{{ route('admin.orders') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/reviews*') ? 'active' : '' }}"
                            href="{{ route('admin.reviews') }}">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end"
            style="height:70px;position:absolute;top:0;right:0;z-index:2;margin-right:20px;">
            <ul class="navbar-nav flex-row" style="gap:2.5rem;">
                <li class="nav-item">
                    <a class="fs-4" href="/user" title="Profiles" style="color:#ff6f61;">
                        <span
                            style="background:#fff;border-radius:50%;width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <i class="bi bi-person-circle"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div style="height:12px;background:#ff6f61;border-radius:0 0 8px 8px;"></div>
</nav>
