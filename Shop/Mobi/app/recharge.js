/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue;
    var data = {d: {money: '', memo: ''}, params: {rule: 100}}, type = 0;
    vue = new Vue({
        el: '#recharge',
        data: data,
        methods: {
            finished: function () {
                if (parseFloat(data.d.money) % parseInt(data.params.rule) != 0) {
                    base.errorMsg(base.sprintf('充值金额为%d的整数倍', data.params.rule));
                }
                base.sendAjax({
                    data: {service: 'Recharge.DoRecharge', amount: data.d.money, money_type: type, memo: data.d.memo},
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d, function () {
                                $.router.back();
                            });
                        } else {
                            base.errorMsg(d);
                        }
                    }
                })
            }, blur: function (key, e) {
                var value = $(e.target).val();
                data.d[key] = value;
            }
        }
    });

    $(document).on("pageReinit", '#recharge', function () {
        obj.getData();
    });
    $(document).on("pageInit", '#recharge', function () {
        obj.getData();
    });
    var obj = {
        getData: function () {
            if ($.router.params.type) {//充值钱包类型
                type = $.router.params.type;
            }
            $.router.params = {};
            base.sendAjax({
                data: {service: "Recharge.Recharge"},
                success: function (d) {
                    if (d.code == 40000) {
                        data.params = d.data.params;
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    };
    // obj.getData();

    //输出booth_news接口
    exports('recharge', {});
});