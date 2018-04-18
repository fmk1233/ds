/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base;
    var data = {recharge_list: [], loading: 0}, vue, page = {total: 1, limit: 10, offset: 0};
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Recharge.GetRechargeList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.recharge_list.push(d.data.rows[i]);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }, refresh: function () {
            $('#moneyinto .mui-scroll').attr('style', '');
            data.recharge_list = [];
            page.offset = 0;
            obj.getData();
        }
    };

    vue = new Vue({
        el: '#moneyinto',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            }
        },
        mounted: function () {
            mui('#moneyinto .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#moneyinto', function (e) {
        obj.refresh();
    });

    //输出booth_news接口
    exports('moneyinto', {refresh: obj.refresh});
});