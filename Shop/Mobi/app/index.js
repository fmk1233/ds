/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = {total: 1, limit: 10, offset: 0};
    var data = {d: {},goods_list:[],keywords:[],self_keywords:[], loading: 0, cart_num: 0, banner_height: 157};
    vue = new Vue({
        el: '#index',
        data: data,
        methods: {
            goodsPic: function (path) {
                return base.goodsThumb(path);
            },
            goodsPics: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
        },
        mounted: function () {
            $.initPage($('#index'));
        }
    });
    $('#index').find('.infinite-scroll').on('infinite', function (e) {
        if (data.loading == 0) {
            page.offset += page.limit;
            obj.getData();
        }
    });
    vue1 = new Vue({
        el: '#search',
        data: data,
        methods:{
            search:function (keyword) {
                $('#newinput').val(keyword);
                this.submit();
            },
            submit:function () {
                var value = $('#newinput').val();
                if(value==''){
                    return;
                }
                var keywords = base.searchKey(value);
                data.self_keywords = keywords;
                $("#search .close-popup").trigger('click');
                $.router.params.keywords = value;
                if( location.hash != '#product' ){
                    $.router.loadPage('#product');
                }else{
                    layui.product.refresh();
                }

            }
        }
    })
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Shop.Main', offset: page.offset, limit: page.limit},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                        for (var i = 0, len = d.data.goods.rows.length; i < len; i++) {
                            data.goods_list.push(d.data.goods.rows[i]);
                        }
                        data.keywords = d.data.keywords;
                        page.total = d.data.goods.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        vue.$nextTick(function () {
                            new Swiper('#index .swiper-banner', {
                                pagination: '.swiper-pagination',
                                paginationClickable: true,
                                autoplayDisableOnInteraction: false,
                                autoplay: 5000,
                                loop: true
                            });
                            new Swiper('#index .swiper-text', {
                                paginationClickable: true,
                                direction: 'vertical',
                                swipeHandler : '.swipe-handler',
                                autoplayDisableOnInteraction: false,
                                autoplay: 3000,
                                loop: true
                            });
                        })
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        getCartNum: function () {
            base.sendAjax({
                data: {service: 'Goods.GetCartCount'},
                success: function (d) {
                    if (d.code == 40000) {
                        output.changeNum(d.data);
                    }
                }
            });
        },
        refresh: function () {
            $.router.stack.back = "[]";
            data.goods_list = [];
            data.loading = 0;
            page.offset = 0;
            obj.getData();
            obj.getCartNum();
            $.router.params = {};
        }
    };

    $(document).on("pageReinit", '#index', function () {
        obj.refresh();
    });
    data.banner_height = (window.innerWidth > 623 ? 623 : window.innerWidth) * 157 / 320;
    $(document).on("pageInit", '#index', function () {
        obj.refresh();
        if($.inArray(hash, ['#index','#category','#cart','#user',''])==-1){
            // $.router.loadPage(hash);
        }
    });
    // obj.refresh();
    var output = {
        changeNum: function (num) {
            if (num == 0) {
                layui.data('cart', {key: 'cart_num', value: '0'});
            } else {
                layui.data('cart', {key: 'cart_num', value: num});
            }
            data.cart_num = num;
        }
    }

    //输出address接口
    exports('index', output);
});