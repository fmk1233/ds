<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style type="text/css">
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            vertical-align: middle;
        }
        .table img{
            max-width: 60px;
            max-height:60px;
        }
        .order-container {
            position: relative;
            overflow: hidden;
            border: 1px solid #f2f2f2;
            margin: 0px;
        }
        .order-container-left {
            float: left;
            width: 300px;
        }
        .order-container-right {
            border-left: 1px solid #f2f2f2;
            float: left;
            width: 500px;
            position: relative;
        }
        .ordertable tr td {
            padding: 10px 0px 0;
            vertical-align: top;
        }
        .ordertable tr td:first-child {
            text-align: right;
        }

    </style>
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
                    <h2><?php echo T('订单信息'); ?>
                        </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('订单管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('订单信息'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content l-position">
                                    <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?><i
                                            class="fa fa-arrow-circle-left"></i></a>
                                    <div class="row order-container ddxq-obox">
                                        <div class="order-container-left ddxq-box">
                                            <div class="panel-body pad0">
                                                <h4 class="m-t-none m-b ddxq-title">订单信息</h4>
                                                <div class="form-group" style="padding:0 10px;">
                                                    <table class="ordertable" style="table-layout:fixed">
                                                        <tbody><tr>
                                                            <td style="width:80px">订单编号：</td>
                                                            <td><?php echo $order['order_sn']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>订单金额：</td>
                                                            <td>￥<?php echo $order['order_amount']; ?> &nbsp;&nbsp;</td>
                                                        </tr>



                                                        <tr>
                                                            <td style="width:80px">付款方式：</td>
                                                            <td> <?php if($order['status']==0): ?>
                                                                    未支付
                                                                <?php elseif($order['status']==4): ?>
                                                                    取消支付
                                                                <?php else: ?>
                                                                    <?php echo $order['pay_name'] ?>
                                                                <?php endif;?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>买家：</td>
                                                            <td><?php echo $order['buyer_name']; ?> &nbsp;&nbsp;</td>
                                                        </tr>
                                                        </tbody></table>

                                                    <table class="ordertable" style="table-layout:fixed;border-top:1px dotted #ccc">

                                                        <tbody><tr>
                                                            <td style="width:80px">配送方式：</td>
                                                            <td>
                                                                快递
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td style="width:80px">收货人：</td>
                                                            <td style="word-break: break-all;white-space: normal">
                                                                <?php $address = unserialize($order['address']); echo $address['province'],' ',$address['city'],' ',$address['area'],' ',$address['address'],' ',$address['realname'],' ',$address['mobile'],' '; ?> </td>
                                                        </tr>

                                                        </tbody></table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-container-right bd0">
                                            <div class="panel-body pad0 ddzz-obox">
                                                <div class="ddzx-title">
                                                    <div class="control-label fl">订单状态: </div>
                                                    <div class="fl">
                                                        <div class="form-control-static">
                                                            <?php if($order['status']==0): ?>
                                                                <span class="text-default">待付款</span>
                                                            <?php elseif($order['status']==1): ?>
                                                                <span class="text-info">待发货</span>
                                                            <?php elseif($order['status']==2): ?>
                                                                <span class="text-warning">待收货</span>
                                                            <?php elseif($order['status']==3): ?>
                                                                <span class="text-success">已完成</span>
                                                            <?php elseif($order['status']==4): ?>
                                                                <span class="text-default">已取消</span>
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <!--<div class="ddzz-cnt">
                                                    <div>您还有<span style="color: #C60500;">5天2小时14分27秒</span>来确认收货,超时订单自动确认收货</div>
                                                    <div>物流： 中通&nbsp;&nbsp;&nbsp;&nbsp;运单号：431080303261</div>
                                                </div>
                                                <button class="ddxq-btn">确认收货</button>-->
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <span>商品信息</span>
                                        </div>
                                        <div class="panel-body table-responsive">
                                            <table class="table">
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
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer_js'); ?>
</body>

</html>
