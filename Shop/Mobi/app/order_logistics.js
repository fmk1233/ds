/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue, order_info = 0;
    var data = {logistics: {}, com: '', code: '', sn: ''};
    vue = new Vue({
        el: '#order_logistics',
        data: data,
        methods: {
        },
        updated:function () {
            $('.lgst-cnt-msg-dtl .lbox').height($('.lgst-cnt-msg-dtl .rbox').height());
        }
    });

    $(document).on("pageReinit", '#order_logistics', function () {
        obj.getData();
    });
    $(document).on("pageInit", '#order_logistics', function () {
        obj.getData();
    });
    var obj = {
        getData: function () {

            order_info = JSON.parse($.router.params.order_info);
            data.com = order_info.delivery_name;
            $.router.params = {};
            base.sendAjax({
                data: {
                    service: "Order.Logistics",
                    com: order_info.delivery_name,
                    sn: order_info.delivery_sn,
                    code: order_info.delivery_code
                },
                success: function (d) {
                    if (d.code == 40000) {
                        data.logistics = d.data;
                    } else {
                        base.errorMsg(d);
                    }
                }
            });
        }
    };

    //输出booth_news接口
    exports('order_logistics', {});
});