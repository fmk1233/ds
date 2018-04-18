/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue, index = layui.index;
    var data = {cart_list: [], address: {}, total: 0, totalPrice: 0, del: false, cart_num: 0, list: ''};

    vue = new Vue({
        el: '#cart',
        data: data,
        methods: {
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
            addressInfo: function (d) {
                var address = base.getAddress(d.province, d.city, d.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            finished: function () {
            }, blur: function (key, e) {
                data.d[key] = $(e.target).val();
            }, check: function (index) {
                var cart = data.cart_list[index];
                cart.checked = !cart.checked;
                Vue.set(data.cart_list, index, cart);
                calculate();
                vue.$nextTick(function () {
                    if ($('#cart .cart-list input:checked').length == data.cart_list.length && !$('#cart_check_all').hasClass('checked')) {
                        $('#cart_check_all').addClass('checked');
                    } else if ($('#cart .cart-list input:checked').length != data.cart_list.length && $('#cart_check_all').hasClass('checked')) {
                        $('#cart_check_all').removeClass('checked');
                    }
                });

            }, checkAll: function (e) {
                var tag = $(e.currentTarget);
                var $this = this;
                if (tag.hasClass('checked')) {
                    tag.removeClass('checked');
                    $('#cart .cart-list .icheckbox_flat-red').each(function (i) {
                        if ($(this).hasClass('checked')) {
                            $this.check(i);
                        }
                    });
                } else {
                    tag.addClass('checked');
                    $('#cart .cart-list .icheckbox_flat-red').each(function (i) {
                        if (!$(this).hasClass('checked')) {
                            $this.check(i);
                        }
                    });

                }
            },
            showDel: function () {
                data.del = !data.del;
            },
            changeNum: function (type, index, event) {
                var num = 1;
                var cart = data.cart_list[index];
                var orgin_num = parseInt(cart.total);
                switch (type) {
                    case 'plus':
                        num = orgin_num + 1;
                        break;
                    case 'minus':
                        num = orgin_num - 1;
                        break
                    case 'num':
                        var tag = $(event.currentTarget);
                        num = parseInt(tag.val());
                        break;
                }
                if (num < 1 || isNaN(num)) {
                    num = cart.total;
                    cart.total = 1;
                    cart.total = num;
                    return;
                }
                base.sendAjax({
                    data: {service: 'Order.ChangeCart', cartid: cart.id, num: num},
                    success: function (d) {
                        if (d.code == 40000) {
                            cart.total = num;
                            base.successMsg(d);
                        } else {
                            cart.total = orgin_num;
                            base.errorMsg(d);
                        }
                        calculate();
                    }
                });

            },
            batchDel: function () {
                var ids = [];
                var index = [];
                $('#cart .cart-list input:checked').each(function () {
                    ids.push($(this).val());
                    index.push($(this).data('index'));
                });
                if (ids.length == 0) {
                    return;
                }
                index.reverse();
                base.confirm('您确认要删除这些选项？', function () {
                    base.sendAjax({
                        data: {service: 'Cart.BatchDel', cart_ids: ids},
                        success: function (d) {
                            if (d.code == 40000) {
                                for (var i = 0, len = index.length; i < len; i++) {
                                    data.cart_list.splice(index[i], 1);
                                }
                                calculate();
                                base.successMsg(d);
                            } else {
                                base.errorMsg(d);
                            }
                        }
                    });
                });
            }
        }
    });

    $(document).on("pageReinit", '#cart', function () {
        if (!$.router.params.back) {
            obj.getData();
        }
        $.router.params = {};
    });
    $(document).on("pageInit", '#cart', function () {
        obj.getData();
    });
    function calculate() {
        data.total = 0;
        data.totalPrice = 0;
        var list = [];
        var total = 0;
        for (var i = 0, len = data.cart_list.length; i < len; i++) {
            if (data.cart_list[i].checked == true) {
                data.total += parseInt(data.cart_list[i].total);
                data.totalPrice += parseInt(data.cart_list[i].total) * parseFloat(data.cart_list[i].price);
                list.push(data.cart_list[i]);
            }
            total += parseInt(data.cart_list[i].total);
        }
        data.list = JSON.stringify(list);
        data.totalPrice = data.totalPrice.toFixed(2);
        data.cart_num = total;
        index.changeNum(total);
    }

    var obj = {
        getData: function () {
            $('#cart_check_all').removeClass('checked');
            base.sendAjax({
                data: {service: 'Order.CartList'},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.cart_list.length; i < len; i++) {
                            var option = JSON.parse(d.data.cart_list[i].goods_option);
                            for (var j = 0, lens = option.length; j < lens; j++) {
                                if (option[j].option_id == d.data.cart_list[i].option_id) {
                                    d.data.cart_list[i].price = option[j].option_price;
                                    break;
                                }
                            }
                        }
                        data.cart_list = d.data.cart_list;
                        data.address = d.data.address;
                        data.del = false;
                        data.cart_num = base.cart_num();
                        calculate();
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        }
    };
    // obj.getData();

    //输出booth_news接口
    exports('cart', {});
});