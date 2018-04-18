/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, vue, ranks_load = false, user_name = '', type = 1;
    var data = {
        d: {rank_names: {}, rank_colors: {}},
        title: '安置图',
        memo: '图例注释：所在层数[*] 会员编号[****] 会员级别[****]位置[***] 开通状态'
    };
    vue = new Vue({
        el: '#azfig',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            search: function () {
                user_name = $('#search').val();
                obj.getData();
            }
        },
        mounted: function () {
            mui('#azfig .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            $('#azfig .team-li').on('click', 'a[search]', function () {
                user_name = $(this).data('username');
                obj.getData();
            });
        }
    });

    $('body').on('viewDidLoad', '#azfig', function (e) {
        user_name = '';
        type = e.detail.type;
        if (type == 1) {
            data.title = '安置图';
            data.memo = '图例注释：所在层数[*] 会员编号[****] 会员级别[****]位置[***] 开通状态';
        } else {
            data.title = '推荐图';
            data.memo = '图例注释：所在代数[*] 会员编号[****] 会员级别[****] 开通状态';
        }
        obj.getData();
    });


    var obj = {
        getData: function () {
            $('#azfig .mui-scroll').attr('style', '');
            if (!ranks_load) {
                base.sendAjax({
                    data: {service: 'Net.GetRankColor'},
                    success: function (d) {
                        if (d.code == 40000) {
                            data.d = d.data;
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            }
            base.sendAjax({
                data: {service: 'Net.net', username: user_name, type: type},
                dataType: 'html',
                success: function (d) {
                    $('#azfig .team-li').html(d);
                }
            });
        }
    };
    //输出booth_news接口
    exports('azfig', {});
});