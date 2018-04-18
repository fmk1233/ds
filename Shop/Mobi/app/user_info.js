/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue;
    var data = {d: {}, loading: 0, from: false};
    vue = new Vue({
        el: '#user_info',
        data: data,
        methods: {
            bonus: function (key) {
                return data.d[data.name + key];
            },
            addressInfo: function (addre) {
                var address = base.getAddress(addre.province, addre.city, addre.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            timer: base.myTime.UnixToDate,
            blur: function (key, e) {
                data.d[key] = $(e.target).val();
            },
            finished: function () {
                base.sendFormAjax($('#user_info form')[0], function () {
                    $.router.back();
                });
            },
        }, mounted: function () {
            $("#user_area").cityPicker({
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
    var obj = {
        getData: function () {
            base.sendAjax({
                data: {service: 'User.UserInfo'},
                success: function (d) {
                    if (d.code == 40000) {
                        data.d = d.data;

                        var sexValues = [];
                        var sexDisplayValues = [];
                        for (var key in d.data.sexs) {
                            sexValues.push(key);
                            sexDisplayValues.push(d.data.sexs[key]);
                        }
                        $("#sexs").picker({
                            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">完成</button><h1 class="title">选择性别</h1></header>',
                            cols: [
                                {
                                    textAlign: 'center',
                                    values: sexValues,
                                    displayValues: sexDisplayValues
                                }
                            ], formatValue: function (p, values, displayvalues) {
                                data.d.sex = values;
                                data.d.sex_name = displayvalues;
                                return displayvalues;
                            }
                        });
                        var picker = $('#user_area').data('picker');
                        var address_a = [data.d.province, data.d.city, data.d.area];
                        if (picker.cols.length == 0) {
                            picker.open();
                            picker.close();
                            picker.setValue(address_a);
                        }
                        picker.params.onChange(picker,address_a,['','','']);

                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            obj.getData();
        }
    };

    $(document).on("pageReinit", '#user_info', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#user_info', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('user_info', {});
});