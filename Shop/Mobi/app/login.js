/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {d: {}, remember: 0};
    vue = new Vue({
        el: '#login',
        data: data,
        methods: {
            login: function () {
                base.sendFormAjax($('#login form')[0], function (d) {
                    layui.data('2957297735fbf429', {key: 'token', value: d.token});
                    var device = layui.device('weixin');
                    if (device.weixin && d.openid == false) {//TODO 不需要微信的注释掉
                        location.href = baseUrl + '../mobile.php' + base.url({
                                service: 'Default.GetOpenid',
                                id: d.user_id
                            });
                        return;
                    }
                    $.router.back();
                });
            }
        }
    });
    // 注册登录页面密码样式开关
    $('#login .login-switch').on('click', function () {
        if ($(this).hasClass('btn-on')) {
            $(this).removeClass('btn-on');
            $(this).prev().children().attr('type', 'password');
        } else {
            $(this).addClass('btn-on');
            $(this).prev().children().attr('type', 'text');
        }
    });
    var obj = {
        getData: function () {
        },
        refresh: function () {
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#login', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#login', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('login', {});
});