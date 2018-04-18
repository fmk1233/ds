/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base;
    var data = {d: {params: {}, user: {}}}, vue;

    vue = new Vue({
        el: '#take',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                base.sendFormAjax($('#take form'), function () {
                    viewApi.backRoot();
                });
            },
        },
        mounted: function () {
            mui('#take .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }

    });

    $('body').on('viewDidLoad', '#take', function (e) {
        obj.getData();
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'Bonus.GetCashInfo'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;
                        var user = data.d.user;
                        if (user['bank_no'] == '' || user['bank_name'] == '' || user['bank_address'] == '' || user['bank_user'] == '') {
                            base.successMsg('请填写银行信息', function () {
                                mui.back();
                            });
                        }
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    }
    //输出booth_news接口
    exports('take', {});
});