<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo @$_SESSION["token"]?:false; ?>">
    <title>Animerl</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url();?>assets/cms/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/cms/css/style.css" rel="stylesheet" />
    <style>
        .input-group {
            display: flex;
        }
        .form-line {
            margin-right: 10px;
        }
    </style>
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Animarl</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up">
                    <div class="msg">新規本登録画面</div>
                        <label>名前</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span> -->
                            <div class="form-line">
                                <input type="text" class="form-control" name="name[0]" placeholder="姓" required autofocus>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="name[1]" placeholder="名" required>
                            </div>
                        </div>
                        <label for="kana">フリガナ</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span> -->
                            <div class="form-line">
                                <input type="text" class="form-control" name="kana[0]" placeholder="カナ姓" required autofocus>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="kana[1]" placeholder="カナ名" required>
                            </div>
                        </div>
                        <label for="mail">メールアドレス</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">mail</i>
                            </span> -->
                            <div class="form-line">
                                <input type="mail" class="form-control" name="email" placeholder="メールアドレス" value="<?= $tmp_shop_email ?>" required>
                            </div>
                        </div>
                        <label for="tel">電話番号</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span> -->
                            <div class="form-line">
                                <input type="text" class="form-control" name="tel" placeholder="電話番号(ハイフンなし)" required>
                            </div>
                        </div>
                        <label for="zip_code">郵便番号</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span> -->
                            <div class="form-line">
                                <input type="text" class="form-control" name="zip_code" placeholder="郵便番号(ハイフンなし)" required>
                            </div>
                        </div>
                        <label for="zip_address">住所</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span> -->
                            <div class="form-line">
                                <input type="text" class="form-control" name="zip_address[0]" placeholder="都道府県" required>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="zip_address[1]" placeholder="市町村" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" class="form-control" name="zip_address[2]" placeholder="町域名" required>
                            </div>
                        </div>
                        <label for="password">パスワード</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span> -->
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" minlength="6" placeholder="英数字で8文字以上" required>
                            </div>
                        </div>
                        <label for="confirm_pass">確認用パスワード</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span> -->
                            <div class="form-line">
                                <input type="password" class="form-control" name="confirm_pass" minlength="6" placeholder="もう一度同じパスワードを入力" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms"><a href="javascript:void(0);">利用規約</a>に同意します</label>
                        </div>
                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>
                        <div class="m-t-25 m-b--5 align-center">
                            <a href="login">既にアカウントを持っている場合</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/cms/js/admin.js"></script>
    <script src="<?php echo base_url();?>assets/cms/js/pages/register/register.js"></script>


</body>

</html>