/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'audit', 'team'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);


    var $ = layui.jquery, base = layui.base, audit = layui.audit, team = layui.team, vue;
    var data = {user: {}};
    vue = new Vue({
        el: '#auditview',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            address: function (province, city, area) {
                var address = getAddress(province, city, area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            change: function (type) {
                var $msg, $service;
                switch (type) {
                    case 0:
                        $service = 'User.DelMember';
                        $msg = '您确认要删除该会员';
                        break;
                    case 1:
                        $service = 'User.ActivateMember';
                        $msg = '您确认要激活该会员';
                        break;
                    default:
                        return;
                }
                mui.confirm($msg, '提示信息', '', function (i) {
                    if (i.index == 1) {
                        base.sendAjax({
                            data: {service: $service, userid: data.user.id},
                            success: function (d) {
                                if (d.code == 40000) {
                                    base.successMsg(d, function () {
                                        audit.refresh();
                                        team.changeNum();
                                        mui.back();
                                    });
                                } else {
                                    base.errorMsg(d);
                                }
                            }
                        });
                    }
                });
            }
        },
        mounted: function () {
            mui('#auditview .mui-scroll-wrapper').scroll({
                // bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            var gal = mui('#sliderAuditBox');
            gal.slider();

        }
    });

    $('body').on('viewDidLoad', '#auditview', function (e) {
        obj.getData(e.detail.info);
    });


    var obj = {
        getData: function (d) {
            data.user = JSON.parse(d);
        }
    };
    //输出booth_news接口
    exports('auditview', {});
});