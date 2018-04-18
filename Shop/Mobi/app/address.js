/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base', 'order_number'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, order_number = layui.order_number, page = {total: 1, limit: 10, offset: 0};
    var data = {address_list: [], loading: 0, from: false};
    vue = new Vue({
        el: '#address',
        data: data,
        methods: {
            addressInfo: function (addre) {
                var address = base.getAddress(addre.province, addre.city, addre.area);
                return address.province + ' ' + address.city + ' ' + address.area;
            },
            setDefault: function (index) {
                var address = data.address_list[index];
                base.sendAjax({
                    data: {service: 'Address.SetDefault', addressid: address.id},
                    success: function (d) {
                        if (d.code == 40000) {
                            for (var i = 0, len = data.address_list.length; i < len; i++) {
                                if (data.address_list[i].is_default == 1) {
                                    data.address_list[i].is_default = 0;
                                }
                            }
                            address.is_default = 1;
                            base.successMsg(d);
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            },
            delAddress: function (index) {
                var address = data.address_list[index];
                base.sendAjax({
                    data: {service: 'Address.DelAddress', addressid: address.id},
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d, function () {
                                data.address_list.splice(index, 1);
                            });
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            },
            select: function (index, event) {
                if ($(event.target).is('a') || $(event.target).parent().is('a')) {
                    return;
                }
                if (data.from) {
                    order_number.changeAddress(data.address_list[index]);
                    $.router.back();
                }
            },
            forward: function () {

            }
        }
    });
    $('#address').find('.infinite-scroll').on('infinite', function (e) {
        if (data.loading == 0) {
            page.offset += page.limit;
            obj.getData();
        }
    });
    var obj = {
        getData: function () {
            if (page.offset > page.total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {service: 'Address.AddressList', limit: page.limit, offset: page.offset},
                success: function (d) {
                    if (d.code == 40000) {
                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.address_list.push(d.data.rows[i]);
                        }
                        page.total = d.data.total;
                        if (page.total <= page.offset + page.limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        vue.$nextTick(function () {
                            $.initPage($('#address'));
                        });
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            data.address_list = [];
            page.offset = 0;
            data.from = $.router.params.from?$.router.params.from:'';
            obj.getData();
            $.router.params = {};
        }
    };

    $(document).on("pageReinit", '#address', function () {
        obj.refresh();
    });
    $(document).on("pageInit", '#address', function () {
        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('address', {data:data});
});