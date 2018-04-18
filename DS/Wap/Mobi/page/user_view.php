<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="#zledit" :data-info="JSON.stringify(d)" data-from="user_view" class="mui-action-back mui-btn mui-btn-link mui-pull-right">编辑</a>
    <h1 class="mui-center mui-title">查看资料</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="ui-list-title">基本资料</div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back">
                    会员编号<span class="mui-pull-right">{{d.user_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    会员姓名<span class="mui-pull-right">{{d.true_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    会员等级<span class="mui-pull-right">{{d.rank_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    推荐人<span class="mui-pull-right">{{d.tjr_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back" v-if="d.is_pre">
                    接点人<span class="mui-pull-right">{{d.pre_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back" v-if="d.is_pre">
                    市场位置<span class="mui-pull-right">{{d.pos_name}}</span></a>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    省市区<span class="mui-pull-right">{{address(d.province,d.city,d.area)}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    性别<span class="mui-pull-right">{{d.sex_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    注册时间<span class="mui-pull-right">{{timer(d.reg_time ,true)}}</span>
                </li>
            </ul>
            <div class="ui-list-title">银行信息</div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back">
                    开户银行<span class="mui-pull-right">{{d.bank_name}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    银行卡号<span class="mui-pull-right">{{d.bank_no}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    开户姓名<span class="mui-pull-right">{{d.bank_user}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    银行地址<span class="mui-pull-right">{{d.bank_address}}</span>
                </li>
            </ul>
            <div class="ui-list-title">联系方式</div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back">
                    手机号码<span class="mui-pull-right">{{d.mobile}}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
