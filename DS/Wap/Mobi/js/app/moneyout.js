/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, page = {total: 1, offset: 0, limit: 10};
    var data = {transfer_list: [], bonus_names: {}, loading: 0}
    vue = new Vue({
        el: '#moneyout',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            },
            bonus_name: function (money_type) {
                return data.bonus_names[money_type] ? data.bonus_names[money_type] : '';
            }
        },
        mounted: function () {
            mui('#moneyout .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#moneyout', function (e) {
        obj.refresh();
    });

    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Transfer.GetTransferList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.transfer_list.push(d.data.rows[i]);
                        }
                        data.bonus_names = d.data.bonus_names;
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
            })
        },
        refresh: function () {
            $('#moneyout .mui-scroll').attr('style', '');
            data.transfer_list = [];
            page.offset = 0;
            obj.getData();
        }
    };

    //输出booth_news接口
    exports('moneyout', {refresh: obj.refresh});
});