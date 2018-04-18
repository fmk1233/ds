<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">奖金明细详情</h1>
</div>
<div class="mui-page-content">
    <div class="ui-foot-content">
        <button type="button" class="mui-btn mui-btn-primary ui-btn-block">实得奖金： ￥{{d.money}}</button>
    </div>
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="ui-list-title">{{d.periods}}期数<span class="mui-pull-right">{{timer(d.add_time,true)}}</span></div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back" v-for="(value ,key) in rewardPrice">
                    {{key}}<span class="mui-pull-right ui-text-success">+{{d[value]}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back" v-for="(value ,key) in rewardFee">
                    {{key}}<span class="mui-pull-right ui-text-success">-{{d[value]}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    {{d.memo}}
                </li>
            </ul>
        </div>
    </div>
</div>