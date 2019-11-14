$('#form').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/password_reset',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'reset-password': $('#reset-password').val(),
            'reset-token': $('#reset-token').val(),
            'confirm-password': $('#confirm-password').val()
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