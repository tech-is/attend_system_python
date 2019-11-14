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

<form method="POST" action="../cl_reserve/register_reserve_data" id="reserve">
    <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
        <h2 class="pull-left" style="font-weight: bold; line-height: 37px; margin: 0px">新規予約</h2>
        <div class="pull-right">
            <button type="button" class="btn bg-pink waves-effect" onclick="window.open('reserve', '_self')">
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
        <div class="form-group">
            <div class="form-line">
                <label for="customer">お客様名<span style="color: red; margin-left: 10px">必須</span></label>
                <input type="text" class="form-control" name="customer" placeholder="例：田中太郎さん">
            </div>
        </div>
        <div class="form-group">
            <div class="form-line">
                <label for="pet">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                <input type="text" class="form-control" name="pet" placeholder="例：ポチくん">
            </div>
        </div>
        <div class="form-group">
            <!-- <div class="form-line"> -->
            <label for="staff">担当者</label>
            <?= select_staff()?>
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-line">
                        <label for="start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="datetime-local" name="start" class="form-control" placeholder="開始日時">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-line">
                        <label for="end">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="time" name="end" class="datetimepicker form-control" placeholder="終了日時">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-line">
                <label for="from_name">予約内容</label>
                <textarea rows=4 class="form-control" name="content" placeholder="トリミング"></textarea>
            </div>
        </div>
    </div>
</form>

<script>
$("#reserve").validate({
        rules: {
            customer: {
                required: true
            },
            pet: {
                required: true
            },
            start: {
                required: true
            },
            end: {
                required: true
            },
            content: {
                required: true
            }
        },
        messages: {
            customer: {
                required: "入力してください。"
            },
            pet: {
                required: "入力してください。"
            },
            start: {
                required: "入力してください。"
            },
            end: {
                required: "入力してください。"
            },
            content: {
                required: "入力してください。"
            }
        },
        highlight: function (input) {
            // console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        }
    });
</script>