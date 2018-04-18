<div class="mui-scroll-wrapper" style="padding-bottom: 30px;">
    <div class="mui-scroll">
        <!--首页-banner-->
        <div id="banner-slider" class="mui-slider">
            <div class="mui-slider-group mui-slider-loop">
                <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
                <div class="mui-slider-item mui-slider-item-duplicate" v-if="d.advs.length>0">
                    <a href="javascript:;">
                        <img :src="goodsPath(d.advs[d.advs.length-1]['icon'])">
                    </a>
                </div>
                <!-- 第一张 -->
                <div class="mui-slider-item"  v-for="(adv, index) in d.advs">
                    <a href="javascript:;">
                        <img :src="goodsPath(adv['icon'])">
                    </a>
                </div>
                <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
                <div class="mui-slider-item mui-slider-item-duplicate" v-if="d.advs.length>0">
                    <a href="javascript:;">
                        <img :src="goodsPath(d.advs[0]['icon'])">
                    </a>
                </div>
            </div>
            <div class="mui-slider-indicator">
                <div class="mui-indicator " v-for="(adv, index) in d.advs" :class="{'mui-active':index==0}">
                </div>
            </div>
        </div>
        <!--首页-用户信息-->
        <ul class="mui-table-view mui-table-view-chevron ui-home-info">
            <li class="mui-table-view-cell">
                <a href="#user_view" class="mui-navigate-right"><img src="<?php echo URL_ROOT.'../DS/Wap/Mobi/'; ?>images/object.png"
                                                                     class="ui-object"/><span
                        class="ui-text">{{ d.user.user_name }}</span><span
                        class="mui-ellipsis ui-ellipsis">{{d.user.true_name}}</span><span
                        class="ui-grade">{{d.user.rank_name}}</span></a>
            </li>
        </ul>
        <!--首页-收入概要-->
        <ul class="mui-row ui-home-summary">
            <li class="mui-col-xs-6 mui-col-sm-6">
                <div class="mui-table-view-cell">
                    <a href="#bonuseetails"><i class="icon icon-shouru"></i>
                        <div class="mui-media-body">
                            总收入<p class="ui-ellipsis">{{d.reward_total}}</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="mui-col-xs-6 mui-col-sm-6">
                <div class="mui-table-view-cell">
                    <a href="#takeconfirm"><i class="icon icon-tixian"></i>
                        <div class="mui-media-body">
                            已提现<p class="ui-ellipsis">{{d.cash_money}}</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="mui-col-xs-6 mui-col-sm-6">
                <div class="mui-table-view-cell">
                    <a href="#azfig" data-type="2"><i class="icon icon-jiangbei"></i>
                        <div class="mui-media-body">
                            直推<p class="ui-ellipsis">{{d.tj_num}}人</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="mui-col-xs-6 mui-col-sm-6">
                <div class="mui-table-view-cell">
                    <a href="#azfig" data-type="2"><i class="icon icon-tuandui"></i>
                        <div class="mui-media-body">
                            团队<p class="ui-ellipsis">{{d.total_num}}人</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <!--首页-公告新闻-->
        <ul class="mui-table-view mui-table-view-chevron ui-home-news">
            <li class="mui-table-view-cell">
                <a href="#announces" >
                    <img src="<?php echo URL_ROOT.'../DS/Wap/Mobi/'; ?>images/news.png" class="ui-object">
                    <div class="swiper-container ui-text" style="height: 17px;">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide" style="text-overflow: ellipsis;overflow: hidden" v-for="notice in d.notices">{{notice.news_title}}</div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!--首页-数据概要-->
        <div id="slider" class="mui-table-view mui-slider ui-home-statistics">
            <div class="mui-slider-group">
                <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->

                <!-- 第一张 -->
                <div class="mui-slider-item" v-for="(reward ,index) in d.reward_list">
                    <div class="mui-table-view-cell">
                        <a href="#income" :data-info="JSON.stringify(d.reward_list)" :data-price="JSON.stringify(d.rewardPrice)" :data-fee="JSON.stringify(d.rewardFee)" :data-index="index">
                            <div class="mui-card-header" v-if="index==0">今日收入</div>
                            <div class="mui-card-header" v-else-if="index==1">昨日收入</div>
                            <div class="mui-card-header" v-else-if="index==2">全部收入</div>
                            <div class="mui-row">
                                <div class="mui-col-sm-4 mui-col-xs-4">收入<p class="ui-ellipsis">
                                    {{total(reward)}}</p>
                                </div>
                                <div class="mui-col-sm-4 mui-col-xs-4">税额<p>{{fee(reward)}}</p>
                                </div>
                                <div class="mui-col-sm-4 mui-col-xs-4">实得<p class="ui-ellipsis">
                                    {{reward.money}}</p></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="mui-slider-indicator" >
                <div class="mui-indicator" v-for="(reward ,index) in d.reward_list" :class="{'mui-active':index==0}">
                </div>
            </div>
        </div>
        <!--首页-收入情况-->
        <div class="mui-table-view ui-home-chart">
            <div class="mui-card-header">收入情况</div>
            <div class="mui-content-padded">
                <div class="chart" id="lineChart"></div>
            </div>
        </div>

    </div>
</div>