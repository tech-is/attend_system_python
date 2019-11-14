<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 37px">スタッフ管理</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-deep-purple waves-effect" id="staff_list">
                                スタッフ一覧
                            </button>
                        </div>
                    </div>
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- シフト入力フォーム -->

<!-- スタッフ一覧テーブル -->
<section id="modalArea_staff_list" class="modalArea">
    <div id="modalBg_staff_list" class="modalBg"></div>
        <div class="modalWrapper_staff_list">
        <h3>スタッフ一覧</h3>
            <table id="datatable" class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>カラーラベル</th>
                    <th>備考</th>
                </tr>
            </thead>
            </table>
        <div>
            <hr>
            <div class="pull-left">
                <button id="registButton" type="button" class="btn btn-primary">スタッフ追加</button>
                <button id="updateButton" type="button" class="btn btn-success" disabled>更新</button>
            </div>
            <div class="pull-right">
                <button id="deleteButton" type="button" class="btn btn-danger" disabled>削除</button>
            </div>
        </div>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- シフト入力フォーム -->
<section id="modalArea_add_shift" class="modalArea">
    <div id="modalBg_add_shift" class="modalBg"></div>
        <div class="modalWrapper_shift">
            <form id="form_shift" action="POST">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 id ="modal_shift_title" style="margin: 0px">シフト追加</h3>
                </div>
                <div class="body">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="start">担当スタッフ<span style="color: red; margin-left: 10px">必須</span></label>
                            <?php
                                if(isset($select_staff)) {
                                    echo '<select id="select_shift_staff" class="form-control show-tick" value="">';
                                    echo '<option value="">-- スタッフを選択してください --</option>';
                                    foreach($select_staff as $value) {
                                        echo "<option value={$value['staff_id']}>{$value['staff_name']}</option>";
                                    }
                                } else {
                                    echo '<select id="update_shift_staff" class="form-control show-tick" disabled value="">';
                                    echo '<option value="">スタッフが登録されていません</option>';
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="shift_start">始業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" name="shift_start" class="form-control" placeholder="開始日時" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="shift_end">終業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" name="shift_end" class="form-control" placeholder="終了日時" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="shift_id" id="shift_id" />
                    <div class="pull-left">
                        <?php if(isset($select_staff)){ ?>
                            <button type="submit" id="register_add_shift" class="btn btn-primary m-t-15 waves-effect">登録</button>
                        <?php } else { ?>
                            <button type="submit" id="register_add_shift" class="btn btn-primary m-t-15 waves-effect" disabled>登録</button>
                        <?php } ?>
                        <button type='submit' id='send_Update_shift' class='btn btn-primary m-t-15 waves-effect'>更新</button>
                        <button type="button" id="cancel_add_shift" class="btn btn-primary m-t-15 waves-effect" style="margin-left: 10px;">キャンセル</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" id="send_Delete_shift" class='btn btn-primary m-t-15 waves-effect'>削除</button>
                    </div>
                </div>
            </form>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- スタッフ入力フォーム -->
<section id="modalArea_add_staff" class="modalArea_shift">
    <div id="modalBg_add_staff" class="modalBg_shift"></div>
        <div class="modalWrapper_shift">
            <form id="form_shift">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 id="dialogTitle" style="margin: 0px">スタッフ追加</h3>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="staff_name">従業員名
                                <span style="color: red; margin-left: 10px">必須</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="staff_name[0]" placeholder="姓名">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="staff_name[1]" placeholder="名前">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                        <label for="staff_name">電話番号
                            <span style="color: red; margin-left: 10px">必須</span>
                        </label>
                            <input type="text" class="form-control" name="staff_tel" placeholder="ハイフンなし" maxlength="11">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                        <label for="staff_name">メールアドレス
                            <span style="color: red; margin-left: 10px">必須</span>
                        </label>
                            <input type="text" class="form-control" name="staff_email" placeholder="...@...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="staff_color">シフト用カラーラベル<span style="color: red; margin-left: 10px">必須</span></label>
                            <input type="color" class="form-control" name="staff_color" value="#0080ff">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="staff_content">備考<span style="color: red; margin-left: 10px"></span></label>
                            <textarea rows="4" class="form-control no-resize" name="staff_remarks"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="sendRegistButton" class="btn btn-primary m-t-15 waves-effect">
                            登録
                        </button>
                        <button type="button" id="sendUpdateButton" class="btn btn-primary m-t-15 waves-effect">
                            更新
                        </button>
                        <button type="button" id="cancel_add_staff" class="btn btn-primary m-t-15 waves-effect" style="margin-left: 10px;">
                            キャンセル
                        </button>
                    </div>
                </div>
            </form>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>
<!-- END -->


</div>

<!-- モーダルエリアここまで -->

<!-- Jquery Core Js -->
<script src="../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='../assets/cms/plugins/momentjs/moment.js'></script>

<!-- fullcalendar -->
<script src="../assets/cms/plugins/fullcalendar-3.9.0/fullcalendar.min.js"></script>
<script src="../assets/cms/plugins/fullcalendar-3.9.0/locale-all.js"></script>

<!-- Bootstrap Core Js -->
<script src=" ../assets/cms/plugins/bootstrap/js/bootstrap.js"> </script>

<!-- Slimscroll Plugin Js -->
<script src="../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="../assets/cms/plugins/raphael/raphael.min.js"></script>
<script src="../assets/cms/plugins/morrisjs/morris.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="../assets/cms/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Validation Plugin Js -->
<script src="../assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Jquery-datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- SweetAlert Plugin Js -->
<!-- <script src="../assets/cms/plugins/sweetalert/sweetalert.min.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Custom Plugin Js -->
<script src="../assets/cms/js/admin.js"></script>

<script>
    table_json = <?php echo $staff ?>;
    event_json = <?php echo @$shift?: "{}"; ?>;
</script>

<script src="../assets/cms/js/pages/staff/staff_list.js"></script>

</body>

</html>