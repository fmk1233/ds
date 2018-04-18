<?php $this->view('common/header'); ?>
<!--图片放大效果-->
<script src="<?php echo $path; ?>js/jqzoom.js" type="text/javascript"></script>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--产品详细页样式-->
<div class="clearfix Inside_pages">
    <div class="Location_link">
        <em></em>
        <?php foreach ($categorys['name'] as $key => $name): ?>
            <a data-toggle="url" data-service="Goods.ProductList" data-cid="<?php echo $categorys['ids'][$key]; ?>"
               href="javascript::void(-1)"> <?php echo $name; ?></a> &lt;
        <?php endforeach; ?>
        <a href="javascript:void(-1)"><?php echo $goods['goods_name']; ?></a>
    </div>
    <!--产品详细介绍样式-->
    <div class="clearfix" id="goodsInfo">
        <!--产品图片放大-->
        <div class="mod_picfold clearfix">
            <div class="clearfix" id="detail_main_img">
                <div class="layout_wrap preview">
                    <div id="vertical" class="bigImg">
                        <img src=" <?php Domain_Goods::goodInfo($goods);
                        echo Common_Function::GoodsPath($goods['goods_pics'][0]); ?>" width="" height="" alt=""
                             id="midimg"/>
                        <div id="winSelector"></div>
                    </div>
                    <div class="smallImg">
                        <div class="scrollbutton smallImgUp disabled">&lt;</div>
                        <div id="imageMenu">
                            <ul>
                                <?php foreach ($goods['goods_pics'] as $goods_pic): ?>
                                    <li><img src="<?php echo Common_Function::GoodsPath($goods_pic); ?>" width="68"
                                             height="68"/></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="scrollbutton smallImgDown">&gt;</div>
                    </div><!--smallImg end-->
                    <div id="bigView" style="display:none;">
                        <div><img width="800" height="800" alt="" src=""/></div>
                    </div>
                </div>
            </div>
            <div class="Sharing">
                <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1441079683326"><a href="#"
                                                                                                       class="bds_more"
                                                                                                       data-cmd="more">分享到：</a><a
                            href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#"
                                                                                               class="bds_tsina"
                                                                                               data-cmd="tsina"
                                                                                               title="分享到新浪微博"></a><a
                            href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren"
                                                                                           data-cmd="renren"
                                                                                           title="分享到人人网"></a><a
                            href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                <script>
                    window._bd_share_config = {
                        "common": {
                            "bdSnsKey": {},
                            "bdText": "",
                            "bdMini": "2",
                            "bdMiniList": false,
                            "bdPic": "",
                            "bdStyle": "0",
                            "bdSize": "16"
                        },
                        "share": {"bdSize": 16},
                        "image": {
                            "viewList": ["qzone", "tsina", "tqq", "renren", "weixin"],
                            "viewText": "分享到：",
                            "viewSize": "16"
                        },
                        "selectShare": {
                            "bdContainerClass": null,
                            "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]
                        }
                    };
                    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                </script>
                <!--收藏-->
                <!--                <div class="Collect"><a href="javascript:collect(92)"><em class="ico1"></em>收藏商品( 2345 )</a></div>-->
            </div>
        </div>
        <!--产品信息-->
        <div class="property" style="width: 784px">
            <!--            <form action="javascript:addToCart(97)" name="ECS_FORMBUY" id="ECS_FORMBUY">-->
            <h2><?php echo $goods['goods_name']; ?></h2>
            <!--                <div class="goods_info">◆买即送大麦茶◆满2件减10元再赠2罐大麦茶◆礼品袋茶包免费赠◆</div>-->
            <div class="ProductD clearfix">
                <div class="productDL">
                    <dl>
                        <dt>售&nbsp;&nbsp;价：</dt>
                        <dd><span id="price"><i>￥</i><?php echo $goods['price']; ?></span>
                            <del id="marke_price">市场价：￥<?php echo $goods['market_price']; ?></del>
                        </dd>
                    </dl>
                    <!--                        <dl><dt>总 重 量：</dt><dd>140克</dd> </dl>-->
                    <?php if ($goods['has_option'] == 1): ?>
                        <?php foreach ($goods['option_title'] as $option_title): ?>
                            <dl>
                                <dt><?php echo $option_title['title']; ?>：</dt>
                                <dd>
                                    <?php foreach ($option_title['items'] as $key => $option_items): ?>
                                        <div class="item  <?php echo $key == 0 ? 'selected' : ''; ?>"><b></b><a
                                                    href="#none"
                                                    title="<?php echo $option_items['title']; ?>"><?php echo $option_items['title']; ?></a><input
                                                    type="hidden" value="<?php echo $option_items['id']; ?>"
                                                    name="<?php echo $option_title['id']; ?>"></div>
                                    <?php endforeach; ?>
                                </dd>
                            </dl>
                        <?php endforeach; ?>

                    <?php endif; ?>

                    <dl>
                        <dt>上架时间：</dt>
                        <dd><?php echo date('Y-m-d', $goods['add_time']); ?></dd>
                    </dl>
                    <div class="Appraisal"><p>销售量</p><a><?php echo $goods['buy_num']; ?></a></div>
                </div>
            </div>
            <div class="buyinfo" id="detail_buyinfo">
                <dl>
                    <dt>数量</dt>
                    <dd>
                        <input type="hidden" id="optionid" name="optionid"
                               value="<?php echo isset($goods['optionid']) ? $goods['optionid'] : ''; ?>"/>
                        <div class="choose-amount left">
                            <a class="btn-reduce" href="javascript:;" onclick="setAmount.reduce('#buy-num')">-</a>
                            <a class="btn-add" href="javascript:;" onclick="setAmount.add('#buy-num')">+</a>
                            <input class="text" id="buy-num" value="1" onkeyup="setAmount.modify('#buy-num');">
                        </div>
                        <div class="P_Quantity" id="stock">剩余：<?php echo $goods['stock']; ?>件</div>
                    </dd>
                    <dd>
                        <div class="wrap_btn"><a href="javascript:void(-1)" id="add_to_cart"
                                                 data-id="<?php echo $goods['id']; ?>" class="wrap_btn1"
                                                 title="加入购物车"></a>
                            <a href="javascript:void(-1)" buy data-id="<?php echo $goods['id']; ?>" class="wrap_btn2"
                               title="立即购买"></a></div>
                    </dd>
                </dl>
            </div>
            <!--            </form>-->
        </div>
        <!--推荐-->
    </div>
    <!--样式-->
    <div class="clearfix">
        <!--介绍信息样式-->
        <div class="page_right_style Widescreen">
            <div class="inDetail_boxOut ">
                <div class="inDetail_box">
                    <div class="fixed_out ">
                        <ul class="inLeft_btn fixed_bar" style="width: 1200px">
                            <li class="active"><a id="property-id" href="#shangpsx" class="current">规格与包装</a></li>
                        </ul>
                        <div class="subbuy">
                            <span class="extra currentPrice"> ¥129.90</span>
                            <a href="javascript:void(-1)" buy data-id="<?php echo $goods['id']; ?>"
                               class="extra  notice J_BuyButtonSub">立即购买</a></div>
                    </div>
                </div>
            </div>
            <div id="shangpjs" class="info_style" style="text-align:center;min-height: 20px">
                <?php echo $goods['memo']; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    setAmount = {
        value: 1,
        stock:<?php echo $goods['stock']; ?>,
        reduce: function ($id) {
            var value = $($id).val();
            if (value <= 1) {
                return false;
            }
            value--;
            this.value = value;
            $($id).val(value);
        },
        add: function ($id) {
            var value = $($id).val();
            if (value >= this.stock) {
                return false;
            }
            value++;
            this.value = value;
            $($id).val(value);
        }, modify: function ($id) {
            var value = $($id).val();
            if (value < 1 || value >= this.stock) {
                $($id).val(this.value);
            } else {
                this.value = value;
            }
        }
    }
    $(function () {
        $('.productDL .item').on('click', function () {
            $(this).siblings().removeClass('selected');
            $(this).addClass('selected');
            calInfo();
        });


        function calInfo() {
            var goods_options = JSON.parse('<?php echo json_encode($goods['goods_option']); ?>');
            var options = [];
            $('.productDL .item.selected').each(function () {
                var input = $(this).find('input');
                options.push(input.val());
            });
            for (var i = 0, len = goods_options.length; i < len; i++) {
                var goods_options_all = goods_options[i].option_ids.split('_');
                if (goods_options_all.sort().toString() == options.sort().toString()) {
                    $('#price').html('<i>￥</i>' + goods_options[i].option_price);
                    $('#market_price').html('市场价：￥' + goods_options[i].option_marketprice);
                    $('#stock').html('剩余：' + goods_options[i].option_stock + '件');
                    $('#optionid').val(goods_options[i].option_id);
                    break;
                }
            }
        }

        $('a[buy]').on('click', function () {
            var button = $(this);
            var data = {
                service: 'Order.OrderConfirm',
                goodsid: button.data('id'),
                total: $('#buy-num').val(),
                optionid: $('#optionid').val()
            };
            location.href = ds.url(data);
        });
        $('#add_to_cart').on('click', function () {
            var button = $(this);
            var params = {
                service: 'Order.AddCart',
                goodsid: button.data('id'),
                num: $('#buy-num').val(),
                optionid: $('#optionid').val()
            };
            sendButtonAjax(button, params, {
                callback: function (d) {
                    setTimeout(function () {
                        cart_list();
                    }, 1000);
                }
            });
        });
    });

</script>

