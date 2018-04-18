<!-- 产品页 -->
<div class="page" id='product_detail' v-cloak="">

    <!--产品购物-->
    <nav class="bar bar-tab ">
        <a class="tab-item" href="#cart" style="width:0.5%;">
            <span class="icon iconfont icon-cart"></span>
            <span class="tab-label">购物车</span>
            <span class="badge">{{ cart_num }}</span>
        </a>
        <div class="tab-item">
            <button  @click="submit" type="button" class="btn-show-div btn-cart">加入购物车</button>
        </div>
        <div class="tab-item">
            <button  type="button" @click="buyNow" class="btn-show-div btn-submit">立即购买</button>
        </div>
    </nav>
    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="box-flex">
                    <ul class="box-flex goods-header-nav-box">
                        <li class="box-flex"><a class="goods-product show-div-guanbi" @click="showDetail(false)" :class="{active:!show_detail}" href="javascript:;">商品</a>
                        </li>
                        <li class="box-flex"><a class="goods-detail" :class="{active:show_detail}" @click="showDetail(true)" href="javascript:;">详情</a></li>
                    </ul>
                </div>
                <a class="a-sequence j-a-sequence goods-link" @click="showNav"><i class="iconfont icon-qrcode" data="1"></i></a>
                <div class="goods-nav ts-3"  :class="{active:show_nav}" >
                    <ul class="goods-nav-box">
                        <a href="#index">
                            <li><i class="iconfont icon-home j-nav-box"></i>首页</li>
                        </a>
                        <a href="#message">
                            <li><i class="iconfont icon-comments j-nav-box"></i>消息</li>
                        </a>
                        <a href="#user">
                            <li><i class="iconfont icon-account j-nav-box"></i>用户中心</li>
                        </a>
                        <a href="#order">
                            <li style="border:none"><i class="iconfont icon-form j-nav-box"></i>全部订单</li>
                        </a>
                    </ul>
                </div>
            </div>
        </section>
    </header>

    <div class="content">
        <!--产品图片-->
        <div class="swiper-container goods-photo">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="goods_pic in d.goods_pics">
                    <a href="javascript:;"><img :src="goodsPic(goods_pic)"></a>
                </div>


            </div>
            <div class="swiper-pagination goods-pagination"></div>
        </div>
        <!--产品概要-->
        <div class="goods-info">
            <section class="goods-title bg-white padding-all ">
                <div class="dis-box">
                    <h3 class="box-flex">{{d.goods_name}}</h3>
                    <span class="heart j-heart "><i class="icon icon-share ts-2"></i><em class="ts-2">分享</em></span>
                </div>
            </section>
            <section class="goods-price padding-all bg-white">
                <p class="p-price">
                    <span class="color-money">￥{{d.price}}元</span>
                    <!--                    <em class="em-promotion">积分可抵现</em>-->
                </p>

                <p class="p-market">市场价
                    <del>￥{{d.market_price}}元</del>
                </p>
                <p class=" dis-box g-p-tthree m-top04">
                    <!--                    <span class="box-flex text-left">销量：0</span>-->
                    <span class="box-flex text-right">库存: {{d.stock}}</span>
                </p>
            </section>
            <section class="padding-all bg-white goods-service">
                <div class="dis-box">
                    <div class="box-flex">
                        <div class="dis-box m-top08 g-r-rule goods-service-list">
                            <p class="box-flex ">
                                <em class="fl em-promotion"><i class="iconfont icon-jewelry"></i></em><span
                                        class="fl">正品保障</span></p>
                            <p class="box-flex ">
                                <em class="fl em-promotion"><i class="iconfont icon-favorites"></i></em><span
                                        class="fl">贴心售后</span></p>
                            <p class="box-flex ">
                                <em class="fl em-promotion"><i class="iconfont icon-renwuguanli"></i></em><span
                                        class="fl">极速达</span></p>
                        </div>
                    </div>
                </div>
            </section>


            <form>
                <section class="m-top10 padding-all bg-white goods-attr j-goods-attr j-show-div" @click.stop="showGuige">
                    <div class="dis-box">
                        <label class="t-remark g-t-temark t-goods1">已选<span>{{ num }}</span>份</label>
                        <div class="box-flex t-goods1 ">请选择</div>
                        <span class="t-jiantou"><i class="icon icon icon-left tf-180"></i></span>
                    </div>

                    <div class="mask-filter-div" @click.stop="showGuige" ></div>
                    <div class="show-goods-attr j-filter-show-div ts-3 bg-color "@click.stop>
                        <section class="s-g-attr-title bg-color  product-list-small">
                            <div class="product-div">
                                <img :src="goodsPic(d.goods_pics[0])" :alt="d.goods_name" class="product-list-img"/>
                                <div class="product-text n-right-box">
                                    <div class="dis-box">
                                        <h4 class="box-flex">{{d.goods_name}}</h4>
                                        <i class="iconfont icon-close show-div-guanbi"  @click.stop="showGuige"></i>
                                    </div>
                                    <p><span class="p-price color-money">￥{{d.price}}元</span></p>
                                    <p class="dis-box p-t-remark"><span
                                                class="box-flex">库存:{{d.stock}}</span></p>
                                </div>
                            </div>
                        </section>
                        <section class="s-g-attr-con bg-white padding-all m-top1px swiper-detail" >
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div v-for="(options ,index) in d.option_title">
                                        <h4 class="t-remark">{{options.title}}</h4>
                                        <ul class="select-detail j-get-one m-top06">
                                            <li class="ect-select dis-flex fl"  v-for="(item,i) in options.items">
                                                <div class="radio_sm-blue  checked" style="position: static;" v-if="i==0" @click.stop="changeItem" >
                                                    <input type="radio" :name="'size'+index" :value="item.id" checked style="position: absolute; visibility: hidden;">{{item.title}}
                                                </div>
                                                <div class="radio_sm-blue " style="position: static;" v-else @click.stop="changeItem" ><input type="radio" :name="'size'+index" :value="item.id"  style="position: absolute; visibility: hidden;">{{item.title}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dis-box">
                                        <h4 class="t-remark box-flex" style="line-height: 3.2rem">数量</h4>
                                        <div class="div-num dis-box">
                                            <a class="num-less" @click.stop="changeNum('minus')"></a>
                                            <input class="box-flex"  @blur.stop="changeNum('num',$event)" type="text" :value="num" name="number"  autocomplete="off"/>
                                            <a class="num-plus"  @click.stop="changeNum('plus')"></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </section>
                    </div>
                </section>
            </form>


            <section class="m-top10 goods-evaluation" @click="showDetail(true)">
                <a href="javascript:;" class="goods-detail">
                    <div class="dis-box padding-all bg-white  g-evaluation-title">
                        <div class="box-flex t-goods1"><label>商品详情</label></div>
                        <div class="t-goods1"><span class="t-jiantou"><i class="icon icon icon-left tf-180"></i></span>
                        </div>
                    </div>
                </a>
                <section class="show-goods-attr goods-detail-box  ts-3 bg-color">
                    <div class="goods-detail-main padding-all">
                        <!--产品详情写在这里-->

                        <!--如果有内容就去掉这个-->
                        <div class="no-div-message" v-if="d.memo==''">
                            <i class="iconfont icon-service"></i>
                            <p>亲，此处没有内容～！</p>
                        </div>
                        <div v-else v-html="d.memo"></div>
                        <!--End 如果有内容就去掉这个-->

                    </div>

                </section>
            </section>


        </div>
        <!-- <div class="goods-scoll-bg"></div>-->


    </div>
</div>
