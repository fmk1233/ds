<!DOCTYPE html>
<html>

<?php $this->view('header'); ?>
<style type="text/css">
    td label{
        font-weight: normal;
        cursor: pointer;
    }
</style>
<link href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>奖金参数设置</h5>
                    <!-- 特别提示，哪怕只有一个级别，请也写成数组 -->
                </div>
                <div class="ibox-content">
                    <form method="post" id="setting" class="form-horizontal" onsubmit="return false;">
                        <input type="hidden" value="Setting.DoSetting" name="service"/>
                        <div class="table-responsive">
                            <table class="table tablesaw-stack" data-tablesaw-mode="stack">
                                <tbody>
                                <tr>
                                    <td>会员等级</td>
                                    <?php for ($i = 0; $i <= RANKNUM; $i++): ?>
                                        <td><input name="rank_name[]" class="form-control" style="width: auto;"
                                                   type="text"
                                                   value="<?php echo($setting['rank_name'][$i]); ?>">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td>持币量</td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][0]); ?>">之内
                                        </td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][1]); ?>">之内
                                        </td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][2]); ?>">之内
                                        </td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][3]); ?>">之内
                                        </td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][4]); ?>">之内
                                        </td>
                                        <td><input name="money[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['money'][5]); ?>">以上
                                        </td>
                                </tr>
                                <tr>
                                    <td>直推奖</td>
                                    <?php for ($i = 0; $i <= RANKNUM; $i++): ?>
                                        <td><input name="ztj[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['ztj'][$i]); ?>">%
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td>日分红</td>
                                    <?php for ($i = 0; $i <= RANKNUM; $i++): ?>
                                        <td><input name="rfh[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['rfh'][$i]); ?>">%
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td>智能链接算力奖</td>
                                    <?php for ($i = 0; $i <= RANKNUM; $i++): ?>
                                        <td><input name="dpj[]" class="form-control" style="width: auto;display:inline" type="text"
                                                   value="<?php echo($setting['dpj'][$i]); ?>">%
                                        </td>
                                    <?php endfor; ?>
                                </tr>
<!--                                <tr>-->
<!--                                    <td>对碰奖层数</td>-->
<!--                                    --><?php //for ($i = 0; $i <= RANKNUM; $i++): ?>
<!--                                        <td><input name="dpj_cs[]" class="form-control" style="width: auto;" type="text"-->
<!--                                                   value="--><?php //echo($setting['dpj_cs'][$i]); ?><!--">-->
<!--                                        </td>-->
<!--                                    --><?php //endfor; ?>
<!--                                </tr>-->
                                <tr>
                                    <td>日封顶：持币量的</td>
                                        <td colspan="<?php echo RANKNUM + 1; ?>"><input name="dpj_rfd[]" class="form-control" style="width: auto;display:inline"
                                                   type="text"
                                                   value="<?php echo($setting['dpj_rfd'][0]); ?>">%
                                        </td>
                                </tr>

<!--                                <tr>-->
<!--                                    <td>报单中心</td>-->
<!--                                    --><?php //for ($i = 0; $i <= RANKNUM; $i++): ?>
<!--                                        <td><input name="bdj[]" class="form-control" style="width: auto;" type="text"-->
<!--                                                   value="--><?php //echo($setting['bdj'][$i]); ?><!--">-->
<!--                                        </td>-->
<!--                                    --><?php //endfor; ?>
<!--                                </tr>-->


<!--                                <tr>-->
<!--                                    <td>奖金分配</td>-->
<!--                                    <td colspan="--><?php //echo RANKNUM + 1; ?><!--">-->
<!--                                        <div class="input-group">-->
<!--                                            <span class="input-group-addon">每一笔奖金：</span>-->
<!--                                            <input type="text" class="form-control"-->
<!--                                                   value="--><?php //echo($setting['repeat_account']); ?><!--"-->
<!--                                                   name="repeat_account">-->
<!--                                            <span class="input-group-addon">%进入重消账号</span>-->
<!--                                            <input type="text" class="form-control"-->
<!--                                                   value="--><?php //echo($setting['account']); ?><!--" name="account">-->
<!--                                            <span class="input-group-addon">%进入现金账户</span>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                </tr>-->

                                <tr>
                                    <td>奖金开关</td>
                                    <td colspan="<?php echo RANKNUM + 1; ?>">
                                        <label style="margin-left: 20px" for="ztj">
                                            <input id="ztj"  type="checkbox" data-type="power" <?php echo isset($setting['open']['ztj'])?'checked':''; ?> name="open[ztj]" value="1"/>直推奖
                                        </label>
                                        <label style="margin-left: 20px" for="rfh">
                                            <input id="rfh"  type="checkbox" data-type="power" <?php echo isset($setting['open']['rfh'])==1?'checked':''; ?> name="open[rfh]" value="1"/>日分红
                                        </label>
                                        <label style="margin-left: 20px" for="dpj">
                                            <input id="dpj"  type="checkbox" data-type="power" <?php echo isset($setting['open']['dpj'])?'checked':''; ?> name="open[dpj]" value="1"/>对碰奖
                                        </label>
                                        <label style="margin-left: 20px" for="dpglj">
                                            <input id="dpglj"  type="checkbox" data-type="power" <?php echo isset($setting['open']['dpglj'])==1?'checked':''; ?> name="open[dpglj]" value="1"/>对碰管理奖
                                        </label>
                                        <label style="margin-left: 20px" for="bdj">
                                            <input id="bdj"  type="checkbox" data-type="power" <?php echo isset($setting['open']['bdj'])?'checked':''; ?> name="open[bdj]" value="1"/>报单奖
                                        </label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn-primary btn">保存</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript">
    $(function () {
        bindFormAjax($('#setting'));
    });
</script>

</html>
