@extends('master')

@section('content1')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header bg-success text-white fw-semibold">Login</div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input id="email" type="email" name="email"
                     value="{{ old('email') }}" required autofocus
                     class="form-control @error('email') is-invalid @enderror">
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input id="password" type="password" name="password" required
                     class="form-control @error('password') is-invalid @enderror">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
              <input type="checkbox" name="remember" id="remember" class="form-check-input">
              <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-success">
                  Forgot your password?
                </a>
              @endif

              <button type="submit" class="btn btn-success">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
