<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">会员转账</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <!--首页-用户信息-->
            <ul class="mui-table-view ">
                <li class="mui-table-view-cell ui-on-back">
                    您目前的{{bonus_name}}为<span class="mui-pull-right ui-text-danger">￥{{bonus}}</span>
                </li>
            </ul>
            <form onsubmit="return false;">
                <input type="hidden" name="zztype" :value="type"/>
                <input type="hidden" name="service" value="Transfer.AddTransfer"/>
                <div class="ui-list-title">会员转账 {{real_name}}</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row" id='TType'>
                        <label>转账类型</label>
                        <div class="ui-option mui-navigate-right" id='TTypeTxt'><span>{{bonus_name}}</span></div>
                    </li>
                    <li class="mui-input-row">
                        <label>转入编号</label>
                        <input type="text" name="tousername" @blur="checkUserName" placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>转出金额</label>
                        <input type="number" name="amount" placeholder="请输入内容">
                    </li>
                </ul>
                <div class="mui-content-padded">
                    <button type="button" @click="finished" class="mui-btn mui-btn-primary ui-btn-block">确定</button>
                </div>

            </form>

        </div>
    </div>
</div>