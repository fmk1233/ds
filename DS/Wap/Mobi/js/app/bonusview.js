/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);


    var $ = layui.jquery, base = layui.base, vue;
    var data = {d: {}, rewardPrice: {}, rewardFee: {}};
    vue = new Vue({
        el: '#bonusview',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate
        },
        mounted: function () {
            mui('#bonusview .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#bonusview', function (e) {
        obj.getData(e.detail);
    });

    var obj = {
        getData: function (d) {
            data.d = JSON.parse(d.info);
            data.rewardPrice = JSON.parse(d.price);
            data.rewardFee = JSON.parse(d.fee);
        }
    };
    //输出booth_news接口
    exports('bonusview', {});
});