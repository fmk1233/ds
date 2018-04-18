/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue;
    var data = {d:{service:'User.PwdEdit',action:'pwd',old_pass:'',password:'',confirm_password:''},title:'修改登陆密码'};
    vue = new Vue({
        el: '#pwd_edit',
        data: data,
        methods: {
            finished: function () {
                base.sendAjax({
                    data: data.d,
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d, function () {
                                $.router.back();
                            });
                        } else {
                            base.errorMsg(d);
                        }
                    }
                })
            }, blur: function (key, e) {
                var value = $(e.target).val();
                data.d[key] = value;
            }
        }
    });

    $(document).on("pageReinit", '#pwd_edit', function () {
        obj.getData();
    });
    $(document).on("pageInit", '#pwd_edit', function () {
        obj.getData();
    });
    var obj = {
        getData: function () {
            if($.router.params.action==0){
                data.d.action = 'pwd';
                data.title = '修改登陆密码';
            }else{
                data.d.action = 'sec_pwd';
                data.title = '修改安全密码';
            }
            data.d.old_pass = '';
            data.d.password = '';
            data.d.confirm_password = '';
        }
    };
    obj.getData();

    //输出booth_news接口
    exports('pwd_edit', {});
});