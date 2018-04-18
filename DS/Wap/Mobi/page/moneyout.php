<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="#transfer"  class="mui-action-back mui-btn mui-btn-link mui-pull-right">我要转账</a>
    <h1 class="mui-center mui-title">奖金转出</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">

            <div class="ui-box-row">
                <!--标题-->
                <ul class="ui-hd-row mui-row ui-list-title">
                    <li class="mui-col-sm-3 mui-col-xs-3">货币类型</li>
                    <li class="mui-col-sm-6 mui-col-xs-6">目标会员</li>
                    <!--<li class="mui-col-sm-2 mui-col-xs-2">手续费</li>-->
                    <li class="mui-col-sm-3 mui-col-xs-3">状态</li>

                </ul>
                <!--列表-->
                <ul class="mui-table-view ">
                    <!--未处理-->
                    <li class="mui-table-view-cell ui-main-row" v-for="transfer in transfer_list">
                        <ul class="ui-bd-row mui-row">
                            <li class="mui-col-sm-3 mui-col-xs-3"><span>{{bonus_name(transfer.money_type)}}</span>
                                <p class="ui-time">{{timer(transfer.add_time)}}</p></li>
                            <li class="mui-col-sm-6 mui-col-xs-6"><span class="ui-text-danger">{{transfer.money}}</span>
                                <p class="ui-time">{{transfer.t_user_name + '('+transfer.t_true_name+')'}}</p></li>
                            <!--<li class="mui-col-sm-2 mui-col-xs-2">-10</li>-->
                            <li class="mui-col-sm-3 mui-col-xs-3">
                                <span class="mui-btn mui-btn-primary mui-btn-outlined"><i class="icon icon-jinggao"></i>已完成</span>
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