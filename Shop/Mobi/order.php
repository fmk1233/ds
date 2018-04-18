<!-- 全部订单 -->
<div class="page" id='order' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search" @click="back" :data-from="from"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>我的订单</span>
                </div>


            </div>
        </section>
    </header>
    <div class="content" >
        <div class="buttons-tab">
            <a href="javascript:void(-1);" class="active button">全部</a>
            <a href="javascript:void(-1);" class="button">待付款</a>
            <a href="javascript:void(-1);" class="button">待发货</a>
            <a href="javascript:void(-1);" class="button">待收货</a>
            <a href="javascript:void(-1);" class="button">已完成</a>
        </div>
        <div style=" position: absolute;top: 4.6rem; right: 0;bottom: 0;left: 0;overflow: auto;-webkit-overflow-scrolling: touch;" class="infinite-scroll">
            <div class="swiper-container" style="min-height: 100%">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="(orders ,key) in order_list">
                        <div class="ect-pro-list order-list" style="margin-bottom: 4rem;">
                            <ul class="list-container" v-if="orders.length>0">
                                <li class="m-top10" v-for="(order ,index) in orders">
                                    <div class="ordernum dis-box">
                                        <div class="box-flex t-goods1"><label class="my-u-title-size"><a
                                                        href="#order_detail" :data-order_info="JSON.stringify(order)">订单 {{ order.order_sn }}</a></label>
                                            <span class="bg-discount" v-if="order.status==0">待付款</span>
                                            <span class="bg-default" v-else-if="order.status==1">待发货</span>
                                            <span class="bg-user" v-else-if="order.status==2">待收货</span>
                                            <span class="bg-exchange" v-else-if="order.status==3">已完成</span>
                                            <span class="bg-brand-second" v-else-if="order.status==4">已取消</span>
                                        </div>
                                        <div class="t-goods1"><a href="#order_detail" :data-order_info="JSON.stringify(order)"><span class="t-jiantou"><i
                                                            class="icon icon icon-right  "></i></span></a></div>
                                    </div>
                                    <div class="ect-clear-over" v-for="(goods ,goods_index) in order.goods">
                                        <a href="#product_detail" :data-id="goods.goods_id"><img :src="goodsPic(goods.goods_pic)"
                                                                           :title="goods.goods_name"></a>
                                        <dl>
                                            <dt>
                                            <h4 class="title-b"><a href="#product_detail" :data-id="goods.goods_id">{{ goods.goods_name }}</a>
                                            </h4></dt>
                                            <dd>
                                                <p class="col-9 f-03">{{ goods.guige }}</p>
                                                <div class="fl color-money f-04">￥{{ goods.price }}元</div>
                                                <div class="fr col-9 f-04">x{{ goods.total }}</div>

                                            </dd>
                                        </dl>
                                    </div>

                                </li>
                            </ul>
                            <!--空列表-->
                            <section class="padding-all" v-else>
                                <div class="flow-no-pro"><i class="iconfont icon-service"></i>
                                    <p class="text-center">列表什么都没有，赶快去购物吧</p>
                                    <a type="button" href="#product" class=" btn-submit">去购物</a></div>
                            </section>
                            <!--End空列表-->
                            <a href="javascript:;" class="get-more" v-if="loading==1">
                                <div class="preloader"></div>正在努力加载中！
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
