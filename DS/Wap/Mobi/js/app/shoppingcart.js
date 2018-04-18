/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'shop', 'productview'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);


    var $ = layui.jquery, shop = layui.shop, base = layui.base, productview = layui.productview, vue,
        data = {cart_list: [], priceTotal: 0, goodsTotal: 0, address: {}};
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'Order.CartList'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.cart_list = d.data.cart_list;
                        data.address = d.data.address;
                        obj.calcul();
                    } else {
                        base.errorMsg(d);
                    }
                }

            })
        }, price: function (goods) {
            if (goods.option_id == '') {
                return goods.price;
            }
            var goods_option = JSON.parse(goods.goods_option);
            for (var i = 0, len = goods_option.length; i < len; i++) {
                if (goods_option[i].option_id == goods.option_id) {
                    return goods_option[i]['option_price'];
                }
            }
        }, calcul: function () {
            var goodsTotal = 0;
            var priceTotal = 0;
            for (var i = 0, len = data.cart_list.length; i < len; i++) {
                var goods = data.cart_list[i];
                goodsTotal += parseInt(goods.total);
                priceTotal += parseFloat(obj.price(goods)) * parseInt(goods.total);
            }
            data.goodsTotal = goodsTotal;
            shop.changeCartNum(goodsTotal);
            productview.changeCartNum(goodsTotal);
            data.priceTotal = priceTotal;
        }, changeCart: function (id, total, callback) {
            base.sendAjax({
                data: {service: 'Order.ChangeCart', cartid: id, num: total},
                success: function (d) {
                    if (d.code == 40000) {
                        base.successMsg(d);
                        callback(true)
                    } else {
                        base.errorMsg(d);
                        callback(false, d.data);
                    }
                }
            });
        }, delCart: function (id) {
            base.sendAjax({
                data: {service: 'Order.DelCart', cartid: id},
                success: function (d) {
                    if (d.code == 40000) {
                        base.successMsg(d);
                        for (var i = 0, len = data.cart_list.length; i < len; i++) {
                            var goods = data.cart_list[i];
                            if (goods.id == id) {
                                data.cart_list.splice(i, 1);
                                obj.calcul();
                            }
                        }
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }

    };
    vue = new Vue({
        el: '#shoppingcart',
        data: data,
        methods: {
            goodsPic: function (goods_pics) {
                if (goods_pics != '')return base.goodsThumb(goods_pics.split(',')[0]);
                return '';
            },
            price: obj.price,
            guige: function (goods) {
                if (goods.option_id == '') {
                    return '';
                }
                var goods_option = JSON.parse(goods.goods_option);
                for (var i = 0, len = goods_option.length; i < len; i++) {
                    if (goods_option[i].option_id == goods.option_id) {
                        return goods_option[i]['option_title'];
                    }
                }
            },
            plus: function (index) {
                var goods = data.cart_list[index];
                var num = parseInt(goods.total);
                obj.changeCart(goods.id, num + 1, function (result, data) {
                    if (result) {
                        goods.total = num + 1;
                    } else {
                        goods.total = data;
                    }
                    obj.calcul();
                });

            },
            changeNum: function (index, e) {
                var num = parseInt($(e.target).val());
                if (num <= 0) {
                    num = 1;
                }
                var goods = data.cart_list[index];
                obj.changeCart(goods.id, num, function (result, data) {
                    if (result) {
                        goods.total = num;
                    } else {
                        goods.total = data;
                    }
                    obj.calcul();
                });
            },
            minus: function (index) {

                var goods = data.cart_list[index];
                var num = parseInt(goods.total);
                if (num <= 1) {
                    return;
                }
                obj.changeCart(goods.id, num - 1, function (result, data) {
                    if (result) {
                        goods.total = num - 1;
                    } else {
                        goods.total = data;
                    }
                    obj.calcul();
                });
            }, delCart: function (index) {
                var goods = data.cart_list[index];
                obj.delCart(goods.id);
            }, order: function () {
                var address = data.address;
                if (address.mobile == '' || address.province == '' || address.city == '' || address.area == '' || address.realname == '') {
                    base.successMsg('请填写收货信息', function () {
                        viewApi.fire('#shippingedit', {info: JSON.stringify(address), from: 'cart'});
                    });
                    return;
                }
                address.phone = address.mobile;
                var submit = $.extend({service: 'Order.AddOrders'}, address);
                base.sendAjax({
                    data: submit,
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d, function () {
                                shop.changeCartNum(0);
                                productview.changeCartNum(0);
                                viewApi.fire('#orders', {from: 'cart'});
                            });
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            }
        },
        mounted: function () {
            mui('#shoppingcart .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#shoppingcart', function (e) {
        $('#shoppingcart .mui-scroll').attr('style', '');
        data.cart_list = [];
        data.address = {};
        obj.getData();
    });

    //输出booth_news接口
    exports('shoppingcart', {refresh: obj.getData});
});