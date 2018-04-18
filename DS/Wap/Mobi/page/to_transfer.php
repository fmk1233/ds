<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">钱包互转</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <!--首页-用户信息-->
            <form onsubmit="return false;">
                <input type="hidden" name="service" value="Bonus.DoTransfer"/>
                <input type="hidden" name="money_type" :value="money_type"/>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>转换的金额</label>
                        <input type="number" name="amount" placeholder="请输入转换金额">
                    </li>
                    <li class="mui-input-row" id="money_type">
                        <label>类型</label>
                        <div class="ui-option mui-navigate-right"><span>{{bonus_name}}</span></div>
                    </li>
<!--                    <li class="mui-input-row" style="height: auto">-->
<!--                        <textarea id="textarea" name="content" rows="4" placeholder="备注"></textarea>-->
<!--                    </li>-->
                </ul>
                <div class="mui-content-padded">
                    <button type="button" @click="finished" class="mui-btn mui-btn-primary ui-btn-block">确认</button>
                    <p class="info">转换金额为100元的整数倍</p>
                </div>

            </form>

        </div>
    </div>
</div>