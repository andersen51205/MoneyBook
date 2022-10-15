const defaultText = (title, text) => {
    return {
        title,
        text
    };
};
const responseText = (message, description) => {
    return {
        title: message,
        text: description
    };
};

window.UtilSwal = {
    // 通用 Info
    showInfo: function(title = '系統提示', hintText = null) {
        Swal.fire({
            ...defaultText(title, hintText),
            icon: 'info',
            showConfirmButton: true,
        });
    },
    // 通用 Success
    showSuccess: function(title = '操作成功') {
        Swal.fire({
            ...defaultText(title, ''),
            icon: 'success',
            showConfirmButton: true,
        });
    },
    // 通用 Warning
    showWarning: function(title = '系統警告', hintText = null) {
        Swal.fire({
            ...defaultText(title, hintText),
            icon: 'warning',
            showConfirmButton: true,
        });
    },
    // 通用 Fail
    showFail: function(title = '操作失敗', hintText = null) {
        Swal.fire({
            ...defaultText(title, hintText),
            icon: 'error',
            showConfirmButton: true,
        });
    },
    // 用於表單驗證後呼叫
    formSubmit: function(options, cb) {
        Swal.fire({
            icon: 'warning',
            ...defaultText('是否確認送出？', ''),
            showCancelButton: true,
            cancelButtonColor: '#aaa',
            cancelButtonText: '取消',
            confirmButtonColor: '#d33',
            confirmButtonText: '確定',
            ...options,
        }).then(result => {
            if (result.isConfirmed) {
                UtilSwal.showLoading();
                cb();
            }
        });
    },
    // 等待 Loading 用
    showLoading: function(
        title = '資料處理中，請稍後',
        allowOutsideClick = false
    ) {
        Swal.fire({
            icon: 'info',
            ...defaultText(title, ''),
            showConfirmButton: false,
            showCloseButton: false,
            allowOutsideClick: allowOutsideClick,
            didOpen: () => {
                Swal.showLoading();
            },
        });
    },
    // 接續 Fetch 成功
    submitSuccess: function(options) {
        Swal.fire({
			icon: 'success',
            ...responseText('儲存成功', '自動重新載入頁面！'),
			confirmButtonText: '確定',
            ...options,
        }).then(result => {
            if (result.isConfirmed) {
                options?.redirectPage
                    ? window.location.assign(options.redirectPage)
                    : location.reload();
            }
        });
    },
    // 接續 Fetch 失敗
    submitFail: function(options) {
        Swal.fire({
			icon: 'error',
            ...defaultText(
                '🙏 抱歉，有東西出錯了',
                '請再操作一次，若問題持續發生請回報網站管理員處理!'
            ),
            ...options,
        });
    },
}
