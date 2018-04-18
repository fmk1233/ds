<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>
<style type="text/css">
    .Order_form_list table  td .product_name a{
        width: 201px;
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
            <div class="info_content">
                <div class="title_Section"><span>订单管理</span></div>
                <div class="Order_Sort">
                    <ul>
                        <li><a data-toggle="url" data-service="Order.OrderList" data-status="0" href="javascript::void(-1)"><img src="<?php echo $path; ?>images/icon-dingdan1.png"><br>待付款（<?php echo $order['wait_pay']; ?>）</a></li>
                        <li><a  data-toggle="url" data-service="Order.OrderList" data-status="3" href="javascript::void(-1)"><img src="<?php echo $path; ?>images/icon-dingdan.png"><br>已完成（<?php echo $order['finished']; ?>）</a></li>
                        <li><a  data-toggle="url" data-service="Order.OrderList" data-status="1" href="javascript::void(-1)"><img src="<?php echo $path; ?>images/icon-kuaidi.png"><br>待发货（<?php echo $order['payed']; ?>）</a>
                        </li>
                        <li class="noborder"><a data-toggle="url" data-service="Order.OrderList" data-status="2" href="javascript::void(-1)"><img src="<?php echo $path; ?>images/icon-weibiaoti101.png"><br>待收货（<?php echo $order['shipping']; ?>）</a></li>
                    </ul>
                </div>
                <div class="Order_form_list">
                    <table>
                        <thead>
                        <tr>
                            <td class="list_name_title0">商品</td>
                            <td class="list_name_title1">单价(元)</td>
                            <td class="list_name_title2">数量</td>
                            <td class="list_name_title4">实付款(元)</td>
                            <td class="list_name_title5">订单状态</td>
                            <td class="list_name_title6">操作</td>
                        </tr>
                        </thead>
                        <?php foreach ($list as $list_item): ?>
                            <tbody>
                            <tr class="Order_info">
                                <td colspan="6" class="Order_form_time">
                                    下单时间：<?php echo date('Y-m-d', $list_item['add_time']); ?> |
                                    订单号：<?php echo $list_item['order_sn']; ?> <em></em></td>
                            </tr>
                            <tr class="Order_Details">
                                <td colspan="3">
                                    <table class="Order_product_style">
                                        <tbody>
                                        <?php foreach ($list_item['goods'] as $goods_item): ?>
                                            <tr>
                                                <td>
                                                    <div class="product_name clearfix">
                                                        <a data-service="Goods.Product" data-id="<?php echo $goods_item['goods_id']; ?>" class="product_img" data-toggle="url" href="javascript::void(-1)"><img src="<?php echo Common_Function::GoodsPath($goods_item['goods_pic']); ?>"  width="80px"  height="80px"></a>
                                                        <a href="3"><?php echo $goods_item['goods_name']; ?></a>
                                                        <p class="specification"><?php echo $goods_item['guige']; ?></p>
                                                    </div>
                                                </td>
                                                <td>￥ <?php echo $goods_item['price']; ?></td>
                                                <td>x <?php echo $goods_item['total']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </td>
                                <td class="split_line"><?php echo $list_item['order_amount']; ?></td>
                                <td class="split_line">
                                    <?php if ($list_item['status'] == 0): ?>
                                        待付款
                                    <?php elseif ($list_item['status'] == 1): ?>
                                        待发货
                                    <?php elseif ($list_item['status'] == 2): ?>
                                        待收货
                                    <?php elseif ($list_item['status'] == 3): ?>
                                        完成
                                    <?php endif; ?>
                                </td>
                                <td class="operating">
                                    <a data-toggle="url" data-service="Order.OrderInfo"
                                       data-id="<?php echo $list_item['id']; ?>" href="javascript::void(-1)">查看详细</a>
                                    <?php if ($list_item['status'] == 0): ?>
                                        <a data-service="Order.DelOrder" data-orderid="<?php echo $list_item['id']; ?>"
                                           href="javascript::void(-1)" del>删除</a>
                                        <a data-toggle="url" data-service="Order.Pay"
                                           data-id="<?php echo $list_item['id']; ?>" href="javascript::void(-1)">支付</a>
                                    <?php elseif ($list_item['status'] == 2): ?>
                                        <a data-service="Order.ConfirmOrder" data-orderid="<?php echo $list_item['id']; ?>"
                                           href="javascript::void(-1)" confirm>确认收货</a>
                                    <?php endif; ?>

                                </td>
                            </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
                <script>jQuery(".Order_form_list").slide({
                        titCell: ".Order_info",
                        targetCell: ".Order_Details",
                        defaultIndex: 1,
                        delayTime: 300,
                        trigger: "click",
                        defaultPlay: false,
                        returnDefault: false
                    });</script>
            </div>
            <?php $this->view('common/page'); ?>
            <!---->
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    $(function () {
        $('.Order_form_list a[del]').on('click', function () {
            var $this = $(this);
            layer.confirm('您确认要删除该订单，一经删除不能还原',function () {
                sendButtonAjax($this, $this.data());
            });
        });
        $('.Order_form_list a[confirm]').on('click', function () {
            var $this = $(this);
            layer.confirm('您确认要该订单已收到货！！',function () {
                sendButtonAjax($this, $this.data());
            });
        });
    });
</script>
