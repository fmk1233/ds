/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, RankTypeBox, TorankBox;
    var data = {up_names: {}, rank_names: {}, user: {}, rank_name: '', rank_type: '', newrank: 1, uptype: 1};
    vue = new Vue({
        el: '#upgrade',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                // console.log($('#upgrade form').serializeObject());
                base.sendFormAjax($('#upgrade form')[0], function () {

                });
            }
        },
        mounted: function () {
            mui('#upgrade .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            //申请方式
            RankTypeBox = new mui.PopPicker();

            var RankTypeButton = document.getElementById('RankType');
            RankTypeButton.addEventListener('tap', function (event) {
                RankTypeBox.show(function (items) {
                    data.rank_type = items[0].text;
                    data.uptype = items[0].value;
                });
            }, false);

            //会员级别
            TorankBox = new mui.PopPicker();
            var TorankButton = document.getElementById('Torank');
            TorankButton.addEventListener('tap', function (event) {
                TorankBox.show(function (items) {
                    data.rank_name = items[0].text;
                    data.newrank = items[0].value;
                });
            }, false);

        }
    });

    $('body').on('viewDidLoad', '#upgrade', function () {
        obj.getData();
    });

    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.Upgrade', action: 'view'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.user = d.data.user;
                        data.up_names = d.data.up_names;
                        data.rank_names = d.data.rank_names;
                        var datas = [];
                        var i = 0;
                        for (var key in data.up_names) {
                            var sex = data.up_names[key];
                            if (i == 0) {
                                data.rank_type = sex;
                                data.uptype = key;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        RankTypeBox.setData(datas);
                        var datas = [];
                        var i = 0;
                        for (var key in data.rank_names) {
                            if (key <= data.user['rank']) {
                                continue;
                            }
                            var sex = data.rank_names[key];
                            if (i == 0) {
                                data.rank_name = sex;
                                data.newrank = key;
                            }
                            var da = {};
                            da.text = sex;
                            da.value = key;
                            datas.push(da);
                            i++;
                        }
                        TorankBox.setData(datas);
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    };

    //输出booth_news接口
    exports('upgrade', {});
});