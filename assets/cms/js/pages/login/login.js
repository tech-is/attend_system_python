function show_prov_register() {
    $('#login').hide();
    $('#forgot-password').hide();
    $('#prov-register').show();
}

function show_login() {
    $('#prov-register').hide();
    $('#forgot-password').hide();
    $('#login').show();
}

function forgot_password() {
    $('#prov-register').hide();
    $('#login').hide();
    $('#forgot-password').show();
}

$('#login').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/login',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'login-email': $('#login-email').val(),
            'login-password': $('#login-password').val()
        },
        dataType: 'json'
    }).then(
        function (data) {
            process_callback(data)
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK'
                },
            })
        });
    return false;
});

$('#prov-register').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/prov_register',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'prov-email': $('#prov-email').val(),
        },
        dataType: 'json'
    }).then(
        function (data) {
            // console.log(data);
            process_callback(data);
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK',
                    value: true
                },
            })
        });
    return false;
});

$('#forgot-password').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/send_token_for_reset',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'forgot-email': $('#forgot-email').val(),
        },
        datatype: JSON
    }).then(
        function (data) {
            // console.log(data);
            process_callback(data);
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK',
                    value: true
                },
            })
        });
    return false;
});

// function process_callback(json) {
//     $('label' + '.error').remove();
//     $('.form-line').removeClass('error')
//     $.each(json, function (index, val) {
//         switch (index) {
//             case 'success':
//                 swal({
//                     title: val,
//                     text: 'ボタンをクリックして画面を閉じてください',
//                     icon: 'success',
//                     button: {
//                         text: 'OK',
//                         value: true
//                     },
//                 }).then(function () {
//                     location.reload();
//                 });
//                 break;
//             case 'error':
//                 console.log(val);
//                 swal({
//                     title: val.title,
//                     text: val.msg,
//                     icon: 'warning',
//                     button: {
//                         text: 'OK',
//                         value: true,
//                     },
//                 });
//                 break;
//             case 'valierr':
//                 $.each(val, function (name, text) {
//                     $('#' + name).parents('.form-line').addClass('error')
//                     let parent = $('#' + name).parents('.input-group');
//                     parent.append('<label class="error">' + text + '</label>');
//                     $('#' + name).focus();
//                 });
//                 break;
//             default:
//                 break;
//         }
//     });
// }