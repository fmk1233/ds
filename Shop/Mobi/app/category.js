layui.define(['base'], function (exports) {

    var base = layui.base, vue;
    var data = {category_list: [], cart_num: 0,category_id:0, category_name: '', juniors: []};
    var obj = {
        getCategorys: function () {
            $.router.stack.back = "[]";
            base.sendAjax({
                data: {service: 'Goods.GetGoodsCategoryByPid', pid: 0},
                success: function (d) {
                    if (d.code == 40000) {
                        data.category_list = d.data;
                        if (data.category_list.length > 0) {
                            setTimeout(function () {
                                category_detail(0);
                            }, 10)
                        }
                        data.cart_num = base.cart_num();
                    }else{
                        base.errorMsg(d);
                    }
                }
            });
        },
    };

    function category_detail(index) {
        var category = data.category_list[index];
        vue.$nextTick(function () {
            $('#sidebar').find('li').removeClass('active');
            $('#sidebar li[data-id="' + category.id + '"]').addClass('active');
        });
        base.sendAjax({
            data: {service: 'Goods.GetGoodsCategoryByPid', pid: category.id},
            success: function (d) {
                if (d.code == 40000) {
                    data.category_name = category.category_name;
                    data.category_id = category.id;
                    data.juniors = d.data;
                }
            }
        });
    }

    vue = new Vue({
        el: '#category',
        data: data,
        methods: {
            category_detail: category_detail,
            goodsPic: function (path) {
                if(path==''){
                    return;
                }
                return base.goodsThumb(path);
            },
        }
    });


    $(document).on("pageReinit", '#category', function () {
        obj.getCategorys();
    });
    $(document).on("pageInit", '#category', function () {
        obj.getCategorys();
    });
    // obj.getCategorys();


    exports('category', {});
});
