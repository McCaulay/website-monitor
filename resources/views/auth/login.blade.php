@extends('layouts.auth')

@section('title', __('Login'))
@section('header', __('Login to your account'))

@section('body')
    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label d-flex justify-content-between align-items-end">
                <div>{{ __('Password') }}</div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="d-block small">{{ __('Forgot password?') }}</a>
                @endif
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="custom-control-label" for="remember">{{ __('Remember me') }}</span>
            </label>
            <button type="submit" class="btn btn-primary">{{ __('Sign In') }}</button>
        </div>
    </form>
    <!-- / Form -->
@endsection

@if (Route::has('register'))
    @section('footer')
    {{ __('Don\'t have an account yet?') }} <a href="{{ route('register') }}">{{ __('Sign Up') }}</a>
    @endsection
@endif
