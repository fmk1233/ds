/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = {total: 1, limit: 10, offset: 0};
    var data = {cash_list: [], loading: 0};
    vue = new Vue({
        el: '#cash_detail',
        data: data,
        methods: {
            timer:base.myTime.UnixToDate
        }
    });
    $('#cash_detail').find('.infinite-scroll').on('infinite', function (e) {
        if (data.loading == 0) {
            page.offset += page.limit;
            obj.getData();
        }
    });
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Bonus.GetCashList',limit:page.limit,offset:page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.cash_list.push(d.data.rows[i]);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        vue.$nextTick(function () {
                            $.initPage($('#cash_detail'));
                        });
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            data.cash_list = [];
            page.offset = 0;
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#cash_detail', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#cash_detail', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('cash_detail', {});
});