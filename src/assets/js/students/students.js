$('#datatable tbody').on("click", "tr", function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        $("#datatable tr").removeClass("active");
        $(this).addClass("active");
        $("#update").prop("disabled", false);
        $("#barcode").prop("disabled", false);
    }
});

$('#register').on('click', function () {
    $('#student_id').val('');
    $("#sendUpdate").hide();
    $("#sendRegister").show();
    $('#modalArea_register').fadeIn();
});

$("#update").on("click", function () {
    let row = $('#datatable').DataTable().rows('.active').data();
    let name = row[0].student_name.split(' ');
    let kana = row[0].student_kana.split(' ');
    let array = {
        'name[0]': name[0],
        'name[1]': name[1],
        'kana[0]': kana[0],
        'kana[1]': kana[1],
        'tel': row[0].student_tel,
        'email': row[0].student_email,
        'zip_code': row[0].student_zipcode,
        'address': row[0].student_streetaddress
    };
    $.each(array, function (index, value) {
        $('input[name="' + index + '"]').val(value);
    });
    $('#student_id').val(row[0].student_id);
    $('#modal_title').text('生徒情報更新');
    $("#sendUpdate").show();
    $("#sendRegister").hide();
    $('#modalArea_register').fadeIn();
});

$("#barcode").on("click", function () {
    let data = $('#datatable').DataTable().row('.active').data();
    window.open('http://localhost/tech_isys/students/create_barcode?barcode=' + data.student_barcode + '&name=' + data.student_name)
});

$(function () {
    $('#datatable').DataTable({
        scrollX: false,
        columnDefs: [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            },
            {
                "targets": 1,
                "visible": false,
                "searchable": false
            }
        ],
        data: students_json,
        columns: [
            { 'data': "student_id" },
            { 'data': "student_barcode" },
            { 'data': "student_name" },
            { 'data': "student_kana" },
            { 'data': "student_tel" },
            { 'data': "student_email" },
            { 'data': "student_zipcode" },
            { 'data': "student_streetaddress" }
        ]
    });
});

$('#form').on('submit', function (e) {
    e.preventDefault();
    let form = $('#form').serializeArray();
    var param = {};
    for (let i = 0; i < form.length; i++) {
        param[form[i]['name']] = form[i]['value'];
    }
    var type = 'POST';
    if ($('#student_id').val() === '') {
        var url = 'students/register_student';
    } else {
        param['student_id'] = $('#student_id').val();
        var url = 'students/update_student';
    }
    xhr_connect(type, url, param);
});

$("#sendUpdateData").on("click", function () {
    let form = $('#form').serializeArray();
    let param = {};
    for (let i = 0; i < form.length; i++) {
        param[form[i]['name']] = form[i]['value'];
    }
    param['student_id'] = $('student_id').val();
    let type = 'POST';
    let url = 'students/update_student';
    xhr_connect(type, url, param);
});

$('#zip-search').on('click', function () {
    $.ajax({
        url: 'http://zipcloud.ibsnet.co.jp/api/search',
        type: 'GET',
        cache: false,
        data: { zipcode: $('input[name="zip_code"]').val() },
        dataType: "jsonp",
    }).then(
        function (data) {
            $('input[name="address"]').val(data['results'][0]['address1'] + data['results'][0]['address2'] + data['results'][0]['address3']);
        },
        function (error) {
            console.log(error);
        })
});

//カスタマー登録の×のイベント
$('.modalBg, .closeModal, #P_cancel').on('click', function () {
    $('.modalArea').fadeOut();//モーダルエリアを閉じる
    $('label' + '.error').remove();
    $('.form-line').removeClass('error');
});