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
                        <input type="hidden" value="Setting.ClearCache" name="service">
                        <input type="hidden" value="post" name="type">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">缓存：</label>
                            <div class="col-sm-10 menu">
                                <?php $menus = array('全选' => array(
                                    '文章分类' => 'article_class_all',
                                    '商品分类' => 'goods_class_all',
                                    '系统参数' => 'setting',
                                    '手机商城' => 'shop_index',
                                    'DS手机端' => 'ds_wap_index',
                                    '商城底部' => 'shop_footer',
                                    '顶部页面导航' => 'shop_navigation0',
                                    '中部页面导航' => 'shop_navigation1',
                                    '底部页面导航' => 'shop_navigation2',
                                    '支付缓存'=>'payment'
                                ));
                                foreach ($menus as $key => $menu): ?>
                                <?php echo '<div><input id="' . $key . '" type="checkbox" name="power_all"><label for="' . $key . '">&nbsp;' . $key . '</label> <br>'; ?>
                                <?php foreach ($menu as $key2 => $me): ?>
                                    <label style="margin-left: 20px" for="<?= $me ?>"><input id="<?= $me ?>"
                                                                                             type="checkbox"
                                                                                             data-type="power"
                                                                                             name="caches[]"
                                                                                             value="<?php echo $me; ?>"/>&nbsp;<?php echo $key2; ?>&emsp;</label>
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
