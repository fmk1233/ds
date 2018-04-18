
<!-- 消息中心 -->
<div class="page" v-cloak="" id='message'>

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>消息中心</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content infinite-scroll" data-distance="100">
        <!--列表-->
        <div class="user-account-detail m-top10">
            <!--空列表-->
            <section class="padding-all" v-if="news_list.length==0">
                <div class="flow-no-pro"><i class="iconfont icon-service"></i>
                    <p class="text-center">亲，此处没有内容～！</p>
                </div>
            </section>
            <!--End空列表-->
            <ul v-else>
                <li v-for="news in news_list">
                    <div class="dis-box new-msg-title" >
                            <a href="#message_detail" :data-news="JSON.stringify(news)" class="box-flex">
                            <h4>{{ news.news_title }}</h4>
                            <span>{{ timer(news.add_time,true) }}</span>
                            </a>
                    </div>
                </li>
            </ul>
            <a href="javascript:;" class="get-more" v-if="loading==1">
                <div class="preloader"></div>正在努力加载中！
            </a>
        </div>




    </div>

</div>