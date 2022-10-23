@extends('layouts.Backstage')

@section('main')
    {{-- 麵包屑 --}}
    @include('layouts._Breadcrumb', ['root' => '帳戶管理'])
    <div id="Div_account_list">
        <div class="d-flex justify-content-end my-3">
            <button type="button" class="btn btn-outline-primary"
                    onclick="changePage('form')">
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
            </tbody>
        </table>
        <template id="Template_account_row">
            <tr>
                <td class="number"></td>
                <td class="text-start ps-3">
                    <div class="type d-inline-block">
                        <span class="cash d-none">
                            <span class="badge rounded-pill fs-5 bg-primary bg-opacity-75 p-2">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </span>
                        </span>
                        <span class="bank d-none">
                            <span class="badge rounded-pill fs-5 bg-warning p-2">
                                <i class="fa-solid fa-building-columns"></i>
                            </span>
                        </span>
                        <span class="ticket-card d-none">
                            <span class="badge rounded-pill fs-5 bg-success bg-opacity-75 p-2">
                                <i class="fa-regular fa-credit-card"></i>
                            </span>
                        </span>
                    </div>
                    <div class="name d-inline-block ms-1"></div>
                </td>
                <td class="balance text-end pe-3"></td>
                <td class="remark text-start"></td>
                <td class="status">
                    <span class="show d-none">
                        <span class="badge rounded-pill fs-6 bg-secondary p-2">
                            <i class="fa-solid fa-eye"></i> 顯示
                        </span>
                    </span>
                    <span class="hide d-none">
                        <span class="badge rounded-pill fs-6 bg-secondary bg-opacity-75 p-2">
                            <i class="fa-solid fa-eye-slash"></i> 隱藏
                        </span>
                    </span>
                </td>
                <td class="operation">
                    <button type="button" class="btn btn-outline-success m-1 edit"
                            onclick="editAccount(this)">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger m-1 delete"
                            onclick="deleteAccount(this)">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </td>
            </tr>
        </template>
    </div>
    <div id="Div_account_form" class="d-none">
        <div class="row justify-content-center">
            <form method="" action="" id="Form_account" class="col-11 col-md-6 mx-2 mx-md-4">
                <div class="row mb-3">
                    <label for="Input_name" class="col-sm-2 col-form-label">名稱</label>
                    <div class="col-sm-10">
                        <input type="text" id="Input_name" class="form-control necessary" name="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Select_type" class="col-sm-2 col-form-label">種類</label>
                    <div class="col-sm-10">
                        <select id="Select_type" class="form-select necessary" name="type">
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
                                name="hidden" value="1">
                            <label class="form-check-label" for="Input_hide">
                                隱藏帳戶
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <button type="button" id="Btn_submit" class="btn btn-primary px-3"
                            onclick="formSubmit(this)">
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
        let accountData = [];
        // 頁面初始化
        window.onload = function() {
            getAccountList();
        }
        // 取得資料
        function getAccountList() {
            const route = "{{ route('Account_List') }}";
            UtilSwal.showLoading();

            axios({
                url: route,
                method: "GET",
            }).then(function (response) {
                // handle success
                accountData = response['data']['account'];
                setAccountList(accountData);
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
        }
        // 渲染資料
        function setAccountList(data) {
            const accountTbody = document.querySelector('#Tbody_account');
            const rowTemplate = document.querySelector('#Template_account_row').content;
            let accountRow;
            accountTbody.textContent = "";
            if(data.length > 0) {
                for(let i=0; i<data.length; i++) {
                    accountRow = rowTemplate.cloneNode(true);
                    // 編號
                    accountRow.querySelector('.number').textContent = i+1;
                    // 種類
                    if(data[i]['type'] === 1) {
                        // 現金
                        accountRow.querySelector('.type .cash').classList.remove('d-none');
                    }
                    else if(data[i]['type'] === 2) {
                        // 銀行
                        accountRow.querySelector('.type .bank').classList.remove('d-none');
                    }
                    else if(data[i]['type'] === 3) {
                        // 卡片
                        accountRow.querySelector('.type .ticket-card').classList.remove('d-none');
                    }
                    // 名稱
                    accountRow.querySelector('.name').textContent = data[i]['name'];
                    // 金額
                    accountRow.querySelector('.balance').textContent = data[i]['balance'];
                    // 備註
                    accountRow.querySelector('.remark').textContent = data[i]['remark'];
                    // 狀態
                    if(data[i]['hidden']) {
                        accountRow.querySelector('.status .hide').classList.remove('d-none');
                    }
                    else {
                        accountRow.querySelector('.status .show').classList.remove('d-none');
                    }
                    // 操作按鈕
                    accountRow.querySelector('.edit').setAttribute('data-id', data[i]['id']);
                    accountRow.querySelector('.delete').setAttribute('data-id', data[i]['id']);
                    accountTbody.appendChild(accountRow);
                }
            }
            else {
                accountTbody.innerHTML = '<tr><td class="text-center" colspan="6">無帳戶資料</td></tr>';
            }
        }
        // 編輯帳戶
        function editAccount(el) {
            const accountId = el.getAttribute('data-id');
            let accountIndex;
            if(!accountId) {
                UtilSwal.submitFail();
                return;
            }
            accountIndex = accountData.findIndex(function(item) {
                return item['id'] === Number(accountId);
            });
            changePage('form');
            setAccountForm(accountIndex);
        }
        // 帶入帳戶資料
        function setAccountForm(index) {
            const form = document.querySelector('#Form_account');
            const account = accountData[index];
            form.querySelector('#Input_name').value = account['name'];
            form.querySelector('#Select_type').value = account['type'];
            form.querySelector('#Input_amount').value = account['amount'];
            form.querySelector('#Textarea_remark').value = account['remark'];
            form.querySelector('#Input_hide').checked = account['hidden'];
            form.querySelector('#Btn_submit').setAttribute('data-index', index);
        }
        // 刪除帳戶
        function deleteAccount(el) {
            const accountId = el.getAttribute('data-id');
            let accountIndex;
            if(!accountId) {
                UtilSwal.submitFail();
                return;
            }
            accountIndex = accountData.findIndex(function(item) {
                return item['id'] === Number(accountId);
            });

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
                    if(accountIndex === -1) {
                        UtilSwal.showFail('找不到資料', '請重整頁面');
                        return;
                    }
                    accountData.splice(accountIndex, 1);
                    setAccountList(accountData);
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
        // 切換頁面
        function changePage(page) {
            resetAccountForm();
            if(page === 'list') {
                document.querySelector('#Div_account_list').classList.remove('d-none');
                document.querySelector('#Div_account_form').classList.add('d-none');
            }
            else if(page === 'form') {
                document.querySelector('#Div_account_list').classList.add('d-none');
                document.querySelector('#Div_account_form').classList.remove('d-none');
            }
        }
        // 清空表單
        function resetAccountForm() {
            document.querySelector('#Input_name').value = "";
            document.querySelector('#Select_type').value = "";
            document.querySelector('#Input_amount').value = "";
            document.querySelector('#Textarea_remark').value = "";
            document.querySelector('#Input_hide').checked = false;
            document.querySelector('#Btn_submit').removeAttribute('data-index');
        }
        // 表單提交
        function formSubmit(el) {
            const index = el.getAttribute('data-index');
            // validation
            if(validateForm()) {
                UtilSwal.formSubmit({}, function () {
                    const createRoute = "{{ route('Create_Account') }}";
                    const updateRoute = "{{ route('Update_Account', 'accountId') }}";
                    let route = createRoute;
                    const form = document.querySelector('#Form_account');
                    let postData = new FormData(form);
                    if(index) {
                        route = updateRoute.replace('accountId', accountData[index]['id']);
                        postData.append('_method', 'PUT');
                    }

                    axios({
                        url: route,
                        method: "POST",
                        data: postData,
                    }).then(function (response) {
                        // handle success
                        UtilSwal.showSuccess(response['data']['message']);
                        if(index) {
                            accountData[index] = response['data']['account'];
                        }
                        else {
                            accountData.push(response['data']['account']);
                        }
                        setAccountList(accountData);
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
    </script>
@endsection