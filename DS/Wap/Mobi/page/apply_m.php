<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">报单中心申请</h1>
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
                            class="ui-grade">{{user.bd_name}}</span></a>
                </li>
            </ul>
            <form onsubmit="return false;">
                <div class="ui-list-title">报单中心申请</div>
                <input type="hidden" :value="newrank" name="newrank"/>
                <input type="hidden" value="post" name="action"/>
                <input type="hidden" value="User.ApplyCenter" name="service"/>
                <ul class="mui-input-group">
                    <li class="mui-input-row" id='TorankCenter'>
                        <label>申请级别</label>
                        <div class="ui-option mui-navigate-right" ><span>{{rank_name}}</span></div>
                    </li>
                </ul>
                <div class="mui-content-padded">
                    <button type="button" @click="finished" class="mui-btn mui-btn-primary ui-btn-block">申请</button>
                </div>

            </form>

        </div>
    </div>
</div>