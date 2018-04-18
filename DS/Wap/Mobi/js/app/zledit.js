/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'user_view', 'takeconfirm'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery;
    var base = layui.base, user_view = layui.user_view, takeconfirm = layui.takeconfirm;
    var data = {d: []}, vue, cityPicker3, sexPicker, from = 'user_view';
    vue = new Vue({
        el: '#zledit',
        data: data,
        methods: {
            finished: function () {
                base.sendFormAjax($('#zledit form')[0], function () {
                    switch (from) {
                        case 'user_view':
                            user_view.refresh();
                            break;
                        case 'takeconfirm':
                            takeconfirm.refresh();
                            break;
                    }
                    mui.back();
                });
            },
            address: function (province, city, area) {
                var address = getAddress(province, city, area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            blur: function (key, e) {
                data.d[key] = $(e.target).val();
            }
        },
        mounted: function () {
            mui('#zledit .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });

            //省市区选择
            cityPicker3 = new mui.PopPicker({
                layer: 3
            });
            cityPicker3.setData(cityData3);
            var showCityPickerButton = document.getElementById('diqu');
            var cityResult3 = document.getElementById('diqu_txt');
            showCityPickerButton.addEventListener('tap', function (event) {
                cityPicker3.show(function (items) {
                    $(cityResult3).html((items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text);
                    data.d.province = (items[0] || {}).value;
                    data.d.city = (items[1] || {}).value;
                    data.d.area = (items[2] || {}).value;
                });
            }, false);
            //性别
            sexPicker = new mui.PopPicker();
            var showSexPickerButton = document.getElementById('sex');
            var sexResult = document.getElementById('sex_txt');
            showSexPickerButton.addEventListener('tap', function (event) {
                sexPicker.show(function (items) {
                    $(sexResult).html((items[0] || {}).text);
                    data.d.sex = (items[0] || {}).value;
                });
            }, false);
        }
    });

    $(document).on('viewDidLoad', '#zledit', function (e) {
        from = e.detail.from;
        obj.getData(e.detail.info);

    });
    var obj = {
        getData: function (d) {
            data.d = JSON.parse(d);
            obj.format();
        }, format: function () {
            var index = getAddressIndex(data.d.province, data.d.city, data.d.area);
            cityPicker3.pickers[0].setSelectedIndex(index.province);
            cityPicker3.pickers[1].setSelectedIndex(index.city);
            cityPicker3.pickers[2].setSelectedIndex(index.area);
            var datas = [];
            for (var key in data.d.sexs) {
                var sex = data.d.sexs[key]
                var da = {};
                da.text = sex;
                da.value = key;
                datas.push(da);
            }
            sexPicker.setData(datas);
            sexPicker.pickers[0].setSelectedIndex(data.d.sex - 1);
        }
    };
    //输出booth_news接口
    exports('zledit', {});
});