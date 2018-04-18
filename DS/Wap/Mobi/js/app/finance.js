/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, pullRefresh, fresh = false, pageInited = false;
    var data = {d: {bonus_names: {}}}
    vue = new Vue({
        el: '#finance',
        data: data,
        methods: {},
        mounted: function () {
            mui('#finance .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            pullRefresh = mui('#finance .mui-scroll-wrapper').pullRefresh({
                down: {
                    height:60,
                    callback: function () {
                        fresh = true;
                        obj.getData();
                    }
                }
            });
        }
    });

    $('#Index .mui-bar-tab a[href="#finance"]').on('tap', function () {
        if(!pageInited){
            pageInited = true;
            obj.getData();
        }
    });

    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'Bonus.Finance'},
                success: function (d) {
                    if (fresh) {
                        setTimeout(function () {
                            pullRefresh.endPulldownToRefresh();
                        },500);
                        fresh = false;
                    }
                    if (d.code == 40000) {
                        data.d = d.data;
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        }
    };
    //输出booth_news接口
    exports('finance', obj);
});