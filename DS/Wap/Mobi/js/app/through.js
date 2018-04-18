/**
 * Created by denn on 2017/3/9.
 */
layui.define(['jquery'],function(exports){ //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var html = function () {
        /* <div><div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
            <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
        </button>
        <h1 class="mui-center mui-title">已激活会员</h1>
    </div>
        <div class="mui-page-content">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">

                    <div class="ui-box-row">
                        <!--标题-->
                        <ul class="ui-hd-row mui-row ui-list-title">
                            <li class="mui-col-sm-5 mui-col-xs-5">会员编号</li>
                            <li class="mui-col-sm-4 mui-col-xs-4">推荐人</li>
                            <li class="mui-col-sm-3 mui-col-xs-3">概要</li>
                        </ul>
                        <!--列表-->
                        <ul class="mui-table-view ">
                            <li class="mui-table-view-cell ui-main-row">
                                <a href="#AuditView">
                                    <ul class="mui-row ui-bd-row">
                                        <li class="mui-col-sm-5 mui-col-xs-5"><span>z716577</span>
                                            <p class="ui-time">邓志远</p></li>
                                        <li class="mui-col-sm-4 mui-col-xs-4"><span class="ui-text-danger">z367909</span>
                                            <p class="ui-time">2016-10-22</p></li>
                                        <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-success">银卡</span>
                                            <p class="ui-time">A区</p></li>

                                    </ul>
                                </a>
                            </li>
                            <li class="mui-table-view-cell ui-main-row">
                                <a href="#AuditView">
                                    <ul class="mui-row ui-bd-row">
                                        <li class="mui-col-sm-5 mui-col-xs-5"><span>z716577</span>
                                            <p class="ui-time">邓志远</p></li>
                                        <li class="mui-col-sm-4 mui-col-xs-4"><span class="ui-text-danger">z367909</span>
                                            <p class="ui-time">2016-10-22</p></li>
                                        <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-success">银卡</span>
                                            <p class="ui-time">A区</p></li>

                                    </ul>
                                </a>
                            </li>
                            <li class="mui-table-view-cell ui-main-row">
                                <a href="#AuditView">
                                    <ul class="mui-row ui-bd-row">
                                        <li class="mui-col-sm-5 mui-col-xs-5"><span>z716577</span>
                                            <p class="ui-time">邓志远</p></li>
                                        <li class="mui-col-sm-4 mui-col-xs-4"><span class="ui-text-danger">z367909</span>
                                            <p class="ui-time">2016-10-22</p></li>
                                        <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-success">银卡</span>
                                            <p class="ui-time">A区</p></li>

                                    </ul>
                                </a>
                            </li>
                        </ul>


                    </div>

                </div>
            </div>
        </div></div>*/
    }

    var $ = layui.jquery;
    var data = {news_list:[]},
        name='through',
        html=layui.tmpl(html),
        methods={
        };
    layui.addVueComponent(name,html,data,methods);
    $('body').on('viewDidLoad','#through',function (e) {
        console.log(e.detail);
        /* $.ajax({
             success:function (d) {
                 data = d;
             }
         });*/
    });
    new Vue({
        el: '#through'
    });

    var obj = data;
    //输出booth_news接口
    exports('through', obj);
});