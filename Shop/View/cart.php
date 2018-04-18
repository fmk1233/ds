<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/Orders.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .shop_carts .Process {
        width: 900px;
        padding: 30px 0;
        margin-left: 300px;
    }
</style>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--购物车样式-->
<div class="Inside_pages clearfix">
    <div class="shop_carts">
        <div class="Process"><img src="<?php echo $path; ?>images/flow_step-4.png"/></div>
        <div class="Shopping_list">
            <div class="title_name">
                <ul>
                    <li class="checkbox"></li>
                    <li class="name">商品名称</li>
                    <li class="scj">市场价</li>
                    <li class="bdj">本店价</li>
                    <li class="sl">购买数量</li>
                    <li class="xj">小计</li>
                    <LI class="cz">操作</LI>
                </ul>
            </div>
            <div class="shopping">
                <form method="post" onsubmit="return false;">
                    <table class="table_list">
                        <?php foreach ($cart_list as $cart_item): ?>
                            <tr class="tr">
                                <td class="checkbox"><input name="checkitems"
                                                            data-name="<?php Domain_Cart::goodsInfo($cart_item);
                                                            echo $cart_item['goods_name']; ?>" type="checkbox"
                                                            value="<?php echo $cart_item['id']; ?>"/></td>
                                <td class="name">
                                    <div class="img"><a data-toggle="url" data-service="Goods.Product"
                                                        data-id="<?php echo $cart_item['goods_id']; ?>"
                                                        href="javascript::void(-1)"><img
                                                    src="<?php $goods_pics = explode(',', $cart_item['goods_pics']);
                                                    echo Common_Function::GoodsPath($goods_pics[0]); ?>"/></a></div>
                                    <div class="p_name"><a data-toggle="url" data-service="Goods.Product"
                                                           data-id="<?php echo $cart_item['goods_id']; ?>"
                                                           href="javascript::void(-1)"><?php echo $cart_item['goods_name']; ?></a>
                                    </div>
                                </td>
                                <td class="scj sp"><span
                                            id="Original_Price_<?php echo $cart_item['id']; ?>">￥<?php echo $cart_item['price']; ?></span>
                                </td>
                                <td class="bgj sp"><span
                                            id="price_item_<?php echo $cart_item['id']; ?>">￥<?php echo $cart_item['market_price']; ?></span>
                                </td>
                                <td class="sl">
                                    <div class="Numbers">
                                        <a onClick="setAmount.reduce('#qty_item_<?php echo $cart_item['id']; ?>',<?php echo $cart_item['stock']; ?>)"
                                           href="javascript:void(0)" class="jian">-</a>
                                        <input type="text" name="qty_item[]" value="<?php echo $cart_item['total']; ?>"
                                               id="qty_item_<?php echo $cart_item['id']; ?>"
                                               onkeyup="setAmount.modify('#qty_item_<?php echo $cart_item['id']; ?>',<?php echo $cart_item['stock']; ?>)"
                                               data-id="<?php echo $cart_item['id']; ?>" class="number_text">
                                        <a onclick="setAmount.add('#qty_item_<?php echo $cart_item['id']; ?>',<?php echo $cart_item['stock']; ?>)"
                                           href="javascript:void(0)" class="jia">+</a>
                                    </div>
                                </td>
                                <td class="xj"><span id="total_item_<?php echo $cart_item['id']; ?>"></span></td>
                                <td class="cz">
                                    <p><a del href="javascript:void(-1)" data-service="Order.DelCart"
                                          data-cartid="<?php echo $cart_item['id']; ?>">删除</a>
                                    <P>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="sp_Operation clearfix">
                        <div class="select-all">
                            <div class="cart-checkbox"><input type="checkbox" id="CheckedAll" name="toggle-checkboxes"
                                                              class="jdcheckbox" clstag="clickcart">全选
                            </div>
                            <div class="operation"><a href="javascript:void(0);" id="send">删除选中的商品</a></div>
                        </div>
                        <!--结算-->
                        <div class="toolbar_right">
                            <ul class="Price_Info">
                                <li class="p_Total"><label class="text">商品总价：</label><span class="price sumPrice"
                                                                                           id="Total_price"></span></li>
                                <li class="Discount"><label class="text">以&nbsp;&nbsp;节&nbsp;&nbsp;省：</label><span
                                            class="price" id="Preferential_price"></span></li>
                                <!--                                <li class="integral">本次购物可获得<b id="total_points"></b>积分</li>-->
                            </ul>
                            <div class="btn"><a class="cartsubmit" order data-service="Order.OrderConfirm"
                                                href="javascript::void(-1)"></a><a
                                        class="continueFind" data-toggle="url" data-service="Default.Index"
                                        href="javascript::void(-1)"></a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--推荐产品样式-->
    </div>
