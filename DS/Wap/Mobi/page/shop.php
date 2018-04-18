<div class="ui-navbar">
    <a href="#shoppingcart" class="icon icon-gouwuche mui-pull-right"><span
            class="mui-badge">{{cart_num}}</span></a>
</div>
<div id="offCanvasWrapper" class="mui-off-canvas-wrap mui-draggable mui-slide-in">
    <aside id="offCanvasSide" class="mui-off-canvas-right ui-canvas">
        <ul class="ui-shop-operating">
            <li><a id="offCanvasHide">确定</a></li>
        </ul>
        <div id="offCanvasSideScroll" class="mui-scroll-wrapper" style="padding-bottom: 60px;">
            <div class="mui-scroll">
                <div class="title">全部分类</div>
                <ul class="mui-table-view mui-table-view-radio">
                    <li class="mui-table-view-cell mui-selected">
                        <a class="mui-navigate-right" data-id="0" data-name="全部分类">全部分类</a>
                    </li>
                    <li class="mui-table-view-cell" v-for="category in categorys">
                        <a class="mui-navigate-right" :data-id="category.id" :data-name="category.category_name">{{category.category_name}}</a>
                    </li>
                </ul>

            </div>
        </div>

    </aside>
    <div class="mui-inner-wrap">
        <div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper"
             style="padding-bottom: 40px;">
            <div class="mui-scroll">
                <div class="ui-list-title mui-navigate-right ui-shop-title">商品列表<span
                        class="mui-pull-right"><a href="#offCanvasSide" id="shopSort">全部分类</a></span>
                </div>
                <ul class="mui-table-view ui-shop-list">
                    <li class="mui-table-view-cell mui-media" v-for="goods in goods_list">
                        <a href="#productview" :data-goods="JSON.stringify(goods)">
                            <img class="mui-media-object mui-pull-left" :src="goodsPic(goods.goods_pics)">
                            <div class="mui-media-body">
                                <h3>{{goods.goods_name}}</h3>
                                <div class="ui-parameter">
                                    <div class="mui-pull-left">
                                        <p class="ui-price"><em>￥</em>{{goods.price}}</p>
                                        <p class="mui-ellipsis">{{goods.category_name}}</p></div>
                                    <div class="mui-pull-right"><span class="mui-icon mui-icon-plus ui-shop-btn"></span></div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

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
        <div class="mui-off-canvas-backdrop"></div>
    </div>
</div>