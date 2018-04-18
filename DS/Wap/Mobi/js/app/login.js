/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery', 'home', 'base','shop','user','team','finance'], function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);

    var $ = layui.jquery;
    var home = layui.home, shop = layui.shop, user = layui.user, team = layui.team, finance = layui.finance;
    var base = layui.base;

    base.bindFormAjax($('#login form'), function (d) {
        layui.data('2957297735fbf429', {key: 'token', value: d.token});
        $('#login input[name="password"]').val('');
        $('#login').removeClass('mui-active');
        switch (activeTab){
            case '#Home':
                home.getData();
                break;
            case '#shop':
                shop.shopData();
                break;
            case '#user':
                user.getData();
                break;
            case '#Team':
                team.refresh();
                break;
            case '#finance':
                finance.getData();
                break;
        }
    });
    //输出booth_news接口
    exports('login', {});
});