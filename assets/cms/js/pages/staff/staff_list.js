/******************************************************************** */
/** flatpickr */
/******************************************************************** */
$(function () {
    $("input[name='shift_start']").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
    $("input[name='shift_end']").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
});

/******************************************************************** */
/** スタッフ一覧テーブル */
/******************************************************************** */
$(function () {
    $('#datatable').DataTable({
        'paging': true,
        'pageLength': 10,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'tabIndex': -1,
        'order': [[0, 'asc']],
        'colReorder': true,
        'data': table_json,
        'columns': [
            { 'data': "staff_id" },
            { 'data': "staff_name" },
            { 'data': "staff_tel" },
            { 'data': "staff_mail" },
            { 'data': "staff_color" },
            { 'data': "staff_remarks" },
        ],
        columnDefs: [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            },
            {
                "targets": 4,
                render: function (data, type, full, meta) {
                    return "<div style='background-color:" + data + "; width: 100%; height: 24px'></div>";
                }
            }
        ],
        'language': {
            'decimal': ".",
            'emptyTable': "表示するデータがありません。",
            'info': "_START_ ～ _END_ / _TOTAL_ 件中",
            'infoEmpty': "0 ～ 0 / 0 件",
            'infoFiltered': "(合計 _MAX_ 件からフィルタリングしています)",
            'infoPostFix': "",
            'thousands': ",",
            'lengthMenu': "1ページ _MENU_ 件を表示する",
            'loadingRecords': "読み込み中...",
            'processing': "処理中...",
            'search': "絞り込み:",
            'zeroRecords': "一致するデータが見つかりません。",
            'paginate': {
                'first': "最初",
                'last': "最後",
                'next': "次",
                'previous': "前"
            }
        }
    });
});
// テーブル行クリックの設定
$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        var owner = $(this);
        $("#datatable tr").removeClass("active");
        owner.addClass("active");
        $("#updateButton").prop("disabled", false);
        $("#deleteButton").prop("disabled", false);
    }
});

/******************************************************************** */
/*シフトカレンダー */
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
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: event_json,
        eventRender: function (eventObj, $el, calEvent) {
            var start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content: start + " ~ " + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            let start = $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.start, 'HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.end, 'HH:mm');
            update_shift_id = eventObj.shift_id
            $('#modal_shift_title').html("シフト更新・削除");
            $('#send_Update_shift').show();
            $('#send_Delete_shift').show();
            $('#register_add_shift').hide();
            $('#select_shift_staff').val(eventObj.staff_id);
            $('#shift_id').val(eventObj.shift_id);
            $('input[name="shift_start"]').val(start);
            $('input[name="shift_end"]').val(end);
            $('#modalArea_add_shift').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            $('#modal_shift_title').html("シフト登録");
            $('#register_add_shift').show();
            $('#send_Update_shift').hide();
            $('#send_Delete_shift').hide();
            let day = $.fullCalendar.formatDate(date, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(date, 'HH:mm');
            $("input[name='shift_start']").val(day);
            $('#modalArea_add_shift').fadeIn();
        }
    });
});

/******************************************************************** */
/** シフト登録 **/
/******************************************************************** */
function register_shift() {
    let param = {
        staff_id: $('#select_shift_staff').val(),
        shift_start: $("input[name='shift_start']").val(),
        shift_end: $("input[name='shift_end']").val()
    }
    $.ajax({
        url: "../Cl_shift/insert_shift",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == "success") {
            SweetAlertMessage("success_register");
        } else {
            SweetAlertMessage("failed_register");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_register");
    }).always(function () {
        return false;
    });
}


/******************************************************************** */
/** シフト更新*/
/******************************************************************** */
function update_shift() {
    var param = {
        shift_id: $('#shift_id').val(),
        staff_id: $('#select_shift_staff').val(),
        shift_start: $("input[name='shift_start']").val(),
        shift_end: $("input[name='shift_end']").val(),
    }
    $.ajax({
        url: "../cl_shift/update_shift_data",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == "success") {
            SweetAlertMessage("success_update");
        } else {
            SweetAlertMessage("failed_update");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_update");
    }).always(function () {
        return false;
    });
};

/******************************************************************** */
/* シフト削除 */
/******************************************************************** */
$("#send_Delete_shift").on("click", function () {
    SweetAlertMessage("confirm_delete")
});