</div>


<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    setAmount = {
        value: 1,
        reduce: function ($id, stock) {
            var value = $($id).val();
            if (value <= 1) {
                return false;
            }
            value--;
            this.value = value;
            $($id).val(value);
            this.change($id, this.value);
        },
        add: function ($id, stock) {
            var value = $($id).val();
            if (value >= stock) {
                return false;
            }
            value++;
            this.value = value;
            $($id).val(value);
            this.change($id, this.value);
        }, modify: function ($id, stock) {
            var value = $($id).val();
            if (value < 1 || value >= stock) {
                $($id).val(this.value);
                return false;
            } else {
                this.value = value;
            }
            this.change($id, this.value);
        }, change: function ($id, value) {
            var $this = $($id);
            ds.sendAjax({
                data: {service: 'Order.ChangeCart', cartid: $this.data('id'), num: value},
                success: function (d) {
                    if (d.code == 40000) {
                        if (d.data && d.data.total) {
                            $this.val(d.data.total);
                            alertMsg(d);
                        } else {
                            cal()
                        }
                    } else {
                        alertMsg(d);
                    }
                }
            })
        }
    }
    function cal() {
        var allTotal = 0;
        var oldTotal = 0;
        $('[id^=Original_Price_]').each(function () {
            var id = this.id.replace('Original_Price_', '');
            var market_price = parseFloat($('#price_item_' + id).html().replace('￥', ''));
            var price = parseFloat($(this).html().replace('￥', ''));
            var total = parseInt($('#qty_item_' + id).val());
            allTotal += total * price;
            oldTotal += total * market_price;
            $('#total_item_' + id).html('￥' + (price * total).toFixed(2));

        });
        $('#Total_price').html('￥' + allTotal.toFixed(2));
        $('#Preferential_price').html('￥' + (oldTotal - allTotal).toFixed(2));
    }
    $(document).ready(function () {
        //全选
        $("#CheckedAll").click(function () {
            if (this.checked) {                 //如果当前点击的多选框被选中
                $('input[type=checkbox][name=checkitems]').attr("checked", true);
            } else {
                $('input[type=checkbox][name=checkitems]').attr("checked", false);
            }
        });
        $('input[type=checkbox][name=checkitems]').click(function () {
            var flag = true;
            $('input[type=checkbox][name=checkitems]').each(function () {
                if (!this.checked) {
                    flag = false;
                }
            });

            if (flag) {
                $('#CheckedAll').attr('checked', true);
            } else {
                $('#CheckedAll').attr('checked', false);
            }
        });
        //输出值
        $("#send").click(function () {
            if ($("input[type='checkbox'][name='checkitems']:checked").attr("checked")) {
                var str = "你是否要删除选中的商品：\r\n";
                var ids = [];
                $('input[type=checkbox][name=checkitems]:checked').each(function () {
                    str += $(this).data('name') + "\r\n";
                    ids.push($(this).val());
                })
                layer.confirm(str, function () {
                    ds.sendAjax({
                        data: {service: 'Order.BatchDelCart', ids: ids},
                        success: function (d) {
                            if (d.code == 40000) {
                                successMsg(d);
                            } else {
                                alertMsg(d);
                            }
                        }
                    })
                });
            }
            else {
                var str = "你未选中任何商品，请选择后在操作！";
                layer.alert(str);
            }

        });
        $('a[order]').on('click', function () {
            var $this = $(this);
            if ($("input[type='checkbox'][name='checkitems']:checked").attr("checked")) {
                var str = "你是否要删除选中的商品：\r\n";
                var ids = [];
                $('input[type=checkbox][name=checkitems]:checked').each(function () {
                    str += $(this).data('name') + "\r\n";
                    ids.push($(this).val());
                })
                var data = $.extend({}, $this.data(), {cartids: ids});
                location.href = ds.url(data);
            }
            else {
                var str = "你未选中任何商品，请选择后在操作！";
                layer.alert(str);
            }
        });
        cal();
        $('.shopping a[del]').on('click', function () {
            var button = $(this);
            var params = button.data();
            layer.confirm('您确认要删除该购物车商品', function () {
                sendButtonAjax(button, params, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            button.parent().parent().parent().remove();
                            cart_list();
                            cal();
                        }
                    }
                });
            });
        });

    });
</script>
