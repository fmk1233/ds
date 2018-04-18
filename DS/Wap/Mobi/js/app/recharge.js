layui.define(['jquery', 'base', 'moneyinto'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, moneyinto = layui.moneyinto;
    var data = {bonus_names: {}, bonus_name: '', money_type: 0}, vue, bonusPicker;

    vue = new Vue({
        el: '#recharge',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                base.sendFormAjax($('#recharge form'), function () {
                    moneyinto.refresh();
                    mui.back();
                });
            },
        },mounted:function () {
            mui('#recharge .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });

            bonusPicker = new mui.PopPicker();
            var bonusPickerButton = document.getElementById('money_type');
            bonusPickerButton.addEventListener('tap', function () {
                bonusPicker.show(function (items) {
                    data.money_type = (items[0] || {}).value;
                    data.bonus_name = (items[0] || {}).text;
                });
            }, false);
        }
    });

    $('body').on('viewDidLoad', '#recharge', function (e) {
        obj.getData();
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'Recharge.Recharge'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.bonus_names = d.data.bonus_names;
                        var datas = [];
                        var i = 0;
                        for (var key in data.bonus_names) {
                            var sex = data.bonus_names[key];
                            if (i == 0) {
                                data.bonus_name = sex;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        bonusPicker.setData(datas);
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    }
    //输出booth_news接口
    exports('recharge', {});
});
