<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="POST" action="#">
                        <div class="header clearfix">
                            <div class="pull-left">
                                <h2 class="card-inside-title" style="line-height: 37px"><?= $template_name[0] ?></h2>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn bg-pink waves-effect"
                                    onclick="window.open('magazine', '_self')">
                                    <i class="material-icons">cancel</i>
                                    <span>cancel</span>
                                </button>
                                <button type="submit" class="btn bg-blue waves-effect" style="margin-right: 10px"
                                    onclick="return confirm_form()">
                                    <i class=" material-icons">contact_mail</i>
                                    <span>SEND</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="body">
                        <h2 class="card-inside-title" id="list-title" style="cursor: pointer;">送り先▼</h2>
                        <div id="list">
                            <?php for($i = 1; $i < count($name); $i++) { ?>
                                <p style="display:none"><?= $name[$i] ?></p>
                            <?php } ?>
                        </div>
                        <!-- メールマガジン送信希望者すべてにメールを送る -->
                        <h2 class="card-inside-title">メールヘッダー</h2>
                        <p>From: <?= $from_name[0]. "＜" .$mail[0]. "＞" ?></p>
                        <p>件名: <?= $mail_subject[0] ?></p>
                        <h2 class="card-inside-title">メール本文</h2>
                        <p><?= $mail_detail[0] ?></p>
                    </div>
                    </form>
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

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/magazine.js"></script>

<!-- Demo Js -->
<script>
$(function() {
    $('#list-title').click(function(){
        $('#list > p').toggle();
    });
});
</script>
</body>

</html>