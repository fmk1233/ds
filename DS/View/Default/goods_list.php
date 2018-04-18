<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style type="text/css">
    .mt-widget-2 .mt-body .mt-body-title{
        line-height: 1.5em;
        height: 1.5em;
    }
</style>
<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <!--左侧导航-手机不显示-->
                <div class="col-xs-12 zs-md-2 hidden-xs hidden-sm">
                    <div class="profile-sidebar">
                        <?php $this->view('profile_side') ?>
                    </div>

                </div>
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border" id="bodys" v-cloak="">
                        <div class="row">
                            <div class="col-xs-12 profile-info summary-info">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="ui-text-blue"><?php echo T('产品分类'); ?></span>

                                        </div>
                                        <div class="actions">
                                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?>
                                                <i class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body util-btn-margin-bottom-5" id="categorys">
                                        <br>
                                        <a href="javascript:;" class="btn btn-default blue">全部</a>
                                        <?php foreach ($categorys as $category): ?>
                                            <a href="javascript:;" class="btn btn-default"
                                               data-id="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></a>
                                        <?php endforeach; ?>
                                        <br>
                                        <br>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="portlet light">

                                    <div class="portlet-body mt-element-overlay">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6 col-lg-4 " v-for="(good ,idx) in goods">
                                                <div class="mt-widget-2">
                                                    <div class="mt-product">
                                                        <a :href="goodsPath(good.id)">
                                                            <img :src="goodsPic(good.goods_pics)">
                                                        </a>
                                                    </div>
                                                    <div class="mt-body">
                                                        <h3 class="mt-body-title">
                                                            <a :href="goodsPath(good.id)">{{ good.goods_name }}</a></h3>
                                                        <ul class="mt-body-stats">

                                                            <li class="font-red">
                                                                <i class="fa fa fa-cny "></i> {{ goodsPrice(good) }}
                                                            </li>
                                                        </ul>
                                                        <div class="mt-body-actions">
                                                            <div class="btn-group btn-group btn-group-justified">
                                                                <a :href="goodsPath(good.id)"
                                                                   class="btn hidden-xs hidden-sm">
                                                                    <i class="icon-bubbles"></i> 查看详情 </a>
                                                                <a :href="goodsPath(good.id)" class="btn ">
                                                                    <i class="fa fa-heart-o"></i> 立即购买 </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--翻页-->
                                <div class="row page-box">
                                    <div class="col-md-6" style="padding-top: 10px;">
                                        <?php echo T('共{total}条记录，当前显示第 {currenPage} 页 共{totalPage}页',array('total'=>'<b class="blue">{{ total }}</b>','currenPage'=>'<b class="blue">{{ currenPage }}</b>','totalPage'=>'{{ totalPage}}')); ?><p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right" style="padding-top: 5px;">
                                            <a :class="{ blue:first }" class="btn btn-default" type="button"
                                               href="javascript:;"  @click="firstPage()"><?php echo T('首页'); ?></a>
                                            <a class="btn btn-default" type="button" href="javascript:;"
                                               @click="prePage()"><?php echo T('上一页'); ?></a>
                                            <a class="btn btn-default" type="button" href="javascript:;"
                                               @click="nexPage()"><?php echo T('下一页'); ?></a>
                                            <a :class="{ blue: end }" class="btn btn-default" type="button"
                                               href="javascript:;"  @click="endPage()"><?php echo T('尾页'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!--END 主体-->
    </div>
    <!--END 主体-->

    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->


</div>
<?php $this->view('footer_js'); ?>
<script src="<?php echo URL_ROOT . '/static/'; ?>js/vue.min.js"></script>
<script type="text/javascript">
    $(function () {
        var data = {goods: [], total: 0, first: true, end: false, currenPage: 1,totalPage:1};
        var limit = 16;
        var vue = new Vue({
            el: '#bodys',
            data: data,
            methods: {
                goodsPic: function (goods_pics) {
                    return goodsThumb(goods_pics.split(',')[0]);
                },
                goodsPath:function (id) {
                    return ds.url({service:'Order.GoodsDetail',goodsid:id});
                },
                goodsPrice:function (goods) {
                    var options_title = JSON.parse(goods.option_title);
                    var price = goods.price;
                    if (options_title.length > 0) {
                        var goods_options = JSON.parse(goods.goods_option);
                        price = goods_options[0].option_price;
                    }
                    return parseFloat(price).toFixed(2);
                },
                nexPage: function () {
                    if(data.currenPage==data.totalPage){
                        return;
                    }
                    data.currenPage += 1;
                    getGoodsList();
                },
                firstPage: function () {
                    data.currenPage = 1;
                    getGoodsList();
                },
                endPage: function () {
                    data.currenPage = data.totalPage;
                    getGoodsList();
                },
                prePage: function () {
                    if(data.currenPage==1){
                        return;
                    }
                    data.currenPage -= 1;
                    getGoodsList();
                }
            }
        });
        getGoodsList();
        var category_id = 0;
        function getGoodsList() {
            if(data.currenPage>data.totalPage){
                return;
            }
            var offset = (data.currenPage-1)*limit;
            var request = {service: 'Order.GetGoodsInfoList', limit: limit, offset: offset,category_id:category_id}
            ds.sendAjax({
                data: request,
                success: function (d) {
                    if (d.code == 40000) {
                        data.goods = d.data.rows;
                        data.total = d.data.total;
                        data.totalPage = Math.ceil(data.total/limit);
                        if (request.offset == 0) {
                            data.first = true;
                            data.end = false;
                        } else if (request.offset + limit >= data.total) {
                            data.first = false;
                            data.end = true;
                        } else {
                            data.first = false;
                            data.end = false;
                        }
                        vue.$nextTick(function () {
                            $('#bodys img').height($('#bodys img').width());
                        })
                    } else {
                        alertMsg(d);
                    }
                }
            });
        }

        $('#categorys a').on('click', function () {
            var $this = $(this);
            if ($this.hasClass('blue')) {
                return;
            }
            $('#categorys a').removeClass('blue');
            $this.addClass('blue');
            category_id = $this.data('id');
            data.currenPage = 1;
            data.totalPage = 1;
            getGoodsList();
        });
    });
</script>
</body>
</html>