<?php
function select_staff()
{
    if(isset($staff_id)) {
        $select = "<select name='staff_id' class='form-control show-tick'>";
        while($staff_id) {
            $select .= "<option value='{$staff_id}'>{$staff_id}</option>";
        }
    } else {
        $select = "<select name='staff_id' class='form-control' disabled>";
        $select .= "<option>スタッフが登録されていません</option>";
    }
    $select .= "</select>";
    return $select;
}
?>
<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header clearfix">
                        <h2 class="pull-left" style="font-weight: bold; line-height: 37px"></h2>
                        <div class="pull-right">
                            <button type="button" class="btn bg-pink waves-effect"
                                onclick="window.open('reserve', '_self')">
                                <i class="material-icons">cancel</i>
                                <span>削除</span>
                            </button>
                            <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px"
                                onclick="return confirm_form()">
                                <i class=" material-icons">save</i>
                                <span>変更</span>
                            </button>
                        </div>
                    </div>
                    <div class="body">
                        <p>お客様名:<?= $content[0]["event_customer"] ?>様</p>
                        <p>予約内容:<?= $content[0]["event_content"] ?></p>
                        <p>開始日時:<?= $content[0]["event_start"] ?></p>
                        <p>終了日時:<?= $content[0]["event_end"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Moment Plugin Js -->
<script src="../assets/cms/plugins/momentjs/moment.js"></script>


<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<!-- <script src="../assets/cms/js/pages/magazine.js"></script> -->
<script>
$('.datetimepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DDTHH:mm',
    clearButton: true,
    weekStart: 1
});
</script>
</body>

</html>