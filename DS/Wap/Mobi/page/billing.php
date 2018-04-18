<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">奖金记录</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">

            <div class="ui-box-row">
                <!--标题-->
                <ul class="ui-hd-row mui-row ui-list-title">
                    <li class="mui-col-sm-12 mui-col-xs-12">奖金币记录</li>
                </ul>
                <!--列表-->
                <ul class="mui-table-view ">
                    <li class="mui-table-view-cell ui-main-row" v-for="bonus in bonus_list">
                        <ul class="ui-bd-row mui-row">
                            <li class="mui-col-sm-6 mui-col-xs-6"><span>{{bonus_types[bonus.bonus_type]}}</span>
                                <p class="ui-time">{{bonus.memo}}</p></li>
                            <li class="mui-col-sm-3 mui-col-xs-3">
                                <span class="ui-text-success" v-if="bonus.is_out==0">+{{bonus.money}}
</span>
                                <span class="ui-text-success" v-else>+0.00
</span>
                            </li>
                            <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-danger" v-if="bonus.is_out==0">-0.00</span>
                                <span class="ui-text-danger" v-else>{{bonus.money}}</span>
                                <p class="ui-time">{{timer(bonus.add_time)}}</p></li>
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