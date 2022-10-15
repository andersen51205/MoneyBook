// 驗證紅框提示清除
window.resetValidMark = (section = document) => {
    const validMarks = section.querySelectorAll('.is-invalid');
    const customValidMarks = section.querySelectorAll('.custom-invalid');
    for(let i=0; i<validMarks.length; i++) {
        validMarks[i].classList.remove('is-invalid');
    }
    for(let i=0; i<customValidMarks.length; i++) {
        customValidMarks[i].classList.remove('custom-invalid');
    }
};
// 表單驗證
window.validateForm = (section = document, isShowAlert = true) => {
    let failedCount = 0;
    resetValidMark(section);
    // 必填驗證
    failedCount += validateFormInput(section);
    failedCount += validateFormCheckbox(section);
    if(failedCount > 0 && isShowAlert) {
        UtilSwal.showFail('請確實填寫所有必填欄位!', '(有加*號的項目)');
        return false;
    }
    // 格式驗證
    failedCount += validateFormEmail(section, isShowAlert);
    failedCount += validateFormPassword(section, isShowAlert);
    return failedCount === 0;
}
// Input驗證
function validateFormInput(section) {
    const inputs = section.querySelectorAll('.necessary');
    let failedCount = 0;
    for(let i=0; i<inputs.length; i++) {
        if(!inputs[i].value) {
            inputs[i].classList.add('is-invalid');
            failedCount++;
        }
    }
    return failedCount;
}
// Checkbox驗證
function validateFormCheckbox(section) {
    const checkboxesGroup = section.querySelectorAll('.necessaryCheckbox');
    let failedCount = 0;
    for(let i=0; i<checkboxesGroup.length; i++) {
        if(!checkboxesGroup[i].querySelector('input:checked')) {
            checkboxesGroup[i].classList.add('custom-invalid');
            failedCount++;
        }
    }
    return failedCount;
}
// Email驗證
function validateFormEmail(section, isShowAlert) {
    const emails = section.querySelectorAll('input[type=email]');
    const emailRegExp = /[\w-]+@([\w-]+\.)+[\w-]+/;
    let failedCount = 0;
    for(let i=0; i<emails.length; i++) {
        if(!emailRegExp.test(emails[i].value)) {
            emails[i].classList.add('is-invalid');
            failedCount++;
        }
    }
    if(failedCount > 0 && isShowAlert) {
        UtilSwal.showFail("電子郵件信箱格式錯誤");
    }
    return failedCount;
}
// 密碼驗證
function validateFormPassword(section, isShowAlert) {
    const passwords = section.querySelectorAll('input[type=password]');
    let failedCount = 0;
    for(let i=0; i<passwords.length; i++) {
        if(passwords[i].value.length < 8) {
            passwords[i].classList.add('is-invalid');
            failedCount++;
        }
    }
    if(failedCount > 0 && isShowAlert) {
        UtilSwal.showFail("密碼長度過短", "(至少8字元)");
    }
    return failedCount;
}
// 確認密碼驗證
window.validatePasswordConfirmation = (section = document, isShowAlert = true) => {
    const password = section.querySelector('input[name=password]');
    const passwordConfirm = section.querySelector('input[name=password_confirmation]');
    if(password.value !== passwordConfirm.value) {
        password.classList.add('is-invalid');
        passwordConfirm.classList.add('is-invalid');
        if(isShowAlert) {
            UtilSwal.showFail('密碼確認不一致');
        }
        return false;
    }
    return true;
}
