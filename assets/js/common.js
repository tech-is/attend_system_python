/**
 * ajaxを実行
 * 
 * @param {string} type 
 * @param {string} path 
 * @param {string} param 
 */
function xhr_connect(type, path, param) {
    $.ajax({
        type: type,
        url: '//localhost/tech_isys/' + path,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: param
    })
        .done(function (data) {
            process_callback(data)
        })
        .fail(function (jqXHR) {
            switch (jqXHR.status) {
                case 403:
                    forbidden_callback();
                    break;
                case 500:
                    systemerr_callback();
                    break;
            }
        })
    // }).then(
    //     function (data) {
    //         process_callback(data)
    //     }
    // ).catch((...args) => {
    //     const [jqXHR, textStatus, errorThrown] = args;
    //     switch (jqXHR.status) {
    //         case 403:
    //             forbidden_callback();
    //             break;
    //         case 500:
    //             systemerr_callback();
    //             break;
    //     }
    // })
}

function systemerr_callback() {
    swal({
        title: 'システムエラー',
        text: 'また後ほどお試しください',
        icon: 'warning',
        button: {
            text: 'OK'
        }
    })
}

function forbidden_callback() {
    swal({
        title: 'アクセスエラー',
        text: 'このページを再読み込みしてからまた送信してください',
        icon: 'warning',
        button: {
            text: 'OK'
        }
    })
}

function process_callback(json) {
    $('label' + '.error').remove();
    $('.form-line').removeClass('error');
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: val.title,
                    text: val.msg,
                    icon: 'success',
                    button: {
                        text: 'OK',
                        value: true
                    },
                }).then(function () {
                    location.reload();
                });
                break;
            case 'sound':
                $('#barcode').val('');
                swal({
                    title: val.title,
                    text: val.msg,
                    icon: 'success',
                    timer: 1000,
                    button: false
                });
                break;
            case 'error':
                swal({
                    title: val.title,
                    text: val.msg,
                    icon: 'warning',
                    button: {
                        text: 'OK',
                        value: true,
                    },
                });
                break;
            case 'error-1':
                $('#barcode').val('');
                swal({
                    title: val.title,
                    text: val.msg,
                    icon: 'warning',
                    timer: 1000,
                    button: false
                });
                break;
            case 'valierr':
                $.each(val, function (index, text) {
                    // if ($('#' + id).parents('.form-line').addClass('error')) {
                    //     let parent = $('#' + id).parents('.input-group');
                    //     parent.append('<label class="error">' + text + '</label>');
                    //     $('#' + id).focus();
                    let input = $('input[name="' + index + '"]');
                    input.parents('.form-line').addClass('error');
                    input.parents('.form-group').append('<label class="error">' + text + '</label>');
                    input.focus();
                });
                break;
            default:
                break;
        }
    });
}

// function PlaySound() {
//     audioElem = new Audio();
//     audioElem.src = "//localhost/tech_isys/assets/sounds/waows.mp3";
//     audioElem.play();
// }