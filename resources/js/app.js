import './bootstrap';

// Sweet Alert 套件引入
window.Swal = require('sweetalert2');
// 配置套件
window.Swal = Swal.mixin({
    allowOutsideClick: false,
    confirmButtonText: '關閉',
});

// Chart.js 套件引入
window.Chart = require('chart.js/auto').default;
