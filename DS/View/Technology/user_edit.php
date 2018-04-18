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
                    <h2><?php echo  T('修改资料');?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('我的资料'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('修改资料'); ?></strong>
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
                                    <h5> <?php echo  T('修改资料');?>
                                    </h5>
                                </div>
                                <div class="ibox-content">

                                    <form class="form-horizontal" id="form1" onsubmit="return false;">
                                        <input type="hidden" value="User.EditUser" name="service"/>
                                        <input type="hidden" value="post" name="action"/>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><i class="text-danger">*</i> <?php echo T('会员编号'); ?> </label>
                                            <div class="col-sm-9">
                                                <input name="username" type="text" class="form-control" value="<?php echo $user['user_name']; ?>" placeholder="" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('性别'); ?></label>

                                            <div class="col-sm-9">
                                                <?php $sexs= DI()->config->get('app.sex'); foreach($sexs as $key=>$val): ?>
                                                    <input name="sex" type="radio" value="<?php echo $key; ?>" <?php echo  $key==$user['sex']?'checked':''; ?>> &nbsp;<?php echo $val; ?>
                                                <?php endforeach;?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control" name="phone" value="<?php echo $user['mobile']; ?>" placeholder="<?php echo T('输入'),T('手机号码'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('省市区'); ?></label>

                                            <div class="col-sm-9">
                                                <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-sm-offset-2 col-sm-9">
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
