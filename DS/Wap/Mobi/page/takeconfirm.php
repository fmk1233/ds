<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">奖金提现-确认资料</h1>
</div>
<div class="mui-page-content">
    <div class="ui-foot-content">
        <div class="mui-row">
            <div class="mui-col-xs-6 mui-col-sm-6">
                <a href="#zledit":data-info="JSON.stringify(d)" data-from="takeconfirm" class="mui-btn mui-btn-warning ui-btn-block" v-if="d.bank_no==''">完善资料</a>
                <a href="#zledit":data-info="JSON.stringify(d)" data-from="takeconfirm" class="mui-btn mui-btn-warning ui-btn-block" v-else>修改资料</a>
            </div>
            <div class="mui-col-xs-6 mui-col-sm-6"><a href="#take"  class="mui-btn mui-btn-primary ui-btn-block">确定无误</a></div>
        </div>
    </div>
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <dl class="ui-prompt">
                <dt><i class="icon icon-jinggao"></i></dt>
                <dd>请仔细核对下表所列的账户资料是否存在误填，漏填现象,如有请到资料修改栏中修改并完善</dd>
            </dl>
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
                <li class="mui-table-view-cell ui-on-back">
                    手机号码<span class="mui-pull-right">{{d.mobile}}</span>
                </li>
            </ul>

        </div>
    </div>
</div>