function shift_delete() {
    var param = {
        shift_id: $('#shift_id').val()
    }
    $.ajax({
        url: "../Cl_shift/delete_shift_data",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == "success") {
            SweetAlertMessage("success_update");
            $("#modalArea_add_shift").fadeOut();
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("success_update");
    });
}

/******************************************************************** */
/*スタッフ一覧モーダル */
/******************************************************************** */
$('#staff_list').click(function () {
    $('#modalArea_staff_list').fadeIn();
});

$('#closeModal_staff_list, #modalBg_staff_list, #cancel_staff_list').click(function () {
    $('#modalArea_staff_list').fadeOut();
    if ($("tr").hasClass("active")) {
        $("tr").removeClass("active");
    }
    $("#updateButton").prop("disabled", true);
    $("#deleteButton").prop("disabled", true);
});

/******************************************************************** */
/** スタッフ追加モーダル */
/******************************************************************** */
$('#add_staff').click(function () {
    $('#modalArea_add_staff').fadeIn();
});

$('#closeModal_add_staff, #modalBg_add_staff, #cancel_add_staff').click(function () {
    $('#modalArea_add_staff').fadeOut();
    $("input[name='staff_name[0]']").val("");
    $("input[name= 'staff_name[1]']").val("");
    $("input[name='staff_tel']").val("");
    $("input[name='staff_email']").val("");
    $("input[name='staff_color']").val("");
    $("textarea[name='staff_remarks']").val("");
});

/******************************************************************** */
/** シフト追加モーダル */
/******************************************************************** */
$('#add_shift').click(function () {
    $('#modalArea_add_shift').fadeIn();
});

$('#closeModal_add_shift , #modalBg_add_shift, #cancel_add_shift').click(function () {
    $('#modalArea_add_shift').fadeOut();
    $('#select_shift_staff').val(0);
    $('input[name="shift_staff"]').val("");
    $('input[name="shift_start"]').val("");
    $('input[name="shift_end"]').val("");
});


/******************************************************************** */
/* スタッフ登録 */
/******************************************************************** */
$("#registButton").on("click", function () {
    $("#sendRegistButton").show();
    $("#sendUpdateButton").hide();
    $("#dialogTitle").html("スタッフ追加");
    $('#modalArea_add_staff').fadeIn();
});

