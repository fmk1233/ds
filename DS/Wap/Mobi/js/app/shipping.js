/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, vue;
    var data = {d: {province: 0, city: 0, area: 0, id: 0}};
    vue = new Vue({
        el: '#shipping',
        data: data,
        methods: {
            address: function (d) {
                var address = getAddress(d.province, d.city, d.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            }
        },
        mounted: function () {
            mui('#shipping .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#shipping', function (e) {
        obj.getData();
    });

    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.Address'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        }
    };
    //输出booth_news接口
    exports('shipping', {refresh: obj.getData});
});