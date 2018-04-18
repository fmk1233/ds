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
                            <h1> <?php echo T('收货地址'); ?>
                                <small></small>
                            </h1>
                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?><i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" id="form1" onsubmit="return false;">
                                    <input type="hidden" value="post" name="action"/>
                                    <input type="hidden" value="<?php echo $address['id']; ?>" name="addressid"/>
                                    <input type="hidden" value="User.AddressEdit" name="service"/>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span
                                                class="text-danger">*</span> <?php echo T('联系人'); ?></label>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="realname"
                                                   value="<?php echo $address['realname']; ?>"
                                                   placeholder="<?php echo T('输入'), T('联系人'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span
                                                class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phone"
                                                   value="<?php echo $address['mobile']; ?>"
                                                   placeholder="<?php echo T('输入'), T('手机号码'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span
                                                class="text-danger">*</span> <?php echo T('省市区'); ?>
                                        </label>

                                        <div class="col-md-5">
                                            <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?php echo T('详细地址'); ?>：</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="address"
                                                   value="<?php echo $address['address']; ?>"
                                                   placeholder="<?php echo T('输入'), T('详细地址'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn blue mt-clipboard" type="submit"><i
                                                        class="fa fa-check"></i> <?php echo $address['id']==0?T('确认'):T('修改'); ?></button>
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
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<!-- 省市区插件-->
<script type="text/javascript">
    new PCAS('province','city','area','<?php echo $address['province'];?>','<?php echo $address['city'];?>','<?php echo $address['area'];?>');
    $(function () {
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
            fields: {
                realname: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('联系人') ?>',
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('手机号码') ?>',
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('详细地址') ?>',
                        }
                    }
                },

            }
        });
    });
</script>
</body>
</html>