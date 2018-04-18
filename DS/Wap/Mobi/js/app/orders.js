/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var html = function () {

    }

    var $ = layui.jquery, base = layui.base, vue, page = {total: 1, limit: 10, offset: 0}, from = '';
    var data = {order_list: [], loading: 0};
    vue = new Vue({
        el: '#orders',
        data: data,
        methods: {
            goodsPic: function (goods_pics) {
                if (goods_pics != '')return base.goodsThumb(goods_pics);
                return '';
            }, loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            }, changeOrder: function (index, type) {
                var order_info = data.order_list[index];
                var $service;
                var $msg;
                switch (type) {
                    case 'pay':
                        $service = 'Order.PayOrder';
                        $msg = '您确认支付此订单';
                        break;
                    case 'confirm':
                        $service = 'Order.ConfirmOrder';
                        $msg = '您确认此订单已收货';
                        break;
                    case 'cancel':
                        $service = 'Order.DelOrder';
                        $msg = '您确认取消此订单';
                        break;
                    case 'del':
                        $service = 'Order.DelOrder';
                        $msg = '您确认删除此订单';
                        break;
                }
                if ($service == '') {
                    return;
                }
                mui.confirm($msg, '提示信息', '', function (i) {
                    if (i.index == 1) {
                        base.sendAjax({
                            data: {service: $service, orderid: order_info.id},
                            success: function (d) {
                                if (d.code == 40000) {
                                    base.successMsg(d, function () {
                                        if (type == 'del') {
                                            viewApi.back();
                                            return;
                                        }
                                        order_info.status = d.data.status
                                    });
                                } else {
                                    base.errorMsg(d);
                                }
                            }
                        });
                    }
                });
            }, back: function () {
                if (from == 'cart') {
                    viewApi.backRoot();
                } else {
                    viewApi.back();
                }
            }
        }
    });
    mui('#orders .mui-scroll-wrapper').scroll({
        bounce: true, //是否启用回弹
        indicators: false, //是否显示滚动条
        deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
    });

    $('body').on('viewDidLoad', '#orders', function (e) {
        $('#orders .mui-scroll').attr('style', '');
        data.order_list = [];
        page.offset = 0;
        from = e.detail.from;
        obj.getData();
    });


    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Order.GetOrderList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.order_list.push(d.data.rows[i]);
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

            })
        }
    };
    //输出booth_news接口
    exports('orders', {});
});