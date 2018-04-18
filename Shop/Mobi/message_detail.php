<!-- 消息详情 -->
<div class="page" id='message_detail' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>消息详情</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content">
        <!--详情-->
        <div class="user-account-detail  m-top10">
            <ul>
                <li style="margin-bottom: 0">
                    <div class="dis-box new-msg-title">
                        <a href="javascript:void(0)" class="box-flex">
                            <h4 class="message-detail-h4 col-3">{{ news.news_title }}</h4>
                            <span>{{ timer(news.add_time,true) }}</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="bg-white padding-all essay-content" v-html="news.content">
        </div>

    </div>

</div>