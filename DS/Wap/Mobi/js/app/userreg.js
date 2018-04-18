/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, vue, NTorankBox, PositionBox, cityPicker3, sexPicker;
    var data = {d: {sexs: {}, pos_names: {}, rank_names: {}}, rank_name: '', pos_name: '', address: '', sex_name: ''};
    vue = new Vue({
        el: '#userreg',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                base.sendFormAjax($('#userreg form')[0], function () {
                    mui.back();
                });
            },
            change: function (type, e) {
                var value = $(e.target).val();
                data.d[type] = value;
            }
        }, mounted: function () {
            mui('#userreg .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            NTorankBox = new mui.PopPicker();
            var NTorankButton = document.getElementById('NTorank');
            NTorankButton.addEventListener('tap', function () {
                NTorankBox.show(function (items) {
                    data.rank_name = items[0].text;
                    data.d.rank = items[0].value;
                });
            }, false);

            PositionBox = new mui.PopPicker();
            var PositionButton = document.getElementById('Position');
            PositionButton.addEventListener('tap', function (event) {
                PositionBox.show(function (items) {
                    data.pos_name = items[0].text;
                    data.d.pos = items[0].value;
                });
            }, false);

            //下拉城市联动
            cityPicker3 = new mui.PopPicker({
                layer: 3
            });
            cityPicker3.setData(cityData3);
            var showCityPickerButton = document.getElementById('showCityPicker');
            showCityPickerButton.addEventListener('tap', function (event) {
                cityPicker3.show(function (items) {
                    data.address = (items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text;
                    data.d.province = (items[0] || {}).value;
                    data.d.city = (items[1] || {}).value;
                    data.d.area = (items[2] || {}).value;
                });
            }, false);

            sexPicker = new mui.PopPicker();
            var showSexPickerButton = document.getElementById('sexs');
            showSexPickerButton.addEventListener('tap', function (event) {
                sexPicker.show(function (items) {
                    data.sex_name = items[0].text;
                    data.d.sex = items[0].value;
                });
            }, false);
        }
    });


    $('body').on('viewDidLoad', '#userreg', function (e) {
        obj.getData();
    });

    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.UserReg'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                        if(!d.data.user_can_bd){
                            base.successMsg('您没有报单的权限',function () {
                                mui.back();
                            });
                            return;
                        }
                        data.address = '请选择省市区';
                        var datas = [];
                        var i = 0;
                        for (var key in data.d.sexs) {
                            var sex = data.d.sexs[key];
                            if (i == 0) {
                                data.sex_name = sex;
                                data.d.sex = key;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        sexPicker.setData(datas);
                        var datas = [];
                        var i = 0;
                        for (var key in data.d.pos_names) {
                            var sex = data.d.pos_names[key];
                            if (i == 0) {
                                data.pos_name = sex;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        PositionBox.setData(datas);
                        PositionBox.pickers[0].setSelectedIndex(data.d.pos - 1);
                        var datas = [];
                        var i = 0;
                        for (var key in data.d.rank_names) {
                            var sex = data.d.rank_names[key];
                            if (i == 0) {
                                data.rank_name = sex;
                                data.d.rank = key;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        NTorankBox.setData(datas);
                    } else {
                        base.errorMsg(d);
                    }
                }
            });


        }
    };

    //输出booth_news接口
    exports('userreg', {});
});