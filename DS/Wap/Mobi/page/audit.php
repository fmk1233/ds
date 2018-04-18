<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title" v-if="state==0">待审会员</h1>
    <h1 class="mui-center mui-title" v-else>已审会员</h1>
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
                    <li class="mui-table-view-cell ui-main-row" v-for="user in user_list">
                        <a  :href="[user.state==0?'#auditview':'javascript:void(-1);']" :data-info="JSON.stringify(user)">
                            <ul class="mui-row ui-bd-row">
                                <li class="mui-col-sm-5 mui-col-xs-5"><span>{{user.user_name}}</span>
                                    <p class="ui-time">{{user.true_name}}</p></li>
                                <li class="mui-col-sm-4 mui-col-xs-4"><span class="ui-text-danger">{{user.t_user_name}}</span>
                                    <p class="ui-time">{{timer(user.reg_time)}}</p></li>
                                <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-success">{{user.rank_name}}</span>
                                    <p class="ui-time">{{user.pos_name}}</p></li>
                            </ul>
                        </a>
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