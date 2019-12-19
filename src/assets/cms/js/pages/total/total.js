//datatable
$(function () {
    $('#datatable').DataTable({
        'responsive': true,
        'searching': true,
        'paging': true,
        'columnDefs': [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            }
        ]
    });
});

// カスタマーデータ登録

$('#register').on('click', function () { //顧客登録 ボタンタグにid
    $('#img > img').css({ 'width': '', 'height': '' });
    $('#img > img').attr('src', '');
    $("#sendUpdateData").hide(); //顧客登録画面内の更新ボタン
    $("#send_register").show(); //顧客登録画面内の登録ボタン
    $('#modalArea_register').fadeIn();//モーダルエリアそのもの
});
//カスタマー登録の×のイベント
$('#modalBg_register, #C_cancel, #P_cancel').on('click', function () {
    $('#modalArea_register').fadeOut();//モーダルエリアを閉じる
});

$('#send_register').on('click', function () { //顧客登録画面内の登録ボタンをクリック時
    let fd = new FormData($('#total_form_data').get(0));
    $.ajax({
        url: '../Cl_total_list/insert_total_data',
        type: 'POST',
        dataType: "text",
        processData: false,
        contentType: false,
        data: fd
    })
        .done(function (data, textStatus, jqXHR) {
            if (data == "success") {
                SweetAlertMessage("success_register");
                console.log(data);
            } else {
                SweetAlertMessage("failed_register");
                console.log(data);
                // location.reload();
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            SweetAlertMessage("failed_register");
            console.log(data);
        });
});

/******************************************************************** */
/** グループ項目削除 **/
/******************************************************************** */
$(function () {
    $("#delete_group_register").on("click", function () {
        // var selectedRows = $('#select_1').DataTable().rows('.active').data();
        SweetAlertMessage("confirm_kind_group_delete");
    });
});

function kind_group_delete() {
    var param = {
        kind_group_id: $("#select_1").val()
    }
    $.ajax({
        url: "../Cl_total_list/delete_kind_group",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == 1) {
            SweetAlertMessage("success_delete");
        } else {
            SweetAlertMessage("failed_delete");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_register");
    });
}

$(function () {
    //グループ登録ボタンをクリック時
    $('#group_register').on('click', function () {

        let param = { kind_group_name: $('#select_group').val() }
        $.ajax({
            url: '../Cl_total_list/insert_kind_group',
            type: 'POST',
            data: param
        })
            .done(function (data, textStatus, jqXHR) {
                if (data == "success") {
                    SweetAlertMessage("success_register");
                    console.log(data);
                } else {
                    SweetAlertMessage("failed_register");
                    console.log(data);
                    // location.reload();
                }
            })
            .fail(function (data, textStatus, errorThrown) {
                // SweetAlertMessage("failed_register");
                console.log(data);
            });
    });

    // ペットデータ登録
    // $('#register2').on('click', function(){
    //     $('#modalPetArea').fadeIn();
    //     return false;
    // });
    // $('#modalPetBg, #P_cancel').on('click', function(){
    //     $('#modalPetArea').fadeOut();
    //     return false;
    // });

    // $('#sendPetData').on('click', function(){
    //     let param = {
    //         pet_name : $("input[name='pet_name']").val(),
    //         pet_classification : $("input[name='pet_classification']").val(),
    //         pet_type : $("input[name='pet_type']").val(),
    //         pet_animal_gender : $("[name='pet_animal_gender']:checked").val(),
    //         pet_contraception : $("[name='pet_contraception']:checked").val(),
    //         pet_body_height : $("input[name='pet_body_height']").val(),
    //         pet_body_weight : $("input[name='pet_body_weight']").val(),
    //         pet_birthday : $("input[name='pet_birthday']").val(),
    //         pet_last_reservdate : $("input[name='pet_last_reservdate']").val(),
    //         pet_information : $("textarea[name='pet_information']").val()

    //     }
    //     $.ajax({
    //         url: '../Cl_pet_info/pet_info_validation',
    //         type: 'POST',
    //         data: param
    //     })
    //     .done(function(data, textStatus, jqXHR) {
    //         // alert("success!");
    //         console.log(data);
    //         location.reload();
    //     })
    //     .fail(function(data, textStatus, errorThrown) {
    //         console.log(data);
    //     })
    // });
    //予約登録
    $('#register3').on('click', function () { //予約登録ボタンを押したら
        $('#modalReserveArea').fadeIn();
    });
    //予約登録で×を押したときのイベント
    $('#modalBg_register, #R_cancel').on('click', function () {
        $('#modalReserveArea').fadeOut();
    });
    //ポスト値
    $('#sendResisterReserve').on('click', function () {
        let param = {
            pet_name: $('#pet_name').val(),
            reserve_start: $('#reserve_start').val()
        }
        //投げる
        $.ajax({
            url: '../cl_reserve/register_reserve_data',
            type: 'POST',
            data: param
        })
            //成功したとき
            .done((data) => {
                if (data == "success") {
                    SweetAlertMessage("success_register");
                    console.log(data);
                } else {
                    SweetAlertMessage("failed_register");
                    console.log(data);
                    // location.reload();
                }
            })
            //失敗したとき
            .fail((data) => {
                SweetAlertMessage("failed_register");
                console.log(data);
            });
    });

    /*************************************************************************** */
    /** Total更新 **/
    /*************************************************************************** */
    // テーブル行クリックの設定 id=データテーブル tbody要素に対して
    $('#datatable tbody').on("click", "tr", function () {
        if ($(this).find('.dataTables_empty').length == 0) {
            var owner = $(this);
            $("#datatable tr").removeClass("active");
            owner.addClass("active");
            $("#register3").prop("disabled", false); //予約ボタン
            $("#register4").prop("disabled", false); //更新ボタン false で既存のdiabledを外す。
        }
    });

    //更新ボタンを押す、押した後のイベント
    $('#register4').on("click", function () { //更新ボタン
        let row = $('#datatable').DataTable().rows('.active').data(); //pet_idの情報の取得
        let pet_id = row[0][0];
        // console.log(column);
        $.ajax({
            url: '../cl_total_list/get_total_all_data',
            type: 'POST',
            data: {
                id: pet_id
            }
        })
            //成功したとき、返ってきたデータ
            .done((data) => {
                $("#sendUpdateData").show();
                $("#send_register").hide();
                $("input[name='customer_name']").val(data['customer_name']);
                $("input[name='customer_kana']").val(data['customer_kana']);
                $("input[name='customer_mail']").val(data['customer_mail']);
                $("input[name='customer_tel']").val(data['customer_tel']);
                $("input[name='customer_zip_adress']").val(data['customer_zip_adress']);
                $("input[name='customer_address']").val(data['customer_address']);
                $("[name='customer_magazine']:checked").val(data['customer_magazine']);
                $("textarea[name='customer_add_info']").val(data['customer_add_info']);
                if (data['pet_img'] !== "") {
                    $('#img').children('img').attr('src', data['pet_img']);
                    $('#img > img').css({ 'width': '100px', 'height': '100px' });
                }
                $("#customer_id").val(data['customer_id']);
                $("#pet_id").val(data['pet_id']);
                $("input[name='pet_name']").val(data['pet_name']);
                $("input[name='pet_classification']").val(data['pet_classification']);
                $("input[name='pet_type']").val(data['pet_type']);
                $("[name='pet_animal_gender']:checked").val(data['pet_animal_gender']);
                $("[name='pet_contraception']:checked").val(data['pet_contraception']);
                $("input[name='pet_body_height']").val(data['pet_contraception']);
                $("input[name='pet_body_weight']").val(data['pet_body_weight']);
                $("input[name='pet_birthday']").val(data['pet_birthday']);
                $("input[name='pet_last_reservdate']").val(data['pepet_informationt_last_reservdate']);
                $("textarea[name='pet_information']").val(data['pet_information']);
                $('#modalArea_register').fadeIn();
            })
            //失敗したとき
            .fail((data) => {
                alert("失敗しました");
            })
    })
});

$("#sendUpdateData").on("click", function () {
    let fd = new FormData($('#total_form_data').get(0));
    // for (let value of fd.entries()) {
    //     console.log(value);
    // }
    // return false;
    fd.append("customer_id", $("#customer_id").val());
    fd.append("pet_id", $("#pet_id").val());
    $.ajax({
        url: '../Cl_total_list/update_total_data',
        type: 'POST',
        processData: false,
        contentType: false,
        data: fd
    })
        .done(function (data, textStatus, jqXHR) {
            if (data == "success") {
                SweetAlertMessage("success_register");
            } else {
                SweetAlertMessage("failed_register");
                console.log(data);
                // location.reload();
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            SweetAlertMessage("failed_register");
            console.log(data);
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
        confirm_kind_group_delete: {
            title: "削除しますか？",
            icon: "warning",
            buttons: {
                OK: {
                    text: "OK",
                    value: "kind_group_delete",
                    closeModal: "false"
                },
                Cancel: {
                    text: "Cancel",
                    value: "false"
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
            case "kind_group_delete":
                kind_group_delete();
                break;
        }
    })
}

$(function () {
    $("#reserve_start").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
    $("#reserve_end").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
});

$(function () {
    $('#files').on("change", function () { // upするinputのID
        let file = $(this).prop('files')[0];
        if ($(this).prop('files')[0] === "undefined") {
            // if (!file.type.match('image.*')) { //こちらでjpg フィルタ処理
            $(this).val('');
            $('#img > img').css({ 'width': '', 'height': '' });
            $('#img > img').attr('src', '');
            return;
        } else {
            let reader = new FileReader();
            reader.onload = function () {//OKならこちらでリサイズ処理して表示
                $('#img > img').css({ 'width': '100px', 'height': '100px' });
                $('#img > img').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        }
    });
});