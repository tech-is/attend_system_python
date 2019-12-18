<?php
    $columns_array = [
        'default'=>
            [
                'id',
                '生徒名',
                '出席日時',
                '退出日時',
                '滞在時間(H:i:s)'
            ],
        'total'=>
            [
                'id',
                '生徒名',
                '出席日時',
                '退出日時',
                '滞在時間(H:i:s)'
            ],
        'weeks'=>
            [
                'id',
                '生徒名',
                '合計時間(H:i:s)',
                '週初め'
        ],
        'months'=>
        [
            'id',
            '生徒名',
            '合計時間(H:i:s)',
            '月'
        ]
    ];
?>

<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>入退室管理</h2>
                    </div>
                    <div class="body">
                        <form action="<?php echo base_url()?>attend">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="calender">日付絞り込み</label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="refine" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <button type="submit" class="btn bg-light-blue waves-effect">絞り込み</button>
                                </div>
                            </div>
                        </form>
                        <form action="<?php echo base_url()?>attend">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="display:inline-block">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="dateRange[0]" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="dateRange[1]" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <button type="submit" class="btn bg-light-blue waves-effect">絞り込み</button>
                                </div>
                            </div>
                        </form>
                        <div class="button-wrapper">
                            <a href="<?php echo base_url() ?>attend"><button type="type" class="btn bg-light-blue waves-effect">本日</button></a>
                            <a href="<?php echo base_url() ?>attend?where=weeks"><button type="type" class="btn bg-light-blue waves-effect">週合計</button></a>
                            <a href="<?php echo base_url() ?>attend?where=months"><button type="type" class="btn bg-light-blue waves-effect">月合計</button></a>
                            <a href="<?php echo base_url() ?>attend?where=total"><button type="type" class="btn bg-light-blue waves-effect">すべて表示</button></a>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover dataTable" style="min-width: 100%">
                                <thead>
                                    <tr>
                                        <?php foreach (array_key_exists($columns, $columns_array)? $columns_array[$columns]: $columns_array['default'] as $column): ?>
                                            <th><?php echo $column; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($td_arrays)): ?>
                                    <?php foreach ($td_arrays as $array): ?>
                                        <tr>
                                        <?php foreach ($array as $td): ?>
                                            <td><?php echo $td; ?></td>
                                        <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!--ボタン効果Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/attend/attend.js"></script>

</body>

</html>