<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">奖金提现</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <!--首页-用户信息-->
            <ul class="mui-table-view ">
                <li class="mui-table-view-cell ui-on-back">
                    您目前的余额为<span class="mui-pull-right ui-text-danger">￥{{d.money}}</span>
                </li>
            </ul>
            <form onsubmit="return false;">
                <input type="hidden" name="bank_name" :value="d.user.bank_name"/>
                <input type="hidden" name="bank_no" :value="d.user.bank_no"/>
                <input type="hidden" name="bank_user" :value="d.user.bank_user"/>
                <input type="hidden" name="bank_address" :value="d.user.bank_address"/>
                <input type="hidden" name="service" value="Bonus.AddCash"/>
                <div class="ui-list-title">提现日期</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>手续费</label>
                        <input type="text" :value="d.params.fee" disabled="disabled" placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>提现金额</label>
                        <input type="number" name="amount" placeholder="请输入提现金额">
                    </li>
                </ul>
                <div class="mui-content-padded">
                    <button type="button" @click="finished" class="mui-btn mui-btn-primary ui-btn-block">申请提现</button>
                    <p class="info">提现金额为100元的整数倍</p>
                </div>

            </form>

        </div>
    </div>
</div>