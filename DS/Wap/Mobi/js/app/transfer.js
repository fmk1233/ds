/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'moneyout'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, moneyout = layui.moneyout, vue, bonusPicker;
    var data = {d: {bonus_names: {}, name: '', user: {}}, bonus_name: '', bonus: 0, type: -1, real_name: ''};
    vue = new Vue({
        el: '#transfer',
        data: data,
        methods: {
            checkUserName: function (e) {
                var value = ($(e.target).val());
                base.sendAjax({
                    data: {service: 'Public.CheckUserField', field: 'username', value: value},
                    success: function (d) {
                        if (d.code == 40000) {
                            data.real_name = d.data['true_name'];
                        } else {
                            base.errorMsg('会员不存在');
                        }
                    }
                })
            },
            finished: function () {
                base.sendFormAjax($('#transfer form'), function () {
                    moneyout.refresh();
                    mui.back();
                });
            }
        },
        watch: {
            type: function (value) {
                var d = data.d;
                this.bonus_name = d.bonus_names[value];
                this.bonus = d.user[d.name + value];
            }
        },
        mounted: function () {
            mui('#transfer .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            bonusPicker = new mui.PopPicker();
            var bonusPickerButton = document.getElementById('TType');
            var bonusResult = document.getElementById('TTypeTxt');
            bonusPickerButton.addEventListener('tap', function (event) {
                bonusPicker.show(function (items) {
                    data.type = (items[0] || {}).value;
                });
            }, false);

        }
    });


    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: "Transfer.GetTransferInfo"},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                        var datas = [];
                        for (var key in data.d.bonus_names) {
                            var name = data.d.bonus_names[key];
                            var da = {};
                            da.text = name;
                            da.value = key;
                            datas.push(da);
                        }
                        bonusPicker.setData(datas);
                        data.type = datas[0].value;
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        }
    };

    $('body').on('viewDidLoad', '#transfer', function (e) {
        obj.getData();
    });
    //输出booth_news接口
    exports('transfer', {});
});