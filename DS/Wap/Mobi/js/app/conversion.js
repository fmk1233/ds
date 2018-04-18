/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'],function(exports){ //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var html = function () {
        /*<div><div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">奖金转换</h1>
</div>
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <!--首页-用户信息-->
                <ul class="mui-table-view ">
                    <li class="mui-table-view-cell ui-on-back">
                        您目前的现金余额为<span class="mui-pull-right ui-text-danger">￥4715.65</span>
                    </li>
                </ul>
                <form>
                    <div class="ui-list-title">奖金转换</div>
                    <ul class="mui-input-group">
                        <li class="mui-input-row" id='Mode'>
                            <label>转换方式</label>
                            <div class="ui-option mui-navigate-right" id='ModeTxt'><span>请输入内容</span></div>
                        </li>
                        <li class="mui-input-row">
                            <label>转出金额</label>
                            <input type="text" placeholder="请输入内容">
                        </li>

                    </ul>
                    <div class="mui-content-padded">
                        <button type="button" class="mui-btn mui-btn-primary ui-btn-block">确认转换</button>
                    </div>

                </form>

            </div>
        </div>
    </div></div>*/
    }

    /*var $ = layui.jquery;
    var data = {news_list:[]},
        name='conversion',
        html=layui.tmpl(html),
        methods={
        };
    layui.addVueComponent(name,html,data,methods);
    $('body').on('viewDidLoad','#conversion',function (e) {
        console.log(e.detail);
        /!* $.ajax({
             success:function (d) {
                 data = d;
             }
         });*!/
    });
    new Vue({
        el: '#conversion'
    });*/

    var obj = {};
    //输出booth_news接口
    exports('conversion', obj);
});