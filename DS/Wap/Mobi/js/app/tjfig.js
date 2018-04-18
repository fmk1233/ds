/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'],function(exports){ //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var html = function () {
        /*<div><div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
            <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
        </button>
        <h1 class="mui-center mui-title">推荐图</h1>
    </div>
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <div class="ui-search">
                    <div class="mui-input-row mui-search">
                        <input type="search" class="mui-input-clear" placeholder="请输入会员编号">
                    </div>
                </div>
            </div>
        </div>
    </div></div>*/
    }

    var $ = layui.jquery;
    var data = {news_list:[]},
        name='tjfig',
        html=layui.tmpl(html),
        methods={
        };
    layui.addVueComponent(name,html,data,methods);
    $('body').on('viewDidLoad','#tjfig',function (e) {
        console.log(e.detail);
        /* $.ajax({
             success:function (d) {
                 data = d;
             }
         });*/
    });
    new Vue({
        el: '#tjfig'
    });

    var obj = data;
    //输出booth_news接口
    exports('tjfig', obj);
});