$("#sendRegistButton").on("click", function () {
    $.ajax({
        url: "../Cl_staff/register_staff",
        type: "POST",
        data: {
            staff_name: $("input[name='staff_name[0]']").val() + " " + $("input[name= 'staff_name[1]']").val(),
            staff_tel: $("input[name='staff_tel']").val(),
            staff_email: $("input[name='staff_email']").val(),
            staff_color: $("input[name='staff_color']").val(),
            staff_remarks: $("textarea[name='staff_remarks']").val()
        },
    }).done(function (data) {
        if (data == "success") {
            SweetAlertMessage("success_register");
        } else {
            SweetAlertMessage("failed_register");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_register");
    });
});

/******************************************************************** */
/** スタッフ更新
/******************************************************************** */
$(function () {
    $('#datatable').DataTable().rows('.active').on("dblclick", function () {
        let row = $('#datatable').DataTable().rows('.active').data();
        let str = row[0].staff_name;
        row_staff_id = row[0].staff_id;
        let staff_name = str.split(' ');
        $("#dialogTitle").html("スタッフ更新");
        $("input[name='staff_name[0]']").val(staff_name[0]) + " " + $("input[name='staff_name[1]']").val(staff_name[1]);
        $("input[name='staff_tel']").val(row[0].staff_tel);
        $("input[name='staff_email']").val(row[0].staff_mail);
        $("input[name='staff_color']").val(row[0].staff_color);
        $("textarea[name='staff_remarks']").val(row[0].staff_remarks);
        $('#modalArea_add_staff').fadeIn();
        $('#sendRegistButton').hide();
        $('#sendUpdateButton').show();
    });

    $("#updateButton").on("click", function () {
        let row = $('#datatable').DataTable().rows('.active').data();
        let str = row[0].staff_name;
        row_staff_id = row[0].staff_id;
        let staff_name = str.split(' ');
        $("#dialogTitle").html("スタッフ更新");
        $("input[name='staff_name[0]']").val(staff_name[0]) + " " + $("input[name='staff_name[1]']").val(staff_name[1]);
        $("input[name='staff_tel']").val(row[0].staff_tel);
        $("input[name='staff_email']").val(row[0].staff_mail);
        $("input[name='staff_color']").val(row[0].staff_color);
        $("textarea[name='staff_remarks']").val(row[0].staff_remarks);
        $('#modalArea_add_staff').fadeIn();
        $('#sendRegistButton').hide();
        $('#sendUpdateButton').show();
    });

    $("#sendUpdateButton").on("click", function () {
        let param = {
            staff_id: row_staff_id,
            staff_name: $("input[name='staff_name[0]']").val() + " " + $("input[name='staff_name[1]']").val(),
            staff_tel: $("input[name='staff_tel']").val(),
            staff_email: $("input[name='staff_email']").val(),
            staff_color: $("input[name='staff_color']").val(),
            staff_remarks: $("textarea[name='staff_remarks']").val()
        }
        $.ajax({
            url: "../cl_staff/update_staff_list",
            type: "POST",
            data: param,
        }).done(function (data) {
            if (data == "success") {
                SweetAlertMessage("success_update");
            } else {
                SweetAlertMessage("failed_update");
            }
        }).fail(function (xhr, textStatus, errorThrown) {
            SweetAlertMessage("failed_register");
        });
    });
});
/******************************************************************** */
/** スタッフ削除  **/
/******************************************************************** */
$("#deleteButton").on("click", function () {
    SweetAlertMessage("confirm_staff_delete");
});

function staff_delete() {
    var selectedRows = $('#datatable').DataTable().rows('.active').data();
    var param = {
        staff_id: selectedRows[0].staff_id
    }
    $.ajax({
        url: "../cl_staff/delete_staff",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == "success") {
            SweetAlertMessage("success_delete");
        } else {
            SweetAlertMessage("failed_delete");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_register");
    });
}

/******************************************************************** */
/* jquery.validate */
/******************************************************************** */
$(function () {
    $("#form_shift").validate({
        rules: {
            shift_start: { required: true },
            shift_end: { required: true },
        },
        messages: {
            shift_start: { required: "入力してください。" },
            shift_end: { required: "入力してください。" },
        },
        highlight: function (input) {
            // console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form) {
            if ($("#shift_id").val() == "") {
                register_shift();
                return false;
            } else {
                update_shift();
                return false;
            }
        }
    });
});

$(function () {
    $("#form_shift").validate({
        rules: {
            shift_start: { required: true },
            shift_end: { required: true },
        },
        messages: {
            shift_start: { required: "入力してください。" },
            shift_end: { required: "入力してください。" },
        },
        highlight: function (input) {
            // console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form) {
            if ($("#shift_id").val() == "") {
                register_shift();
                return false;
            } else {
                update_shift();
                return false;
            }
        }
    });
});

/******************************************************************** */
/** SweetAlert  **/
/******************************************************************** */
function SweetAlertMessage(key) {
    let message_json = {
        success_register: {
            title: "登録が完了しました！",
            text: "ボタンをクリックして画面を閉じてください",
            icon: "success",
            button: {
                text: "OK",
                value: "success",
                visible: true,
                className: "",
                closeModal: true,
            },
        },
        failed_register: {
            title: "登録に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        success_update: {
            title: "更新が完了しました！",
            icon: "success",
            button: {
                text: "OK",
                value: true,
            }
        },
        failed_update: {
            title: "更新に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        success_delete: {
            title: "削除が完了しました！",
            icon: "success",
            button: {
                text: "OK",
                value: true,
            }
        },
        failed_delete: {
            title: "削除に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        confirm_delete: {
            title: "削除しますか？",
            icon: "warning",
            buttons: {
                OK: {
                    text: "OK",
                    value: "shift_delete",
                    closeModal: false
                },
                Cancel: {
                    text: "Cancel",
                    value: false
                }
            }
        },
        confirm_staff_delete: {
            title: "削除しますか？",
            icon: "warning",
            buttons: {
                OK: {
                    text: "OK",
                    value: "staff_delete",
                    closeModal: false
                },
                Cancel: {
                    text: "Cancel",
                    value: false
                }
            }
        }
    }
    let swal_data = message_json[key];
    swal(
        swal_data
    ).then((value) => {
        switch (value) {
            case "success":
                location.reload(true);
                break;
            case "shift_delete":
                shift_delete();
                break;
            case "staff_delete":
                staff_delete();
            case false:
                return false;
        }
    })
}