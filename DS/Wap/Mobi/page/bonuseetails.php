<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">奖金明细</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">

            <div class="ui-box-row">
                <!--标题-->
                <ul class="ui-hd-row mui-row ui-list-title">
                    <li class="mui-col-sm-3 mui-col-xs-3">期数</li>
                    <li class="mui-col-sm-3 mui-col-xs-3">总奖金</li>
                    <li class="mui-col-sm-3 mui-col-xs-3">扣除</li>
                    <li class="mui-col-sm-3 mui-col-xs-3">实得奖金</li>
                </ul>
                <!--列表-->
                <ul class="mui-table-view ">
                    <li class="mui-table-view-cell ui-main-row" v-for="reward in reward_list">
                        <a href="#bonusview" :data-info="JSON.stringify(reward)" :data-price="JSON.stringify(rewardPrice)" :data-fee="JSON.stringify(rewardFee)">
                            <ul class="mui-row ui-bd-row">
                                <li class="mui-col-sm-3 mui-col-xs-3"><span>{{reward.periods}}</span></li>
                                <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-success">{{total(reward)}}</span>
                                </li>
                                <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-danger">-{{fee(reward)}}</span>
                                </li>
                                <li class="mui-col-sm-3 mui-col-xs-3"><span class="ui-text-warning">{{reward.money}}</span>
                                </li>


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