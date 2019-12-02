@extends('layouts.auth')

@section('title', __('Confirm Password'))
@section('header', __('Confirm your account password'))

@section('body')
    {{ __('Please confirm your password before continuing.') }}

    <!-- Form -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4">{{ __('Confirm Password') }}</button>
    </form>
    <!-- / Form -->
@endsection

@if (Route::has('password.request'))
    @section('footer')
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endsection
@endif