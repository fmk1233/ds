/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base;
    var data = {upgrade_list: [], loading: 0}, vue, page = {total: 1, limit: 10, offset: 0};
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'User.GetUpgradeList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.upgrade_list.push(d.data.rows[i]);
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
        }
    };

    vue = new Vue({
        el: '#upgradelist',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            }
        },
        mounted: function () {
            mui('#upgradelist .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#upgradelist', function (e) {
        $('#upgradelist .mui-scroll').attr('style', '');
        data.upgrade_list = [];
        page.offset = 0;
        obj.getData();
    });
    //输出booth_news接口
    exports('upgradelist', {});
});