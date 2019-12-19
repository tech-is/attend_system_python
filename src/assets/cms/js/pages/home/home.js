// $(function () {
//     if (result = SweetAlertMessage("success_register")) {
//         console.log(result);
//     }
// })

/******************************************************************** */
/*カレンダー */
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
        defaultView: 'listDay',
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
                content: start + " ~ " + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            let start = $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.start, 'HH:mm');
            let end = $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.end, 'HH:mm');
            $('#modal_title').text('予約更新・削除');
            $('#reserve_customer').val(eventObj.customer_name);
            $('#reserve_pet').val(eventObj.title);
            $('#start').val(start);
            $('#end').val(end);
            $("#reserve_pet_id").val(eventObj.reserve_pet_id);
            $('#sendUpdateReserve').val(eventObj.reserve_id);
            $('#modalArea_register').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            let day = $.fullCalendar.formatDate(date, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(date, 'HH:mm');
            $("#start").val(day);
            $('#modalArea_register').fadeIn();
        }
    });
});


$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        let owner = $(this);
        $("#datatable tr").removeClass("active");
        owner.addClass("active");
        let row = $('#datatable').DataTable().rows(owner).data()[0];
        $("#reserve_pet_id").val(row.pet_id);
        $("#reserve_customer").val(row.customer_name);
        $("#reserve_pet").val(row.pet_name);
    }
});


$('#sendResisterReserve').on('click', function () {
    $.ajax({
        url: ' cl_reserve/register_reserve_data',
        type: 'POST',
        data: {
            "reserve_pet_id": $('#reserve_pet_id').val(),
            "reserve_start": $('#start').val(),
            "reserve_end": $('#end').val(),
            "reserve_content": $('#reserve_content').val()
        }
    })
        .done((data) => {
            SweetAlertMessage("success_register") ? window.reload() : false;
        })
        .fail((data) => {
            alert("失敗しました");
        })
});

$('#sendUpdateReserve').on('click', function () {
    $.ajax({
        url: 'cl_reserve/get_reserve_data',
        type: 'POST',
        data: {
            "reserve_id": $('#sendUpdateReserve').val(),
            "reserve_pet_id": $('#reserve_pet_id').val(),
            "reserve_start": $('#start').val(),
            "reserve_end": $('#end').val(),
            "reserve_content": $('#reserve_content').val()
        }
    })
        .done((data) => {
            $('#modalArea').fadeOut();
            $('#modalArea_update').fadeIn();
        })
        .fail((data) => {
            alert("失敗しました");
        })
});

$('#closeModal , #modalBg').on('click', function () {
    $('#modalArea').fadeOut();
});

$('#closeModal_register , #modalBg_register').on('click', function () {
    $('#modalArea_register').fadeOut();
});

$('#register').on('click', function () {
    $('#modalArea_register').fadeIn();
});

$('#closeModal_update , #modalBg_update').on('click', function () {
    $('#modalArea_update').fadeOut();
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
                value: true,
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
                value: true,
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
        return value;
        // switch (value) {
        //     case "success":
        //         location.reload(true);
        //         break;
        //     case "shift_delete":
        //         return 1;
        //         break;
        //     case "staff_delete":
        //         staff_delete();
        //     case false:
        //         return false;
        // }
    })
}