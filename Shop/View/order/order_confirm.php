<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/Orders.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $path; ?>js/jquery.reveal.js" type="text/javascript"></script>
<style type="text/css">
    #Orders .Orders_style {
        padding: 0;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .payment ul li {
        float: left;
        padding: 20px 30px 0px 0;;
    }

    #Orders .Process {
        width: 900px;
        padding: 30px 0;
        margin-left: 300px;
        margin-top: 20px;
    }
</style>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<div class="Inside_pages clearfix" id="Orders">
    <div class="Process"><img src="<?php echo $path; ?>images/flow_step-5.png"/></div>
    <div class="Orders_style clearfix">
        <!--地址信息样式-->
        <div class="Address_info">
            <div class="title_name">默认收货地址<a data-toggle="url" data-service="User.Address" data-from="1"
                                             href="javascript::void(-1)">其他收货地址</a></div>
            <ul>
                <li><label>收件人姓名：</label><span id="realname"></span></li>
                <li>
                    <label>收件人地址：</label><span id="address"></span></li>
                <li><label>收件人电话：</label><span id="mobile"></span></li>
                <!--                <li><label>邮&nbsp;&nbsp;&nbsp;编：</label>123456</li>-->
            </ul>

        </div>
    </div>
    <form class="form layui-form" method="post" onsubmit="return false;">
        <input type="hidden" name="realname" value=""/>
        <input type="hidden" name="phone" value=""/>
        <input type="hidden" name="address" value=""/>
        <input type="hidden" name="province" value=""/>
        <input type="hidden" name="city" value=""/>
        <input type="hidden" name="area" value=""/>
        <input type="hidden" name="service" value="Order.AddOrders"/>
        <input type="hidden" name="goodsid" value="<?php echo $goodsid; ?>"/>
        <input type="hidden" name="optionid" value="<?php echo $optionid; ?>"/>
        <input type="hidden" name="total" value="<?php echo $total; ?>"/>
        <fieldset>
            <!--快递选择-->
            <div class="express_delivery">
                <div class="title_name">选择快递方式</div>
                <ul class="dowebok">
                    <?php $logistics = Domain_Logistics::getAllList();
                    foreach ($logistics as $logistics_item): ?>
                        <li>
                            <input type="radio" name="logistics_id" lay-ignore
                                   value="<?php echo $logistics_item['id']; ?>"
                                   data-labelauty="<?php echo $logistics_item['company']; ?>">
                            <div class="description">
                                <?php echo $logistics_item['memo']; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--付款方式-->
            <div class="payment">
                <div class="title_name">支付方式</div>
                <ul>
                    <?php $payments = Domain_Payment::getPayment();
                    foreach ($payments as $payment): ?>
                        <li><input type="radio" name="pay_type" value="<?php echo $payment['id']; ?>" lay-ignore
                                   data-labelauty="<?php echo $payment['payment_name']; ?>"></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--<div class="invoice_style">
                <ul>
                    <li class="invoice_left"><input name="" type="checkbox" value="" data-labelauty="是否开发票"/></li>
                    <li class="invoice_left"><select name="somename" class="SlectBox"
                                                     onclick="console.log($(this).val())"
                                                     onchange="console.log('change is firing')">
                            <option disabled="disabled" selected="selected">发票类型</option>
                            <option value="办公用品">办公用品</option>
                            <option value="食品">食品</option>
                            <option value="20元红包">20元红包</option>
                            <option value="50元红包">50元红包</option>
                            <option value="100元红包">100元红包</option>
                            <option value="200元红包">200元红包</option>
                        </select>
                    </li>
                    <li class="invoice_left">发票抬头
                        <input name="" type="text" class="text_info"/></li>
                    <li class="invoice_left">
                        <select name="somename" class="SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                            <option disabled="disabled" selected="selected">发票内容</option>
                            <option value="办公用品">办公用品</option>
                            <option value="食品">食品</option>
                            <option value="数码配件">数码配件</option>
                            <option value="电脑">电脑</option>
                            <option value="手机">手机</option>
                            <option value="200元红包">200元红包</option>
                        </select>

                    </li>
                </ul>
            </div>-->
            <!--产品列表-->
            <div class="product_List">
                <table>
                    <thead>
                    <tr class="title">
                        <td class="name">商品名称</td>
                        <td class="price">商品价格</td>
                        <td class="Preferential">优惠价</td>
                        <td class="Quantity">购买数量</td>
                        <td class="Money">金额</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $market_total = 0;
                    $price_total = 0;
                    foreach ($cart_list as $cart_item): Domain_Cart::goodsInfo($cart_item); ?>
                        <tr>
                            <td class="Product_info" style="position: relative">
                                <input type="hidden" value="<?php echo $cart_item['id']; ?>" name="cart_ids[]">
                                <a data-toggle="url" data-service="Goods.Product"
                                   data-id="<?php echo $cart_item['goods_id']; ?>" href="javascript::void(-1)"><img
                                            src="<?php $goods_pics = explode(',', $cart_item['goods_pics']);
                                            echo Common_Function::GoodsPath($goods_pics[0]); ?>" width="100px"
                                            height="100px"/></a>
                                <a data-toggle="url" data-service="Goods.Product"
                                   data-id="<?php echo $cart_item['goods_id']; ?>" href="javascript::void(-1)"
                                   class="product_name"><?php echo $cart_item['goods_name']; ?></a>
                                <p style="position: absolute; top: 85px;left: 123px;">规格：<?php echo $cart_item['guige']; ?></p>
                            </td>
                            <td><i>￥</i><?php echo $cart_item['market_price']; ?></td>
                            <td><i>￥</i><?php echo $cart_item['price']; ?></td>
                            <td><?php echo $cart_item['total']; ?></td>
                            <td class="Moneys"><i>￥</i>
                                <?php
                                $total = $cart_item['total'] * $cart_item['price'];
                                $price_total += $total;
                                $market_total += $cart_item['total'] * $cart_item['market_price'];
                                echo $total; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- <div class="envelopes">
                     选择已有红包<select name="somename" class="SlectBox" onclick="console.log($(this).val())"
                                   onchange="console.log('change is firing')">
                         <option disabled="disabled" selected="selected">选择红包金额</option>
                         <option value="5元红包">5元红包</option>
                         <option value="10元红包">10元红包</option>
                         <option value="20元红包">20元红包</option>
                         <option value="50元红包">50元红包</option>
                         <option value="100元红包">100元红包</option>
                         <option value="200元红包">200元红包</option>
                     </select>
                     或者输入红包序列号<input name="" type="text" class="text_number"/><input type="submit"
                                                                                     class="verification_btn"
                                                                                     value="验证序列号"/>
                 </div>-->
                <div class="Pay_info">
                    <label>订单留言</label><input name="memo" type="text" onkeyup="checkLength(this);" class="text_name "/>
                    <span class="wordage">剩余字数：<span id="sy" style="color:Red;">50</span></span>
                </div>
                <!--价格-->
                <div class="price_style">
                    <div class="right_direction">
                        <ul>
                            <li>
                                <div class="fl"><label>商品总价</label></div>
                                <div class="fr"><i>￥</i><span><?php echo $market_total; ?></span></div>
                                <div class="clx"></div>
                            </li>
                            <li>
                                <div class="fl"><label>优惠金额</label></div>
                                <div class="fr"><i>￥</i><span><?php echo $price_total - $market_total; ?></span></div>
                                <div class="clx"></div>
                            </li>
                            <li>
                                <div class="fl"><label>配&nbsp;&nbsp;送&nbsp;&nbsp;费</label></div>
                                <div class="fr"><i>￥</i><span>0.00</span></div>
                                <div class="clx"></div>
                            </li>
                            <li class="shiji_price">
                                <div class="fl"><label>实&nbsp;&nbsp;付&nbsp;&nbsp;款</label></div>
                                <div class="fr"><i>￥</i><span><?php echo $price_total; ?></span></div>
                                <div class="clx"></div>
                            </li>
                        </ul>
                        <div class="btn" style="width: 344px">
                                <!---->
                            <input lay-submit lay-filter="formDemo" style="float: right" type="submit" value="提交订单" class="submit_btn"/>

                            <?php if($goodsid==0): ?>
                                <input name="" type="button" onclick="window.history.go(-1);" value="返回购物车"
                                       class="return_btn"/>
                            <?php endif;?>
                        </div>
                        <!--                        <div class="integral right">待订单确认后，你将获得<span>345</span>积分</div>-->
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>


