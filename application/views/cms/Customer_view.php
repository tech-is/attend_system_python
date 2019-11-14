<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>顧客入力画面</title>
    <!-- Favicon-->
    <link rel="icon" href="../assets/cms/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../assets/cms/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../assets/cms/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../assets/cms/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../assets/cms/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../assets/cms/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/cms/css/themes/all-themes.css" rel="stylesheet" />
</head>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>顧客管理情報</h2>
        </div>
        <!-- Input -->
        <form action="../cl_customer/customer_validation" method="POST">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            顧客管理
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">お名前（漢字）</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_name'); ?>
                                            <input type="text" class="form-control" name="customer_name" required >
                                            <label class="form-label">山田　太郎</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">フリガナ(全角カナ)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_kana'); ?>
                                            <input type="text" class="form-control" name="customer_kana" required>
                                            <label class="form-label">ヤマダ　タロウ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">メールアドレス(半角英数字)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_mail'); ?>
                                            <input type="mail" class="form-control" name="customer_mail" required>
                                            <label class="form-label">半角英数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">電話番号</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_tel'); ?>
                                            <input type="text" class="form-control" name="customer_tel"
                                                pattern="\d{2,4}-?\d{3,4}-?\d{3,4}"
                                                title="固定回線の場合は市外局番付きハイフン（-）無しでご記入ください。" required >
                                            <label class="form-label">半角数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">郵便番号</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_zip_adress'); ?>
                                            <input type="text" class="form-control" name="customer_zip_adress"
                                                pattern="\d{3}-?\d{4}" title="郵便番号は、3桁の数字、ハイフン（-）無しで、4桁の数字の順で記入してください。"
                                                required >
                                            <label class="form-label">半角数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">住所(全角)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_address'); ?>
                                            <input type="text" class="form-control" name="customer_address"
                                            required>
                                            <label class="form-label">(例: 東京都中央区日本橋茅場町〇〇番地〇〇マンション〇〇号)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">メールマガジン</h2>
                            <div class="switch">
                                <label>未希望<input type="checkbox" name="customer_magazine" checked="off"><span
                                        class="lever switch-col-red"></span>希望</label>
                            </div>
                            <h2 class="card-inside-title">追加情報</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="customer_add_info"
                                                placeholder="顧客に関する情報：例：夏に旅行をする"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">GROUP</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <select class="form-control show-tick" name="customer_group">
                                        <option value="gold">金</option>
                                        <option value="silver">銀</option>
                                        <option value="bronze">銅</option>
                                        <option value="black">黒</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">登録</button>
                            <button type="reset" class="btn btn-primary m-t-15 waves-effect">クリア</button>
                            <button type="reset" onclick="location.href='custmoer_list'" class="btn btn-primary m-t-15 waves-effect">ホームへ戻る</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
    <?php  //isset($text)? $text: false; ?>
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

<!-- Autosize Plugin Js -->
<script src="../assets/cms/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="../assets/cms/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/forms/basic-form-elements.js"></script>

<!-- Demo Js -->
<script src="../assets/cms/js/demo.js"></script>
</body>

</html>