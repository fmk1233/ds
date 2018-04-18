/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'mailbox'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, mailbox = layui.mailbox, vue;
    var data = {d: {}};
    vue = new Vue({
        el: '#writemail',
        data: data,
        methods: {
            finished: function () {
                base.sendFormAjax($('#writemail form')[0], function () {
                    mailbox.refresh();
                    mui.back();
                });
            }
        },
        mounted: function () {
            mui('#writemail .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });


    $('body').on('viewDidLoad', '#writemail', function (e) {
        obj.getData();
    });


    var obj = {
        getData: function () {
        }
    };

    //输出booth_news接口
    exports('writemail', {});
});