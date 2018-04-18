<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>
<style type="text/css">
    .on{
        color: #FFFFFF;
        background: #FF6060;
        padding: 5px;
    }
</style>
<!--产品列表样式-->
<div class="Inside_pages clearfix">
    <!--位置-->
    <div class="Location_link">
        <em></em><a data-toggle="url" data-service="Default.Index" href="javascript::void(-1)">首页</a> <?php if(isset($categorys)): foreach ($categorys['name'] as $key=>$name): ?>
            &lt;  <a data-toggle="url" data-service="Goods.ProductList" data-cid="<?php echo $categorys['ids'][$key]; ?>" href="javascript::void(-1)"> <?php echo $name; ?></a>
        <?php endforeach;elseif(isset($keyword)):?>
            &lt;  <a href="javascript::void(-1)"><?php echo $keyword; ?></a>
        <?php endif;?>
    </div>
    <!--筛选样式-->
    <div id="Filter_style">
        <!--推荐-->
       <!-- <div class="page_recommend">
            <div class="hd"><em></em>今日推荐
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <li>
                        <div class="img"><a href="Product_Detailed.html"><img src="<?php /*echo $path; */?>products/p_4.jpg"
                                                                              width="120" height="120"/></a></div>
                        <div class="pro_info">
                            <a href="Product_Detailed.html">洗颜专科 柔澈泡沫 洁面乳 120g（资生堂旗下）</a>
                            <p class="Price"><i>￥</i>231.00</p>
                            <p class="Sales">热销：<b>1234</b>件</p>
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="<?php /*echo $path; */?>products/p_55.jpg" width="120"
                                                          height="120"/></a></div>
                        <div class="pro_info">
                            <a href="#">洗颜专科 柔澈泡沫 洁面乳 120g（资生堂旗下）</a>
                            <p class="Price"><i>￥</i>231.00</p>
                            <p class="Sales">热销：<b>1234</b>件</p>
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="<?php /*echo $path; */?>products/p_17.jpg" width="120"
                                                          height="120"/></a></div>
                        <div class="pro_info">
                            <a href="#">洗颜专科 柔澈泡沫 洁面乳 120g（资生堂旗下）</a>
                            <p class="Price"><i>￥</i>231.00</p>
                            <p class="Sales">热销：<b>1234</b>件</p>
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="<?php /*echo $path; */?>products/p_54.jpg" width="120"
                                                          height="120"/></a></div>
                        <div class="pro_info">
                            <a href="#">洗颜专科 柔澈泡沫 洁面乳 120g（资生堂旗下）</a>
                            <p class="Price"><i>￥</i>231.00</p>
                            <p class="Sales">热销：<b>1234</b>件</p>
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="<?php /*echo $path; */?>products/p_58.jpg" width="120"
                                                          height="120"/></a></div>
                        <div class="pro_info">
                            <a href="#">洗颜专科 柔澈泡沫 洁面乳 120g（资生堂旗下）</a>
                            <p class="Price"><i>￥</i>231.00</p>
                            <p class="Sales">热销：<b>1234</b>件</p>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="next" href="javascript:void(0)"><em class="iconfont icon-left"></em></a>
            <a class="prev" href="javascript:void(0)"><em class="iconfont icon-right"></em></a>
        </div>
        <script type="text/javascript">
            jQuery(".page_recommend").slide({
                titCell: ".hd ul",
                mainCell: ".bd ul",
                autoPage: true,
                effect: "left",
                autoPlay: true,
                vis: 4,
                trigger: "click"
            });
        </script>-->
        <!--条件筛选样式-->
        <div class="Filter">
            <div class="Filter_list clearfix">
                <div class="Filter_title"><span>分类：</span></div>
                <div class="Filter_Entire"><a data-toggle="url" data-service="Goods.ProductList" data-cid="0" href="javascript::void(-1)" <?php echo $c_id==0?'':'style="background: #fff;color: #333"'; ?>>全部</a></div>
                <div class="p_f_name infonav_hidden">
                    <?php foreach($goods_class as $goods_class_item): ?>
                        <a data-toggle="url" data-service="Goods.ProductList" data-cid="<?php echo $goods_class_item['id']; ?>" href="javascript::void(-1)"  title="<?php echo $goods_class_item['category_name']; ?>"><span class="<?php echo $goods_class_item['id']==$c_id?'on':''; ?>"><?php echo $goods_class_item['category_name']; ?></span></a>
                    <?php endforeach;?>
                </div>
                <p class="infonav_more"><a href="javascript:void(-1)" class="more" >更多<em
                                class="pullup"></em></a></p>
            </div>
        </div>
    </div>
    <!--样式-->
    <div class="scrollsidebar side_green clearfix" id="scrollsidebar">
        <!--列表样式属性-->
        <div class="page_right_style Widescreen">
            <div id="Sorted">
                <div class="Sorted">
                    <div class="Sorted_style">
                        <a href="javascript:void(-1)" data-order="0">默认</a>
                        <a href="javascript:void(-1)" data-order="1">价格<i class="iconfont icon-unfold"></i></a>
                        <a href="javascript:void(-1)" data-order="2">销量<i class="iconfont icon-unfold"></i></a>
                        <!--                        <a href="#">新品<i class="iconfont icon-fold"></i></a>-->
                    </div>
                    <!--产品搜索-->
                    <div class="products_search">
                        <input name="" type="text" class="search_text" value="<?php echo $keyword; ?>" placeholder="请输入你要搜索的产品" >
                        <input name=""   type="button"        value=""    class="search_btn">
                    </div>
                    <!--页数-->
                    <div class="s_Paging">
                        <span> <?php echo $page; ?>/<?php echo $page_total = ceil($total / PAGENUM); ?></span>
                        <a href="javascript:void(-1)" data-page="<?php echo $page - 1; ?>"
                           class="<?php echo $page == 1 ? 'disabled' : 'on'; ?>">&lt;</a>
                        <a href="javascript:void(-1)" class="<?php echo $page == $page_total ? 'disabled' : 'on'; ?>"
                           data-page="<?php echo $page + 1; ?>">&gt;</a>
                    </div>
                </div>
            </div>
            <!--产品列表样式-->
            <div class="p_list  clearfix">
                <ul>
                    <?php foreach ($goods_list as $goods_item): ?>
                        <li class="gl-item">
                            <!--<em class="icon_special tejia xinping"></em>-->
                            <div class="Borders">
                                <div class="img"><a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['id']; ?>" href="javascript::void(-1)"><img
                                                src="<?php $pics = explode(',', $goods_item['goods_pics']);
                                                Domain_Goods::goodInfo($goods_item);
                                                echo Common_Function::GoodsPath($pics[0]); ?>"
                                                style="width:220px;height:220px"></a></div>
                                <div class="Price">
                                    <b>¥<?php echo $goods_item['price']; ?></b><span>¥<?php echo $goods_item['market_price']; ?></span>
                                </div>
                                <div class="name"><a  data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['id']; ?>" href="javascript::void(-1)" ><?php echo $goods_item['goods_name']; ?></a>
                                </div>
                                <div class="Review">已有<a
                                            href="javascript:void(-1)"><?php echo $goods_item['buy_num']; ?></a>购买
                                </div>
                                <div class="p-operate">
                                    <!--                                <a href="#" class="p-o-btn Collect"><em></em>收藏</a>-->
                                    <span href="javascript:void(-1)" data-id="<?php echo $goods_item['id']; ?>" data-optionid="<?php echo isset($goods_item['optionid'])?$goods_item['optionid']:''; ?>" class="add_to_cart" style="cursor: pointer"><a  class="p-o-btn shop_cart" ><em></em>加入购物车</a></span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php $this->view('common/page') ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    $(function () {
        $('.infonav_more').on('click',function () {
            if($(this).prev().hasClass('infonav_hidden')){
                $(this).find('.more').html('收起 <em class="pulldown"></em>');
                $(this).prev().removeClass('infonav_hidden');
            }else{
                $(this).find('.more').html('更多 <em class="pullup"></em>');
                $(this).prev().addClass('infonav_hidden');
            }
        });
        var order = <?php echo $order; ?>;
        $('#Sorted .Sorted_style a').removeClass('on');
        switch (order) {
            case 0:
                $($('#Sorted .Sorted_style a')[0]).addClass('on');
                break;
            case 1:
            case 2:
                $($('#Sorted .Sorted_style a')[1]).addClass('on');
                if (order == 1) {
                    $($('#Sorted .Sorted_style a')[1]).find('i').removeClass('icon-fold');
                    $($('#Sorted .Sorted_style a')[1]).find('i').addClass('icon-unfold');
                } else {
                    $($('#Sorted .Sorted_style a')[1]).find('i').removeClass('icon-unfold');
                    $($('#Sorted .Sorted_style a')[1]).find('i').addClass('icon-fold');
                }
                break;
            case 3:
            case 4:
                if (order == 3) {
                    $($('#Sorted .Sorted_style a')[2]).find('i').removeClass('icon-fold');
                    $($('#Sorted .Sorted_style a')[2]).find('i').addClass('icon-unfold');
                } else {
                    $($('#Sorted .Sorted_style a')[2]).find('i').removeClass('icon-unfold');
                    $($('#Sorted .Sorted_style a')[2]).find('i').addClass('icon-fold');
                }
                $($('#Sorted .Sorted_style a')[2]).addClass('on');
                break;
        }
        $('#Sorted .Sorted_style a').on('click', function () {
            var new_order = parseInt($(this).data('order'));
            if ($(this).hasClass('disabled')) {
                return;
            }
            var url = JSON.parse('<?php echo json_encode($url)?>');
            switch (new_order) {
                case 0:
                    order = new_order;
                    break;
                case 1:
                    if (order != 1) {
                        order = new_order;
                    } else {
                        order = 2;
                    }
                    break;
                case 2:
                    if (order != 3) {
                        order = 3;
                    } else {
                        order = 4;
                    }
                    break;
            }
            url.order = order;
            location.href = ds.url(url);
        });
        $('#Sorted .search_btn').on('click', function () {
            var value = $(this).prev().val();
            var url = JSON.parse('<?php echo json_encode($url)?>');
            url.keyword = value;
            location.href = ds.url(url);
        });
        $('.add_to_cart').on("click",function () {
            var button = $(this);
            var params = {
                service: 'Order.AddCart',
                goodsid: button.data('id'),
                num: 1,
                optionid: button.data('optionid')
            };
            sendButtonAjax(button, params, {
                callback: function (d) {
                    cart_list();
                }
            });
        });

    });
</script>

