/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = {total: 1, limit: 10, offset: 0}, category_id, keywords = '';
    var data = {goods_list: [], loading: 0, order: 0,keywords:'请输入关键字'};
    vue = new Vue({
        el: '#product',
        data: data,
        methods: {
            goodsPic: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
            goodsOption: function (goods, type) {
                var options_title = JSON.parse(goods.option_title);
                var price = goods.price;
                var stock = goods.stock;
                var market_price = goods.market_price;
                if (options_title.length > 0) {
                    var goods_options = JSON.parse(goods.goods_option);
                    price = goods_options[0].option_price;
                    stock = goods_options[0].option_stock;
                    market_price = goods_options[0].option_marketprice;
                }
                switch (type) {
                    case 'price':
                        return parseFloat(price).toFixed(2);
                        break;
                    case 'market_price':
                        return parseFloat(market_price).toFixed(2);
                        break;
                    case 'stock':
                        return parseInt(stock);
                        break;
                }
            },
            orderGoods: function (order) {
                switch (parseInt(order)) {
                    case 0:
                        if (data.order == order) {
                            return;
                        }
                        data.order = 0;
                        break;
                    case 1:
                        if (data.order == 1) {
                            data.order = 2;
                        } else if (data.order == 2) {
                            data.order = 1;
                        } else {
                            data.order = 1;
                        }
                        break;
                    case 3:
                        if (data.order == 3) {
                            data.order = 4;
                        } else if (data.order == 4) {
                            data.order = 3;
                        } else {
                            data.order = 3;
                        }
                        break;
                }
                data.goods_list = [];
                page.offset = 0;
                obj.getData();
            }

        }
    });

    $('#product .infinite-scroll').on('infinite', function (e) {
        if (data.loading == 0) {
            page.offset += page.limit;
            obj.getData();
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
                    order: data.order,
                    key:keywords
                },
                success: function (d) {
                    data.loading = 0;
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.goods_list.push(d.data.rows[i]);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        vue.$nextTick(function () {
                            $.initPage($('#product'));
                        });
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            if ($.router.params.back) {
                return;
            }
            data.goods_list = [];
            page.offset = 0;
            if ($.router.params.id) {
                category_id = $.router.params.id;
            }
            if ($.router.params.keywords) {
                keywords = $.router.params.keywords;
                data.keywords = keywords;
            } else {
                keywords = '';
                data.keywords = '请输入关键字';
            }
            data.order = 0;
            $.router.params = {};
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#product', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#product', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('product', {refresh:obj.refresh});
});