/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base', 'wallet'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue, wallet = layui.wallet;
    var data = {d: {user: {}, money: 0, params: {}}, from: false};
    vue = new Vue({
        el: '#account_raply',
        data: data,
        methods: {
            finished: function () {
                var user = data.d.user;
                if (user.bank_name == '' || user.bank_no == '' || user.bank_user == '' || user.bank_address == '') {
                    base.errorMsg('请填写银行信息');
                    return;
                }
                base.sendFormAjax($('#account_raply form')[0], function (d) {
                    wallet.changeMoney(data.d.money);
                    $.router.back();
                });
            }, blur: function (key, e) {
                var value = $(e.target).val();
                if (key == 'money') {
                    data.d.money = value;
                    return;
                }
                data.d.user[key] = value;
            }
        }
    });

    $(document).on("pageReinit", '#account_raply', function () {
        obj.getData();
    });
    $(document).on("pageInit", '#account_raply', function () {
        obj.getData();
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: "Bonus.GetCashInfo"},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    };
    // obj.getData();

    //输出booth_news接口
    exports('account_raply', {});
});