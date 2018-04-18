/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = {total: 1, limit: 10, offset: 0};
    var data = {news_list: [], loading: 0, from: false};
    vue = new Vue({
        el: '#message',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate
        }
    });
    $('#message').find('.infinite-scroll').on('infinite', function (e) {
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
                data: {service: 'News.GetNewsList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.news_list.push(d.data.rows[i]);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        vue.$nextTick(function () {
                            $.initPage($('#message'));
                        });
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            data.news_list = [];
            page.offset = 0;
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#message', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#message', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('message', {});
});