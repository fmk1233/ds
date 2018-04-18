<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="javascript:;" @click="finished" class="mui-btn mui-btn-link mui-pull-right">完成</a>
    <h1 class="mui-center mui-title">{{title}}</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <form onsubmit="return false;">
                <input type="hidden" value="User.PwdEdit" name="service"/>
                <input type="hidden" :value="action" name="action"/>
                <div class="ui-list-title">原密码</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row mui-password">
                        <label>原密码</label><input type="password" name="old_pass" class="mui-input-password" placeholder="请输入原密码">
                    </li>
                </ul>
                <div class="ui-list-title">{{pass_name}}</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row mui-password">
                        <label>{{new_name}}</label><input type="password" name="password" class="mui-input-password" placeholder="请输入新密码">
                    </li>
                    <li class="mui-input-row mui-password">
                        <label>确认新密码</label><input type="password" name="confirm_password" class="mui-input-password" placeholder="请输入新密码">
                    </li>

                </ul>
            </form>
        </div>

    </div>
</div>