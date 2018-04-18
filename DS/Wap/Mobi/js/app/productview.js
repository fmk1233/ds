/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'base', 'shop'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery, base = layui.base, shop = layui.shop,PopPicker=[];
    var data = {d: {goods_pics: '', option_title: []}, num: 1, cart_num: 0}, vue, submit = {
        goodsid: 0,
        optionid: '',
        stock: 0,
        service: 'Order.AddCart'
    };

    vue = new Vue({
        el: '#productview',
        data: data,
        methods: {
            goodsPic: function (goods_pics) {
                if (goods_pics != '')return base.goodsThumb(goods_pics.split(',')[0]);
                return '';
            },
            minus: function () {
                if (data.num <= 1) {
                    return;
                }
                data.num -= 1
            },
            changeNum: function (e) {
                var num = parseInt($(e.target).val());
                if (num <= 0) {
                    data.num = 1;
                } else if (num >= submit.stock) {
                    data.num = submit.stock;
                }
            },
            plus: function () {
                if (data.num >= submit.stock) {
                    return;
                }
                data.num += 1;
            },
            submit: function (type) {
                base.sendAjax({
                    data: {
                        service: submit.service,
                        goodsid: submit.goodsid,
                        num: data.num,
                        optionid: submit.optionid
                    },
                    success: function (d) {
                        if (d.code == 40000) {
                            base.successMsg(d);
                            data.cart_num += parseInt(data.num);
                            shop.changeCartNum(data.cart_num);
                            if(type==1){
                                viewApi.fire('#shoppingcart', {});
                            }
                        } else {
                            base.errorMsg(d);
                        }
                    }
                });
            }
        },
        mounted: function () {
            mui('#productview .mui-scroll-wrapper').scroll({
                bounce: true, //是否启用回弹
                indicators: false, //是否显示滚动条
                deceleration: 0.0003 //阻尼系数,系数越小滑动越灵敏
            });
        }
    });

    $('body').on('viewDidLoad', '#productview', function (e) {
        mui('#productview .mui-scroll-wrapper').scroll().scrollTo(0,0,100);
        if (e.detail.id) {
            obj.getData(e.detail.id);
        } else {
            var d = JSON.parse(e.detail.goods);
            obj.getData(d);
        }

    });
    $('#app').on('pageBeforeBack',function (e) {
        if(e.detail.page.id == 'productview'){
            for(var key in PopPicker){
                $(PopPicker[key].panel).remove();
            }
            PopPicker = [];
        }
    });

    function calculate() {
        var options = [];
        $('.option').each(function () {
            options.push($(this).val());
        });
        var goods_options = data.d.goods_option;
        for (var i = 0, len = goods_options.length; i < len; i++) {
            var option_all = goods_options[i].option_ids.split('_')
            if (option_all.sort().toString() == options.sort().toString()) {
                $('#price').html(goods_options[i].option_price);
                // $('#market_price').html(goods_options[i].option_marketprice);
                $('#stock').html(goods_options[i].option_stock);
                submit.stock = goods_options[i].option_stock;
                submit.optionid = goods_options[i].option_id;
                mui('#productview .mui-numbox').numbox().setOption('max',submit.stock);
                // $('#optionid').val(goods_options[i].option_id);
                break;
            }
        }
    }

    function dataView(d) {
        var cart = layui.data('cart');
        data.cart_num = parseInt(cart.cart_num);
        data.d = d;
        submit.goodsid = d.id;
        submit.stock = d.stock;
        mui('#productview .mui-numbox').numbox().setOption('max',submit.stock);
        vue.$nextTick(function () {
            var box={};
            for (var i = 0, len = d.option_title.length; i < len; i++) {
                var option_title = d.option_title[i];
                //规格选项
                box['option' + i] = new mui.PopPicker();
                PopPicker.push(box['option' + i]);
                var datas = [];
                box['txt' + i] = $('#option' + i + 'txt');
                for (var j = 0, lens = option_title.items.length; j < lens; j++) {
                    var item = option_title.items[j];
                    var data = {}
                    data.value = item['id'];
                    data.text = item['title'];
                    datas.push(data);
                    if (j == 0) {
                        box['txt' + i].html(data.text);
                        box['txt' + i].val(data.value);
                    }
                }
                box['option' + i].setData(datas);
                box['button' + i] = $('#option' + i + 'val');
                box['button' + i].off('tap').on('tap', function () {
                    var index = $(this).data('index');
                    box['option' + index].show(function (items) {
                        box['txt' + index].html(items[0].text);
                        box['txt' + index].val(items[0].value);
                        calculate();
                    });
                });

            }
            calculate();

        });
    }

    var obj = {
        getData: function (d) {
            if (d.id) {
                d.goods_option = JSON.parse(d.goods_option);
                d.option_title = JSON.parse(d.option_title);
                dataView(d);
            } else {
                base.sendAjax({
                    data: {service: 'Goods.GoodsDetail', goodsid: d},
                    success: function (da) {
                        if (da.code == 40000) {
                            dataView(da.data);
                        } else {
                            base.errorMsg(da);
                        }
                    }
                });
            }
        }
    };
    var output = {
        changeCartNum: function (num) {
            data.cart_num = num;
        }
    }
    //输出booth_news接口
    exports('productview', output);
});