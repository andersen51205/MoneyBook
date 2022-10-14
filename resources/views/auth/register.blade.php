@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5 bg-white rounded-4 mt-4 px-5 py-4">
            <form method="" action="" class="mx-4 my-3">
                <div class="text-center">
                    <h1>註冊帳號</h1>
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">使用者名稱</span>
                    <input type="text" class="form-control py-2">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">電子郵件</span>
                    <input type="text" class="form-control py-2">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">密碼</span>
                    <input type="text" class="form-control py-2">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">確認密碼</span>
                    <input type="text" class="form-control py-2">
                </div>
                <div class="d-flex justify-content-between my-3">
                    <div class="d-inline-block">
                        <input type="checkbox" class="form-check-input" id="Input_remember_account" checked>
                        <label class="form-check-label ms-1" for="Input_remember_account">我同意服務條款</label>
                    </div>
                    <div class="d-inline-block">
                        <span>已經有帳號了嗎？<a href="">登入</a></span>
                    </div>
                </div>
                <button class="btn btn-lg btn-secondary rounded-pill px-5 my-3">註冊</button>
            </form>
        </div>

        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
