<div class="s_cart"><em class="iconfont icon-cart2"></em><a data-toggle="url" data-service="Order.CartList"
                                                            href="javascript::void(-1)">我的购物车</a> <i
        class="ci-right">></i><i class="ci-count" id="shopping-amount">0</i></div>
<div class="dorpdown-layer">
    <div class="spacer"></div>
    <?php $cart_list = Domain_Cart::getCartList(Common_Function::user_id()); ?>
    <?php if (count($cart_list) == 0): ?>
        <div class="nogoods"><b></b>购物车中还没有商品，赶紧选购吧！</div>
    <?php else: ?>
        <ul class="p_s_list">
            <?php $all_total = 0;
            $price_total = 0;
            foreach ($cart_list as $cart_item): Domain_Cart::goodsInfo($cart_item); ?>
                <li>
                    <div class="img"><img
                            src="<?php $goods_pics = explode(',', $cart_item['goods_pics']);
                            echo Common_Function::GoodsPath($goods_pics[0]); ?>"></div>
                    <div class="content"><p><a href="#"><?php echo $cart_item['goods_name']; ?></a></p>
                        <p><?php echo $cart_item['guige']; ?> x<?php echo $cart_item['total']; ?></p></div>
                    <div class="Operations">
                        <p class="Price">￥<?php echo $cart_item['price']; ?></p>
                        <p><a  del href="javascript:void(-1)" data-service="Order.DelCart"
                               data-cartid="<?php echo $cart_item['id']; ?>">删除</a></p></div>
                </li>
                <?php $all_total += $cart_item['total'];
                $price_total += $cart_item['total'] * $cart_item['price']; endforeach; ?>

        </ul>
        <div class="Shopping_style">
            <div class="p-total">
                共<b><?php echo $all_total; ?></b>件商品　共计<strong>￥ <?php echo $price_total; ?></strong></div>
            <a data-toggle="url" data-service="Order.CartList" href="javascript::void(-1)" title="去购物车结算"
               id="btn-payforgoods" class="Shopping">去购物车结算</a>
            <script type="text/javascript">
                $(function () {
                    $('#shopping-amount').html('<?php echo $all_total; ?>');
                    $('#Shopping_list a[del]').on('click', function () {
                        var button = $(this);
                        var params = button.data();
                        layer.confirm('您确认要删除该购物车商品', function () {
                            sendButtonAjax(button, params, {
                                callback: function (d) {
                                    if (d.code == 40000) {
                                        cart_list();
                                    }
                                }
                            });
                        });
                    });
                })
            </script>
        </div>
    <?php endif; ?>

</div>