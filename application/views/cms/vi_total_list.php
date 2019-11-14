<section class="content">
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>顧客・ペット一覧</h2>
                    <button id="register" type="btn" class="btn btn-primary m-t-15 waves-effect">顧客登録</button>
                    <button id="register3" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>予約登録</button>
                    <button id="register4" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>顧客更新</button>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><b>グループ登録</b></p>
                            <div class="form-group" style="display:inline-flex;">
                                <div class="form-line" style="margin-right: 10px">
                                    <input type="text" class="form-control" name="kind_group_name" id="select_group" placeholder="例：金・銀・銅">
                                    <label class="form-label"></label>
                                </div>
                                <div class="wrapper" style="margin-top: 6px">
                                    <button id="group_register" type="button" class="btn btn-primary waves-effect">登録</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><b>グループ削除</b></p>
                            <div class="form-group" style="display:inline-flex">
                                <div class="wrapper" style="width: 100%; margin-right: 10px">
                                    <select name="" id="select_1" class="form-control show-tick">
                                        <?php foreach ($groups as $group) : ?>
                                            <option value="<?php echo $group["kind_group_id"]; ?>"><?php echo $group["kind_group_name"]; ?></option>"
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="wrapper" style="margin-top: 6px">
                                    <button id="delete_group_register" type="button" class="btn btn-primary waves-effect">削除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>ペットID</th>
                                    <th>顧客名</th>
                                    <th>ペット名</th>
                                    <th>電話番号</th>
                                    <th>メールアドレス</th>
                                    <th>グループ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($list); $i++) {
                                    $disply = $list[$i];
                                    echo "<tr>";
                                    echo "<td>$disply[pet_id]</td>";
                                    echo "<td>$disply[customer_name]</td>";
                                    echo "<td>$disply[pet_name]</td>";
                                    echo "<td>$disply[customer_tel]</td>";
                                    echo "<td>$disply[customer_mail]</td>";
                                    echo isset($disply["kind_group_name"]) ? "<td>$disply[kind_group_name]</td>" : "<td></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- モーダルウィンドウ カスタマー -->
<!-- モーダルウィンドウの予約フォーム -->
<section id="modalReserveArea" class="modalArea">
<div id="modalReserveBg" class="modalBg"></div>
<div class="modalWrapper_Total">
    <div id="modalReserve" class="modalContents"></div>
    <!-- <div id="closemodalReserve" class="closeModal"> -->
    <div id="P_cancel" class="closeModal">
        <label for="P_cancel" style="font-size:30px;">
            ×
        </label>
    </div>
    <h3>予約新規登録</h3>
    <div class="form-group">
        <label for="reserve_pet">ペット<span style="color: red; margin-left: 10px">必須</span></label>
        <div id="pet_name"></div>
    </div>
    <input type="hidden" class="form-control" id="reserve_pet">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-line">
                    <label for="reserve_start">来店予定<span style="color: red; margin-left: 10px">必須</span></label>
                    <input type="text" name="reserve_start" id="reserve_start" class="form-control" required />
                </div>
            </div>
        </div>
    </div>
    <button id="reserve_register" type="button" class="btn btn-primary waves-effect">登録</button>
    <button class="btn btn-primary waves-effect" type="reset">クリア</button>
    <button type="reset" id="R_cancel" class="btn btn-primary waves-effect">キャンセル</button>
</div>
</section>
<!-- #END# Input -->
<section id="modalArea_register" class="modalArea">
<div id="modalBg_register" class="modalBg"></div>
<div class="modalWrapper">
    <div class="modalContents" id="modalContents_register">
        <div id="C_cancel" class="closeModal">
            <span style="font-size:30px;">
                ×
            </span>
        </div>
        <form id="total_form_data" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <h3>顧客新規登録</h3>
                    <div class="form-group">
                        <label for="customer_name">名前<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="customer_name" placeholder="山田　太郎" required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label for="customer_kana">カナ(全角)<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="customer_kana" placeholder="ヤマダ　タロウ" required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label for="customer_mail">メールアドレス<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="mail" class="form-control" name="customer_mail" placeholder="半角英数字" required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label for="customer_tel">電話番号<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="customer_tel" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="固定回線の場合は市外局番付きハイフン（-）無しでご記入ください。" placeholder="半角数字 " required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label for="customer_zip_adress">郵便番号<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="customer_zip_adress" pattern="\d{3}-?\d{4}" title="郵便番号は、3桁の数字、ハイフン（-）無しで、4桁の数字の順で記入してください。" placeholder="半角数字" required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label for="customer_zip_adress">住所<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="customer_address" placeholder="(例: 東京都中央区日本橋茅場町〇〇番地〇〇マンション〇〇号)" required>
                            <label class="form-label"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_magazine">メールマガジン<span style="color: red; margin-left: 10px">必須</span></label>
                        <div class="switch">
                            <label>未希望
                                <input type="checkbox" id="customer_magazine" name="customer_magazine" value=1>
                                <span class="lever switch-col-red"></span>希望
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_magazine">備考</label>
                        <div class="form-line">
                            <textarea rows="4" class="form-control no-resize" name="customer_add_info" placeholder="顧客に関する情報：例：夏に旅行をする"></textarea>
                        </div><br>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p><b>グループ選択</b></p>
                                <select name="customer_group_id" class=" form-control show-tick">
                                    <?php foreach ($groups as $group) : ?>
                                        <option value="<?php echo $group["kind_group_id"]; ?>"><?php echo $group["kind_group_name"]; ?></option>"
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="customer_id" value="">
                    <input type="hidden" id="pet_id" value="">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3>ペット登録</h3>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group form-float">
                                <label for="pet_name">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pet_name" placeholder="名前" required>
                                    <label class="form-label"></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label for="pet_photo">写真</label>
                                <div id="img">
                                    <img src="">
                                </div>
                                <input type="file" id="files" name="pet_img" size="20" accept="image/png,image/jpeg,image/gif">
                            </div>
                            <div class="form-group form-float">
                                <label for="pet_classification">分類<span style="color: red; margin-left: 10px">必須</span></label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pet_classification" placeholder="分類" required>
                                    <label class="form-label"></label>
                                </div>
                                <div class="help-info">犬、猫、鳥</div>
                            </div>
                            <div class="form-group form-float">
                                <label for="pet_type">種類<span style="color: red; margin-left: 10px">必須</span></label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pet_type" placeholder="種類" required>
                                    <label class="form-label"></label>
                                </div>
                                <div class="help-info">トイ・プードル</div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">性別</label>
                                <div class="form-line">
                                    <input type="radio" name="pet_animal_gender" id="male" value="1" class="with-gap" checked />
                                    <label for="male">オス</label>
                                    <input type="radio" name="pet_animal_gender" id="female" value="2" class="with-gap">
                                    <label for="female" class="m-l-20">メス</label>
                                    <input type="radio" name="pet_animal_gender" id="other" value="3" class="with-gap">
                                    <label for="other" class="m-l-20">その他</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="date">生年月日</label>
                                    <input id="date" name="pet_birthday" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label class="with-gap">去勢</label>
                                    <input type="radio" name="pet_contraception" id="on" value="1" class="with-gap">
                                    <label for="on">有</label>
                                    <input type="radio" name="pet_contraception" id="off" value="2" class="with-gap" checked />
                                    <label for="off">無</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group form-float">
                                <label for="pet_body_height">体高</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="pet_body_height" placeholder="体高">
                                    <label class="form-label"></label>
                                </div>
                                <div class="help-info">cm</div>
                            </div>
                            <div class="form-group form-float">
                                <label for="pet_body_height">体重</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="pet_body_weight" placeholder="体重">
                                    <label class="form-label"></label>
                                </div>
                                <div class="help-info">kg</div>
                            </div>
                            <div class="form-group form-float">
                                <label for="pet_information">備考</label>
                                <div class="form-line">
                                    <textarea name="pet_information" cols="30" rows="5" class="form-control no-resize" placeholder="備考："></textarea>
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <button id="send_register" type="button" class="btn btn-primary waves-effect">登録</button>
                <button id="sendUpdateData" type="button" class="btn btn-primary waves-effect">更新</button>
                <button class="btn btn-primary waves-effect" type="reset">クリア</button>
                <button type="reset" id="P_cancel" class="btn btn-primary waves-effect">キャンセル</button>
            </div>
        </form>
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

<!-- Jquery DataTable Plugin Js -->
<script src="../assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<!--ボタン効果Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/total/total.js"></script>

</body>

</html>