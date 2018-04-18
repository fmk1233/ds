/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, vue;
    var data = {d: {goods: [], address: {realname: '', mobile: '', province: '', city: '', area: '', address: ''}}};
    vue = new Vue({
        el: '#ordersview',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            goodsPic: function (goods_pics) {
                if (goods_pics != '')return base.goodsThumb(goods_pics);
                return '';
            },
        },
        mounted: function () {
            mui('#ordersview .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#ordersview', function (e) {
        obj.getData(e.detail.info);
    });

    var obj = {
        getData: function (d) {
            var order_info = JSON.parse(d);
            data.d = order_info;
        }
    };
    //输出booth_news接口
    exports('ordersview', {});
});