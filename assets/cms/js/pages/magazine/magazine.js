/******************************************************************** */
/** 顧客一覧テーブル */
/******************************************************************** */
$(function () {
    $('#datatable').DataTable({
        'paging': true,
        'pageLength': 5,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'tabIndex': -1,
        'order': [[0, 'asc']],
        'colReorder': true,
        'data': total,
        'columns': [
            { 'data': 'customer_id' },
            { 'data': 'pet_id' },
            { 'data': 'customer_name' },
            { 'data': 'pet_name' },
            { 'data': 'customer_tel' },
            { 'data': 'customer_mail' },
            { 'data': 'kind_group_name' }
        ],
        columnDefs: [
            {
                'targets': 0,
                'visible': false,
                'searchable': false
            },
            {
                'targets': 1,
                'visible': false,
                'searchable': false
            }
        ],
        'language': {
            'decimal': '.',
            'emptyTable': '表示するデータがありません。',
            'info': '_START_ ～ _END_ / _TOTAL_ 件中',
            'infoEmpty': '0 ～ 0 / 0 件',
            'infoFiltered': '(合計 _MAX_ 件からフィルタリングしています)',
            'infoPostFix': '',
            'thousands': ',',
            'lengthMenu': '1ページ _MENU_ 件を表示する',
            'loadingRecords': '読み込み中...',
            'processing': '処理中...',
            'search': '絞り込み:',
            'zeroRecords': '一致するデータが見つかりません。',
            'paginate': {
                'first': '最初',
                'last': '最後',
                'next': '次',
                'previous': '前'
            }
        }
    });
});

/******************************************************************** */
/** メールリスト生成 */
/******************************************************************** */
$('.list-group-item').on('click', function () {
    $('.list-group-item').removeClass('active');
    $(this).addClass('active');
    let index = $('.list-group-item').index(this);
    if (mail_json[index]['mail_sender_name'] === "未登録") {
        $("#send, #update, #delete").prop('disabled', true);
    } else {
        $("#send, #update, #delete").prop('disabled', false);
        $("#update, #delete").val(mail_json[index]['mail_magazine_id']);
    }
    $('#sender').text(mail_json[index]['mail_sender_name']);
    $('#subject').text(mail_json[index]['mail_subject']);
    $('#sended_at').text(mail_json[index]['mail_sendend_at']);
    // content_value.replace(/\\r\\n|\\r|\\n/g, '<br>');
    $('.mail-body').html(mail_json[index]['mail_detail'].replace(/\n/g, "<br>"));
});

/******************************************************************** */
/** モーダルウィンドウ */
/******************************************************************** */

/** モーダル非表示 ****************************************************/
$('#cancel, .closeModal, .modalBg').on('click', function () {
    $('#modalArea_register, #modalArea_send').fadeOut();
});

/** マガジン登録画面 ****************************************************/
$('#register').on('click', function () {
    $('#modal_title').text('新規メールマガジン作成');
    $('#mail_sender_name').val('');
    $('#mail_subject').val('');
    $('#mail_detail').val('');
    $('#sendResister').show();
    $('#sendUpdate').hide();
    $('#modalArea_register').fadeIn();
});

/** マガジン更新画面 ****************************************************/
$('#update').on('click', function () {
    $('#modal_title').text('メールマガジン更新');
    $('#mail_sender_name').val($('#sender').text());
    $('#mail_subject').val($('#subject').text());
    $('#mail_detail').val($('.mail-body').html().replace(/<br>/g, "\n").trim());
    $('#sendResister').hide();
    $('#sendUpdate').show();
    $('#sendUpdate').val($("#update").val());
    $('#modalArea_register').fadeIn();
});

$('#send').on('click', function () {
    $('#modalArea_send').fadeIn();
});


/******************************************************************** */
/** Ajax */
/******************************************************************** */

/** マガジン登録 ********************************************************/
$('#form').on('submit', function () {
    $.ajax({
        url: 'cl_magazine/register_magazine',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dateType: JSON,
        data: {
            mail_sender_name: $('#mail_sender_name').val(),
            mail_subject: $('#mail_subject').val(),
            mail_detail: $('#mail_detail').val()
        }
    }).then(
        function (data) {
            SweetAlertMessage(data === 'success' ? 'success_register' : 'failed_register');
        },
        function () {
            SweetAlertMessage('failed_register');
        })
    return false;
});

/** マガジン更新 ****************************************************/
$('#sendUpdate').on('click', function () {
    $.ajax({
        url: 'cl_magazine/update_magazine',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dateType: JSON,
        data: {
            mail_magazine_id: $('#sendUpdate').val(),
            mail_sender_name: $('#mail_sender_name').val(),
            mail_subject: $('#mail_subject').val(),
            mail_detail: $('#mail_detail').val()
        }
    }).then(
        function (data) {
            SweetAlertMessage(data === 'success' ? 'success_update' : 'failed_update');
        },
        function () {
            SweetAlertMessage('failed_update');
        })
});

/** マガジン削除 ****************************************************/
$('#delete').on('click', function () {
    swal({
        title: '削除しますか？',
        icon: 'warning',
        buttons: {
            OK: {
                text: 'OK',
                value: true,
                closeModal: false
            },
            Cancel: {
                text: 'Cancel',
                value: false
            }
        }
    }).then((value) => {
        if (value === true) {
            $.ajax({
                url: 'cl_magazine/delete_magazine',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mail_magazine_id: $('#delete').val()
                }
            }).then(
                function (data) {
                    SweetAlertMessage(data === 'success' ? 'success_delete' : 'failed_delete');
                },
                function () {
                    SweetAlertMessage('failed_delete');
                });
        }
    })
});

/******************************************************************** */
/** SweetAlert  **/
/******************************************************************** */
function SweetAlertMessage(key) {
    let message_json = {
        success_register: {
            title: '登録が完了しました！',
            text: 'ボタンをクリックして画面を閉じてください',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
                visible: true,
                closeModal: true,
            },
        },
        failed_register: {
            title: '登録に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: true,
            },
        },
        success_update: {
            title: '更新が完了しました！',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
            }
        },
        failed_update: {
            title: '更新に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: false,
            },
        },
        success_delete: {
            title: '削除が完了しました！',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
            }
        },
        failed_delete: {
            title: '削除に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: false,
            }
        }
    }
    swal(message_json[key]);
}