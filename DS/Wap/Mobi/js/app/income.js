/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, gal;
    var data = {list: [{}, {}, {}], price: {}, fee: {}, index: 0};
    vue = new Vue({
        el: '#income',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
        },
        mounted: function () {
            mui('#income .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            gal = mui('#slider-income').slider();
        },
        updated: function () {
            var width = $(window).width();
            $('#income .mui-slider-item ,#income .mui-control-item').removeClass('mui-active');
            $('#income a[href="#item' + (parseInt(data.index) + 1) + 'mobile"]').addClass('mui-active');
            $('#income #item' + (parseInt( data.index) + 1) + 'mobile').addClass('mui-active');
            $('#income .mui-slider-group').css({
                'transform':'translate3d(-'+(parseInt( data.index)*width)+'px, 0px, 0px) translateZ(0px)',
                'transition-duration':0
            });
        }
    });

    $('body').on('viewDidLoad', '#income', function (e) {
        data.index = e.detail.index;
            // 'transform','translate3d(-'+(parseInt(e.detail.index)*$(window).width())+', 0px, 0px) translateZ(0px)');
        data.price = JSON.parse(e.detail.price);
        data.fee = JSON.parse(e.detail.fee);
        obj.getData(e.detail.info);
    });

    var obj = {
        getData: function (d) {
            data.list = JSON.parse(d);
        }
    };

    //输出booth_news接口
    exports('income', {});
});