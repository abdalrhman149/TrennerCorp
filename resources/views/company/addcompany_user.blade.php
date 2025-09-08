@extends('admin.masteradmin')

@section('content3')
<nav class="side-navbar">
    <div class="nav-header">
        <h2><i class="fas fa-leaf"></i> <span>GreenNav</span></h2>
    </div>

    <div class="nav-menu">
        <ul>
            <li><a href="#" ><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="/storecompany"class="active"><i class="fas fa-chart-bar"></i> <span>addcompany</span></a></li>
            <li><a href="/viewcompany"><i class="fas fa-shopping-cart"></i> <span>All user</span></a></li>
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
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white fw-semibold">Add Company</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('storecompany') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Company Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Company Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Company Logo --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">Company Logo</label>
                                <input id="image" type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Company Description</label>
                                <textarea id="description" name="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Hidden Role --}}
                            <input type="hidden" name="role" value="company">

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" required
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success">add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
