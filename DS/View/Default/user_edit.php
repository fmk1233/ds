<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <!--左侧导航-手机不显示-->
                <div class="col-xs-12 zs-md-2 hidden-xs hidden-sm">
                    <div class="profile-sidebar">
                        <?php $this->view('profile_side') ?>
                    </div>

                </div>
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="page-content-title">
                            <h1> <?php echo T('修改资料'); ?>
                                <small></small>
                            </h1>
                            <!--<a href="javascript:history.go(-1)" class="table-btn"><?php /*echo T('返回'); */?><i
                                    class="fa fa-arrow-circle-left"></i></a>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" id="form1" onsubmit="return false;">
                                    <input type="hidden" value="User.EditUser" name="service"/>
                                    <input type="hidden" value="post" name="action"/>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><i class="ui-text-danger">*</i> <?php echo T('会员编号'); ?> ：</label>
                                        <div class="col-md-5">
                                            <input name="username" type="text" class="form-control" value="<?php echo $user['user_name']; ?>" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger">*</span> <?php echo T('性别'); ?></label>

                                        <div class="col-md-5">
                                            <?php $sexs= DI()->config->get('app.sex'); foreach($sexs as $key=>$val): ?>
                                                <input name="sex" type="radio" value="<?php echo $key; ?>" <?php echo  $key==$user['sex']?'checked':''; ?>> &nbsp;<?php echo $val; ?>
                                            <?php endforeach;?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                                        <div class="col-md-5">
                                            <input type="text" readonly class="form-control" name="phone" value="<?php echo $user['mobile']; ?>" placeholder="<?php echo T('输入'),T('手机号码'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger">*</span> <?php echo T('省市区'); ?></label>

                                        <div class="col-md-5">
                                            <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn blue mt-clipboard" type="submit"><i
                                                        class="fa fa-check"></i> <?php echo T('修改'); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>


                    </div>
                </div>
            </div>


        </div>
        <!--END 主体-->
    </div>
    <!--END 主体-->

    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->


</div>
<?php $this->view('footer_js'); ?>
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        new PCAS('province','city','area','<?php echo $user['province'];?>','<?php echo $user['city'];?>','<?php echo $user['area'];?>');
        $('#form1').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            trigger: 'blur',
            onSuccess: function (e) {
                e.preventDefault();
                var $form = $(e.target);
                sendFormAjax($form);
            },
            fields:{
            }
        });
    });
</script>
</body>
</html>