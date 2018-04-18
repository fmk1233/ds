/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base;
    var data = {inner_transfer_records: [], loading: 0}, vue, page = {total: 1, limit: 10, offset: 0};
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Bonus.GetInnerTransferList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.inner_transfer_records.push(d.data.rows[i]);
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
            $('#inner_transfer .mui-scroll').attr('style', '');
            data.inner_transfer_records = [];
            page.offset = 0;
            obj.getData();
        }
    };

    vue = new Vue({
        el: '#inner_transfer',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            }
        },
        mounted: function () {
            mui('#inner_transfer .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#inner_transfer', function (e) {
        obj.refresh();
    });

    //输出booth_news接口
    exports('inner_transfer', {refresh: obj.refresh});
});