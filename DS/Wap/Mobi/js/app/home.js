/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);


    var $ = layui.jquery, base = layui.base, vue, pullRefresh, fresh = false;
    var data = {
        d: {
            advs: [],
            user: {},
            reward_total: 0,
            cash_money: 0,
            tj_num: 0,
            total_num: 0,
            reward_list: [],
            rewardPrice: {},
            rewardFee: {},
            notices: []
        }
    };
    var obj = {
        getData: function () {//获取数据
            base.sendAjax({
                data: {service: "User.Main"},
                success: function (d) {
                    if (fresh) {
                        setTimeout(function () {
                            pullRefresh.endPulldownToRefresh();
                        }, 500);
                        fresh = false;
                    }
                    if (d.code == 40000) {
                        data.d = d.data;
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    };

    vue = new Vue({
        el: '#Home',
        data: data,
        methods: {
            goodsPath: function (url) {
                return baseUrl + 'static' + url;
            },
            total: function (reward) {
                var total = 0;
                for (var key in data.d.rewardPrice) {
                    total += parseFloat(reward[data.d.rewardPrice[key]]);

                }
                return total.toFixed(2);
            },
            fee: function (reward) {
                var fee = 0;
                for (var key in data.d.rewardFee) {
                    fee += parseFloat(reward[data.d.rewardFee[key]]);
                }
                return fee.toFixed(2);
            }
        },
        mounted: function () {
            mui('#Home .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            pullRefresh = mui('#Home .mui-scroll-wrapper').pullRefresh({
                down: {
                    height: 60,
                    callback: function () {
                        fresh = true;
                        obj.getData();
                    }
                }
            });
        },
        updated: function () {
            var gallery = mui('#Home #banner-slider');
            gallery.slider({
                interval: 0//自动轮播周期，若为0则不自动播放，默认为0；
            });
            var gal = mui('#Home #slider');
            gal.slider();
            var getOption = function (chartType) {
                var chartOption = chartType == 'pie' ? {
                    calculable: false,
                    series: [{
                        radius: '65%',
                        center: ['50%', '50%'],

                    }]
                } : {
                    legend: {
                        data: ['收入额'/*, '总收入'*/]
                    },
                    grid: {
                        x: 30,
                        x2: 10,
                        y: 30,
                        y2: 25
                    },
                    toolbox: {
                        show: false,
                        feature: {
                            mark: {
                                show: true
                            },
                            dataView: {
                                show: true,
                                readOnly: false
                            },
                            magicType: {
                                show: true,
                                type: ['line', 'bar']
                            },
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    calculable: false,
                    xAxis: [{
                        type: 'category',
                        data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
                    }],
                    yAxis: [{
                        type: 'value',
                        splitArea: {
                            show: true
                        }
                    }],
                    series: [{
                        name: '收入额',
                        type: chartType,
                        data: data.d.week_reward
                    }]
                };
                return chartOption;
            };//图表
            var lineChart = echarts.init($('#lineChart')[0]);
            lineChart.setOption(getOption('line'));
            new Swiper('#Home .ui-home-news .swiper-container', {
                direction: 'vertical',
                loop: true,
                autoplay: 3000,
                height: 18,
                swipeHandler: '.swipe-handler',
                autoplayDisableOnInteraction: false,
            });
        }
    });
    if ($.isEmptyObject(layui.data('2957297735fbf429'))) {
        $('#login').addClass('mui-active');

    } else {
        obj.getData();
    }


    $('#Index .mui-bar-tab a[href="#Home"]').on('tap', function () {
        new Swiper('#Home .ui-home-news .swiper-container', {
            direction: 'vertical',
            loop: true,
            autoplay: 3000,
            height: 18,
            swipeHandler: '.swipe-handler',
            autoplayDisableOnInteraction: false,
        });

    });


    //输出booth_news接口
    exports('home', obj);
});