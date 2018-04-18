/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base', 'index'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue, index = layui.index, goodsid = 0, submit = {
        goodsid: 0,
        optionid: '',
        stock: 0,
        service: 'Order.AddCart'
    };

    var data = {d: {goods_pics: ['']}, num: 1, cart_num: 1, show_guige: false, show_detail: false, show_nav: false};
    vue = new Vue({
        el: '#product_detail',
        data: data,
        methods: {
            goodsPic: function (goods_pic) {
                if (goods_pic == "")
                    return;
                return base.goodsThumb(goods_pic);
            },
            submit: function () {
                base.sendAjax({
                    data: {
                        service: submit.service,
                        goodsid: submit.goodsid,
                        num: data.num,
                        optionid: submit.optionid
                    },
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d);
                            data.cart_num += parseInt(data.num);
                            index.changeNum(data.cart_num);
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            },
            buyNow: function () {
                base.sendAjax({
                    data: {
                        service: 'Order.Buy',
                        goodsid: submit.goodsid,
                        optionid: submit.optionid
                    },
                    success: function (d) {
                        if (d.code == 40000) {
                            $.router.params = d.data;
                            $.router.loadPage('#order_number');
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            },
            changeNum: function (type, event) {
                var num = 1;
                switch (type) {
                    case 'plus':
                        num = data.num + 1;
                        break;
                    case 'minus':
                        num = data.num - 1;
                        break
                    case 'num':
                        var tag = $(event.currentTarget);
                        num = parseInt(tag.val());
                        break;
                }
                if (num < 1 || num > data.d.stock || num == NaN) {
                    var num = data.num
                    data.num = 1;
                }

                data.num = num;
            },
            changeItem: function (e) {
                var tag = $(e.target);
                var inputCheck = $(e.target).find('input');
                $(tag).parent().parent().find('.radio_sm-blue').removeClass('checked');
                $(tag).parent().parent().find('input').removeAttr('checked');
                tag.addClass('checked');
                inputCheck.attr('checked', true);
                calculate();
            },
            showGuige: function (e) {//展示规格
                e.preventDefault();
                e.stopPropagation();
                data.show_detail = false;
                data.show_nav = false;
                data.show_guige = !data.show_guige;
                $(".goods-detail-box").css('bottom', '-100%');
                if (data.show_guige) {
                    $('.mask-filter-div,.j-filter-show-div').addClass('show');
                    $(".j-filter-show-div").animate({bottom: "0px"}, 100);
                } else {
                    $(".j-filter-show-div").css('bottom', '-100%');
                    setTimeout(function () {
                        $('.mask-filter-div,.j-filter-show-div').removeClass('show');
                    }, 100);
                }
                return false;

            }, showDetail: function (show) {//展示商品详情
                data.show_guige = false;
                data.show_nav = false;
                data.show_detail = show;
                $(".j-filter-show-div").css('bottom', '-100%');
                if (show) {
                    $('.mask-filter-div,.goods-detail-box').addClass('show');
                    $(".goods-detail-box").animate({bottom: "0px"}, 100);
                } else {
                    $(".goods-detail-box").css('bottom', '-100%');
                    setTimeout(function () {
                        $('.mask-filter-div,.goods-detail-box').removeClass('show');
                    }, 100);
                }

                return false;
            }, showNav: function () {
                data.show_nav = !data.show_nav;
                return false;
            }
        }
    });


    var h = $(window).height();
    var th = $("#product_detail .bar-nav").height();
    var hbox = h - th
    $("#product_detail .goods-detail-box").css("height", hbox);

    function calculate() {
        submit.goodsid = data.d.id;
        submit.optionid = '';
        var options = [];
        $('#product_detail .select-detail  input[type="radio"][checked]').each(function () {
            options.push($(this).val());
        });

        var goods_options = data.d.goods_option;
        for (var i = 0, len = goods_options.length; i < len; i++) {
            var option_all = goods_options[i].option_ids.split('_')
            if (option_all.sort().toString() == options.sort().toString()) {
                data.d.price = goods_options[i].option_price;
                data.d.stock = goods_options[i].option_stock;
                data.d.market_price = goods_options[i].option_marketprice;
                submit.optionid = goods_options[i].option_id;
                break;
            }
        }
    }

    var obj = {
        getData: function () {
            data.num = 1;
            if ($.router.params.id) {
                goodsid = $.router.params.id;
            }
            $.router.params = {};
            var d = goodsid;
            base.sendAjax({
                data: {service: 'Goods.GoodsDetail', goodsid: d},
                success: function (da) {
                    if (da.code == 40000) {
                        data.d = da.data;
                        data.d.goods_pics = da.data.goods_pics.split(',');
                        data.show_guige = false;
                        data.show_detail = false;
                        data.show_nav = false;
                        data.cart_num = base.cart_num();
                        vue.$nextTick(function () {
                            var swiper = new Swiper('#product_detail .goods-photo', {
                                pagination: '.swiper-pagination',
                                paginationClickable: true,
                                autoplayDisableOnInteraction: false,
                                paginationType: 'fraction'
                            });
                            calculate();
                        });

                    } else {
                        base.errorMsg(da);
                    }
                }
            });
        }
    };
    $(document).on("pageReinit", '#product_detail', function () {
        vue.$options.methods.showDetail(false);
        obj.getData();
    });

    $(document).on("pageInit", '#product_detail', function () {
        obj.getData();
    });
    //输出booth_news接口
    exports('product_detail', {});
});