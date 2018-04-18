<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>

    <h1 class="mui-center mui-title">商品详情</h1>
</div>
<div class="mui-page-content">

    <div class="ui-foot-content">
        <div class="mui-row">
            <div class="mui-col-xs-4 mui-col-sm-4">
                <div class="ui-pic-foot">
                    <a class="mui-tab-item" href="#orders">
                        <i class="mui-icon icon icon-chakan"></i>
                        <span class="mui-tab-label">订单</span>
                    </a>
                    <a class="mui-tab-item " href="#shoppingcart">
                        <i class="mui-icon icon icon-gouwuche"><span class="mui-badge">{{cart_num}}</span></i>
                        <span class="mui-tab-label">购物车</span>
                    </a>
                </div>
            </div>
            <div class="mui-col-xs-4 mui-col-sm-4">
                <a @click="submit(0)" class="mui-btn mui-btn-primary ui-btn-block">加入购物车</a>
            </div>
            <div class="mui-col-xs-4 mui-col-sm-4">
                <a @click="submit(1)" class="mui-btn mui-btn-danger ui-btn-block">立即购买</a>
            </div>
        </div>
    </div>
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <!--产品图片-->
            <div class="pic-slider">
                <i></i>
                <img :src="goodsPic(d.goods_pics)"/>
            </div>
            <!--标题-->
            <div class="pic-title">
                {{d.goods_name}}
                <p class="pic-price"><em>￥</em><span id="price">{{d.price}}</span></p>
            </div>
            <ul class="mui-input-group pic-list">
                <li class="mui-input-row" v-for="(options ,index) in d.option_title" :data-index="index" :id="'option'+index+'val'" >
                    <label>{{options.title}}</label>
                    <div class="ui-option mui-navigate-right option" :id="'option'+index+'txt'">请选择</div>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    库存<span class="mui-pull-right" id="stock">{{d.stock}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back" style="padding: 8px 15px;">
                    <span style="line-height: 33px;">购买数量</span>
                    <span class="mui-pull-right"> <div class="mui-numbox"  data-numbox-min="1"   data-numbox-max="999">
					<button class="mui-btn mui-btn-numbox-minus" @click="minus" type="button">-</button>
					<input  class="mui-input-numbox" @blur="changeNum" type="number" :value="num">
					<button class="mui-btn mui-btn-numbox-plus" @click="plus" type="button">+</button>
				</div></span>
                </li>

            </ul>

            <ul class="mui-table-view">
                <li class="mui-table-view-cell mui-collapse mui-active">
                    <a class="mui-navigate-right" href="javascript:;">产品详情</a>
                    <div class="mui-collapse-content" v-html="d.memo">
                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>