<?php $this->view('common/footer'); ?>
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript">
    function checkLength(which) {
        var maxChars = 50; //
        if (which.value.length > maxChars) {
            layer.alert("您出入的字数超多限制!");
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0, maxChars);
            return false;
        } else {
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    }
</script>
<script>
    $(function () {
        $(':input').labelauty();
        var address = layui.data('address');
        var address_id = 0;
        if (address.id) {
            address_id = address.id;
        }
        ds.sendAjax({
            data: {service: 'Order.GetAddress', addressid: address_id},
            success: function (d) {
                layui.data('address', {key: 'id', remove: true});
                var address = d.data;
                $('input[name="province"]').val(address.province);
                $('input[name="city"]').val(address.city);
                $('input[name="area"]').val(address.area);
                $('input[name="realname"]').val(address.realname);
                $('input[name="address"]').val(address.address);
                $('input[name="phone"]').val(address.mobile);
                $('#realname').html(address.realname);
                $('#mobile').html(address.mobile);
                var addre = getAddress(address.province, address.city, address.city);
                $('#address').html(addre.province + ' ' + addre.city + ' ' + addre.city + ' ' + address.address);
            }
        })
        layui.use('form', function () {
            var form = layui.form();
            form.on('submit(formDemo)', function (data) {
                var field = data.field;
                if (typeof field.pay_type == 'undefined') {
                    layer.msg('请选择支付方式');
                    return false;
                }
                if (typeof field.logistics_id == 'undefined') {
                    layer.msg('请选择物流方式');
                    return false;
                }
                if (field.province == '' || field.city == '') {
                    layer.msg('请填写收货地址');
                    return false;
                }

                sendButtonAjax($(data.elem), data.field);
                return false;
            })
        });
    });
</script>
