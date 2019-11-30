<?php
    $form_array = [
        'name[0]' => [
            'type' => 'text',
            'col' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12',
            'label' => '姓',
            'require' => true,
            'placeholder' => '田中'
        ],
        'name[1]' => [
            'col' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12',
            'label' => '名',
            'type' => 'text',
            'require' => true,
            'placeholder' => '太郎'
        ],
        'kana[0]' => [
            'col' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12',
            'label' => 'セイ',
            'type' => 'text',
            'require' => true,
            'placeholder' => 'タナカ'
        ],
        'kana[1]' => [
            'col' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12',
            'label' => 'メイ',
            'type' => 'text',
            'require' => true,
            'placeholder' => 'タロウ'
        ],
        'email' => [
            'col' => 'col-sm-12 col-xs-12',
            'label' => 'メールアドレス',
            'type' => 'text',
            'require' => true,
            'placeholder' => ''
        ],
        'tel' => [
            'label' => '電話番号',
            'col' => 'col-sm-12 col-xs-12',
            'type' => 'tel',
            'require' => true,
            'placeholder' => 'ハイフンなし'
        ],
        'zip_code' => [
            'col' => 'col-sm-12 col-xs-12',
            'label' => '郵便番号',
            'type' => 'text',
            'require' => true,
            'placeholder' => '半角数字'
        ],
        'address' => [
            'col' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12',
            'label' => '住所',
            'type' => 'text',
            'require' => true,
            'placeholder' => '例: 愛媛県松山市港町〇〇番地〇〇マンション〇〇号'
        ],
        // 'address[1]' => [
        //     'col' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12',
        //     'label' => '市町村',
        //     'type' => 'text',
        //     'require' => true,
        //     'placeholder' => '例: 松山市'
        // ],
        // 'address[2]' => [
        //     'col' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12',
        //     'label' => '番地',
        //     'type' => 'text',
        //     'require' => true,
        //     'placeholder' => '例: 港町〇〇番地〇〇マンション〇〇号'
        // ]
    ];
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>生徒一覧</h2>
                        <button id="register" type="btn" class="btn btn-primary m-t-15 waves-effect">生徒登録</button>
                        <button id="update" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>生徒更新</button>
                        <button id="barcode" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>バーコード</button>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover" style="min-width: 100%;">
                                <thead>
                                    <tr>
                                        <th>生徒ID</th>
                                        <th>バーコード</th>
                                        <th>生徒名</th>
                                        <th>フリガナ</th>
                                        <th>電話番号</th>
                                        <th>メールアドレス</th>
                                        <th>郵便番号</th>
                                        <th>住所</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modalArea_barcode" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents">
            <div class="closeModal">
                <span style="font-size:30px;">
                    ×
                </span>
            </div>
            <div id="generate_barcode"></div>
        </div>
    </div>
</section>

<!-- モーダルウィンドウ カスタマー -->

<section id="modalArea_register" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents">
            <div class="closeModal">
                <span style="font-size:30px;">
                    ×
                </span>
            </div>
            <h3 id="modal_title">生徒新規登録</h3>
            <form id="form">
                <div class="row clearfix">
                    <?php foreach ($form_array as $name => $parts) :?>
                        <div class="<?php echo $parts['col']; ?>">
                        <?php if(isset($parts['label'])) :?>
                            <label for="<?php echo $name; ?>">
                                <?php echo $parts['label']; echo isset($parts['require'])?'<span style="color: red; margin-left: 10px">必須</span>': false; ?>
                            </label>
                        <?php endif; ?>
                            <?php if ($name === 'zip_code'): ?>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="<?php echo $parts['type']; ?>" class="form-control" name="<?php echo $name; ?>" placeholder="<?php echo $parts['placeholder']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-6">
                                        <button type="button" class="btn btn-primary waves-effect" id="zip-search">住所検索</button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="<?php echo $parts['type']; ?>" class="form-control" name="<?php echo $name; ?>" placeholder="<?php echo $parts['placeholder']; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                        <input type="hidden" id="student_id" value="">
                    <div class="pull-right">
                        <button id="sendRegister" name="submit" type="submit"
                            class="btn btn-primary waves-effect">登録</button>
                        <button id="sendUpdate" name="submit" type="submit"
                            class="btn btn-primary waves-effect">更新</button>
                        <button class="btn btn-primary waves-effect" type="reset">クリア</button>
                        <button type="reset" id="P_cancel" class="btn btn-primary waves-effect">キャンセル</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>/assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>/assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url();?>/assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url();?>/assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url();?>/assets/cms/plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<!--ボタン効果Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom Js -->
<script>
<?php echo !empty($students) ? 'students_json ='.$students : 'students_json ={}'; ?>
</script>
<script src="<?php echo base_url();?>assets/cms/js/admin.js"></script>
<script src="<?php echo base_url();?>assets/js/common.js"></script>
<script src="<?php echo base_url();?>assets/js/students/students.js"></script>

</script>
</body>

</html>