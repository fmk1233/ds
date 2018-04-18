<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <link href="<?php echo Common_Function::GoodsPath('/css/plugins/city-picker/city-picker.css'); ?>" rel="stylesheet">
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo  T('银行账户信息');?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('我的资料'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('安全中心'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5> <?php echo T('银行账户信息');?>
                                    </h5>
                                </div>
                                <div class="ibox-content">

                                    <form class="form-horizontal" id="form1" onsubmit="return false;">
                                        <input type="hidden" value="post" name="action"/>
                                        <input type="hidden" value="User.BankInfoEdit" name="service"/>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo T('开户银行'); ?>
                                                ：</label>
                                            <div class="col-sm-9">
                                                <input name="name" type="text" class="form-control" value="<?php echo $user['bank_name']; ?>" placeholder="<?php echo T('输入'), T('开户银行'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo T('开户姓名'); ?>
                                                ：</label>
                                            <div class="col-sm-9">
                                                <input name="user" type="text" class="form-control" value="<?php echo $user['bank_user']; ?>"  placeholder="<?php echo T('输入'), T('开户姓名'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo T('银行卡号'); ?>
                                                ：</label>
                                            <div class="col-sm-9">
                                                <input name="no" type="text" class="form-control" value="<?php echo $user['bank_no']; ?>" placeholder="<?php echo T('输入'), T('银行卡号'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><i
                                                    class="ui-text-danger">*</i> <?php echo T('银行地址'); ?>
                                                ：</label>
                                            <div class="col-sm-9">
                                                <input name="address" type="text" class="form-control" value="<?php echo $user['bank_address']; ?>"  placeholder="<?php echo T('输入'), T('银行地址'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fa fa-check"></i> <?php echo T('修改'); ?></button>
                                                    <button class="btn" type="button" onclick="history.go(-1)"><?php echo T('返回'); ?></button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
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
            fields:{
                name: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('开户银行') ?>',
                        }
                    }
                },
                user: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('开户姓名') ?>',
                        }
                    }
                },
                no: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('银行卡号') ?>',
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('银行地址') ?>',
                        }
                    }
                },
            }
        });
    });
</script>
</body>

</html>
