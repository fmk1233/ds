<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">会员升级记录</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">

            <div class="ui-box-row">
                <!--标题-->
                <ul class="ui-hd-row mui-row ui-list-title">
                    <li class="mui-col-sm-5 mui-col-xs-5">升级类型</li>
                    <li class="mui-col-sm-4 mui-col-xs-4">申请级别</li>
                    <li class="mui-col-sm-3 mui-col-xs-3">状态</li>
                </ul>
                <!--列表-->
                <ul class="mui-table-view ">
                    <!--未处理-->
                    <li class="mui-table-view-cell ui-main-row" v-for="upgrade in upgrade_list">
                        <ul class="ui-bd-row mui-row">
                            <li class="mui-col-sm-5 mui-col-xs-5"><span>{{upgrade.up_type}}</span>
                                <p class="ui-time">{{timer(upgrade.add_time,true)}}</p></li>
                            <li class="mui-col-sm-4 mui-col-xs-4"><span class="ui-text-success">{{upgrade.old_rank}}<i
                                    class="icon icon-jiantou"></i></span><span class="ui-text-danger">{{upgrade.new_rank}}</span></li>
                            <li class="mui-col-sm-3 mui-col-xs-3">
                                <span class="mui-btn mui-btn-warning mui-btn-outlined" v-if="upgrade.status==0"><i class="icon icon-jinggao"></i>{{upgrade.status_name}}</span>
                                <span class="mui-btn mui-btn-primary mui-btn-outlined" v-else-if="upgrade.status==1"><i class="icon icon-jinggao"></i>{{upgrade.status_name}}</span>
                                <span class="mui-btn ui-btn mui-btn-outlined" v-else><i class="icon icon-jinggao"></i>{{upgrade.status_name}}</span>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="mui-pull-bottom-pocket mui-block mui-visibility">
                    <div class="mui-pull" style="font-weight:normal;" v-if="loading==1">
                        <div class="mui-pull-loading mui-icon mui-spinner mui-visibility"></div>
                        <div class="mui-pull-caption mui-pull-caption-refresh">正在加载...</div>
                    </div>
                    <div class="mui-pull" style="font-weight:normal;" v-else-if="loading==0" @tap="loadMore">
                        <div class="mui-pull-caption mui-pull-caption-refresh">点击加载更多</div>
                    </div>
                    <div class="mui-pull" style="font-weight:normal;" v-else-if="loading==2">
                        <div class="mui-pull-caption mui-pull-caption-refresh">已经到底了</div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>