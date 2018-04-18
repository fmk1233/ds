/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base', 'address', 'order_number'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var base = layui.base, vue, address = layui.address, order_number = layui.order_number;
    var data = {d: {}, from: false};

    vue = new Vue({
        el: '#add_address',
        data: data,
        methods: {
            addressInfo: function (d) {
                var address = base.getAddress(d.province, d.city, d.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            finished: function () {
                base.sendFormAjax($('#add_address form')[0], function () {
                    if (data.from == 'order') {
                        order_number.changeAddress(data.d);
                        $.router.back();
                        $.router.back();
                    } else {
                        $.router.back();
                    }

                });
            }, blur: function (key, e) {
                data.d[key] = $(e.target).val();
            }
        },mounted:function () {
            $("#city-picker").cityPicker({
                toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">完成</button> <h1 class="title">选择地址</h1></header>',
                formatValue: function (p, values, displayvalues) {
                    data.d.province = values[0];
                    data.d.city = values[1];
                    data.d.area = values[2];
                    return displayvalues.join(' ');
                }
            });
        }
    });

    $(document).on("pageReinit", '#add_address', function () {
        obj.getData();
    });
    $(document).on("pageInit", '#add_address', function () {
        obj.getData();
    });

    var obj = {
        getData: function () {
            data.d = JSON.parse($.router.params.info);
            data.from = $.router.params.from;
            $.router.params.from = false;
            $.router.params.info = {};
            var picker = $('#city-picker').data('picker');
            var address_a = [data.d.province, data.d.city, data.d.area];
            if (picker.cols.length == 0) {
                picker.open();
                picker.close();
                picker.setValue(address_a);
            }
            picker.params.onChange(picker,address_a,['','','']);
        }
    };
    // obj.getData();

    //输出booth_news接口
    exports('add_address', {});
});