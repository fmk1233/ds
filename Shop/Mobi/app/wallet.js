/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {bonus_name: '', user: {}, bonus: 0, name: 'b'};
    vue = new Vue({
        el: '#wallet',
        data: data,
        methods: {}
    });
    var obj = {
        getData: function () {
            var params = $.router.params;
            if (!$.isEmptyObject(params)) {
                data.bonus = params.bonus;
                data.user = JSON.parse(params.user);
                data.bonus_name = params.bonus_name;
                data.name = params.name;
            }
            $.router.params = {};
        },
        refresh: function () {
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#wallet', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#wallet', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('wallet', {
        changeMoney: function (money) {
            data.user[data.name + data.bonus] = parseFloat(data.user[data.name + data.bonus]) - parseFloat(money);
        }
    });
});