@extends('layouts.Backstage')

@section('main')
    <div id="Div_account_list">
        {{-- 麵包屑 --}}
        @include('layouts._Breadcrumb', ['root' => '帳戶管理'])
        <div class="d-flex justify-content-end my-3">
            <button type="button" class="btn btn-outline-primary"
                    onclick="changePage('add')">
                <i class="fa-solid fa-plus"></i> 新增
            </button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="Div_add_account" class="d-none">
        {{-- 麵包屑 --}}
        @include('layouts._Breadcrumb', ['root' => '帳戶管理', 'current' => '新增帳戶'])
        <div class="row justify-content-center">
            <form method="" action="" id="Form_add_account" class="col-11 col-md-6 mx-2 mx-md-4">
                <div class="row mb-3">
                    <label for="Input_name" class="col-sm-2 col-form-label">名稱</label>
                    <div class="col-sm-10">
                        <input type="text" id="Input_name" class="form-control necessary" name="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Select_type" class="col-sm-2 col-form-label">種類</label>
                    <div class="col-sm-10">
                        <select id="Select_type" class="form-select">
                            <option value="" selected disabled>請選擇</option>
                            <option value="1">現金</option>
                            <option value="2">銀行</option>
                            <option value="3">儲值卡</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Input_amount" class="col-sm-2 col-form-label">初始金額</label>
                    <div class="col-sm-10">
                        <input type="number" id="Input_amount" class="form-control necessary" name="amount">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Textarea_remark" class="col-sm-2 col-form-label">備註</label>
                    <div class="col-sm-10">
                        <textarea id="Textarea_remark" class="form-control"
                            name="remark" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input type="checkbox" id="Input_hide" class="form-check-input"
                                name="hide" value="1">
                            <label class="form-check-label" for="Input_hide">
                                隱藏帳戶
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <button type="button" class="btn btn-primary px-3"
                            onclick="formSubmit()">
                        送出
                    </button>
                    <button type="button" class="btn btn-secondary px-3 ms-3"
                            onclick="changePage('list')">
                        返回
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function changePage(page) {
            if(page === 'add') {
                document.querySelector('#Div_account_list').classList.add('d-none');
                document.querySelector('#Div_add_account').classList.remove('d-none');
            }
            else if(page === 'list') {
                document.querySelector('#Div_account_list').classList.remove('d-none');
                document.querySelector('#Div_add_account').classList.add('d-none');
            }
        }
    </script>
@endsection