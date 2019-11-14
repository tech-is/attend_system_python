$('#sign_up').on('submit', function () {
    param = {
        shop_name: $('input[name="name[0]"]').val() + " " + $('input[name="name[1]"]').val(),
        shop_kana: $('input[name="kana[0]"]').val() + " " + $('input[name="kana[1]"]').val(),
        shop_tel: $('input[name="tel"]').val(),
        shop_email: $('input[name="email"]').val(),
        shop_zip_code: $('input[name="zip_code"]').val(),
        shop_address: $('input[name="zip_address[0]"]').val() + $('input[name="zip_address[1]"]').val() + $('input[name="zip_address[2]"]').val(),
        shop_password: $('input[name="password"]').val(),
        shop_confirm_pass: $('input[name="confirm_pass"]').val()
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '//animarl.com/register/register',
        type: 'POST',
        data: param,
        datatype: JSON
    }).then(
        function (data) {
            let json = JSON.parse(data);
            // console.log(json);
            process_callback(json);
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
        })
    return false;

});

function process_callback(json) {
    $('label' + '.error').remove();
    $('.form-line').removeClass('error')
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: val,
                    text: 'ボタンをクリックして画面を閉じてください',
                    icon: 'success',
                    button: {
                        text: 'OK',
                        value: true
                    },
                }).then(function () {
                    location.reload();
                });
                break;
            case 'error':
                swal({
                    title: '送信に失敗しました...',
                    text: val,
                    icon: 'warning',
                    button: {
                        text: 'OK',
                        value: true,
                    },
                });
                break;
            case 'valierr':
                $.each(val, function (name, text) {
                    $('#' + name).parents('.form-line').addClass('error')
                    let parent = $('#' + name).parents('.input-group');
                    parent.append('<label class="error">' + text + '</label>');
                    $('#' + name).focus();
                });
                break;
            default:
                break;
        }
    });
}