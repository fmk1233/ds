/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue;
    var data = {d: {}}
    vue = new Vue({
        el: '#takeconfirm',
        data: data,
        mounted: function () {
            mui('#takeconfirm .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#takeconfirm', function (e) {
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

    };
    //输出booth_news接口
    exports('takeconfirm', {refresh: obj.getData});
});