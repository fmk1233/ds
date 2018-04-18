<!DOCTYPE html>
<html>
<link href="<?php echo URL_ROOT . '/static/'; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
<?php $this->view('header'); ?>
<style type="text/css">
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
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                  <a class="btn btn-outline btn-primary pull-right" href="javascript:void(-1) " onclick="history.back(-1)">返回</a>  <h2>订单详情</h2></div>
                <div class="ibox-content">
                    <div class="row order-container">
                        <div class="order-container-left">
                            <div class="panel-body">
                                <h4 class="m-t-none m-b">订单信息</h4>
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

                        <div class="order-container-right">
                            <div class="panel-body" style="height:380px;">
                                <div class="row">
                                    <div class="col-sm-3 control-label" style="padding-top:10px;">订单状态: </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <h3 class="form-control-static">
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
                                        </h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span>商品信息</span>
                        </div>
                        <div class="panel-body table-responsive">
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
                                        <td class="full"><?php echo $good['goods_name']; ?></td>
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
</body>
<?php $this->view('footer_js'); ?>

</html>
