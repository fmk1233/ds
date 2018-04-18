/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'manager'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue, manager = layui.manager, TorankBox;
    var data = {rank_names: {}, user: {}, rank_name: '', rank_type: '', newrank: 1};
    vue = new Vue({
        el: '#apply_m',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                // console.log($('#upgrade form').serializeObject());
                base.sendFormAjax($('#apply_m form')[0], function () {
                    manager.refresh();
                    mui.back();
                });
            }
        },
        mounted: function () {
            mui('#apply_m .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            //会员级别
            TorankBox = new mui.PopPicker();
            var TorankButton = document.getElementById('TorankCenter');
            TorankButton.addEventListener('tap', function (event) {
                TorankBox.show(function (items) {
                    data.rank_name = items[0].text;
                    data.newrank = items[0].value;
                });
            }, false);
        }
    });


    $('body').on('viewDidLoad', '#apply_m', function () {
        obj.getData();
    });


    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.ApplyCenter', action: 'view'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.user = d.data.user;
                        data.rank_names = d.data.rank_names;
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
    exports('apply_m', {});
});