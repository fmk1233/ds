<div class="mui-scroll-wrapper" style="padding-bottom: 30px;">
    <div class="mui-scroll">
        <!--财务概要-->
        <ul class="mui-row ui-team-info">
            <li class="mui-col-xs-4 mui-col-sm-4" v-for="(bonus_name ,key) in d.bonus_names">
                <div class="mui-table-view-cell">
                    <a href="#billing" :data-type="key"><i class="icon icon-yue"></i>
                        <div class="mui-media-body">
                            {{bonus_name}}<p class="ui-ellipsis">{{d.user[d.name+key]}}</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <div class="ui-list-title">基本管理</div>
        <ul class="mui-row mui-table-view mui-grid-view mui-grid-9">
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#bonuseetails">
                <span class="icon icon-mingxi ui-text-danger "></span>
                <div class="mui-media-body">奖金明细</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#moneyout">
                                <span class="icon icon-zhuanzhang ui-text-danger"></span>
                <div class="mui-media-body">会员转账</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#moneyinto">
                <span class="icon icon-daikuan ui-text-success"></span>
                <div class="mui-media-body">充值申请</div>
            </a></li>
           <!-- <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#conversion">
                <span class="icon icon-zhuanhuan ui-text-warning"></span>
                <div class="mui-media-body">奖金转换</div>
            </a></li>-->
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#takeconfirm">
                <span class="icon icon-tixian1 ui-text-primary"></span>
                <div class="mui-media-body">奖金提现</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#inner_transfer">
                    <span class="icon icon-tixian1 ui-text-primary"></span>
                    <div class="mui-media-body">钱包互转</div>
                </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3" v-for="(bonus_name ,key) in d.bonus_names"><a href="#billing" :data-type="key">
                <span class="icon icon-tixian ui-text-primary"></span>
                <div class="mui-media-body">{{bonus_name}}</div>
            </a></li>
        </ul>


    </div>
</div>