<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/Orders.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $path; ?>js/jquery.reveal.js" type="text/javascript"></script>
<style type="text/css">
    img {
        display: block;
    }

    .center-box-h .clr {
        clear: both;
    }

    .center-box-h .successful-left, .center-box-h .successful-rigter {
        float: left;
    }

    .center-box-h .successful-left {
        width: 100px;
        height: 100px;
    }

    .center-box-h .successful-left img {
        width: 100px;
        height: 100px;
    }

    .successful-center-box {
        padding: 20px;
        border: 1px solid #999;
        margin-top: 20px;
    }

    .center-box-h .title-box {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .center-box-h .title-box span {
        color: #ff5d5b;
        font-size: 18px;
    }

    .center-box-h .successful-rigter {
        margin-left: 20px;
        line-height: 24px;
    }

    .center-box-h .text-box a {
        color: #2ea7e7;
    }

    .J-rcChannels {
        padding: 20px 0;
    }

    .row-container-focus {
        border: #85a1d4 3px solid;
        padding: 0 20px;
    }

    .row-basic {
        height: 52px;
        width: 100%;
        line-height: 52px;
        cursor: pointer;
    }

    .row-container-focus .channel-input {
        left: 20px;
        top: 20px;
    }

    .channel-label {
        display: block;
        height: 100%;
        width: 100%;
    }

    .banklogo-HXBANK_s {
        background-image: url(https://as.alipayobjects.com/g/cashier-wd/bank-logo/2017.3.15/HXBANK_s.png);
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: 0 0;
    }

    .pay-amount {
        float: right;
        margin-right: 17px;
        margin-left: 5px;
        min-width: 150px;
        text-align: right;
        padding: 10px 0;
        height: 32px;
        line-height: 32px;
    }

    .channel-bank .channel-name {
        width: 135px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-right: 15px;
        font-size: 14px;
        float: left;
    }

    .row-basic .card-number {
        width: 65px;
        float: left;
        min-height: 20px;
    }

    .row-basic .card-type {
        min-width: 88px;
        float: left;
    }

    .channel-icon {
        height: 15px;
        width: 25px;
        float: left;
        margin-top: 18px;
        margin-right: 5px;
    }

    .row-basic .amount-font-R16 {
        margin-right: 3px;
        margin-left: 3px;
        vertical-align: bottom;
        font-size: 16px;
        color: #ff8208;
        font-weight: 700;
    }

    .row-container {
        position: relative;
    }

    .row-container .channel-input {
        position: absolute;
        left: 24px;
        top: 18px;
        display: block !important;
    }

    .ui-button-lblue {
        height: 50px;
        line-height: 48px;
        padding: 0;
        font-size: 18px;
        width: 220px;
        font-family: "Microsoft Yahei";
        font-weight: 700;
        text-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        background-color: #1bdb68;
        color: #fff;
        display: inline-block;
        border: 1px solid #0fbd55;
        background-repeat: repeat-x;
        border-radius: 2px;
        vertical-align: middle;
        cursor: pointer;
        text-align: center;
        margin-left: 980px;
    }

    body .fn-hide {
        display: none;
        color: #20b907;
        padding-right: 15px;
    }

    .channel-tit {
        margin-left: 50px;
    }

    .fn-clear {
        zoom: 1;
    }

    .payment ul li {
        float: left;
        padding: 20px 30px 0px 0;;
    }

    .Pay_info .text_name {
        border: 1px solid #ddd;
        width: 150px;
        margin: 0px 5px;
        padding: 5px;
        min-height: 18px;
        border-radius: 3px 3px 3px 3px;
        -moz-border-radius: 3px 3px 3px 3px;
        -webkit-border-radius: 3px 3px 3px 3px;
    }


</style>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--确认订单页样式-->
<div class="center-box-h">
    <div class="Inside_pages clearfix layui-form" id="Orders">
        <div class="successful-center-box">
            <div class="successful-left"><img src="<?php echo $path; ?>images/succ.png"></div>
            <ul class="successful-rigter">
                <li class="title-box">订单<?php echo $order['order_sn']; ?>支付成功！订单总价<span>￥<?php echo $order['order_amount']; ?></span>元
                </li>
                <li class="text-box"><a data-toggle="url" data-service="Order.OrderList" href="javascript::void(-1)">*你可以在用户中心中的我的订单查看核订单</a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
        </form>
    </div>
</div>


<?php $this->view('common/footer'); ?>
