<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aceppting</title>
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

</head>

<body>

    <section>
        <div class="container-fluid">
            <div class="img_wrapper">
                <img src="<?php echo base_url(); ?>assets/images/1636138.png" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <form id="form">
            <div class="form-group form-float">
                <label for="barcode">バーコード
                    <span style="color: red; margin-left: 10px">必須</span>
                </label>
                <div class="form-line">
                    <input type="number" class="form-control" id="barcode" name="barcode" value="" maxlength='13'
                        autofocus>
                </div>
            </div>
        </form>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.js"></script>

    <!--ボタン効果Sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/attend/accepting.js"></script>
</body>

</html>