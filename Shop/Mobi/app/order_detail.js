/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {d: {address: {}, goods: []}, total: 0, totalPrice: 0, loading: 0};
    vue = new Vue({
        el: '#order_detail',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            goodsPic: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
            changeOrder: function (type) {
                var order_info = data.d;
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
                base.confirm($msg, function () {
                    base.sendAjax({
                        data: {service: $service, orderid: order_info.id},
                        success: function (d) {
                            if (d.code == 40000) {
                                base.successMsg(d, function () {
                                    if (type == 'del') {
                                        $.router.back();
                                        return;
                                    }
                                    order_info.status = d.data.status
                                });
                            } else {
                                base.errorMsg(d);
                            }
                        }
                    });
                });
            }
        }
    });
    function calculate() {
        data.total = 0;
        data.totalPrice = 0;
        for (var i = 0, len = data.d.goods.length; i < len; i++) {
            data.total += parseInt(data.d.goods[i].total);
            data.totalPrice += parseInt(data.d.goods[i].total) * parseFloat(data.d.goods[i].price);
        }
        data.totalPrice = data.totalPrice.toFixed(2);
    }

    var obj = {
        getData: function () {
            data.d = JSON.parse($.router.params.order_info);
            calculate();
            $.router.params = {};
        },
        refresh: function () {
            obj.getData();
        }
    };

    //调用微信JS api 支付
    function jsApiCall($jsApiParameters) {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', $jsApiParameters,
            function (res) {
                WeixinJSBridge.log(res.err_msg);
                alert(res.err_code + res.err_desc + res.err_msg);
            }
        );
    }

    function callpay($jsApiParameters) {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', jsApiCall($jsApiParameters), false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', jsApiCall($jsApiParameters));
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall($jsApiParameters));
            }
        } else {
            jsApiCall($jsApiParameters);
        }
    }

    var buttons1 = [
        {
            text: '请选择支付方式',
            label: true
        }
    ];
    $(document).on("pageReinit", '#order_detail', function () {
        obj.refresh();
    }).on("pageInit", '#order_detail', function () {
        base.sendAjax({
            data: {
                service: 'Order.PaymentList',
            },
            success: function (d) {
                if (d.code == 40000) {
                    var obj = {};
                    for (var key in d.data) {
                        obj[d.data[key]] = key;
                        buttons1.push({
                            text: d.data[key],
                            bold: true,
                            onClick: function (modal, e) {
                                var index = parseInt(obj[$(e.target).text()]);
                                var device = layui.device('weixin');
                                if (device.weixin) {
                                    index += 1;
                                }
                                console.log(index);
                                var order_info = data.d;
                                base.sendAjax({
                                    data: {service: 'Order.PayOrder', orderid: order_info.id, paytype: index},
                                    success: function (d) {
                                        if (d.code == 40000) {
                                            switch (index) {
                                                case 1:
                                                    order_info.status = d.data.status
                                                    break;
                                                case 2:
                                                    location.href = d.data.alipay;
                                                    break;
                                                case 6:
                                                    $.modal({
                                                        title: '请扫码支付',
                                                        text: '<img src="' + d.data.file + '">'
                                                    });
                                                    break;
                                                case 7:
                                                    callpay(d.data.jsapi);
                                                    break;
                                            }
                                        } else {
                                            base.errorMsg(d);
                                        }
                                    }
                                });
                            }
                        });
                    }
                } else {
                    base.errorMsg(d);
                }
            }
        });
        obj.refresh();
    }).on('click', '#order_detail .pay', function () {

        var buttons2 = [
            {
                text: '取消',
                bg: 'danger'
            }
        ];
        var groups = [buttons1, buttons2];
        $.actions(groups);
    });

    // obj.refresh();

    //输出address接口
    exports('order_detail', {});
});