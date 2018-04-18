/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, page = {total: 1, offset: 0, limit: 10}, type = 0;
    var data = {bonus_list: [], bonus_types: {}, loading: 0}
    vue = new Vue({
        el: '#billing',
        data: data,
        methods: {
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            },
            timer: base.myTime.UnixToDate
        },
        mounted: function () {
            mui('#billing .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#billing', function (e) {
        type = e.detail.type;
        $('#billing .mui-scroll').attr('style', '');
        data.bonus_list = [];
        page.offset = 0;
        obj.getData();
    });

    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Bonus.GetBonusList', limit: page.limit, offset: page.offset, money_type: type},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.bonus_list.push(d.data.rows[i]);
                        }
                        data.bonus_types = d.data.bonus_types;
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
        }
    };
    //输出booth_news接口
    exports('billing', {});
});