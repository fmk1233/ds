<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <script src="<?php echo Common_Function::GoodsPath('/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
    <script src="<?php echo Common_Function::GoodsPath('/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo Common_Function::GoodsPath('/js/inspinia.js'); ?>"></script>
    <style>
        .xs-ts {
            margin-left: 10px;
        }

        .ibox-title {
            padding-left: 14px !important;
            padding-right: 14px !important;
            /*padding-top: 20px!important;*/
        }

        .product-desc .btn-primary {
            color: #1a8dd6 !important;
            border: 1px solid #1a8dd6;
        }

        .product-desc .btn-primary:hover {
            background: transparent;
            color: #14c1b3 !important;
            border: 1px solid #14c1b3;
        }

        @media (max-width: 767px) {
            .tj-title span, .float-e-margins .btn {
                font-size: 14px;
            }
        }

        .btn-sm {
            padding: 8px 12px;
        }

        .l-bgw {
            padding-bottom: 1px;
        }

        .btn-white {
            color: #424b50;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(225, 225, 225, 0.1);
        }
    </style>
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo T('产品订购'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('订单管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('产品订购'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight pd-t-b">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox border-bottom">
                            <div class="ibox-title cpdg-title-top">
                                <h5 class="bdl-green cpdg-wid0 fl">产品分类</h5>
                                <div class="ibox-tools fr">
                                    <a class="collapse-link">
                                        <span>全部分类</span>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content pdlr32 sjpdlr10" style="display: block;">
                                <div class="scroll_content" style="overflow:auto;overflow-x: hidden;" id="categorys">
                                    <div class="col-xs-4 col-sm-2 pdlr0">
                                        <h4><a href="javascript:;" class="sj-size16 ft-cor blue">全部</a></h4>
                                    </div>
                                    <?php foreach ($categorys as $category): ?>
                                        <div class="col-xs-4 col-sm-2 pdlr0">
                                            <h4><a href="javascript:;" class="sj-size16 ft-cor"
                                                   data-id="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></a>
                                            </h4>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bodys" v-cloak>
                    <div class="row" style="padding: 0 60px;margin-top: 40px;">
                        <div class="col-md-3 cpdg" v-for="(good ,idx) in goods">
                            <a :href="goodsPath(good.id)">
                                <div class="ibox">
                                    <div class="ibox-content product-box cpibox">
                                        <div class="product-imitation" style="padding: 0px;">
                                            <img :src="goodsPic(good.goods_pics)" width="100%" height="100%">
                                        </div>
                                        <div class="product-desc">

                                            <a :href="goodsPath(good.id)"
                                               class="product-name font-colorc sj-size16 font-sw" style="height: 34px;">
                                                {{ good.goods_name }}</a>


                                            <div class="m-t text-righ cpdg-text">
                                                <span class="product-price" style="display: block">￥{{ goodsPrice(good) }}</span>
                                                <a :href="goodsPath(good.id)"
                                                   class="btn btn-xs btn-outline btn-primary cpdg-text">立即购买</a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--翻页-->
                    <div class="row grey-bg" style="margin-top: 70px;margin-bottom: 30px;">
                        <div class="col-md-12 pad-lr0 l-tc">
                            <div style="display: inline-block">
                                <div class="btn-group btn-o-black fl">
                                    <a class="btn btn-sm" :class="[ first?'btn-primary':' btn-white' ]" type="button"
                                       href="javascript:;" @click="firstPage()">首页</a>
                                    <a class="btn btn-sm btn-white" type="button" href="javascript:;"
                                       @click="prePage()">上一页</a>
                                    <a class="btn btn-sm btn-white" type="button" href="javascript:;"
                                       @click="nexPage()">下一页</a>
                                    <a class="btn btn-sm" :class="[ end?'btn-primary':' btn-white' ]" type="button"
                                       href="javascript:;" @click="endPage()">尾页</a>
                                </div>
                                <p class="xs-ts font-gary mrgl20 fl"><?php echo T('共{total}条记录，当前显示第 {currenPage} 页 共{totalPage}页', array('total' => '<b>{{ total }}</b>', 'currenPage' => '<b>{{ currenPage }}</b>', 'totalPage' => '{{ totalPage}}')); ?></p>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <div class="col-md-6" style="text-align: left;line-height: 36px;">

                        </div>
                    </div>
                </div>

            </div>
            <?php $this->view('footer'); ?>
        </div>
    </div>
</div>

<?php $this->view('footer_js'); ?>
<script src="<?php echo URL_ROOT . '/static/'; ?>js/vue.min.js"></script>
<script type="text/javascript">
    $(function () {
        var data = {goods: [], total: 0, first: true, end: false, currenPage: 1, totalPage: 1};
        var limit = 16;
        var vue = new Vue({
            el: '#bodys',
            data: data,
            methods: {
                goodsPic: function (goods_pics) {
                    return goodsThumb(goods_pics.split(',')[0]);
                },
                goodsPath: function (id) {
                    return ds.url({service: 'Order.GoodsDetail', goodsid: id});
                },
                goodsPrice: function (goods) {
                    var options_title = JSON.parse(goods.option_title);
                    var price = goods.price;
                    if (goods.has_option == 1) {
                        if (options_title.length > 0) {
                            var goods_options = JSON.parse(goods.goods_option);
                            price = goods_options[0].option_price;
                        }
                    }
                    return parseFloat(price).toFixed(2);
                },
                nexPage: function () {
                    if (data.currenPage == data.totalPage) {
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
                    if (data.currenPage == 1) {
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
            if (data.currenPage > data.totalPage) {
                return;
            }
            var offset = (data.currenPage - 1) * limit;
            var request = {service: 'Order.GetGoodsInfoList', limit: limit, offset: offset, category_id: category_id}
            ds.sendAjax({
                data: request,
                success: function (d) {
                    if (d.code == 40000) {
                        data.goods = d.data.rows;
                        data.total = d.data.total;
                        data.totalPage = Math.ceil(data.total / limit);
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
