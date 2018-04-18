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
                    <!--提示信息-->
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="page-content-title">
                            <h1>安全中心<small> 当前安全等级：<span class="ui-text-danger">中</span>（建议您开启全部安全设置，以保障账户及资金安全）</small></h1>
                          <!--<a href="javascript:history.go(-1)" class="table-btn">返回 <i class="fa fa-arrow-circle-left"></i></a>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="set-card">
                                    <div class="col-xs-12 col-sm-2 col-md-2 set-icon">
                                        <i class="iconfont icon-suo"></i>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-describe">
                                        <p class="set-desc-head"><?php echo T('一级密码'); ?></p>
                                        <p class="set-desc-status"><?php echo T('已设置'); ?></p>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-action">
                                        <a data-toggle="url" data-service="User.PwdEdit" data-action="pwd" ><?php echo T('修改密码'); ?></a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="set-card">
                                    <div class="col-xs-12 col-sm-2 col-md-2 set-icon">
                                        <i class="iconfont icon-zhangdan2"></i>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-describe">
                                        <p class="set-desc-head"><?php echo T('安全密码'); ?></p>
                                        <?php if($user['sec_pwd']): ?>
                                            <p class="set-desc-status"><?php echo T('已设置'); ?></p>
                                        <?php else: ?>
                                            <p class="set-desc-status ui-text-danger"><?php echo T('未设置'); ?></p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-action">
                                        <?php if($user['sec_pwd']): ?>
                                            <a data-toggle="url" data-service="User.PwdEdit" data-action="sec_pwd" ><?php echo T('修改密码'); ?></a>
                                        <?php else: ?>
                                            <a  data-toggle="url" data-service="User.PwdEdit" data-action="sec_pwd"><?php echo T('前往设置'); ?></a>
                                        <?php endif;?>
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="set-card">
                                    <div class="col-xs-12 col-sm-2 col-md-2 set-icon">
                                        <i class="iconfont icon-diannao"></i>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-describe">
                                        <p class="set-desc-head"><?php echo T('银行账户信息'); ?></p>
                                        <?php if($user['bank_no']): ?>
                                            <p class="set-desc-status"><?php echo T('已设置'); ?></p>
                                        <?php else: ?>
                                            <p class="set-desc-status ui-text-danger"><?php echo T('未设置'); ?></p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-xs-6 col-sm5 col-md-5 set-action">
                                        <?php if($user['bank_no']): ?>
                                            <a  data-toggle="url" data-service="User.BankInfoEdit" ><?php echo T('修改'); ?></a>
                                        <?php else: ?>
                                            <a data-toggle="url" data-service="User.BankInfoEdit" ><?php echo T('前往设置'); ?></a>
                                        <?php endif;?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="set-card">
                                    <div class="col-xs-12 col-sm-2 col-md-2 set-icon">
                                        <i class="icon icon-basket"></i>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 set-describe">
                                        <p class="set-desc-head"><?php echo T('收货地址'); ?></p>
                                        <?php if($address['id']): ?>
                                            <p class="set-desc-status"><?php echo T('已设置'); ?></p>
                                        <?php else: ?>
                                            <p class="set-desc-status ui-text-danger"><?php echo T('未设置'); ?></p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-xs-6 col-sm5 col-md-5 set-action">
                                        <?php if($address['id']): ?>
                                            <a data-toggle="url" data-service="User.AddressEdit"><?php echo T('修改'); ?></a>
                                        <?php else: ?>
                                            <a data-toggle="url" data-service="User.AddressEdit" ><?php echo T('前往设置'); ?></a>
                                        <?php endif;?>
                                    </div>
                                </div>

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

</body>
</html>