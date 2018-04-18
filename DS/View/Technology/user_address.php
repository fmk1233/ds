<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
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
                    <h2><?php echo T('收货地址'); ?></h2>
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
                                    <h5> <?php echo T('收货地址'); ?>
                                        <small>（<?php echo T('打{type}号为必填项',array('type'=>'<i class="ui-text-danger">*</i>')); ?>）</small>
                                    </h5>
                                </div>
                                <div class="ibox-content">

                                    <form class="form-horizontal" id="form1" onsubmit="return false;">
                                        <input type="hidden" value="post" name="action"/>
                                        <input type="hidden" value="<?php echo $address['id']; ?>" name="addressid"/>
                                        <input type="hidden" value="User.AddressEdit" name="service"/>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><span
                                                    class="text-danger">*</span> <?php echo T('联系人'); ?></label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="realname"
                                                       value="<?php echo $address['realname']; ?>"
                                                       placeholder="<?php echo T('输入'), T('联系人'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><span
                                                    class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone"
                                                       value="<?php echo $address['mobile']; ?>"
                                                       placeholder="<?php echo T('输入'), T('手机号码'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><span
                                                    class="text-danger">*</span> <?php echo T('省市区'); ?>
                                            </label>

                                            <div class="col-sm-9">
                                                <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo T('详细地址'); ?>：</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="address"
                                                       value="<?php echo $address['address']; ?>"
                                                       placeholder="<?php echo T('输入'), T('详细地址'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fa fa-check"></i> <?php echo $address['id']==0?T('确认'):T('修改'); ?></button>
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
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        new PCAS('province','city','area','<?php echo $address['province'];?>','<?php echo $address['city'];?>','<?php echo $address['area'];?>');
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
