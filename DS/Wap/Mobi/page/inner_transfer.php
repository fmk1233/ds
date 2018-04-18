<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="#to_transfer"  class="mui-btn mui-btn-link mui-pull-right">转换</a>
    <h1 class="mui-center mui-title">钱包互转记录</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">

            <div class="ui-box-row">
                <!--标题-->
                <ul class="ui-hd-row mui-row ui-list-title">
                    <li class="mui-col-sm-3 mui-col-xs-3">类型</li>
                    <li class="mui-col-sm-6 mui-col-xs-6">转换金额</li>
                    <!--<li class="mui-col-sm-2 mui-col-xs-2">手续费</li>-->
<!--                    <li class="mui-col-sm-3 mui-col-xs-3">备注</li>-->

                </ul>
                <!--列表-->
                <ul class="mui-table-view ">
                    <!--已完成-->
                    <li class="mui-table-view-cell ui-main-row" v-for="record in inner_transfer_records">
                        <div class="mui-row"><p class="ui-time">会员编号：{{record.user_name}}</p></div>
                        <ul class="ui-bd-row mui-row">
                            <li class="mui-col-sm-3 mui-col-xs-3">
                                <span>{{record.type}}</span>
                                <p class="ui-time">{{timer(record.add_time)}}</p>
                            </li>

                            <li class="mui-col-sm-6 mui-col-xs-6">
                                <span class="ui-text-success">{{record.money}}</span>
                            </li>

<!--                            <li class="mui-col-sm-3 mui-col-xs-3">-->
<!--                                <span v-if="record.memo=NULL">{{record.memo}}</span>-->
<!--                            </li>-->
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