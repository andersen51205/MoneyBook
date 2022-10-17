<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Web Title -->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
        <!-- Script -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div>
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top fs-4">
                <div class="container">
                    <a class="navbar-brand fs-4 mx-2" href="/">MoneyBook</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#Div_navbar_collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="Div_navbar_collapse" class="collapse navbar-collapse justify-content-end">
                        <div class="navbar-nav">
                            <a class="nav-link mx-3" href="{{ route('Login_View') }}">登入</a>
                            <a class="nav-link mx-3" href="{{ route('Register_View') }}">註冊</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="main">
            <div class="container px-4 h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-7 mb-4">
                        <h1 class="text-white">理財從記帳開始</h1>
                        <hr class="text-white">
                        <p class="text-white mb-3 fs-5">
                            記帳不會讓你賺大錢，但想賺大錢就從記帳開始。<br>
                            透過記帳能你瞭解自己的開銷，規劃預算、控制花費，改善自己的消費習慣。<br>
                            設定財務目標，做好理財投資規劃，才能夠追尋自己理想的生活方式。
                        </p>
                        <a class="btn btn-light btn-lg px-4 mx-3" href="/login">馬上使用</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
