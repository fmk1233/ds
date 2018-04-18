<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" @click="back" class="mui-left mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">我的订单</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="cart-lis" v-for="(orders,index) in order_list">
                <dt class="ui-view-cell">订单号：{{orders.order_sn}}
                    <span class="mui-btn mui-pull-right mui-btn-warning mui-btn-outlined" v-if="orders.status==0"><i class="icon icon-jinggao"></i>待支付</span>
                    <span class="mui-btn mui-pull-right mui-btn-warning mui-btn-outlined" v-else-if="orders.status==1"><i class="icon icon-jinggao"></i>待发货</span>
                    <span class="mui-btn mui-pull-right mui-btn-danger mui-btn-outlined" v-else-if="orders.status==2"><i class="icon icon-jinggao"></i>待收货</span>
                    <span class="mui-btn mui-pull-right mui-btn-primary mui-btn-outlined" v-else-if="orders.status==3"><i class="icon icon-jinggao"></i>完成</span>
                    <span class="mui-btn mui-pull-right mui-btn-info mui-btn-outlined" v-else-if="orders.status==4"><i class="icon icon-jinggao"></i>已取消</span>
                </dt>
                <dd class="ui-view-cell mui-table-view-cell" v-for="(goods ,ind) in orders.goods"><a href="#productview" :data-id="goods.goods_id">
                    <img class="mui-media-object mui-pull-left" :src="goodsPic(goods.goods_pic)">
                    <div class="mui-media-body">
                        <h3>{{goods.goods_name}}</h3>
                        <h3>{{goods.guige}}</h3>
                    </div>
                </a></dd>
                <dt class="ui-view-cell"><span class="mui-pull-right">共{{orders.goods.length}}件商品 实际支付：<span class="ui-price"><em>￥</em>{{orders.order_amount}}</span></span>
                </dt>
                <dt class="ui-view-cell ui-cell-operating"><a href="#ordersview" :data-info="JSON.stringify(orders)" class="mui-btn ui-btn mui-btn-outlined">查看</a><a href="javascript:;" class="mui-btn ui-btn mui-btn-outlined" v-if="orders.status==0" @click="changeOrder(index,'pay')">支付</a>
                    <a href="javascript:;" class="mui-btn ui-btn mui-btn-outlined" v-if="orders.status==0" @click="changeOrder(index,'del')">删除</a>
                </dt>
            </div>

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