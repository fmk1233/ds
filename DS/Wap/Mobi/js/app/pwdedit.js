/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var $ = layui.jquery, base = layui.base, vue;
    var data = {pass_name: '', new_name: '', title: '', action: 'pwd'};
    vue = new Vue({
        el: '#pwdedit',
        data: data,
        methods: {
            timer: base.myTime.UnixToDate,
            finished: function () {
                // console.log($('#upgrade form').serializeObject());
                base.sendFormAjax($('#pwdedit form')[0], function () {
                    mui.back();
                });
            }
        },
        mounted: function () {
            mui('#pwdedit .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
            mui('#pwdedit .mui-input-row input').input();
        }
    });


    $('body').on('viewDidLoad', '#pwdedit', function (e) {
        if (e.detail.type == 1) {
            data.pass_name = '登陆密码';
            data.new_name = '新登陆密码';
            data.title = '修改登陆密码';
            data.action = 'pwd';
        } else {
            data.pass_name = '安全密码';
            data.new_name = '新安全密码';
            data.title = '修改安全密码';
            data.action = 'sec_pwd';
        }

    });


    var obj = {};

    //输出booth_news接口
    exports('pwdedit', {});
});