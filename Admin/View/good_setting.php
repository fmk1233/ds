<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<link href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>商城设置</h5>
                    <div class="ibox-tools">
                        <div class="ibox-tools pull-right">
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" id="setting" class="form-horizontal" onsubmit="return false;">
                        <input type="hidden" value="Goods.DoSetting" name="service"/>
                        <div class="table-responsive">
                            <table class="table tablesaw-stack" data-tablesaw-mode="stack">
                                <tbody>
                                <tr>
                                    <td>联系电话</td>
                                    <td><input name="phone" class="form-control" style=""
                                               type="text"
                                               value="<?php echo($shop_setting['phone']); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>qq</td>
                                    <td><input name="qq" class="form-control" style=""
                                               type="text"
                                               value="<?php echo($shop_setting['qq']); ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>客服QQ1</td>
                                    <td><input name="qq1" class="form-control" style=""
                                               type="text"
                                               value="<?php echo($shop_setting['qq1']); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>客服QQ2</td>
                                    <td><input name="qq2" class="form-control" style=""
                                               type="text"
                                               value="<?php echo($shop_setting['qq2']); ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>提示</td>
                                    <td><textarea name="tips" class="form-control" ><?php echo($shop_setting['tips']); ?> </textarea>
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
<script>
    $(function () {
        bindFormAjax($('#setting'));
    });
</script>
</html>
