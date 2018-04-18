<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        vertical-align: middle;
    }
    .table img{
        max-width: 60px;
        max-height:60px;
    }
</style>
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
                            <h1><?php echo T('订单详情'); ?><small><!--这里是概要--></small></h1>
                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?> <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-md-6 profile-info summary-info">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('订单信息'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">

                                            <li>
                                                <span class="sale-info"><?php echo T('编号'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-danger"><?php echo $order['order_sn']; ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('订单金额'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-primary"><?php echo $order['order_amount']; ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('待付款金额'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-danger"><?php echo $order['pay_amount']; ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('付款方式'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-info"><?php echo $order['pay_name'] ?>></span></span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 profile-info summary-info">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('订单状态'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">

                                            <li>
                                                <span class="sale-info"><?php echo T('状态'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-info"><?php echo Domain_ShopOrders::orderStatus($order['status']); ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('配送方式'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-default"><?php echo T('快递'); ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('买家'); ?>：</span>
                                                <span class="sale-num"><span class="badge badge-danger"><?php echo $order['buyer_name']; ?></span></span>
                                            </li>
                                            <li>
                                                <span class="sale-info"><?php echo T('收货人信息'); ?>：</span>
                                                <span class="sale-num"><span class="badge"><?php $address = unserialize($order['address']); echo $address['province'],' ',$address['city'],' ',$address['area'],' ',$address['address'],' ',$address['realname'],' ',$address['mobile'],' '; ?></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end col-md-8-->
                            <div class="col-md-12 profile-info summary-info summary-fr">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('商品信息'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="navbar-inner">
                                            <tr>
                                                <th style="width:200px">标题</th>
                                                <th>规格/编号/条码</th>
                                                <th>单价(元)/数量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($goods as $good): ?>
                                                <tr>
                                                    <td class="full"><div style="display: inline-block"><img src="<?php echo Common_Function::GoodsPath($good['goods_pic']); ?>"></div><?php echo $good['goods_name']; ?></td>
                                                    <td><span style="white-space:normal;">
                                                <?php if($good['goods_option']):$good['goods_option'] = json_decode($good['goods_option'],true); ?>
                                                    <?php echo $good['goods_option']['option_title'] ?>
                                                <?php endif;?>
                                            </span></td>
                                                    <td><?php echo $good['price'],'<br>x',$good['total']; ?></td>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody></table>
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