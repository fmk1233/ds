layui.define(['jquery', 'base', 'inner_transfer'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, inner_transfer = layui.inner_transfer;
    var data = {bonus_names: {}, bonus_name: '', money_type: 1}, vue, bonusPicker;

    vue = new Vue({
        el: '#to_transfer',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                base.sendFormAjax($('#to_transfer form'), function () {
                    inner_transfer.refresh();
                    mui.back();
                });
            },
        },mounted:function () {
            mui('#to_transfer .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });

            bonusPicker = new mui.PopPicker();
            var bonusPickerButton = document.getElementById('money_type');
            bonusPickerButton.addEventListener('tap', function () {
                bonusPicker.show(function (items) {
                    data.money_type = (items[1] || {}).value;
                    data.bonus_name = (items[1] || {}).text;
                });
            }, false);
        }
    });

    $('body').on('viewDidLoad', '#to_transfer', function (e) {
        obj.getData();
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'Bonus.ToTransfer'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.bonus_names = d.data;
                        var datas = [];
                        for (var key in data.bonus_names) {
                            var sex = data.bonus_names[key];
                            data.bonus_name = sex;
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas[key] = sex;
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
    exports('to_transfer', {});
});
