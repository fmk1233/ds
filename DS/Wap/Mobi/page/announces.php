<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">新闻公告</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <ul class="mui-table-view mui-table-view-striped mui-table-view-condensed  mui-table-view-chevron">
                <li class="mui-table-view-cell ui-news-lis" v-for="(news ,index) in news_list">
                    <a href="#announceview" :data-news="JSON.stringify(news)">
                        <div class="mui-table">
                            <div class="mui-table-cell">
                                <h3>{{news.news_title}}</h3>
                                <span>{{timer(news.add_time,true)}}</span>
                            </div>

                        </div>
                    </a>
                </li>
            </ul>
            <div class="mui-pull-bottom-pocket mui-block mui-visibility">
                <div class="mui-pull" style="font-weight:normal;" v-if="loading==1">
                    <div class="mui-pull-loading mui-icon mui-spinner mui-visibility"></div>
                    <div class="mui-pull-caption mui-pull-caption-refresh">正在加载...</div>
                </div>
                <div class="mui-pull" style="font-weight:normal;" v-else-if="loading==0" @tap="loadMore">
                    <div class="mui-pull-caption mui-pull-caption-refresh">点击加载更多</div>
                </div>
                <div class="mui-pull" style="font-weight:normal;" v-else-if="loading==2">
                    <div class="mui-pull-caption mui-pull-caption-refresh">已经到底了</div>
                </div>
            </div>
        </div>
    </div>
</div>