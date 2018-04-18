/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base;
    var data = {d: {}}, vue;

    vue = new Vue({
        el: '#user_view',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            address: function (province, city, area) {
                var address = getAddress(province, city, area);
                return address.province + ' ' + address.city + ' ' + address.area;
            }
        },
        mounted: function () {
            mui('#user_view .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }

    });

    $('body').on('viewDidLoad', '#user_view', function (e) {
        obj.getData();
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.UserInfo'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;

                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    }
    //输出booth_news接口
    exports('user_view', {refresh: obj.getData});


});