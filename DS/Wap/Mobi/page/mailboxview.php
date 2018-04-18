<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">详情</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="ui-news-view">
                <h3>{{d.msg_title}}</h3>
                <div class="ui-news-info">
                    <span>发布时间：{{timer(d.add_time,true)}}</span>
                </div>
                <div class="ui-news-content">
                    <p v-html="d.content"></p>
                </div>
                <div class="ui-news-info"><span>回复</span></div>
                <div class="ui-news-content">
                    <p v-html="d.reply"></p>
                </div>

            </div>

        </div>
    </div>
</div>