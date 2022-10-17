@extends('layouts.app')

@section('content')
<div class="container-md">
    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-6 col-xl-5 bg-white rounded-4 mt-4 px-md-5 py-4">
            <form method="" action="" id="Form_register" class="mx-4 my-3">
                <div class="text-center">
                    <h1>註冊帳號</h1>
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">使用者名稱</span>
                    <input type="text" class="form-control py-2 necessary"
                        name="username" max="20">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">電子郵件</span>
                    <input type="email" class="form-control py-2 necessary" name="email">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">密碼</span>
                    <input type="password" class="form-control py-2 necessary" name="password">
                </div>
                <div class="mt-3">
                    <span class="d-block mb-1">確認密碼</span>
                    <input type="password" class="form-control py-2 necessary" name="password_confirmation">
                </div>
                <div class="d-flex justify-content-between my-3">
                    <div class="d-inline-block necessaryCheckbox">
                        <input type="checkbox" id="Input_remember_account" class="form-check-input"
                            name="agreeTerms" checked>
                        <label class="form-check-label ms-1" for="Input_remember_account">我同意服務條款</label>
                    </div>
                    <div class="d-inline-block">
                        <span>已經有帳號了嗎？<a href="{{ route('Login_View') }}">登入</a></span>
                    </div>
                </div>
                <button type="button" class="btn btn-lg btn-secondary rounded-pill px-5 my-3"
                        onclick="formSubmit()">
                    註冊
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // 按鈕事件
        function formSubmit() {
            // validation
            if(validateForm()
                    && validatePasswordComplexity()
                    && validatePasswordConfirmation()
                ) {
                UtilSwal.formSubmit({}, function () {
                    const route = "{{ route('Register') }}";
                    const form = document.querySelector('#Form_register');
                    let postData = new FormData(form);
                    
                    axios({
                        url: route,
                        method: "POST",
                        data: postData,
                    }).then(function (response) {
                        // handle success
                        UtilSwal.submitSuccess(response['data']);
                    })
                    .catch(function (error) {
                        // handle error
                        if(error.response.status === 400
                            || error.response.status === 422) {
                            UtilSwal.showFail(error.response.data.message);
                        }
                        else {
                            UtilSwal.submitFail();
                        }
                    });
                });
            }
        }
    </script>
@endsection
