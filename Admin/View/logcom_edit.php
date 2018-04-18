<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5><?php echo $logcom['id']==0?'添加商品分类':'修改商品分类'; ?></h5></div>
                <div class="ibox-content">
                    <form class="form-horizontal" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="Logistics.AddLogcomAC" name="service">
                        <input type="hidden" name="id" value="<?php echo $logcom['id']; ?>"/>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">公司名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="company" name="company" value="<?php echo $logcom['company']; ?>" placeholder="请输入公司名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">公司代码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="code" name="code" value="<?php echo $logcom['code']; ?>" placeholder="请输入公司代码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">公司地址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $logcom['address']; ?>" placeholder="请输入公司地址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">联系人</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="contact" value="<?php echo $logcom['contact']; ?>" placeholder="请输入联系人">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">联系电话</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $logcom['tel']; ?>" placeholder="请输入联系电话">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">网址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url" value="<?php echo $logcom['url']; ?>" placeholder="请输入网址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">备注</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="memo" name="memo" value="<?php echo $logcom['url']; ?>" placeholder="请输入备注">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success" type="submit">确定提交</button>
                                <button class="btn btn-primary " type="button" onclick="javascript:history.back();">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>

<script type="text/javascript">
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</html>
