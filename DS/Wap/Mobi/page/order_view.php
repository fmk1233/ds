<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">我的订单-详情</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="cart-lis">
                <dt class="ui-view-cell">订单号：{{d.order_sn}}
                    <span class="mui-btn mui-pull-right mui-btn-warning mui-btn-outlined" v-if="d.status==0"><i class="icon icon-jinggao"></i>待支付</span>
                    <span class="mui-btn mui-pull-right mui-btn-warning mui-btn-outlined" v-else-if="d.status==1"><i class="icon icon-jinggao"></i>待发货</span>
                    <span class="mui-btn mui-pull-right mui-btn-danger mui-btn-outlined" v-else-if="d.status==2"><i class="icon icon-jinggao"></i>待收货</span>
                    <span class="mui-btn mui-pull-right mui-btn-primary mui-btn-outlined" v-else-if="d.status==3"><i class="icon icon-jinggao"></i>完成</span>
                    <span class="mui-btn mui-pull-right mui-btn-info mui-btn-outlined" v-else-if="d.status==4"><i class="icon icon-jinggao"></i>已取消</span>
                </dt>
                <dd class="ui-view-cell mui-table-view-cell" v-for="(goods ,ind) in d.goods"><a href="#productview" :data-id="goods.goods_id">
                    <img class="mui-media-object mui-pull-left" :src="goodsPic(goods.goods_pic)">
                    <div class="mui-media-body">
                        <h3>{{goods.goods_name}}</h3>
                        <h3>{{goods.guige}}</h3>
                    </div>
                </a></dd>
                <dt class="ui-view-cell"><span class="mui-pull-right">共{{d.goods.length}}件商品 实际支付：<span class="ui-price"><em>￥</em>{{d.order_amount}}</span></span>
            </div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back">
                    姓名<span class="mui-pull-right">{{d.address.realname}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    收货地址<span class="mui-pull-right">{{d.address.province+' '+d.address.city+' '+d.address.area}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    详细地址<span class="mui-pull-right">{{d.address.address}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    联系方式<span class="mui-pull-right">{{d.address.mobile}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    订购时间<span class="mui-pull-right">{{timer(d.add_time,true)}}</span>
                </li>

                <li class="mui-table-view-cell ui-on-back">
                    付款时间<span class="mui-pull-right">{{timer(d.pay_time,true)}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    发货时间<span class="mui-pull-right">{{timer(d.delivery_time,true)}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    收货时间<span class="mui-pull-right">{{timer(d.comfirm_time,true)}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    取消时间<span class="mui-pull-right">{{timer(d.cancel_time,true)}}</span>
                </li>
            </ul>
            <div class="mui-content-padded" v-if="d.status==0">
                <button type="button" class="mui-btn mui-btn-primary ui-btn-block">确定支付</button>
            </div>


        </div>
    </div>
</div>