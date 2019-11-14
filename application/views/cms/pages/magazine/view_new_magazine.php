<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <!-- <form method="POST" action="../cl_magazine/registration_magazine"> -->
                    <form onsubmit="ajax();">
                        <div class="header clearfix">
                            <h2 class="pull-left" style="font-weight: bold; line-height: 37px">新規作成</h2>
                            <div class="pull-right">
                                <button type="button" class="btn bg-pink waves-effect"
                                    onclick="window.open('magazine', '_self')">
                                    <i class="material-icons">cancel</i>
                                    <span>cancel</span>
                                </button>
                                <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px">
                                    <i class=" material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">メールヘッダー</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="from_name">差出人</label>
                                    <input type="text" class="form-control" name="from_name" placeholder="例: 株式会社Animarl" value="<?= $mail_from_name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="from_name">表示メールアドレス</label>
                                    <input type="text" class="form-control" name="mail" placeholder="例: 株式会社Animarl" value="<?= $mail_adr?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="mail_subject">件名</label>
                                    <input type="text" class="form-control" name="subject" placeholder="例: 短期休業のお知らせ">
                                </div>
                            </div>
                            <h2 class="card-inside-title">メール本文</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="detail" rows="4" class="form-control no-resize" placeholder="メール本文を入力してください"></textarea>
                                </div>
                            </div>
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
<!-- <script src="../assets/cms/js/pages/magazine.js"></script> -->
<script type="text/javascript">
function ajax()
{
    event.preventDefault();
    $.ajax({
        url:'../cl_magazine/registration_magazine',
        type:'POST',
        data:{
            'from_name':$('input[name="from_name"]').val(),
            'mail':$('input[name="mail"]').val(),
            'subject':$('input[name="subject"]').val(),
            'detail':$('textarea[name="detail"]').val()
        }
    })
    // Ajaxリクエストが成功した時発動
    .done( (data) => {
        console.log(data);
    })
    // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
        // $('.result').html(data);
        console.log(data);
    });
}
    </script>
</body>

</html>