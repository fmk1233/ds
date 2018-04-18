/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, index = layui.index, vue, cart_ids = [], goods_info = [];
    var data = {address: {realname: '', mobile: '', address: ''}, cart_list: [], total: 0, totalPrice: 0};
    vue = new Vue({
        el: '#order_number',
        data: data,
        methods: {
            addressInfo: function (addre) {
                var address = base.getAddress(addre.province, addre.city, addre.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            goodsPic: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
            guige: function (d) {
                var goods_option = JSON.parse(d.goods_option);
                for (var i = 0, len = goods_option.length; i < len; i++) {
                    if (d.option_id == goods_option[i].option_id) {
                        return goods_option[i].option_title;
                    }
                }
            },
            back: back,
            order: function () {
                var address = data.address;
                if (address.mobile == '' || address.province == '' || address.city == '' || address.area == '' || address.realname == '') {
                    base.successMsg('请填写收货信息', function () {
                        $('#order_number a[href="#address"]').trigger('click');
                    });
                    return;
                }
                address.phone = address.mobile;
                var submit = $.extend({service: 'Order.AddOrders'}, address, {
                    cart_ids: cart_ids,
                    goods_info: goods_info
                });
                base.sendAjax({
                    data: submit,
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d, function () {
                                $.router.params = {from: 'order', state: 1};
                                if(!(cart_ids.length==1&&cart_ids[0]==0)){
                                    index.changeNum(base.cart_num() - data.total);//修改cart_num
                                }
                                $.router.loadPage('#order');
                            });
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            }
        }
    });
    function back() {
        $.router.params.back = true;
        $.router.back();
    }

    function calculate() {
        data.total = 0;
        data.totalPrice = 0;
        cart_ids = [];goods_info=[];
        if (data.cart_list.length == 1 && data.cart_list[0]['id'] == 0) {
            var cart = data.cart_list['0'];
            var good_info = {total: 1, id: cart.goods_id, option_id: cart.option_id, cart_id: cart.id};
            goods_info.push(good_info);
        }
        for (var i = 0, len = data.cart_list.length; i < len; i++) {
            data.total += parseInt(data.cart_list[i].total);
            data.totalPrice += parseInt(data.cart_list[i].total) * parseFloat(data.cart_list[i].price);
            cart_ids.push(data.cart_list[i].id);
        }
        data.totalPrice = data.totalPrice.toFixed(2);
    }

    var obj = {
        getData: function () {
            if ($.router.params.from == 'order') {
                return;
            }
            if (!$.isEmptyObject($.router.params)) {
                data.address = JSON.parse($.router.params.address);
                data.cart_list = JSON.parse($.router.params.cart_list);
            }
            $.router.params = {};
            if (data.cart_list.length == 0) {
                base.errorMsg('请选择商品');
                setTimeout(function () {
                    back();
                }, 1500);
                return;
            }
            calculate();
        },
        refresh: function () {
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#order_number', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#order_number', function () {
        obj.refresh();
    });


    //输出address接口
    exports('order_number', {
        changeAddress: function (address) {
            data.address = address;
        }, refresh: obj.refresh
    });
});