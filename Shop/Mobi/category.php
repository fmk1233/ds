<!-- 分类页 -->
<div class="page " id='category' v-cloak="">
    <!--底部导航-->
    <nav class="bar bar-tab">
        <a class="tab-item no-transition " href="#index">
            <span class="icon iconfont icon-shouye"></span>
            <span class="tab-label">首页</span>
        </a>
        <a class="tab-item no-transition active" href="#category">
            <span class="icon iconfont icon-all"></span>
            <span class="tab-label">分类</span>

        </a>
        <a class="tab-item no-transition" href="#cart">
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
                <div class="box-flex ect-header">
                    <span>选择分类</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content scrollbar-hidden">
        <aside class="menu-left" style="width: 25%;float: left;">
            <div class="scrollbar-none" id="sidebar">
                <ul>
                    <li v-for="(category ,index) in category_list" :class="{active:index==0}" :data-id="category.id" @click="category_detail(index)">{{ category.category_name }}</li>
                </ul>
            </div>
        </aside>
        <aside class="menu-right" style="width: 75%;float: right;">
            <section class="menu-right padding-all j-content" style="display: block;"  >
                <h5><a href="#product" :data-id="category_id">{{ category_name }}</a></h5>
                <ul>
                    <li class="w-3" v-for="junior in juniors">
                        <a href="#product" :data-id="junior.id"></a>
                        <img :src="goodsPic(junior.icon)" data-id="0"><span>{{ junior.category_name }}</span></li>
                </ul>
            </section>
        </aside>
    </div>
</div>



