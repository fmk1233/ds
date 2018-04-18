/**
 * Created by denn on 2017/3/9.
 */
layui.define(['base'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var base = layui.base, vue, page = [], isLoading = [false, false, false, false, false], state = 0, tabsSwiper;
    var data = {order_list: [[], [], [], [], []], loading: 0, from: false};

    var obj = {
        getData: function (state) {
            if (page[state].offset > page[state].total) {
                data.loading = 2;
                return;
            }
            data.loading = 1;
            base.sendAjax({
                data: {
                    service: 'Order.GetOrderList',
                    limit: page[state].limit,
                    offset: page[state].offset,
                    state: state
                },
                success: function (d) {
                    if (d.code == 40000) {

                        for (var i = 0, len = d.data.rows.length; i < len; i++) {
                            data.order_list[state].push(d.data.rows[i]);
                        }
                        page[state].total = d.data.total;
                        if (page[state].total <= page[state].offset + page[state].limit) {
                            data.loading = 2;
                        } else {
                            data.loading = 0;
                        }
                        isLoading[state] = true;
                    } else {
                        base.errorMsg(d);
                    }
                }
            })
        },
        refresh: function () {
            if ($.router.params.state) {
                var new_state = parseInt($.router.params.state)
                if (state == new_state) {
                    return;
                }
                state = new_state;
            }
            if ($.router.params.from) {
                data.from = $.router.params.from;
            }
            if ($.router.params.back) {
                return;
            }

            $.router.params = {};
            data.order_list = [[], [], [], [], []];
            page = [{total: 1, limit: 10, offset: 0}, {total: 1, limit: 10, offset: 0}, {
                total: 1,
                limit: 10,
                offset: 0
            }, {total: 1, limit: 10, offset: 0}, {total: 1, limit: 10, offset: 0}];
            isLoading = [false, false, false, false, false];
            tabsSwiper.slideTo(state);
        }
    };

    vue = new Vue({
        el: '#order',
        data: data,
        methods: {
            goodsPic: function (goods_pics) {
                return base.goodsThumb(goods_pics.split(',')[0]);
            },
            back: function () {
                if (data.from == 'order') {
                    data.from = false;
                    $.router.back();
                    $.router.back();
                } else {
                    $.router.back();
                }
            }
        },
        mounted: function () {
            $.initPage($('#order'));
            $("#order .buttons-tab a").on('touchstart mousedown', function (e) {
                e.preventDefault()
                $("#order .buttons-tab a .active").removeClass('active')
                $(this).addClass('active');
                tabsSwiper.slideTo($(this).index());
            });
            $("#order .buttons-tab a").click(function (e) {
                e.preventDefault();
            });
            $('#order .infinite-scroll').on('infinite', function (e) {
                var state = tabsSwiper.activeIndex ? tabsSwiper.activeIndex : 0;
                if (data.loading == 0) {
                    page[state].offset += page[state].limit;
                    obj.getData(state);
                }
            });
            tabsSwiper = new Swiper('#order .swiper-container', {
                speed: 500,
                autoHeight: true,
                observeParents: true,
                observer: true,
                onSlideChangeStart: function () {
                    $("#order .content").scrollTop(0);
                    $("#order .buttons-tab .active").removeClass('active');
                    $("#order .buttons-tab a").eq(tabsSwiper.activeIndex).addClass('active');
                    state = tabsSwiper.activeIndex;
                    if (!isLoading[tabsSwiper.activeIndex]) {
                        obj.getData(tabsSwiper.activeIndex);
                    }
                }
            });

        },
        updated: function () {
            tabsSwiper.updateAutoHeight();
        }
    });

    $(document).on("pageReinit", '#order', function () {

        obj.refresh();
    });
    $(document).on("pageInit", '#order', function () {

        obj.refresh();
    });
    // obj.refresh();

    //输出address接口
    exports('order', {});
});