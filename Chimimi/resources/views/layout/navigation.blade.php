<style>
    /* Hover underline - teks tidak bergerak */
    .nav-link-hover {
        border-bottom: 2px solid transparent;
    }
    
    .nav-link-hover:hover {
        border-bottom: 2px solid white;
    }
</style>

<nav class="navbar navbar-expand-lg" 
     style="background-color: #f17807; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
    
    <div class="container-fluid">
        
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 55px;">
        </a>

        <!-- Toggler Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            
            <!-- Center Menu -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('/') ? 'active' : '' }}" 
                       href="/">
                        Home
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('product*') ? 'active' : '' }}" 
                       href="/products">
                        Products
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link text-white fw-bold fs-5 nav-link-hover {{ request()->is('reviews*') ? 'active' : '' }}" 
                       href="/reviews">
                        Reviews
                    </a>
                </li>
            </ul>

            <!-- Right Icons -->
            <ul class="navbar-nav">
                <li class="nav-item mx-2">
                    <a class="nav-link text-white fs-4" href="/cart" title="Cart">
                        <i class="bi bi-cart"></i>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white fs-4" href="/profile" title="Profile">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>