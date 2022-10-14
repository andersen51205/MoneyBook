@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5 bg-white rounded-4 mt-5 p-5">
            <form method="" action="" class="mx-4">
                <div class="text-center">
                    <h1>帳號登入</h1>
                </div>
                <div class="mt-3 pt-3">
                    <span class="d-block mb-2">電子郵件</span>
                    <input type="text" class="form-control py-3 px-3">
                </div>
                <div class="mt-3 pt-3">
                    <span class="d-block mb-2">密碼</span>
                    <input type="text" class="form-control py-3 px-3">
                </div>
                <div class="d-flex justify-content-between my-3">
                    <div class="d-inline-block">
                        <input type="checkbox" class="form-check-input" id="Input_remember_account">
                        <label class="form-check-label ms-1" for="Input_remember_account">記住帳號</label>
                    </div>
                    <div class="d-inline-block">
                        <a href="">忘記密碼</a>
                    </div>
                </div>
                <button class="btn btn-lg btn-secondary rounded-pill px-5 my-3">登入</button>
                <div class="text-center">
                    <span>沒有帳號？<a href="">前往註冊</a></span>
                </div>
            </form>
        </div>
    </div>
    
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
