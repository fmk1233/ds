<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<style>
    .menu {
        margin-top: 8px;
    }

    .menu label {
        cursor: pointer;
        font-weight: normal
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5>设置会员注册设置</h5></div>
                <div class="ibox-content clr">
                    <form class="form-horizontal" role="form" method="post" onsubmit="return false;" id="register-form"
                          action="">
                        <input type="hidden" value="Setting.DoUserReg" name="service">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员编号开头字母：</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sys[begin]"
                                       value="<?php echo isset($setting['begin']) ? $setting['begin'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员编号长度：</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sys[length]"
                                       value="<?php echo isset($setting['length']) ? $setting['length'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员编号锁定：</label>
                            <div class="col-sm-10" style="padding-top:7px;">
                                <input type="radio" name="sys[open]"
                                       value="0" <?php echo empty($setting['open']) ? 'checked' : '' ?>/>关闭
                                <input type="radio" name="sys[open]"
                                       value="1" <?php echo empty($setting['open']) ? '' : 'checked' ?>/>开启

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限：</label>
                            <div class="col-sm-10 menu">
                                <?php $i = 0;
                                foreach ($menus as $key => $menu): ?>
                                <?php echo '<div><input id="' . $key . '" type="checkbox" name="power_all"><label for="' . $key . '">&nbsp;' . $key . '</label> <br>';
                                $i++; ?>
                                <?php foreach ($menu as $key2 => $me): ?>
                                    <label style="margin-left: 20px" for="<?= $i . $me ?>"><input id="<?= $i . $me ?>"
                                                                                                  type="checkbox"
                                                                                                  data-type="power"
                                                                                                  name="power_<?php echo $i; ?>[]" <?php if (in_array($me, $setting['power_' . $i])) {
                                            echo 'checked';
                                        } ?> value="<?php echo $me; ?>"/>&nbsp;<?php echo $key2; ?>&emsp;</label>
                                <?php endforeach; ?>
                            </div>
                            <hr/>
                            <?php endforeach; ?>
                        </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label hidden-xs"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-success ladda-button" type="submit" data-style="zoom-in"><span
                                    class="ladda-label">确定提交</span></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script>
    $(function () {
        const power_all = $('input[name=power_all]');
        const power = $('input[data-type=power]');
        $.each(power_all, function () {
            check_checked_all($(this));
        });
        //全选
        power_all.change(function () {
            $(this).parent().find('input[type=checkbox]').prop('checked', $(this).is(':checked'));
        });
        //单选
        power.change(function () {
            check_checked_all($(this).parent().prevAll('input[name=power_all]'));
        });
    });
    //判断全选按钮是否设置为全选状态
    function check_checked_all(power_all_obj) {
        const length = power_all_obj.parent().find('input[data-type=power]').length;
        const check_length = power_all_obj.parent().find('input[data-type=power]:checked').length;
        power_all_obj.prop('checked', length == check_length);
    }
</script>
<script type="text/javascript">
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</html>
