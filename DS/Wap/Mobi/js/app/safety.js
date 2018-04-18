/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'],function(exports){ //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var html = function () {
        /* <div><div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">安全确认</h1>
</div>
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <dl class="ui-prompt">
                    <dt><i class="icon icon-jinggao"></i></dt>
                    <dd>访问此页面需要验证安全密码，<br>本次授权验证仅此一次</dd>
                </dl>
                <form>
                    <ul class="mui-input-group">
                        <li class="mui-input-row mui-password">
                            <label>二级密码</label><input type="password" class="mui-input-password" placeholder="请输入二级密码">
                        </li>
                    </ul>
                    <div class="mui-content-padded">
                        <button type="button" class="mui-btn mui-btn-primary ui-btn-block">确定</button>
                    </div>
                </form>

            </div>
        </div>
    </div></div>*/
    }

  /*  var $ = layui.jquery;
    var data = {news_list:[]},
        name='safety',
        html=layui.tmpl(html),
        methods={
        };
    layui.addVueComponent(name,html,data,methods);
    $('body').on('viewDidLoad','#safety',function (e) {
        console.log(e.detail);
        /!* $.ajax({
             success:function (d) {
                 data = d;
             }
         });*!/
    });
    new Vue({
        el: '#safety'
    });*/

    var obj = {};
    //输出booth_news接口
    exports('safety', obj);
});