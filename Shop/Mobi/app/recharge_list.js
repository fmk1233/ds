/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = {total: 1, limit: 10, offset: 0}, type = 0;
    var data = {recharge_list: [], loading: 0};
    vue = new Vue({
        el: '#recharge_list',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate
        }
    });
    $('#recharge_list').find('.infinite-scroll').on('infinite', function (e) {
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
                data: {service: 'Recharge.GetRechargeList', limit: page.limit, offset: page.offset,type:type},
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
                        vue.$nextTick(function () {
                            $.initPage($('#recharge_list'));
                        });
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            if ($.router.params.type) {//充值钱包类型
                type = $.router.params.type;
            }
            $.router.params = {};
            data.recharge_list = [];
            page.offset = 0;
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#recharge_list', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#recharge_list', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('recharge_list', {});
});