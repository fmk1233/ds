<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="javascript:;" class="mui-btn mui-btn-link mui-pull-right" @click="finished">发送</a>
    <h1 class="mui-center mui-title">我要留言</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <form onsubmit="return false;">
                <input type="hidden" value="Msg.AddMsg" name="service"/>
                <div class="ui-list-title">我要留言</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>留言主题</label>
                        <input type="text" name="title" placeholder="请输入内容">
                    </li>
                    <li class="mui-txt-row">
                        <textarea  name="content" rows="8" placeholder="请输入内容"></textarea>
                    </li>

                </ul>
            </form>
        </div>
    </div>
</div>