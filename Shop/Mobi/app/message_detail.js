/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {news: {}};
    vue = new Vue({
        el: '#message_detail',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate
        }
    });
    var obj = {
        getData: function () {
            if ($.router.params.id) {//如果传过来的是ID
                base.sendAjax({
                    data: {service: 'News.NewsInfo', newsid: $.router.params.id},
                    success: function (d) {
                        if (d.code == 40000) {
                            data.news = d.data;
                        } else {
                            base.errorMsg(d);
                        }
                    }
                })
            } else {//传过来的是数据
                data.news = JSON.parse($.router.params.news);
            }

            $.router.params = {};//清空路由中的传递的参数
        },
        refresh: function () {
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#message_detail', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#message_detail', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('message_detail', {});
});