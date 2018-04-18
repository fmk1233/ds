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
                            <h1> <?php echo T('修改'), $type == 'pwd' ? T('一级密码') : T('安全密码'); ?>
                                <small>（打<i class="ui-text-danger">*</i> 号为必填项）</small>
                            </h1>
                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?><i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" id="form1" onsubmit="return false;">
                                    <input type="hidden" value="<?php echo $type; ?>" name="action"/>
                                    <input type="hidden" value="User.PwdEditAC" name="service"/>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo $type == 'pwd' ? T('原') . T('一级密码') : T('安全密码'); ?>
                                            ：</label>
                                        <div class="col-sm-5">
                                            <input name="old_password" type="password" class="form-control"
                                                   placeholder="<?php echo T('输入'), $type == 'pwd' ? T('原') . T('一级密码') : T('安全密码'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo $type == 'pwd' ? T('一级密码') : T('安全密码'); ?>
                                            ：</label>
                                        <div class="col-md-5">
                                            <input name="password" type="password" class="form-control"
                                                   placeholder="<?php echo T('输入'), $type == 'pwd' ? T('一级密码') : T('安全密码'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo T('确认'), $type == 'pwd' ? T('一级密码') : T('安全密码'); ?>
                                            ：</label>
                                        <div class="col-md-5">
                                            <input name="confirm_password" type="password" class="form-control"
                                                   placeholder="<?php echo T('输入'), $type == 'pwd' ? T('一级密码') : T('安全密码'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn blue mt-clipboard" type="submit"><i
                                                            class="fa fa-check"></i> <?php echo T('修改'); ?></button>
                                                <button class="btn btn-outline grey-salsa"
                                                        onclick="history.go(-1)"><?php echo T('返回'); ?></button>
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
<script type="text/javascript">
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
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('密码') ?>'
                        },
                        callback: {
                            message: '<?php echo $type == 'pwd' ? (T('一级密码') . T('和') . T('确认') . T('一级密码') . T('不一致')) : (T('安全密码') . T('和') . T('确认') . T('安全密码') . T('不一致')); ?>',
                            callback: function (value, validate) {
                                return validate.getFieldElements('password').val() == value;
                            }
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('密码') ?>'
                        }

                    }
                },
                old_password: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写原'), T('密码') ?>'
                        },
                        remote: {
                            url: baseUrl,
                            type: 'POST',
                            data: function (validator, $field, value) {
                                return {
                                    type: '<?= $type;?>' ,
                                    value: validator.getFieldElements('old_password').val(),
                                    service: 'Public.checkPassword'
                                };
                            },
                            message: '<?php echo T('原密码不正确');?>'
                        }

                    }
                }

            }
        });
    });
</script>
</body>
</html>