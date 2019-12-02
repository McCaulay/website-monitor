@extends('layouts.auth')

@section('title', __('Register'))
@section('header', __('Create an account'))

@section('body')
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">{{ __('Your name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Your email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4">{{ __('Sign Up') }}</button>
    </form>
    <!-- / Form -->
@endsection

@section('footer')
{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Sign In') }}</a>
@endsection