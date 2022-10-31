@extends('layouts.Backstage')

@section('main')
    {{-- 麵包屑 --}}
    @include('layouts._Breadcrumb', ['root' => '帳戶管理'])
    <div id="Div_account_list">
        <div class="d-flex justify-content-end my-3">
            <button type="button" class="btn btn-outline-primary"
                    onclick="changePage('create')">
                <i class="fa-solid fa-plus"></i> 新增
            </button>
        </div>
        <table id="Table_account" class="table table-bordered text-center align-middle fs-5">
            <thead>
                <tr class="table-secondary">
                    <th style="width:5%">編號</th>
                    <th style="width:20%">名稱</th>
                    <th style="width:20%">餘額</th>
                    <th style="width:20%">備註</th>
                    <th style="width:10%">狀態</th>
                    <th style="width:10%">操作</th>
                </tr>
            </thead>
            <tbody id="Tbody_account">
                <tr v-if="accounts.length === 0">
                    <td class="text-center" colspan="6">無帳戶資料</td>
                </tr>
                <tr v-for="(account, index) in accounts">
                    <td class="number" v-text="index + 1"></td>
                    <td class="text-start ps-3">
                        <div class="type d-inline-block">
                            <span class="cash" v-if="account['type'] === 1">
                                <span class="badge rounded-pill fs-5 bg-primary bg-opacity-75 p-2">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                </span>
                            </span>
                            <span class="bank" v-if="account['type'] === 2">
                                <span class="badge rounded-pill fs-5 bg-warning p-2">
                                    <i class="fa-solid fa-building-columns"></i>
                                </span>
                            </span>
                            <span class="ticket-card" v-if="account['type'] === 3">
                                <span class="badge rounded-pill fs-5 bg-success bg-opacity-75 p-2">
                                    <i class="fa-regular fa-credit-card"></i>
                                </span>
                            </span>
                        </div>
                        <div class="name d-inline-block ms-2" v-text="account['name']"></div>
                    </td>
                    <td class="balance text-end pe-3" v-text="account['balance']"></td>
                    <td class="remark text-start" v-text="account['remark']"></td>
                    <td class="status">
                        <span class="hide" v-if="account['hidden']">
                            <span class="badge rounded-pill fs-6 bg-secondary bg-opacity-75 p-2">
                                <i class="fa-solid fa-eye-slash"></i> 隱藏
                            </span>
                        </span>
                        <span class="show" v-else>
                            <span class="badge rounded-pill fs-6 bg-secondary p-2">
                                <i class="fa-solid fa-eye"></i> 顯示
                            </span>
                        </span>
                    </td>
                    <td class="operation">
                        <button type="button" class="btn btn-outline-success m-1 edit"
                                v-on:click="editAccount"
                                v-bind:data-index="index">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger m-1 delete"
                                v-bind:data-index="index"
                                v-on:click="deleteAccount">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="Div_account_form" class="d-none">
        <div class="row justify-content-center">
            <form method="" action="" id="Form_account" class="col-11 col-md-6 mx-2 mx-md-4">
                <div class="row mb-3">
                    <label for="Input_name" class="col-sm-2 col-form-label">名稱</label>
                    <div class="col-sm-10">
                        <input type="text" id="Input_name" class="form-control necessary"
                            name="name" v-model="accountData['name']">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Select_type" class="col-sm-2 col-form-label">種類</label>
                    <div class="col-sm-10">
                        <select id="Select_type" class="form-select necessary"
                                name="type" v-model="accountData['type']">
                            <option value="0" selected disabled>請選擇</option>
                            <option value="1">現金</option>
                            <option value="2">銀行</option>
                            <option value="3">儲值卡</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Input_amount" class="col-sm-2 col-form-label">初始金額</label>
                    <div class="col-sm-10">
                        <input type="number" id="Input_amount" class="form-control necessary"
                            name="amount" v-model="accountData['amount']">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Textarea_remark" class="col-sm-2 col-form-label">備註</label>
                    <div class="col-sm-10">
                        <textarea id="Textarea_remark" class="form-control"
                            name="remark" rows="3" v-model="accountData['remark']"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input type="checkbox" id="Input_hide" class="form-check-input"
                                name="hidden" value="1" v-model="accountData['hidden']">
                            <label class="form-check-label" for="Input_hide">
                                隱藏帳戶
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <button type="button" id="Btn_submit" class="btn btn-primary px-3"
                            v-on:click="formSubmit">
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
    let accountListVm, accountFormVm;
    // 頁面初始化
    window.onload = function() {
        // 帳戶列表 Vue Model
        accountListVm = Vue.createApp({
            data() {
                return {
                    accounts: [],
                }
            },
            mounted() {
                const route = "{{ route('Account_List') }}";
                UtilSwal.showLoading();

                axios({
                    url: route,
                    method: "GET",
                }).then(function (response) {
                    // handle success
                    accountListVm.accounts = response['data']['account'];
                    Swal.close();
                }).catch(function (error) {
                    // handle error
                    if(error.response.status === 400
                        || error.response.status === 422) {
                        UtilSwal.showFail(error['response']['data']['message']);
                    }
                    else {
                        UtilSwal.submitFail();
                    }
                });
            },
            methods: {
                // 編輯帳戶
                editAccount(event) {
                    const el = event.currentTarget;
                    const index = el.getAttribute('data-index');
                    changePage('edit');
                    if(index) {
                        accountFormVm.accountData = { ...this.accounts[index] };
                        accountFormVm.accountIndex = index;
                    }
                },
                // 刪除帳戶
                deleteAccount(event) {
                    const el = event.currentTarget;
                    const index = el.getAttribute('data-index');
                    let accountId;
                    if(index) {
                        accountId = this.accounts[index]['id'];
                        UtilSwal.formSubmit({
                            title: '是否確定刪除？'
                        }, () => {
                            let route = "{{ route('Delete_Account', 'accountId') }}";
                            route = route.replace('accountId', accountId);
                            axios({
                                url: route,
                                method: "DELETE",
                            }).then(function (response) {
                                // handle success
                                UtilSwal.showSuccess('刪除成功');
                                // remove data
                                accountListVm.accounts.splice(index, 1);
                            }).catch(function (error) {
                                // handle error
                                if(error.response.status === 400
                                    || error.response.status === 422) {
                                    UtilSwal.showFail(error['response']['data']['message']);
                                }
                                else {
                                    UtilSwal.submitFail();
                                }
                            });
                        })
                    }
                }
            }
        }).mount('#Table_account');
        // 帳戶表單 Vue Model
        accountFormVm = Vue.createApp({
            data() {
                return {
                    accountData: {
                        "type": 0
                    },
                    accountIndex: -1,
                }
            },
            methods: {
                formSubmit() {
                    const accountData = this.accountData;
                    const accountIndex = this.accountIndex;
                    if(validateForm()) {
                        UtilSwal.formSubmit({}, function () {
                            const createRoute = "{{ route('Create_Account') }}";
                            const updateRoute = "{{ route('Update_Account', 'accountId') }}";
                            let route = createRoute;
                            let method = "POST";
                            if(accountIndex !== -1) {
                                route = updateRoute.replace('accountId', accountData['id']);
                                method = "PUT";
                            }

                            axios({
                                url: route,
                                method: method,
                                data: accountData,
                            }).then(function (response) {
                                // handle success
                                UtilSwal.showSuccess(response['data']['message']);
                                if(accountIndex !== -1) {
                                    accountListVm.accounts[accountIndex] = response['data']['account'];
                                }
                                else {
                                    accountListVm.accounts.push(response['data']['account']);
                                }
                                // return to list page
                                changePage('list');
                            }).catch(function (error) {
                                // handle error
                                if(error.response.status === 400
                                    || error.response.status === 422) {
                                    UtilSwal.showFail(error['response']['data']['message']);
                                }
                                else {
                                    UtilSwal.submitFail();
                                }
                            });
                        });
                    }
                }
            }
        }).mount('#Div_account_form');
    }
    // 切換頁面
    function changePage(page) {
        // Reset Form Data
        accountFormVm.accountData = {"type": "0"};
        accountFormVm.accountIndex = -1;
        if(page === 'list') {
            document.querySelector('#Div_account_list').classList.remove('d-none');
            document.querySelector('#Div_account_form').classList.add('d-none');
        }
        else if(page === 'create' || page === 'edit') {
            document.querySelector('#Div_account_list').classList.add('d-none');
            document.querySelector('#Div_account_form').classList.remove('d-none');
        }
    }
</script>
@endsection