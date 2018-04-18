/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, vue, page = {total: 1, offset: 0, limit: 10};
    var data = {reward_list: [], rewardPrice: {}, rewardFee: {}, loading: 0}
    vue = new Vue({
        el: '#bonuseetails',
        data: data,
        methods: {
            total: function (reward) {
                var total = 0;
                for (var key in data.rewardPrice) {
                    total += parseFloat(reward[data.rewardPrice[key]]);

                }
                return total.toFixed(2);
            },
            fee: function (reward) {
                var fee = 0;
                for (var key in data.rewardFee) {
                    fee += parseFloat(reward[data.rewardFee[key]]);
                }
                return fee.toFixed(2);
            },
            loadMore: function () {
                page.offset += page.limit;
                obj.getData();
            }
        },
        mounted: function () {
            mui('#bonuseetails .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#bonuseetails', function (e) {
        $('#bonuseetails .mui-scroll').attr('style', '');
        data.reward_list = [];
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
                data: {service: 'Reward.GetRewardList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.reward_list.push(d.data.rows[i]);
                        }
                        data.rewardPrice = d.data.rewardPrice;
                        data.rewardFee = d.data.rewardFee;
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
    exports('bonuseetails', {});
});