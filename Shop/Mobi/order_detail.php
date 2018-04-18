
<!-- 订单详情 -->
<div class="page" id='order_detail' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back" data-back="true"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>订单详情</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content">
        <!--状态-->
        <div class="result-list m-top10">
            <!--待付款-->
            <div class="order-status dis-box padding-all bg-discount color-whie t-remark" v-if="d.status==0">
                <div class="fui-list-inner box-flex">
                    <div class="title-b">等待付款</div>
                    <div class="text">订单金额(含运费): ￥{{ d.order_amount }}<span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="iconfont icon-information"></i>
                </div>
            </div>
            <!--待发货-->
            <div class="order-status dis-box padding-all bg-default color-whie t-remark" v-else-if="d.status==1">
                <div class="fui-list-inner box-flex">
                    <div class="title-b">等待发货</div>
                    <div class="text">订单金额(含运费): ￥{{ d.order_amount }}<span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="iconfont icon-clock"></i>
                </div>
            </div>
            <!--待收货-->
            <div class="order-status dis-box padding-all bg-user color-whie t-remark" v-else-if="d.status==2">
                <div class="fui-list-inner box-flex">
                    <div class="title-b">等待收货</div>
                    <div class="text">订单金额(含运费): ￥{{ d.order_amount }}<span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="iconfont icon-help"></i>
                </div>
            </div>
            <!--已完成-->
            <div class="order-status dis-box padding-all bg-exchange color-whie t-remark"  v-else-if="d.status==3">
                <div class="fui-list-inner box-flex">
                    <div class="title-b">已经完成</div>
                    <div class="text">订单金额(含运费): ￥{{ d.order_amount }}<span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="iconfont icon-success"></i>
                </div>
            </div>
            <div class="order-status dis-box padding-all bg-exchange color-whie t-remark"  v-else-if="d.status==4">
                <div class="fui-list-inner box-flex">
                    <div class="title-b">已经取消</div>
                    <div class="text">订单金额(含运费): ￥{{ d.order_amount }}<span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="iconfont icon-success"></i>
                </div>
            </div>
        </div>

        <!--收货信息-->
        <div class="order-address bg-white m-top10">
                <div class="flow-have-adr padding-all">
                    <div class="dis-box">
                        <div class="box-flex  ">
                            <p class="f-h-adr-title t-remark">
                                <label class="color-dark">{{d.address.realname}}</label> <span class="color-money">{{d.address.mobile}}</span></p>
                            <p class="f-h-adr-con t-remark m-top04">{{d.address.province+ '' + d.address.city+ '' + d.address.area+ '' + d.address.address}}</p>

                        </div>

                    </div>

                </div>
            <b class="s1-borderB"></b>
        </div>
        <section class="ect-pro-list m-top10">
            <ul>
                <li v-for="goods in d.goods">
                    <div class="ect-clear-over">
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
        </section>
        <section class="goods-evaluation">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1"> </div>
                <div class="t-goods1"><span class="t-jiantou">共 <span class="color-money">{{ total }}</span> 件商品 合计：<span class="color-money">￥<span class="color-money">{{ totalPrice }}</span></span></span></div>
            </div>
        </section>
        <section class="goods-evaluation m-top10">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1">  <label>商品小计</label></div>
                <div class="t-goods1"><span class="t-jiantou">￥<span>{{ totalPrice }}</span><!--<i class="icon icon icon-left tf-180"></i>--></span></div>
            </div>
        </section>
        <!--付款-->
        <section class="order-payment m-top10 bg-white">
            <div class="flow-have-adr padding-all text-center">
                <span class="p-market color-dark">总价:<span class="p-prices color-money">￥<b>{{ totalPrice }}</b></span>
                 <!--<em class="p-market">(总重:0.381kg)</em>--></span>
            </div>
            <div class="flow-no-pro">
                <a type="button" href="javascript:;" class="btn-submit pay"  v-if="d.status==0">支付订单</a>
                <a type="button" href="javascript:;" class="btn-submit"  @click="changeOrder('confirm')" v-else-if="d.status==2">确认收货</a>
                <a type="button" href="javascript:;" class="m-top10 btn-submit1" @click="changeOrder('cancel')" v-if="d.status==0">取消订单</a>
                <a type="button" href="#order_logistics" :data-order_info="JSON.stringify(d)" class="m-top10 btn-submit1"  v-if="d.status==2">查看物流</a>
            </div>


        </section>




    </div>

</div>
