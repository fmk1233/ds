<!-- 购物车 -->
<div class="page" id='cart' v-cloak="">
    <!--购物按钮-->
    <div class="bar bar-tab bar-footer" v-if="cart_list.length>0" >
        <div class="dui-list" id="shop-btn">
            <div class="dui-list-media">
                <label>
                    <div class="icheckbox_flat-red cart_check_all" id="cart_check_all" style="position: relative;" @click="checkAll">
                    </div>
                    <span>全选</span>
                </label>
            </div>
            <div class="dui-list-inner" v-if="del==false">
                <div class="subtitle">合计：<span class="color-money">￥</span><span class="color-money">{{ totalPrice }}</span>
                </div>
                <div class="text">不含运费</div>
            </div>
            <div class="dui-list-inner" v-else>
            </div>
            <div class="dui-list-angle" v-if="del==false">
                <a href="#order_number" :data-address="JSON.stringify(address)" :data-cart_list="list" class="btn btn-submit btn-danger">结算(<span class="total">{{ total }}</span>)</a>
            </div>
            <div class="dui-list-angle" v-else>
                <a href="javascript:;" @click="batchDel" class="btn btn-submit1 btn-danger">删除</a>
            </div>
        </div>
    </div>
    <!--底部导航-->
    <nav class="bar bar-tab">
        <a class="tab-item no-transition" href="#index">
            <span class="icon iconfont icon-shouye"></span>
            <span class="tab-label">首页</span>
        </a>
        <a class="tab-item no-transition" href="#category">
            <span class="icon iconfont icon-all"></span>
            <span class="tab-label">分类</span>

        </a>
        <a class="tab-item no-transition active" href="#cart">
            <span class="icon iconfont icon-cart"></span>
            <span class="tab-label">购物车</span>
            <span class="badge">{{ cart_num }}</span>
        </a>
        <a class="tab-item no-transition" href="#user">
            <span class="icon iconfont icon-account"></span>
            <span class="tab-label">我的</span>
        </a>
    </nav>
    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>购物车</span>
                </div>
                <a href="javascript:;" @click="showDel" class="a-sequence j-a-sequence "><i
                            class="iconfont icon-delete"></i></a>
            </div>
        </section>
    </header>
    <div class="content">
        <!--空购物车-->
        <section class="padding-all" v-if="cart_list.length==0">
            <div class="flow-no-pro">
                <i class="iconfont icon-cart"></i>
                <p class="text-center">购物车什么都没有，赶快去购物吧</p>
                <a type="button" href="#product" data-id="0" class=" btn-submit">去购物</a>
            </div>
        </section>
        <!--End空购物车-->
        <!--产品列表-->
        <section v-else>
            <p class="flow-jiesuan">
                共<b id="total_number">{{ total }}</b>件商品，总价(不含运费)：
                <b class="color-money">￥</b>
                <b class="color-money" id="goods_subtotal">{{ totalPrice }}</b>
                <b class="color-money">元</b>
            </p>
            <section class="ect-pro-list cart-list">
                <ul style="padding-bottom: 6rem">
                    <li class="box-flex" v-for="(cart ,index) in cart_list">
                        <div class="dui-list-media">
                            <div class="icheckbox_flat-red" :class="{checked:cart.checked}" style="position: relative;" @click="check(index)">
                                <input type="checkbox" name="cart[]" v-model="cart.checked" :value="cart.id" :data-index="index" class="icheck_input" style="width: 0px;height: 0px;">
                            </div>
                        </div>
                        <div style="width: 100%">
                            <div class="ect-clear-over">
                                <a href="#product_detail" :data-id="cart.goods_id">
                                    <img :src="goodsPic(cart.goods_pics)" :title="cart.goods_name">
                                </a>
                                <dl>
                                    <dt>
                                    <h4 class="title-b"><a href="#product_detail" data-id="cart.goods_id">{{cart.goods_name}}</a>
                                    </h4></dt>
                                    <dd>
                                        <p class="col-9 f-03">{{guige(cart)}}</p>
                                        <p><strong class="color-money f-04">￥{{ cart.price }}元</strong></p></dd>
                                </dl>
                            </div>
                            <div class="ect-margin-tb m-top08">
                                <div class="div-num dis-box pull-right">
                                    <a class="num-less" @click="changeNum('minus',index)"></a>
                                    <input class="box-flex" type="text"  @blur="changeNum('num',index,$event)" :value="cart.total" name="number"  autocomplete="off"/>
                                    <a class="num-plus"  @click="changeNum('plus',index)"></a>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </section>
        </section>

        <!--End产品列表-->


    </div>
</div>
