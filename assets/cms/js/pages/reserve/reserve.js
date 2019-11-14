/******************************************************************** */
/** flatpickr */
/******************************************************************** */
$(function () {
    $('#start').flatpickr({
        minDate: 'today',
        enableTime: true,
        dateFormat: 'Y-m-dTH:i',
        time_24hr: true
    });

    $('#end').flatpickr({
        minDate: 'today',
        enableTime: true,
        dateFormat: 'Y-m-dTH:i',
        time_24hr: true
    });
});

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
/*予約カレンダー */
/******************************************************************** */
$(function () {
    $('#calendar').fullCalendar({
        height: window.innerHeight - 250,
        windowResize: function () {
            $('#calendar').fullCalendar('option', 'height', window.innerHeight - 220);
        },
        locale: 'ja',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true,
        editable: true,
        eventLimit: true,
        events: reserve,
        eventRender: function (eventObj, $el, calEvent) {
            var start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content: start + ' ~ ' + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            let start = $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.start, 'HH:mm');
            let end = $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.end, 'HH:mm');
            $('#sendResisterReserve').hide();
            $('#modal_title').text('予約更新・削除');
            $('#reserve_customer').val(eventObj.customer_name);
            $('#reserve_pet').val(eventObj.title);
            $('#start').val(start);
            $('#end').val(end);
            $('#reserve_customer_id').val(eventObj.reserve_customer_id);
            $('#reserve_pet_id').val(eventObj.reserve_pet_id);
            $('#sendUpdateReserve').val(eventObj.reserve_id);
            $('#modalArea_register, #sendUpdateReserve, #sendDeleteReserve').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            let start_day = $.fullCalendar.formatDate(date, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(date, 'HH:mm');
            let end_day = $.fullCalendar.formatDate(date, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(date, 'HH:mm');
            $('#start').val(start_day);
            $('#end').val(end_day);
            $('#modal_title').text('新規予約');
            $('#sendResisterReserve').show();
            $('#sendUpdateReserve, #sendDeleteReserve').hide();
            $('#modalArea_register').fadeIn();
        }
    });
});

/******************************************************************** */
/** ajax **/
/******************************************************************** */
function get_reserve_via_ajax() {
    $.ajax({
        url: ' cl_reserve/get_reserve_via_ajax',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    }).then(
        function (data) {
            // console.log(data);
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('addEventSource', data);
            $('#calendar').fullCalendar('rerenderEvents');
        },
        function (error) {
            // SweetAlertMessage('failed_register');
            console.log(error);
        })
}

$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        let owner = $(this);
        $('#datatable tr').removeClass('active');
        owner.addClass('active');
        let row = $('#datatable').DataTable().rows(owner).data()[0];
        $('#reserve_pet_id').val(row.pet_id);
        $('#reserve_pet_id').val(row.customer_id);
        $('#reserve_customer').val(row.customer_name);
        $('#reserve_pet').val(row.pet_name);
    }
});

$('#sendResisterReserve').on('click', function () {
    $.ajax({
        url: ' cl_reserve/register_reserve_data',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'reserve_customer_id': $('#reserve_customer_id').val(),
            'reserve_pet_id': $('#reserve_pet_id').val(),
            'reserve_start': $('#start').val(),
            'reserve_end': $('#end').val(),
            'reserve_content': $('#reserve_content').val(),
            'reserve_color': $('#color').val()
        }
    }).then(
        function (data) {
            SweetAlertMessage(data === 'success' ? 'success_register' : 'failed_register');
            get_reserve_via_ajax();

        },
        function () {
            SweetAlertMessage('failed_register');
        })
});

$('#sendUpdateReserve').on('click', function () {
    swal({
        title: '更新しますか？',
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
                url: 'cl_reserve/update_reserve_data',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'reserve_id': $('#sendUpdateReserve').val(),
                    'reserve_customer_id': $('#reserve_customer_id').val(),
                    'reserve_pet_id': $('#reserve_pet_id').val(),
                    'reserve_start': $('#start').val(),
                    'reserve_end': $('#end').val(),
                    'reserve_content': $('#reserve_content').val(),
                    'reserve_color': $('#color').val()
                }
            }).then(
                function (data) {
                    SweetAlertMessage(data === 'success' ? 'success_register' : 'failed_register');
                    get_reserve_via_ajax();
                },
                function () {
                    SweetAlertMessage('failed_update');
                });
        }
    })
});

$('#sendDeleteReserve').on('click', function () {
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
                url: 'cl_reserve/delete_reserve_data',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'reserve_id': $('#sendUpdateReserve').val(),
                }
            }).then(
                function (data) {
                    SweetAlertMessage(data === 'success' ? 'success_delete' : 'failed_delete');
                    get_reserve_via_ajax();
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

/******************************************************************** */
/*モーダル制御 */
/******************************************************************** */

$('#closeModal , #modalBg').on('click', function () {
    $('#modalArea').fadeOut();
});

$('#closeModal_register , #modalBg_register').on('click', function () {
    $('#modalArea_register').fadeOut();
});

$('#register').on('click', function () {
    $('#modal_title').text('新規予約');
    $('#sendResisterReserve').show();
    $('#sendUpdateReserve, #sendDeleteReserve').hide();
    $('#modalArea_register').fadeIn();
});

$('#closeModal_update , #modalBg_update').on('click', function () {
    $('#modalArea_update').fadeOut();
});

