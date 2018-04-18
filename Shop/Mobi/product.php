<!-- 产品列表页 -->
<div class="page" v-cloak="" id='product'>
    <!--头部-->
    <header class="bar bar-nav">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all"><!--javascript:history.go(-1)-->
                <a class="a-icon-back j-close-search back" ><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="input-text box-flex bar-input open-popup" onclick="searchOpen()" data-popup=".popup-search">
                    <i class="iconfont icon-search"></i> {{ keywords }}

                </div>
                <a class="a-sequence j-a-sequence" onclick="jSequence(this)"><i class="iconfont icon-viewgallery"
                                                                                data="1"></i></a>
            </div>
        </section>
    </header>
    <div class="content">
        <!--筛选-->
        <section class="product-sequence dis-box">
            <a class="box-flex" :class="{active:order==0}" @click="orderGoods(0)" data-sort="rank" >默认</a>

            <a class="box-flex" data-sort="sale":class="[order==3||order==4 ? 'active' : '', order==4 ? 'a-change' : '']"  data-rule="desc" @click="orderGoods(3)" >销量<i class="icon icon-caret"></i></a>


            <!--            <a class="box-flex" data-sort="visit" data-rule="asc">人气<i class="icon icon-caret"></i></a>-->

            <a class="box-flex" data-sort="price" :class="[order==1||order==2 ? 'active' : '', order==2 ? 'a-change' : '']"  data-rule="desc" @click="orderGoods(1)">价格<i class="icon icon-caret"></i></a>

        </section>
        <!--产品列表-->
        <section class="product-list j-product-list product-list-medium" data="1">
            <ul id="j-product-box">
                <li v-for="(goods,index) in goods_list">
                    <div class="product-div">
                        <a class="product-div-link" href="#product_detail" :data-id="goods.id"></a>
                        <img class="product-list-img" onload="this.style.height=this.offsetWidth+'px';" :src="goodsPic(goods.goods_pics)">
                        <div class="product-text">
                            <h4>{{ goods.goods_name }}</h4>
                            <p class="dis-box p-t-remark">
                                <span class="box-flex">库存：<span>{{goodsOption(goods,'stock')}}</span></span>
                            <p>
                               <span class="p-price color-money ">￥{{goodsOption(goods,'price')}}元
                                    <small><del>￥{{goodsOption(goods,'market_price')}}元</del></small>
                               </span>
                            </p>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
            <a href="javascript:;" class="get-more" v-if="loading==1">
                <div class="preloader">
                </div>
            </a>
            <a href="javascript:;" class="get-more" v-else-if="loading==2">已经到底啦！</a>
        </section>


    </div>
</div>