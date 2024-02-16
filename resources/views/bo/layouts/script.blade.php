<!-- Javascripts -->
<script src="/admin/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="/admin/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="/admin/assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="/admin/assets/js/main.min.js"></script>
<script src="/admin/assets/js/pages/dashboard.js"></script>

<!-- Notyf -->
<script src="/admin/assets/plugins/notyf/notyf.min.js"></script>

<script>

let sessionSuccess = @json(session('success'));
let sessionError   = @json(session('error'));

if (sessionSuccess != null){
const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    types: [
        {
            type: 'success',
            background: '#24b552',
            icon: {
                className: 'fa fa-check',
                tagName: 'span',
                color: '#fff'
            },
            dismissible: false
        }
    ]
});
notyf.open({
    type: 'success',
    message: sessionSuccess
});
}
if (sessionError != null){
const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    types: [
        {
            type: 'success',
            background: '#FA5252',
            icon: {
                className: 'fa fa-times',
                tagName: 'span',
                color: '#fff'
            },
            dismissible: false
        }
    ]
});
notyf.open({
    type: 'error',
    message: sessionError
});
}

</script>