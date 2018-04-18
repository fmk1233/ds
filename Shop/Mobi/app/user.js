/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {d: {},bonus_names:{},name:'b',order:{}, loading: 0,cart_num:0,from:false};
    vue = new Vue({
        el: '#user',
        data: data,
        methods: {
            bonus:function (key) {
                return data.d[data.name+key];
            },
            logout: function () {
                base.confirm('是否要退出？', function (e) {
                   base.logout();
                });
            }
        }
    });
    var obj = {
        getData: function () {
            base.sendAjax({
                data:{service:'Shop.User'},
                success:function (d) {
                    if(d.code==40000){
                        data.d = d.data.user;
                        data.bonus_names = d.data.bonus_names;
                        data.name = d.data.name;
                        data.order = d.data.order;
                        data.cart_num = base.cart_num();
                    }else{
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh:function () {
            $.router.stack.back = "[]";
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#user', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#user', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('user', {});
});