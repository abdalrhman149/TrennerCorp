@extends('admin.masteradmin')

@section('content3')

<div class="menu-toggle">
    <i class="fas fa-bars"></i>
</div>

<!-- Green Side Navbar -->
<nav class="side-navbar">
    <div class="nav-header">
        <h2><i class="fas fa-leaf"></i> <span>GreenNav</span></h2>
    </div>

    <div class="nav-menu">
        <ul>
            <li><a href="#" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="/storecompany"><i class="fas fa-chart-bar"></i> <span>addcompany</span></a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
            <li><a href="#"><i class="fas fa-box"></i> <span>Products</span></a></li>
            <li><a href="#"><i class="fas fa-users"></i> <span>Customers</span></a></li>
            <li><a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> <span>Help & Support</span></a></li>
        </ul>
    </div>

    {{-- User Info & Logout --}}
    <div class="nav-footer">
        <div class="user-profile">
            {{-- صورة افاتار ديناميكية --}}
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                 alt="User" class="rounded-circle" width="40">

            <div class="user-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>

        {{-- Logout Button --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </button>
        </form>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">
    <div class="content-header">
        <h1>Dashboard</h1>
        <p>Welcome to your green-themed admin panel</p>
    </div>

    <div class="content-card">
        <h2>Overview</h2>
        <p>This is a sample dashboard page with a green side navigation bar. The navbar is responsive and will collapse on smaller screens.</p>
    </div>

    <div class="content-card">
        <h2>Features</h2>
        <ul>
            <li>Green color scheme matching your CSS variables</li>
            <li>Responsive design that works on all screen sizes</li>
            <li>Smooth transitions and hover effects</li>
            <li>Font Awesome icons for visual elements</li>
            <li>Clean and modern user interface</li>
        </ul>
    </div>
</main>

<script>
    // Toggle mobile menu
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.side-navbar').classList.toggle('active');
    });

    // Close menu when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.side-navbar');
        const toggle = document.querySelector('.menu-toggle');

        if (window.innerWidth < 768 &&
            !navbar.contains(event.target) &&
            !toggle.contains(event.target) &&
            navbar.classList.contains('active')) {
            navbar.classList.remove('active');
        }
    });
</script>

@endsection
