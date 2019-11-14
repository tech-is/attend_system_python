<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 37px">本日の予定</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-deep-purple waves-effect" id="register">
                                新規予約
                            </button>
                        </div>
                    </div>
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modalArea_register" class="modalArea">
    <div id="modalBg_register" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents_register"></div>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
        <form action="" id="reserve">
            <div class="header clearfix" style="margin: 10px 0px">
                <h2 id="modal_title" class="pull-left" style="font-weight: bold; line-height: 37px; margin: 0px">新規予約</h2>
            </div>
            <div class="body">
                <table class="table table-bordered" id="datatable" style="width: 100%">
                    <thead>
                        <th>顧客ID</th>
                        <th>ペットID</th>
                        <th>顧客名</th>
                        <th>ペット名</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>グループ</th>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_customer">顧客名<span style="color: red; margin-left: 10px">必須</span> </label>
                                <input type="text" id="reserve_customer" class="form-control" placeholder="顧客名" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_pet">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="reserve_pet" class="form-control" placeholder="ペット名" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="start" class="form-control flatpickr-input" placeholder="開始日時" value="<?php echo date("Y-m-d")."T00:00" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="end" class="form-control flatpickr-input" placeholder="開始日時" value="<?php echo date("Y-m-d")."T00:00" ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="from_name">予約内容</label>
                        <textarea rows=2 id="reserve_content" class="form-control no-resize" name="content" placeholder="トリミング"></textarea>
                    </div>
                </div>
                <input type="hidden" id="reserve_pet_id">
                <button type="button" id="sendResisterReserve" class="btn bg-pink waves-effect">
                    登録
                </button>
                <button type="button" id="sendUpdateReserve" class="btn bg-pink waves-effect">
                    更新
                </button>
                <button type="button" id="sendDeleteReserve" class="btn bg-pink waves-effect">
                    削除
                </button>
                <button type="button" class="btn bg-orange waves-effect" style="margin-right: 10px">
                    キャンセル
                </button>
            </div>
        </form>
    </div>
</section>

<!-- モーダルエリアここまで -->

<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='<?php echo base_url(); ?>assets/cms/plugins/momentjs/moment.js'></script>

<!-- fullcalendar -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar-3.9.0/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar-3.9.0/locale-all.js"></script>

<!-- Bootstrap Core Js -->
<script src=" <?php echo base_url(); ?>assets/cms/plugins/bootstrap/js/bootstrap.js"> </script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/morrisjs/morris.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom Plugin Js -->
<script>
    let reserve = <?php echo $reserve?>;
</script>
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/cms/js/sidebar.js"></script> -->
<script src="<?php echo base_url(); ?>assets/cms/js/pages/home/home.js"></script>


<!-- <script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        locale: 'ja',
        header: {
        left: 'prev,next today',
        center: 'title',
        // right: 'month,basicWeek,basicDay'
        right: 'month,agendaWeek,ListWeek,listDay'
        },
        // timeFormat: 'HH:mm',
        defaultView: 'listDay',
        timezone: 'Asia/Tokyo',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        eventClick: function(calEvent, jsEvent, view) {
                var contents = "<h2>予約名:"+ calEvent.title + "</h2>"
                contents += "<p>開始日時:" + $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>終了日時:" + $.fullCalendar.formatDate(calEvent.end, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>予約内容:" + calEvent.content + "</p>";
                localStorage.setItem('event_id', calEvent.event_id);
                // contents += calEvent.staff
                // $('#modalContents').html(calEvent.title);
                $('#modalContents').html(contents);
                $('#modalArea').fadeIn();
        }
    });
});
</script>

<script>
$(function () {
    $('#closeModal , #modalBg').click(function() {
        $('#modalArea').fadeOut();
    });

    $('#closeModal_register , #modalBg_register').click(function() {
        $('#modalArea_register').fadeOut();
    });

    $('#register').click(function() {
        $('#modalContents_register').load("../assets/cms/html_parts/reserve_form_parts.php");
        $('#modalArea_register').fadeIn();
    });

    $('#update').click(function() {
        var event_id = localStorage.getItem('event_id');
            $.ajax({
                url:'../cl_reserve/get_reserve_data',
                type:'POST',
                data:{
                    'event_id': event_id,
                    // 'session': <?// $_SESSION["id"] ?>,
                }
            })
            .done( (data) => {
                $('#modalArea').fadeOut();
                $('#modalContents_update').html(data);
                $('#modalArea_update').fadeIn();
                // console.log(data);
            })
            .fail( (data) => {
                alert("失敗しました");
                    // $('.result').html(data);
                    // console.log(data);
            })
        // $('#modalContents_update').html(update_parts);
        // $('#modalContents_update').load(event_id);
        // $('#modalArea_update').fadeIn();
    });

    $('#closeModal_update , #modalBg_update').click(function() {
        $('#modalArea_update').fadeOut();
    });
}); -->

<!-- </script> -->
</body>

</html>