/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery;
    var base = layui.base;
    var data = {goods_list: [], categorys: [], loading: 0, cart_num: 0}, vue, category_id = 0, page = {
        total: 1,
        limit: 10,
        offset: 0
    }, pullRefresh, fresh = false, pageInited = false;
    vue = new Vue({
        el: '#shop',
        data: data,
        methods: {
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            },
            goodsPic: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
        },
        mounted: function () {
            /*订购选择分类*/
            mui.ready(function () {
                /*关闭分类侧滑菜单*/
                document.getElementById('offCanvasHide').addEventListener('tap', function () {
                    offCanvasWrapper.offCanvas('close');
                    var d = $('.mui-selected a').data();
                    $('#shopSort').html(d.name);
                    if (category_id != d.id) {
                        category_id = d.id;
                        data.goods_list = [];
                        page.offset = 0;
                        $('#shop .mui-scroll').attr('style', '');
                        obj.getData();
                    }
                });
                //侧滑容器父节点
                var offCanvasWrapper = mui('#offCanvasWrapper');
                //菜单容器
                var offCanvasSide = document.getElementById("offCanvasSide");
                //Android暂不支持整体移动动画
                /*if (!mui.os.android) {
                    document.getElementById("move-togger").classList.remove('mui-hidden');
                    var spans = document.querySelectorAll('.android-only');
                    for (var i = 0, len = spans.length; i < len; i++) {
                        spans[i].style.display = "none";
                    }
                }*/
                //主界面和侧滑菜单界面均支持区域滚动；
                mui('#offCanvasSideScroll').scroll();
                mui('#offCanvasContentScroll').scroll();
                //实现ios平台的侧滑关闭页面；
                if (mui.os.plus && mui.os.ios) {
                    offCanvasWrapper[0].addEventListener('shown', function (e) { //菜单显示完成事件
                        plus.webview.currentWebview().setStyle({
                            'popGesture': 'none'
                        });
                    });
                    offCanvasWrapper[0].addEventListener('hidden', function (e) { //菜单关闭完成事件
                        plus.webview.currentWebview().setStyle({
                            'popGesture': 'close'
                        });
                    });
                }

            });
            pullRefresh = mui('#offCanvasContentScroll.mui-scroll-wrapper').pullRefresh({
                down: {
                    height:60,
                    callback: function () {
                        data.goods_list = [];
                        page.offset = 0;
                        fresh = true;
                        obj.getData();
                    }
                }
            });
            mui('#shop .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });

        },
        updated: function () {

        }
    });
    $('#Index .mui-bar-tab a[href="#shop"]').on('tap', function () {
        if(!pageInited){
            pageInited = true;
            output.shopData();
        }
    });

    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {
                    service: 'Goods.GetGoodsInfoList',
                    limit: page.limit,
                    offset: page.offset,
                    category_id: category_id,
                    order: 0,
                    key: ''
                },
                success: function (d) {

                    if (fresh) {
                        setTimeout(function () {
                            pullRefresh.endPulldownToRefresh();
                        },500);
                        fresh = false;
                    }

                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            var goods = d.data.rows[i];
                            if (goods.has_option == 1) {
                                var goods_option = JSON.parse(goods.goods_option);
                                goods.price = goods_option[0]['option_price'];
                            }
                            data.goods_list.push(goods);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        },
        getCategorys: function () {
            base.sendAjax({
                data: {service: 'Goods.GetGoodsCategory'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.categorys = d.data;
                    }
                }
            });
        },
        getCartNum: function () {
            var cart = layui.data('cart');
            if ($.isEmptyObject(cart)) {
                base.sendAjax({
                    data: {service: 'Goods.GetCartCount'},
                    success: function (d) {
                        if (d.code == 40000) {
                            output.changeCartNum(d.data);
                        }
                    }
                });
            } else {
                data.cart_num = parseInt(cart.cart_num);
            }
        }

    };
    /* $('#Index .mui-bar-tab a[href="#shop"]').on('tap', function () {
         output.shopData();
     });*/
    var output = {
        changeCartNum: function (num) {
            if (num == 0) {
                layui.data('cart', {key: 'cart_num', value: '0'});
            }
            layui.data('cart', {key: 'cart_num', value: num});
            data.cart_num = num;
        },
        shopData: function () {
            data.goods_list = [];
            page.offset = 0;
            $('#shop .mui-scroll').attr('style', '');
            obj.getCategorys();
            obj.getData();
            obj.getCartNum();
        }
    };
    //输出booth_news接口
    exports('shop', output);
});