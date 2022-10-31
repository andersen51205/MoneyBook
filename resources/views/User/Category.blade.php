@extends('layouts.Backstage')

@section('main')
    {{-- 麵包屑 --}}
    @include('layouts._Breadcrumb', ['root' => '類別管理'])
    <div id="Div_category_list">
        <div id="Div_category_tab" class="nav nav-pills justify-content-center fs-4 mb-4" role="tablist">
            <button type="button" id="Btn_expenditure" class="nav-link col-3 active"
                    v-on:click="changeTab(1)" data-bs-toggle="pill" role="tab">
                支出
            </button>
            <button type="button" id="Btn_income" class="nav-link col-3"
                    v-on:click="changeTab(2)" data-bs-toggle="pill" role="tab">
                收入
            </button>
        </div>
        <div id="Div_category_content" class="tab-content">
            <div class="d-flex justify-content-end my-3">
                <button type="button" class="btn btn-outline-primary"
                        onclick="changePage('create')">
                    <i class="fa-solid fa-plus"></i> 新增
                </button>
            </div>
            <table id="Table_category" class="table table-bordered text-center align-middle fs-5">
                <thead>
                    <tr class="table-secondary">
                        <th style="width:5%">編號</th>
                        <th style="width:20%">名稱</th>
                        <th style="width:10%">狀態</th>
                        <th style="width:10%">操作</th>
                    </tr>
                </thead>
                <tbody id="Tbody_category">
                    <tr v-if="listData !== undefined
                                && listData.length === 0">
                        <td class="text-center" colspan="6">無類別資料</td>
                    </tr>
                    <tr v-for="(listItem, index) in listData">
                        <td class="number" v-text="index + 1"></td>
                        <td class="text-start ps-3">
                            <div class="icon d-inline-block">
                                <span style="width: 45px"
                                        v-bind:class="`badge fs-3 bg-${colors[listItem.color]} bg-opacity-75 p-2`">
                                    <i v-bind:class="icons[listItem.icon]"></i>
                                </span>
                            </div>
                            <div class="name d-inline-block ms-2" v-text="listItem['name']"></div>
                        </td>
                        <td class="status">
                            <span class="hide" v-if="listItem['hidden']">
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
                                    v-bind:data-index="index">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger m-1 delete"
                                    v-bind:data-index="index" v-on:click="deleteCategory">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="Div_category_form" class="d-none">
        <div class="row justify-content-center">
            <form method="" action="" id="Form_category" class="col-11 col-md-6 mx-2 mx-md-4">
                <div class="row mb-3">
                    <label for="Select_type" class="col-sm-2 col-form-label">種類</label>
                    <div class="col-sm-10">
                        <select id="Select_type" class="form-select necessary"
                                name="type" v-model="categoryData['type']">
                            <option value="1">支出</option>
                            <option value="2">收入</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <span class="col-sm-2 col-form-label">圖示</span>
                    <div class="col-sm-8">
                        <span id="Span_icon" style="width: 45px;"
                                v-bind:class="`badge fs-3 bg-${colors[categoryData['color']]} bg-opacity-75 p-2`">
                            <i v-bind:class="icons[categoryData['icon']]"></i>
                        </span>
                    </div>
                    <div class="col-sm-2 text-end">
                        <button type="button" class="btn btn-secondary"
                                v-on:click="initIconModal">
                            選擇
                        </button>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Input_name" class="col-sm-2 col-form-label">名稱</label>
                    <div class="col-sm-10">
                        <input type="text" id="Input_name" class="form-control necessary"
                            name="name" v-model="categoryData['name']">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input type="checkbox" id="Input_hide" class="form-check-input"
                                name="hidden" value="1" v-model="categoryData['hidden']">
                            <label class="form-check-label" for="Input_hide">
                                隱藏
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
    {{-- 圖示Modal --}}
    <div id="Modal_choose_icon" class="modal fade" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">選擇圖示</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="p-2" v-for="(icon, index) in icons">
                            <input type="radio" v-bind:id="'Input_icon_' + index"
                                class="btn-check" name="icon" v-bind:value="index"
                                v-model="selected['icon']">
                            <label v-bind:class="`btn btn-outline-${colors[selected['color']]} opacity-75 fs-3`"
                                    v-bind:for="'Input_icon_' + index" style="width: 55px">
                                <i v-bind:class="icon"></i>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div class="p-2" v-for="(color, index) in colors">
                            <input type="radio" v-bind:id="'Input_color_' + index"
                                class="btn-check" name="color" v-bind:value="index"
                                v-model="selected['color']">
                            <label v-bind:class="`btn btn-outline-${color} opacity-75 fs-4`" v-bind:for="'Input_color_' + index" style="width: 50px">
                                <i class="fa-solid fa-check"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-on:click="saveIcon">儲存</button>
                    <button type="button" id="Btn_modal_cancel" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    const ICONS = [
        "fa-solid fa-utensils",
        "fa-solid fa-burger",
        "fa-solid fa-apple-whole",
        "fa-solid fa-car",
        "fa-solid fa-train-subway",
        "fa-solid fa-plane",
        "fa-solid fa-chess",
        "fa-solid fa-gamepad",
        "fa-solid fa-basketball",
        "fa-solid fa-house",
        "fa-solid fa-shirt",
        "fa-solid fa-socks",
        "fa-solid fa-heart",
        "fa-solid fa-bag-shopping",
        "fa-solid fa-book",
        "fa-solid fa-school",
        "fa-regular fa-credit-card",
        "fa-regular fa-hospital",
        "fa-solid fa-stethoscope",
        "fa-solid fa-file-invoice-dollar",
        "fa-solid fa-users",
        "fa-solid fa-computer",
        "fa-solid fa-mobile-screen-button",
        "fa-solid fa-sack-dollar",
        "fa-regular fa-money-bill-1",
        "fa-solid fa-circle-dollar-to-slot",
        "fa-solid fa-money-bill-trend-up",
        "fa-solid fa-piggy-bank",
        "fa-solid fa-hand-holding-dollar",
        "fa-solid fa-ellipsis",
    ];
    const COLORS = [
        "primary",
        "success",
        "danger",
        "warning",
        "info",
        "secondary",
        "dark",
    ];
    let categoryListVm, categoryFormVm, chooseIconVm;
    // 頁面初始化
    window.onload = function() {
        // 類別列表 Vue Model
        categoryListVm = Vue.createApp({
            data() {
                return {
                    icons: ICONS,
                    colors: COLORS,
                    expenditures: [],
                    incomes: [],
                    listData: [],
                }
            },
            mounted() {
                const route = "{{ route('Category_List') }}";
                UtilSwal.showLoading();

                axios({
                    url: route,
                    method: "GET",
                }).then(function (response) {
                    // handle success
                    categoryListVm.expenditures = response['data']['category']['expenditures'];
                    categoryListVm.incomes = response['data']['category']['incomes'];
                    categoryListVm.listData = categoryListVm.expenditures;
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
                // 切換種類
                changeTab(type) {
                    if(type === 1) {
                        this.listData = this.expenditures;
                    }
                    else if(type === 2) {
                        this.listData = this.incomes;
                    }
                    else {
                        this.listData = [];
                    }
                },
                // 刪除類別
                deleteCategory(event) {
                    const el = event.currentTarget;
                    const index = el.getAttribute('data-index');
                    let categoryId;
                    if(index) {
                        const type = this.listData[index]['type'];
                        categoryId = this.listData[index]['id'];
                        UtilSwal.formSubmit({
                            title: '是否確定刪除？'
                        }, () => {
                            let route = "{{ route('Delete_Category', 'categoryId') }}";
                            route = route.replace('categoryId', categoryId);
                            axios({
                                url: route,
                                method: "DELETE",
                            }).then(function (response) {
                                // handle success
                                UtilSwal.showSuccess('刪除成功');
                                // remove data
                                if(type === 1) {
                                    categoryListVm.expenditures.splice(index, 1);
                                }
                                else if(type === 2) {
                                    categoryListVm.incomes.splice(index, 1);
                                }
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
        }).mount('#Div_category_list');
        // 類別表單 Vue Model
        categoryFormVm = Vue.createApp({
            data() {
                return {
                    icons: ICONS,
                    colors: COLORS,
                    categoryData: {
                        "type": 1,
                        "icon": 0,
                        "color": 0,
                    },
                    categoryIndex: -1,
                }
            },
            methods: {
                initIconModal() {
                    const iconModal = new bootstrap.Modal('#Modal_choose_icon');
                    chooseIconVm.selected['icon'] = this.categoryData['icon'];
                    chooseIconVm.selected['color'] = this.categoryData['color'];
                    iconModal.show();
                },
                formSubmit() {
                    const categoryData = this.categoryData;
                    const categoryIndex = this.categoryIndex;
                    if(validateForm()) {
                        UtilSwal.formSubmit({}, function () {
                            const createRoute = "{{ route('Create_Category') }}";
                            const updateRoute = "{{ route('Update_Category', 'categoryId') }}";
                            let route = createRoute;
                            let method = "POST";
                            if(categoryIndex !== -1) {
                                route = updateRoute.replace('accountId', categoryData['id']);
                                method = "PUT";
                            }

                            axios({
                                url: route,
                                method: method,
                                data: categoryData,
                            }).then(function (response) {
                                // handle success
                                const category = response['data']['category'];
                                UtilSwal.showSuccess(response['data']['message']);
                                if(categoryIndex === -1) {
                                    if(category['type'] === 1) {
                                        categoryListVm.expenditures.push(category);
                                        document.querySelector('#Btn_expenditure').click();
                                    }
                                    else if(category['type'] === 2) {
                                        categoryListVm.incomes.push(category);
                                        document.querySelector('#Btn_income').click();
                                    }
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
        }).mount('#Div_category_form');
        // 選擇圖示 Vue Model
        chooseIconVm = Vue.createApp({
            data() {
                return {
                    icons: ICONS,
                    colors: COLORS,
                    selected: {
                        'icon': 0,
                        'color': 0,
                    }
                }
            },
            methods: {
                saveIcon() {
                    categoryFormVm.categoryData['icon'] = Number(this.selected['icon']);
                    categoryFormVm.categoryData['color'] = Number(this.selected['color']);
                    document.querySelector('#Btn_modal_cancel').click();
                }
            }
        }).mount('#Modal_choose_icon');
    }
    // 切換頁面
    function changePage(page) {
        // Reset Form
        categoryFormVm.categoryData = {
            "type": 1,
            "icon": 0,
            "color": 0,
        };
        categoryFormVm.categoryIndex = -1;
        if(page === 'list') {
            document.querySelector('#Div_category_list').classList.remove('d-none');
            document.querySelector('#Div_category_form').classList.add('d-none');
        }
        else if(page === 'create' || page === 'edit') {
            document.querySelector('#Div_category_list').classList.add('d-none');
            document.querySelector('#Div_category_form').classList.remove('d-none');
        }
    }
</script>
@endsection
