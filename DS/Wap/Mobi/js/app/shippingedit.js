/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'shipping'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);


    var $ = layui.jquery, base = layui.base, shipping = layui.shipping, cart = layui.shoppingcart, vue, cityPicker3,
        from;
    var data = {d: {}};
    vue = new Vue({
        el: '#shippingedit',
        data: data,
        methods: {
            address: function (d) {
                var address = getAddress(d.province, d.city, d.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            finished: function () {
                base.sendFormAjax($('#shippingedit form')[0], function () {
                    if (from == 'cart') {
                        cart.refresh();
                    } else {
                        shipping.refresh();
                    }
                    mui.back();
                });
            }, blur: function (key, e) {
                data.d[key] = $(e.target).val();
            }
        },
        mounted: function () {
            mui('#shippingedit .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            cityPicker3 = new mui.PopPicker({
                layer: 3
            });
            cityPicker3.setData(cityData3);
            var showCityPickerButton = document.getElementById('showCityPicker3');
            var cityResult3 = document.getElementById('cityResult3');
            showCityPickerButton.addEventListener('tap', function (event) {
                cityPicker3.show(function (items) {
                    $(cityResult3).html((items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text);
                    data.d.province = (items[0] || {}).value;
                    data.d.city = (items[1] || {}).value;
                    data.d.area = (items[2] || {}).value;
                    //返回 false 可以阻止选择框的关闭
                    //return false;
                });
            }, false);
        }
    });

    $('body').on('viewDidLoad', '#shippingedit', function (e) {
        from = e.detail.from;
        obj.getData(e.detail.info);
    });

    var obj = {
        getData: function (d) {
            data.d = JSON.parse(d);
            var index = getAddressIndex(data.d.province, data.d.city, data.d.area);
            cityPicker3.pickers[0].setSelectedIndex(index.province);
            cityPicker3.pickers[1].setSelectedIndex(index.city);
            cityPicker3.pickers[2].setSelectedIndex(index.area);
        }
    };
    //输出booth_news接口
    exports('shippingedit', {});
});