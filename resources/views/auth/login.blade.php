@extends('layouts.app')

@section('content')
<div class="container-md">
    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-6 col-xl-5 bg-white rounded-4 mt-4 p-5">
            <form method="" action="" id="Form_login" class="mx-2 mx-md-4">
                <div class="text-center">
                    <h1>帳號登入</h1>
                </div>
                <div class="mt-3 pt-3">
                    <span class="d-block mb-2">電子郵件</span>
                    <input type="email" class="form-control py-3 px-3 necessary"
                        name="email">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-2">密碼</span>
                    <input type="password" class="form-control py-3 px-3 necessary"
                        name="password">
                </div>
                <div class="d-flex justify-content-between my-3">
                    <div class="d-inline-block">
                        <input type="checkbox" id="Input_remember_account"
                            class="form-check-input" tabindex="-1">
                        <label class="form-check-label ms-1" for="Input_remember_account">記住帳號</label>
                    </div>
                    <div class="d-inline-block">
                        <a href="" tabindex="-1">忘記密碼</a>
                    </div>
                </div>
                <button type="button" class="btn btn-lg btn-secondary rounded-pill px-5 my-3"
                        onclick="formSubmit()">
                    登入
                </button>
                <div class="text-center">
                    <span>沒有帳號？<a href="{{ route('Register_View') }}">前往註冊</a></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // 頁面初始化
    window.onload = function() {
        document.querySelector('input[name=email]').focus();
        // 取得記住Email
        const email = getCookie('rememberAccount');
        if(email) {
            document.querySelector('#Input_remember_account').checked = true;
            document.querySelector('input[name=email]').value = email;
            document.querySelector('input[name=password]').focus();
        }
    }
    // 表單提交
    function formSubmit() {
        // validation
        if(validateForm()) {
            const route = "{{ route('Login') }}";
            const form = document.querySelector('#Form_login');
            let postData = new FormData(form);
            UtilSwal.showLoading("登入中");
            
            axios({
                url: route,
                method: "POST",
                data: postData,
            }).then(function (response) {
                // handle success
                const rememberAccount = document.querySelector('#Input_remember_account');
                if(rememberAccount.checked) {
                    const email = document.querySelector('input[name=email]').value;
                    document.cookie = `rememberAccount=${email}`;
                }
                else {
                    document.cookie = "rememberAccount=";
                }
                if(response['data']['redirectTarget']) {
                    window.location.assign(response['data']['redirectTarget']);
                }
            }).catch(function (error) {
                // handle error
                if(error.response.status === 400
                    || error.response.status === 422) {
                    UtilSwal.showFail(error.response.data.message);
                }
                else {
                    UtilSwal.submitFail();
                }
            });
        }
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if(parts.length === 2) {
            return parts.pop().split(';').shift();
        }
    }
</script>
@endsection
