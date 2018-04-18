<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="#upgradelist" class="mui-action-back mui-btn mui-btn-link mui-pull-right">记录</a>
    <h1 class="mui-center mui-title">会员升级</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <!--首页-用户信息-->
            <ul class="mui-table-view mui-table-view-chevron ui-home-info">
                <li class="mui-table-view-cell">
                    <a href="#user_view" class="mui-navigate-right">
                        <img src="<?php echo URL_ROOT.'../DS/Wap/Mobi/'; ?>images/object.png" class="ui-object"/>
                        <span class="ui-text">{{user.true_name}}</span><span class="mui-ellipsis ui-ellipsis">{{user.user_name}}</span><span
                            class="ui-grade">{{user.rank_name}}</span></a>
                </li>
            </ul>
            <form onsubmit="return false;">
                <div class="ui-list-title">会员升级</div>
                <input type="hidden" :value="newrank" name="newrank"/>
                <input type="hidden" :value="uptype" name="uptype"/>
                <input type="hidden" value="post" name="action"/>
                <input type="hidden" value="User.Upgrade" name="service"/>
                <ul class="mui-input-group">
                    <li class="mui-input-row" id='Torank'>
                        <label>申请级别</label>
                        <div class="ui-option mui-navigate-right" id='TorankTxt'><span>{{rank_name}}</span></div>
                    </li>
                    <li class="mui-input-row" id='RankType'>
                        <label>申请方式</label>
                        <div class="ui-option mui-navigate-right" id='RankTypeTxt'><span>{{rank_type}}</span></div>
                    </li>
                </ul>
                <div class="mui-content-padded">
                    <button type="button" @click="finished" class="mui-btn mui-btn-primary ui-btn-block">申请升级</button>
                </div>

            </form>

        </div>
    </div>
</div>