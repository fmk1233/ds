<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>
<style type="text/css">
    .Order_form_list table td .product_name a {
        width: 201px;
    }

    /*订单详情相关
    -------------------------------------------*/
    .dmm-oredr-show {
        width: 99%;
        margin-left: 1%;
    }

    .dmm-order-info {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        border: solid 1px #D8D8D8;
        position: relative;
        z-index: 2;
    }

    .dmm-order-details {
        background-color: #FBFBFB;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        *zoom: 1 /*IE7*/;
        width: 359px;
        border-right: solid 1px #D8D8D8;
    }

    .dmm-order-details .title {
        font-size: 12px;
        font-weight: 600;
        line-height: 20px;
        background-color: #F3F3F3;
        height: 20px;
        padding: 9px;
        border-bottom: solid 1px #D8D8D8;
    }

    .dmm-order-details .content {
        display: block;
        width: auto;
        padding: 17px 17px 7px 17px;
    }

    .dmm-order-details .content dl,
    .dmm-order-contnet .daddress-info {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        margin-bottom: 10px;
    }

    .dmm-order-details .content dl.line {
        padding-top: 10px;
        border-top: dotted 1px #D8D8D8;
    }

    .dmm-order-details .content dl dt,
    .dmm-order-details .content dl dd,
    .dmm-order-contnet .daddress-info dt,
    .dmm-order-contnet .daddress-info dd {
        font-size: 12px;
        line-height: 20px;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        *zoom: 1 /*IE7*/;
    }

    .dmm-order-details .content dl dt {
        color: #888;
        width: 20%;
    }

    .dmm-order-details .content dl dd {
        color: #666;
        width: 80%;
    }

    .dmm-order-details .content dl dd span {
        margin-right: 6px;
    }

    .dmm-order-details .content dl dd a,
    .dmm-order-contnet .daddress-info dd a {
        color: #666;
        float: right;
        padding: 0 5px 0 10px;
        position: relative;
        z-index: 1;
    }

    .dmm-order-details .content dl dd a:hover,
    .dmm-order-contnet .daddress-info dd a:hover {
        text-decoration: none;
        color: #F33;
        z-index: 2;
    }

    .dmm-order-details .content dl dd a i,
    .dmm-order-contnet .daddress-info dd a i {
        font-size: 10px;
        margin-left: 4px;
    }

    .dmm-order-details .content dl dd a .more,
    .dmm-order-contnet .daddress-info dd a .more {
        background-color: #FBFBFB;
        display: none;
        width: 323px;
        padding: 10px;
        border: solid 1px #CCC;
        position: absolute;
        z-index: 1;
        right: -10px;
        top: 25px;
        box-shadow: 2px 2px 0 rgba(153, 153, 153, 0.15)
    }

    .dmm-order-details .content dl dd a:hover .more,
    .dmm-order-contnet .daddress-info dd a:hover .more {
        display: block;
    }

    .dmm-order-details .content dl dd a .more .arrow,
    .dmm-order-contnet .daddress-info dd a .more .arrow {
        background: url(<?php echo $path;?>/images/member_pics.png) no-repeat -140px 0;
        width: 11px;
        height: 6px;
        position: absolute;
        z-index: 2px;
        top: -6px;
        right: 30px;
    }

    .dmm-order-details .content dl dd a .more ul {
    }

    .dmm-order-details .content dl dd a .more li,
    .dmm-order-contnet .daddress-info dd a .more li {
        line-height: 24px;
        color: #888;
    }

    .dmm-container #container {
        width: 320px;
        height: 320px;
    }

    .dmm-order-details .content dl dd a .more li span,
    .dmm-order-contnet .daddress-info dd a .more li span {
        color: #666;
        display: inline;
    }

    .dmm-order-details .content dl dd .msg {
        text-align: left;
        margin-top: 5px;
    }

    .dmm-order-details .content dl dd .msg a {
        float: none;
        padding: 0;
        margin-right: 5px;
    }

    .dmm-order-condition {
        font-size: 12px;
        background-color: #FFF;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        width: 536px;
        *zoom: 1 /*IE7*/;
        padding: 20px 30px;
    }

    .dmm-order-condition dl {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        display: block;
        padding-bottom: 15px;
        margin-bottom: 20px;
        border-bottom: dotted 1px #E7E7E7;
    }

    .dmm-order-condition dl dt,
    .dmm-order-condition dl dd {
        font: normal 16px/32px "microsoft yahei", Arial;
        color: #333;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        *zoom: 1 /*IE7*/;
    }

    .dmm-order-condition ul {
        margin-left: 40px;
    }

    .dmm-order-condition li {
        display: block;
        margin-bottom: 10px;
    }

    .dmm-order-condition li .dmbth-mini {
        margin: 0 5px;
    }

    .dmm-order-condition li time {
        font-family: Tahoma;
        color: #C63;
        margin: 0 5px;
    }

    .dmm-order-info .mall-msg {
        font-size: 12px;
        font-weight: 600;
        color: #999;
        position: absolute;
        z-index: 1;
        bottom: 5px;
        right: 10px;
    }

    .dmm-order-info .mall-msg a {
        font-weight: normal;
        color: #06C;
        margin-left: 4px;
    }

    .dmm-order-info .mall-msg a:hover {
        text-decoration: none;
    }

    .dmm-order-step {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        margin-top: 30px;
        position: relative;
        z-index: 1;
    }

    .dmm-order-step dl {
        font-size: 12px;
        line-height: 20px;
        background: url(<?php echo $path;?>/images/member_pics.png) no-repeat -285px -130px;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        width: 215px;
        height: 36px;
        margin: 50px 0 60px -1px;
        position: relative;
        z-index: auto;
        *zoom: 1 /*IE7*/;
    }

    .dmm-order-step dl.step-first {
        background-position: -240px -130px;
        width: 36px;
        margin-left: 50px;
    }

    .dmm-order-step dl.long {
        background-position: -115px -370px;
        width: 385px;
    }

    .dmm-order-step dl dt {
        font-weight: 600;
        text-align: center;
        width: 70px;
        position: absolute;
        z-index: 1;
        top: -30px;
        right: -12px;
    }

    .dmm-order-step dl.current dt {
        color: #FD6760;
    }

    .dmm-order-step dl dd.bg {
        background: url(<?php echo $path;?>/images/member_pics.png) no-repeat -280px -170px;
        display: none;
        width: 220px;
        height: 36px;
        position: absolute;
        z-index: 1;
        top: 0;
        right: 0;
    }

    .dmm-order-step dl.step-first dd.bg {
        background-position: -240px -170px;
        width: 36px;
    }

    .dmm-order-step dl.long dd.bg {
        background-position: -110px -410px;
        width: 390px;
    }

    .dmm-order-step dl dd.date {
        font: 12px/20px Tahoma, Arial;
        color: #999;
        text-align: center;
        display: none;
        width: 120px;
        position: absolute;
        z-index: 2;
        bottom: -40px;
        right: -42px;
    }

    .dmm-order-step dl.current dd {
        display: block;
    }

    /*线下团订单详情页面的特殊性*/
    /*虚拟商品实体店地址地图*/
    .dms-store-map-content {
        margin: 20px;
        overflow: hidden;
    }

    .dms-store-map-baidu {
        float: left;
    }

    .dms-store-map-info {
        width: 280px;
        height: 400px;
        float: right;
        padding: 0 0 0 20px;
        border-left: solid 1px #E6E6E6;
    }

    .dms-store-map-info .store-district {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .dms-store-map-info .address-box {
        width: 100%;
        height: 360px;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .dms-store-map-info .address-list {
    }

    .dms-store-map-info .address-list dl {
        border: solid 1px #E6E6E6;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .dms-store-map-info .address-list dt {
        font-size: 12px;
        line-height: 20px;
        font-weight: 600;
        background-color: #FAFAFA;
        padding: 2px 10px;
        border-bottom: solid 1px #E6E6E6;
    }

    .dms-store-map-info .address-list dd {
        font-size: 12px;
        line-height: 20px;
        margin: 5px 10px 0 10px
    }

    .dmm-default-table {
        line-height: 20px;
        width: 100%;
        border-collapse: collapse;
        clear: both;
    }

    .dmm-default-table thead th {
        color: #999;
        background-color: #FFF;
        text-align: center;
        height: 20px;
        padding: 8px 0;
        border-bottom: solid 1px #E7E7E7;
    }

    .dmm-order-step .code-list {
        font-size: 12px;
        background-color: #F9F9F9;
        width: 398px;
        padding: 9px;
        margin: -50px 0 0 400px;
        border: solid 1px #CCC;
        position: relative;
        z-index: 1;
        box-shadow: 3px 3px 0 rgba(153, 153, 153, 0.05);
    }

    .dmm-order-step .code-list .arrow {
        background: url(<?php echo $path;?>/images/member_pics.png) no-repeat -140px 0;
        width: 11px;
        height: 6px;
        position: absolute;
        z-index: 1;
        top: -6px;
        left: 90px;
    }

    .dmm-order-step .code-list h5 {
        font-size: 14px;
        line-height: 16px;
        font-weight: 600;
        display: inline-block;
        height: 16px;
        padding-left: 5px;
        border-left: 3px solid #FD6760;
    }

    .dmm-order-step .code-list h5 em {
        font-size: 12px;
        color: #09C;
    }

    .dmm-order-step .code-list #codeList {
        max-height: 135px;
        position: relative;
        z-index: auto;
        overflow: hidden;
    }

    .dmm-order-step .code-list ul {
    }

    .dmm-order-step .code-list li {
        color: #999;
        background-color: #FCFCFC;
        padding: 4px;
        margin-top: 5px;
    }

    .dmm-order-step .code-list li:hover {
        background-color: #FFF;
        box-shadow: 0 0 5px rgba(204, 204, 204, 0.75);
    }

    .dmm-order-step .code-list li strong {
        font-family: Tahoma;
        font-size: 14px;
        font-weight: 600;
        color: #090;
        margin: 0 20px 0 5px;
    }

    .dmm-order-step .code-list li.used {
        color: #F90;
        background-color: transparent;
        box-shadow: none;
    }

    .dmm-order-step .code-list li.used strong {
        color: #999;
    }

    .dmm-order-contnet {
        margin-top: 30px;
    }

    .dmm-order-contnet .dmm-default-table {
        border: solid 1px #D8D8D8;
    }

    .dmm-order-contnet tbody th,
    .dmm-order-contnet tfoot th {
        background-color: #F3FAFE;
    }

    .dmm-order-contnet tbody td.refund span {
        background-color: #69AA46;
        color: #FFF;
        margin-left: 4px;
        padding: 1px 2px;
    }

    .dmm-order-contnet .order-deliver,
    .dmm-order-contnet .daddress-info {
        margin: 5px 10px;
    }

    .dmm-order-contnet .order-deliver span {
        margin-right: 30px;
    }

    .dmm-order-contnet .order-deliver a {
        color: #0279B9;
        position: relative;
        z-index: 1;
    }

    .dmm-order-contnet .order-deliver a:hover {
        color: #F33;
        text-decoration: none;
    }

    .dmm-order-contnet .order-deliver a i {
        font-size: 10px;
        margin-left: 4px;
    }

    .dmm-order-contnet .order-deliver a .more {
        line-height: 28px;
        background-color: #FBFBFB;
        display: none;
        width: 480px;
        padding: 10px;
        border: 1px solid #CCCCCC;
        position: absolute;
        z-index: 1;
        top: 20px;
        left: -200px;
        box-shadow: 2px 2px 0 rgba(153, 153, 153, 0.15);
    }

    .dmm-order-contnet .order-deliver a .more .arrow {
        background: url("<?php echo $path;?>/images/member_pics.png") no-repeat scroll -140px 0 rgba(0, 0, 0, 0);
        width: 11px;
        height: 6px;
        position: absolute;
        z-index: 1;
        top: -6px;
        left: 220px;
    }

    .dmm-order-contnet .order-deliver a:hover .more {
        color: #555;
        display: block;
    }

    .dmm-order-contnet .daddress-info dt {
        color: #888;
        text-align: right;
        width: 28%;
    }

    .dmm-order-contnet .daddress-info dd {
        color: #666;
        width: 72%;
    }

    .dmm-order-contnet .daddress-info dd a .more {
        width: 280px;
        right: 0px;
        top: 25px;
    }

    .dmm-order-contnet .daddress-info dd a .more .arrow {
        top: -6px;
        right: -5px;
    }

    .dm-store-sales {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        display: block;
        clear: both;
        width: 360px;
        height: 24px;
        margin: 4px;
    }

    .dm-store-sales dt,
    .dm-store-sales dd {
        font-size: 12px;
        line-height: 20px;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        *zoom: 1 /*IE7*/;
    }

    .dm-store-sales dt {
        line-height: 20px;
        font-weight: 600;
        color: #FFF;
        background-color: #FF875A;
        text-align: right;
        width: 60px !important;
        padding: 2px 6px;
    }

    .dm-store-sales dd {
        line-height: 20px;
        background-color: #FFF;
        width: 274px;
        height: 20px;
        padding: 1px 5px;
        border: dotted #FF875A;
        border-width: 1px 1px 1px 0;
    }

    .dm-store-sales dd img {
        width: 20px;
        height: 20px;
        display: inline-block;
        vertical-align: top;
    }

    .dmm-order-contnet tfoot td {
        background-color: #F5F5F5;
    }

    .dmm-order-contnet tfoot td dl {
        font-size: 0;
        *word-spacing: -1px /*IE6、7*/;
        float: right;
        clear: both;
        padding: 2px;
    }

    .dmm-order-contnet tfoot td dl dt,
    .dmm-order-contnet tfoot td dl dd {
        font-size: 12px;
        line-height: 20px;
        vertical-align: bottom;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        *display: inline /*IE7*/;
        *zoom: 1 /*IE7*/;
    }

    .dmm-order-contnet tfoot td dl dt {
        width: 100px;
        text-align: right;
    }

    .dmm-order-contnet tfoot td dl dd {
        min-width: 120px;
        text-align: left;
    }

    .dmm-order-contnet tfoot td .sum {
        font-weight: 600;
        color: #666;
    }

    .dmm-order-contnet tfoot td .sum em {
        font: 20px/24px Verdana, Arial;
        color: #C00;
        vertical-align: bottom;
        margin: 0 4px;
    }

    .dmm-default-table img {
        width: 75px;
        height: 75px;
    }

    a.dmbth-mini {
        font: 400 12px/20px "microsoft yahei", arial;
        color: #FFF;
        background-color: #CCD0D9;
        text-align: center;
        vertical-align: middle;
        display: inline-block;
        cursor: pointer;
        line-height: 16px;
        height: 16px;
        padding: 3px 7px;
        border-radius: 2px;
    }

    a.dmbth-bittersweet {
        background-color: #E9573E;
    }
</style>
<!--订单管理-->
<div class="user_style clearfix">
    <div class="user_center">
        <!--左侧菜单栏-->
        <div class="left_style">
            <?php $this->view('user/user_left'); ?>
        </div>
        <!--右侧样式-->
        <div class="right_style">
            <div class="dmm-oredr-show">
                <div class="dmm-order-info">
                    <div class="dmm-order-details">
                        <div class="title">订单信息</div>
                        <div class="content">
                            <dl>
                                <dt>收货地址：</dt>
                                <dd><?php $address = unserialize($order['address']); ?>
                                    <span><?php echo $address['realname']; ?>
                                        ，</span><span><?php echo $address['mobile']; ?>
                                        ，</span><span><?php echo $address['province'] . ' ' . $address['city'] . ' ' . $address['area'] . ' ' . $address['address'] ?></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>买家留言：</dt>
                                <dd><?php echo $order['memo']; ?></dd>
                            </dl>
                            <dl class="line">
                                <dt>订单编号：</dt>
                                <dd><?php echo $order['order_sn']; ?><a href="javascript:void(0);">更多<i
                                                class="icon-angle-down"></i>
                                        <div class="more"><span class="arrow"></span>
                                            <ul>
                                                <li>
                                                    支付方式：<span><?php echo Domain_Payment::paymentTypeName($order['pay_type']); ?></span>
                                                </li>
                                                <li>
                                                    下单时间：<span><?php echo date('Y-m-d H:i:s', $order['add_time']); ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </a></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="dmm-order-condition">
                        <dl>
                            <dt><span ><img width="22px" height="22px" src="<?php echo $path; ?>images/succ.png"></span>  订单状态：</dt>
                            <dd>
                                <?php if ($order['status'] == ORDER_WAIT_PAY): ?>
                                    订单已经提交，等待买家付款
                                <?php elseif ($order['status'] == ORDER_PAYED): ?>
                                    买家已付款，等待卖家发货
                                <?php elseif ($order['status'] == ORDER_SHIPPING): ?>
                                    卖家已发货，等待买家收货
                                <?php elseif ($order['status'] == ORDER_FINISHED): ?>
                                    交易完成
                                <?php endif; ?>

                            </dd>
                        </dl>
                        <ul>
                            <?php if ($order['status'] == ORDER_WAIT_PAY): ?>
                                <li>1. 您尚未对该订单进行支付，请<a data-toggle="url" data-service="Order.Pay"
                                                       data-id="<?php echo $order['id']; ?>"
                                                       class="dmbth-mini dmbth-bittersweet"><i></i>支付订单</a>以确保商家及时发货。
                                </li>
                                <li>2. 如果您不想购买此订单的商品，请选择<a data-service="Order.DelOrder"
                                                           data-orderid="<?php echo $order['id']; ?>"
                                                           href="javascript::void(-1)" del class="dmbth-mini">取消订单</a>操作。
                                </li>
                            <?php elseif ($order['status'] == ORDER_PAYED): ?>
                                <li>1. 您已使用“<?php echo Domain_Payment::paymentTypeName($order['pay_type']); ?>
                                    ”方式成功对订单进行支付，支付单号 “<?php echo $order['order_sn']; ?>”。
                                </li>
                                <li>2. 订单已提交商家进行备货发货准备。</li>
                            <?php elseif ($order['status'] == ORDER_SHIPPING): ?>
                            <?php elseif ($order['status'] == ORDER_FINISHED): ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div id="order-step" class="dmm-order-step">
                    <dl class="step-first <?php echo $order['status'] >= ORDER_WAIT_PAY ? 'current' : ''; ?>">
                        <dt>生成订单</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="下单时间"><?php echo date('Y-m-d H:i:s', $order['add_time']); ?></dd>
                    </dl>
                    <dl class="<?php echo $order['status'] >= ORDER_PAYED ? 'current' : ''; ?>">
                        <dt>完成付款</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="付款时间"><?php echo date('Y-m-d H:i:s', $order['pay_time']); ?></dd>
                    </dl>
                    <dl class="<?php echo $order['status'] >= ORDER_SHIPPING ? 'current' : ''; ?>">
                        <dt>商家发货</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="发货时间"><?php echo date('Y-m-d H:i:s', $order['delivery_time']); ?></dd>
                    </dl>
                    <dl class="<?php echo $order['status'] >= ORDER_FINISHED ? 'current' : ''; ?>">
                        <dt>确认收货</dt>
                        <dd class="bg"></dd>
                        <dd class="date" title="完成时间"><?php echo date('Y-m-d H:i:s', $order['confirm_time']); ?></dd>
                    </dl>
                </div>
                <div class="dmm-order-contnet">
                    <table class="dmm-default-table order">
                        <thead>
                        <tr>
                            <th>商品名称</th>
                            <th>规格</th>
                            <th>单价</th>
                            <th>数量</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($goods as $goods_item): ?>
                            <tr class="bd-line">
                                <td>
                                    <div style="display: inline-block;padding: 10px"><img
                                                src="<?php echo Common_Function::GoodsPath($goods_item['goods_pic']); ?>">
                                    </div>
                                    <div style="display: inline-block">
                                        <?php echo $goods_item['goods_name'] ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($goods_item['goods_option']):$goods_item['goods_option'] = json_decode($goods_item['goods_option'],true); ?>
                                        <?php echo '规格：'.$goods_item['goods_option']['option_title'] ?>
                                    <?php endif;?>
                                </td>
                                <td><?php echo $goods_item['price']; ?></td>
                                <td>x<?php echo $goods_item['total']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="20">
                                <!-- <dl class="freight">
                                     <dd>
                                         （免运费）                              </dd>
                                 </dl>-->
                                <dl class="sum" style="padding: 10px 0px">
                                    <dt>订单应付金额：</dt>
                                    <dd><em><?php echo $order['order_amount']; ?></em>元</dd>
                                </dl>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!---->
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    $(function () {
        $('.dmm-order-info a[del]').on('click', function () {
            var $this = $(this);
            layer.confirm('您确认要删除该订单，一经删除不能还原', function () {
                sendButtonAjax($this, $this.data(), {
                    callback: function () {
                        history.back();
                    }
                });
            });
        });
        $('.dmm-order-info a[confirm]').on('click', function () {
            var $this = $(this);
            layer.confirm('您确认要该订单已收到货！！', function () {
                sendButtonAjax($this, $this.data());
            });
        });
    });
</script>
