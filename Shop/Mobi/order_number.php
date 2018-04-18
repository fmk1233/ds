<!-- 填写订单 -->
<div class="page" id='order_number' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search" @click="back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>填写订单</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content">
        <!--收货信息-->
        <div class="order-address bg-white">
            <a href="#address" data-from="order">
                <div class="flow-have-adr padding-all">
                    <div class="dis-box">
                        <div class="box-flex">
                            <p class="f-h-adr-title t-remark">
                                <label class="color-dark">{{ address.realname }}</label> <span class="color-money">{{ address.mobile }}</span>
                            </p>
                            <p class="f-h-adr-con t-remark m-top04">{{ addressInfo(address)+' '+address.address }}</p>

                        </div>
                        <span class="t-jiantou"><i class="icon icon icon-left tf-180 m-top12"></i></span>
                    </div>

                </div>
            </a>
            <b class="s1-borderB"></b>
        </div>
        <section class="ect-pro-list m-top10">
            <ul>
                <li v-for="cart in cart_list">
                    <div class="ect-clear-over">
                        <a href="#product_detail" :data-id="cart.goods_id">
                            <img :src="goodsPic(cart.goods_pics)" :title="cart.goods_name">
                        </a>
                        <dl>
                            <dt>
                            <h4 class="title-b"><a href="#product_detail"
                                                   data-id="cart.goods_id">{{cart.goods_name}}</a>
                            </h4></dt>
                            <dd>
                                <p class="col-9 f-03">{{guige(cart)}}</p>

                                <div class="fl color-money f-04">￥{{ cart.price }}元</div>
                                <div class="fr col-9 f-04">x{{ cart.total }}</div>

                            </dd>
                        </dl>
                    </div>


                </li>
            </ul>
        </section>
        <section class="goods-evaluation">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1"></div>
                <div class="t-goods1"><span class="t-jiantou">共 <span
                                class="color-money">{{ total }}</span> 件商品 合计：<span class="color-money">￥<span
                                    class="color-money">{{ totalPrice }}</span></span></span></div>
            </div>
        </section>
        <section class="goods-evaluation m-top10">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1"><label>商品小计</label></div>
                <div class="t-goods1"><span class="t-jiantou">￥<span>{{ totalPrice }}</span>
                        <!--<i class="icon icon icon-left tf-180"></i>--></span></div>
            </div>
        </section>
        <!--付款-->
        <section class="order-payment m-top10 bg-white">
            <div class="flow-have-adr padding-all text-center">
                <span class="p-market color-dark">总价:<span class="p-prices color-money">￥<b>{{ totalPrice }}</b></span>
                    <!-- <em class="p-market">(总重:0.381kg)</em>--></span>
            </div>
            <div class="flow-no-pro">
                <a type="button" href="javascript:;" @click="order" class=" btn-submit">立即结算</a>
<!--                <a type="button" href="javascript:;" class="m-top10 btn-submit1">网银支付</a>-->
            </div>


        </section>


    </div>
</div>