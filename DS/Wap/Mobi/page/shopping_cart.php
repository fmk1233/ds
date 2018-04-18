<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">购物车</h1>
</div>
<div class="mui-page-content">
    <div class="ui-foot-content">
        <div class="mui-row">
            <div class="mui-col-xs-6 mui-col-sm-6">
                <div class="ui-pic-foot" style="width: 100%;">
                    <div class="cart-btn">
                        <span>共{{goodsTotal}}个商品</span>
                        <p>总金额 <span class="ui-price"><em>￥</em>{{priceTotal.toFixed(2)}}</span></p>
                    </div>
                </div>
            </div>
            <div class="mui-col-xs-6 mui-col-sm-6"><a @click="order" class="mui-btn mui-btn-primary ui-btn-block">确定购物</a>
                <a href="#shippingedit" id="address" :data-info="JSON.stringify(address)" style="display: none"></a>
            </div>
        </div>
    </div>

    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="cart-lis" v-for="(goods, index) in cart_list">
                <dt class="ui-view-cell">购物单号：{{goods.id}} <span class="cart-delete" @click="delCart(index)"><i class="icon icon-shanchu"></i> 移出购物车</span></dt>
                <dd class="ui-view-cell mui-table-view-cell"><a href="#productview" :data-id="goods.goods_id">
                    <img class="mui-media-object mui-pull-left" :src="goodsPic(goods.goods_pics)">
                    <div class="mui-media-body">
                        <h3>{{goods.goods_name}}</h3>
                        <h3>{{guige(goods)}}</h3>
                    </div>
                </a></dd>
                <dt class="ui-view-cell" style="padding:8px 15px;"><span style="line-height: 33px;">价格： <span
                        class="ui-price"><em>￥</em>{{price(goods)}}</span></span><span class="mui-pull-right"><div
                        class="mui-numbox" data-numbox-min="1" data-numbox-max="999">
					<button class="mui-btn mui-btn-numbox-minus" type="button" @click="minus(index)">-</button>
					<input id="test2" class="mui-input-numbox" @blur="changeNum(index,$event)" type="number" :value="goods.total">
					<button class="mui-btn mui-btn-numbox-plus" type="button" @click="plus(index)">+</button>
				</div></span></dt>
            </div>


        </div>
    </div>
</div>