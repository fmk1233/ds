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
                            <h1><?php echo T('查看资料'); ?><small><!--这里是概要--></small></h1>
                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?> <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-md-4 profile-info summary-info summary-fr">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('资料概要'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">

                                            <li>
                                                <span class="sale-info"><?php echo T('推荐人'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-danger"><?php echo $tjrname; ?></span></span>
                                            </li>
                                            <?php if(POSNUM > 1): ?>
                                                <li>
                                                    <span class="sale-info"><?php echo T('接点人'); ?>：</span>
                                                    <span class="sale-num"><span class="badge badge-warning"><?php echo $prename; ?></span></span>
                                                </li>
                                                <li>
                                                    <span class="sale-info"><?php echo T('市场位置'); ?>：</span>
                                                    <span class="sale-num"><span class="badge badge-info"><?php echo Common_Function::getPosName($user['pos']); ?></span></span>
                                                </li>
                                            <?php endif;?>

                                            <?php if(CAN_BD): ?>
                                                <li>
                                                    <span class="sale-info"><?php echo T('报单中心'); ?>：</span>
                                                    <span class="sale-num"><span class="badge badge-default"><?php echo $user['zmd_name']; ?></span></span>
                                                </li>
                                            <?php endif;?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end col-md-4-->
                            <div class="col-md-8 profile-info summary-info">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('基本信息'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="sale-info"><?php echo T('性别'); ?>：</span>
                                                <span class="sale-txt"><?php $sexs= DI()->config->get('app.sex'); echo $sexs[$user['sex']]; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('身份证号码'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['idcard']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('手机号码'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['mobile']; ?> </span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('所在地'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['province'],'--',$user['city'],'--',$user['area']; ?></span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('银行账户信息'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="sale-info"><?php echo T('开户银行'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['bank_name']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('银行卡号'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['bank_no']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('开户姓名'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['bank_user']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('银行地址'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['bank_address']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                              <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('主要联系方式'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="sale-info"><?php echo T('支付宝'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['alipay']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('QQ'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['qq']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('邮箱'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['email']; ?></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('微信号'); ?>：</span>
                                                <span class="sale-txt"><?php echo $user['weixin']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!--end col-md-8-->

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