<nav class="navbar navbar-expand-lg" style="background-color: #f17807; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
    <div class="container-fluid position-relative" style="min-height:70px;">
        <div class="d-flex align-items-center" style="height:70px;">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/dashboard"
                style="margin-left:18px;color:#ffffff;font-size:1.7rem;">
                Admin
            </a>
            <button class="navbar-toggler me-auto border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <div class="d-flex w-100 align-items-center" style="height:70px;">
                <div style="flex:1;"></div>
                <div class="d-flex justify-content-center" style="flex:2;">
                    <ul class="navbar-nav d-flex flex-row justify-content-center align-items-center mb-0"
                        style="gap:2.2rem;">
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/products*') ? 'active' : '' }}"
                                href="/admin/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/orders*') ? 'active' : '' }}"
                                href="/admin/orders">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('admin/reviews*') ? 'active' : '' }}"
                                href="/admin/reviews">Reviews</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center justify-content-end" style="flex:1; margin-right:16px;">
                    <ul class="navbar-nav flex-row" style="gap:1.2rem;">
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
        </div>
    </div>
    <div style="height:12px;background:#ff6f61;border-radius:0 0 8px 8px;"></div>
</nav>
