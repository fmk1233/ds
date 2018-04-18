<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>
<!--幻灯片样式-->
<div id="slideBox" class="slideBox">
    <div class="hd">
        <ul class="smallUl"></ul>
    </div>
    <div class="bd">
        <ul>
            <?php foreach ($icons as $icon): ?>
                <li><a href="<?php echo empty($icon['url']) ? 'javascript:void(-1)' : $icon['url']; ?>">
                        <div style="background:url('<?php echo Common_Function::GoodsPath($icon['icon']) ?>') no-repeat rgb(226, 155, 197); background-position:center; width:100%; height:460px;"></div>
                    </a></li>
            <?php endforeach; ?>

            <!-- <li><a href="#"><div style="background:url(<?php /*echo $path;*/ ?>AD/ad-2.jpg) no-repeat rgb(255, 227, 130); background-position:center ; width:100%; height:460px;"></div></a></li>
            <li><a href="#"><div style="background:url(<?php /*echo $path;*/ ?>AD/ad-3.jpg) no-repeat rgb(226, 155, 197); background-position:center; width:100%; height:460px;"></div></a></li>
            <li><a href="#"><div style="background:url(<?php /*echo $path;*/ ?>AD/ad-7.jpg) no-repeat #f7ddea; background-position:center; width:100%; height:460px;"></div></a></li>
            <li><a href="#"><div style="background:url(<?php /*echo $path;*/ ?>AD/ad-6.jpg) no-repeat  #F60; background-position:center; width:100%; height:460px;"></div></a></li>-->
        </ul>
    </div>
    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>

</div>
<script type="text/javascript">
    jQuery(".slideBox").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "leftLoop",
        autoPage: true,
        autoPlay: true
    });
</script>
<!--内容样式-->
<div class="index_style">
    <?php $shop_indexs = Domain_GoodsClass::shopIndex();
    $i = 0;
    foreach ($shop_indexs as $key => $shop_index):if ($shop_index['class']['is_show'] == 0) {
        continue;
    }
        $i++; ?>
        <!--推荐图层样式-->
        <?php if (!empty($shop_index['class']['ad'])): ?>
            <div class="AD_tu"><a href="#"><img
                            src="<?php echo Common_Function::GoodsPath($shop_index['class']['ad']); ?>" width="1200"
                            height="120"/></a></div>
        <?php endif; ?>

        <!--产品类样式-->
        <div class="product_Sort">
            <div class="title_name"><span class="floor"><?php echo $i; ?>F</span><span style="color: #333"
                                                                                       class="name"><?php echo $shop_index['class']['category_name'];
                    $left_ads = explode(',', $shop_index['class']['left_ad']); ?></span>
                <!--<span class="link_name"><a href="#">苹果</a> | <a href="#">香蕉</a> | <a href="#">橙子</a> | <a href="#">哈密瓜</a>| <a href="#">白菜</a> | <a href="#">青菜</a></span>-->
            </div>
            <div class="Section_info clearfix">
                <div class="product_AD">
                    <div class="pro_ad_slide">
                        <div class="hd">
                            <ul>
                                <?php foreach ($left_ads as $key => $left_ad): ?>
                                    <li><?php echo $key + 1; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="bd">
                            <ul>
                                <?php foreach ($left_ads as $key => $left_ad): ?>
                                    <li style="display: list-item;"><a href="#"><img
                                                    src="<?php echo Common_Function::GoodsPath($left_ad); ?>"
                                                    width="298" height="489"></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a class="prev" href="javascript:void(0)"><em class="arrow"></em></a>
                        <a class="next" href="javascript:void(0)"><em class="arrow"></em></a>
                    </div>
                    <script type="text/javascript">
                        jQuery(".pro_ad_slide").slide({
                            titCell: ".hd ul",
                            mainCell: ".bd ul",
                            autoPlay: true,
                            autoPage: true,
                            interTime: 6000
                        });
                    </script>
                </div>
                <!--产品列表-->
                <?php $where = array();
                $where['category_id'] = $shop_index['ids'];
                $where['is_rec'] = 1;
                $where['status'] = 1;
                $goods_list = Domain_Goods::getShopIndexList($where, 8 , '*','sort desc,id desc') ?>
                <div class="pro_list">
                    <ul class="pro_list_ul">
                        <?php foreach($goods_list as $goods_item): Domain_Goods::goodInfo($goods_item); ?>
                            <li>
                                <a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['id']; ?>" href="javascript::void(-1)" class="textcenter"><img
                                            src="<?php  echo Common_Function::GoodsPath($goods_item['goods_pics'][0]); ?>" width="160" height="160px"></a>
                                <a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['id']; ?>" href="javascript::void(-1)" class="p_title_name"><?php echo $goods_item['goods_name']; ?></a>
                                <div class="Numeral"><span class="price"><i>￥</i><?php echo $goods_item['price']; ?></span><span
                                            class="Sales">销量<i><?php echo $goods_item['buy_num']; ?></i>件</span></div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!--猜你喜欢样式-->
</div>

<?php $this->view('common/footer.php'); ?>

