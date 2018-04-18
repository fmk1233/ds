<?php if (!defined('API_ROOT')) {
    echo 'error';
    exit();
} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" href="<?php echo URL_ROOT.'..'; ?>/Public/favicon.ico">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--全局引用-防止在子页面刷新-->
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/css/light7.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/css/light7-swipeout.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/swiper/swiper-3.4.1.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/icheck/skins/flat/_all.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/fonts/iconfont/iconfont.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/css/style.css">
    <script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/js/jquery-2.1.4.js"></script>
    <style type="text/css">
        .show-goods-attr, .show-goods-coupon, .show-goods-service, .show-goods-dist, .show-time-con {
            display: none;
            bottom: -100%;
        }

        .show-goods-coupon.show, .show-goods-attr.show, .show-goods-service.show, .show-goods-dist.show, .show-time-con.show {
            display: block;
            bottom: -100%;
        }
        .modal-text{
            font-size: 14px;
            margin: 5px 0 0;
        }
        .modal{
            width: 270px;
            border-radius: 13px;
            margin-left: -135px;
        }
        .modal-button:first-child {
            border-radius: 0 0 0 13px;
        }
        .modal-button:last-child {
            border-radius: 0 0 13px;
        }
        .modal-buttons{
            height: 44px;
        }
        .modal-inner{
            padding: 15px;
            border-bottom: 0;
            border-radius: 13px 13px 0 0;
        }

        .modal-inner:after {
            position: absolute;
            z-index: 15;
            top: auto;
            right: auto;
            bottom: 0;
            left: 0;
            display: block;
            width: 100%;
            height: 1px;
            content: '';
            -webkit-transform: scaleY(.5);
            transform: scaleY(.5);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            background-color: rgba(0,0,0,.2);
        }
        .modal-button {
            position: relative;
            display: block;
            width: 100%;
            height: 44px;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0 5px;
            overflow: hidden;
            font-size: 17px;
            line-height: 44px;
            color: #0894ec;
            text-align: center;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            background: #e8e8e8;
            border-right: 0;
            -webkit-box-flex: 1;
            -ms-flex: 1;
        }
        .modal-button:after {
            position: absolute;
            z-index: 15;
            top: 0;
            right: 0;
            bottom: auto;
            left: auto;
            display: block;
            width: 1px;
            height: 100%;
            content: '';
            -webkit-transform: scaleX(.5);
            transform: scaleX(.5);
            -webkit-transform-origin: 100% 50%;
            transform-origin: 100% 50%;
            background-color: rgba(0,0,0,.2);
        }
        .actions-modal-button{
            font-size: 1.5rem;
            line-height: 3.0rem;
        }
        .actions-modal-label{
            font-size: 1.5rem;
            min-height: 3.0rem;
        }

    </style>
    <!--End 全局引用-->
</head>
<body>
<!-- 首页 -->

<div class="page"  v-cloak="" id="index">
    <!--底部导航-->
    <nav class="bar bar-tab">
        <a class="tab-item no-transition active" href="#index">
            <span class="icon iconfont icon-shouye"></span>
            <span class="tab-label">首页</span>
        </a>
        <a class="tab-item no-transition" href="#category">
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
    <!--内容-->
    <div class="content infinite-scroll">
        <div class="index-banner">
            <div class="index-nav-box">
                <ul class="dis-box">
                    <li class="index-left-box">
                        <a href="#category">
                            <i class="iconfont icon-category color-whie"></i>
                        </a>
                    </li>
                    <li class="box-flex n-input-index-box ">
                        <div class="index-search-box open-popup" onclick="searchOpen()" id="j-input-focus"
                             data-popup=".popup-search">
                            <i class="iconfont icon-search"></i>请输入搜索关键词!
                        </div>
                    </li>
                    <li class="index-right-box">
                        <a href="#message">
                            <i class="iconfont icon-comments color-whie"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="swiper-container swiper-banner" :style="{height: banner_height+'px'}">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="adv in d.advs" style="background: #000;">
                        <a href="javascript:;"><img :src="goodsPic(adv.icon)"></a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="linear"></div>
        </div>
        <!--快捷导航-->
        <nav class="bg-white ptb-1 index-nav">
            <ul class="box ul-4 text-c bg-white">
                <li>
                    <a href="#category"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/nav_0.png"></a>
                    <a class="index-menu-text" href="#category">全部分类</a>
                </li>
                <li>
                    <a href="#order"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/nav_1.png"></a>
                    <a class="index-menu-text" href="#order">我的订单</a>
                </li>

                <li>
                    <a href="#cart"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/nav_7.png"></a>
                    <a class="index-menu-text" href="#cart">购物车</a>
                </li>
                <li>
                    <a href="#user"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/nav_5.png"></a>
                    <a class="index-menu-text" href="#user">个人中心</a>
                </li>
            </ul>
        </nav>
        <!--公告块-->
        <div class="fui-notice">
            <div class="image"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/hotdot.jpg"></div>
            <div class="swiper-container swiper-text">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="news in d.notice">
                        <a href="#message_detail" :data-id="news.id">{{ news.news_title }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!--广告块-->
        <ul class="index-cate-box m-top06">
            <li  v-for="adv in d.adv2" >
                <a :href="adv.url==''?'javascript:;':adv.url"><img :src="goodsPic(adv.icon)"/></a>
            </li>

        </ul>
        <!--热卖产品标题-->
        <div class="text-c n-cate-box">
            <p class="index-title"><i class="iconfont icon-hot"></i>热卖产品</p>
        </div>
        <!--热卖产品列表-->
        <section class="product-list j-product-list n-index-box">
            <ul class="index-more-list">

                <li class="fl" v-for="(goods,index) in goods_list">
                    <a href="#product_detail" :data-id="goods.id">
                        <div class="product-div">

                            <img class="lazy" onload="this.style.height=this.offsetWidth+'px';" :src="goodsPic(goods.goods_pics[0])">
                            <h4>{{ goods.goods_name }}</h4>
                            <p><span>¥{{ goods.price }}</span></p>
                        </div>
                    </a>

                </li>

            </ul>
            <!--<div class="infinite-scroll-preloader">
                <div class="preloader"></div>
            </div>-->
            <a href="javascript:;" class="get-more" v-if="loading==1">
                <div class="preloader"></div>
                正在努力加载中！
            </a>
            <a href="javascript:;" class="get-more" v-else-if="loading==2">已经到底啦！</a>
        </section>
        <!--返回顶部-->
        <div class="filter-top" id="scrollUp" onclick="scrollUp()">
            <i class="icon icon-up"></i>
        </div>


    </div>
</div>

<div class="popup popup-search" id="search" v-cloak="">
    <div class="search-div ts-3">
        <section class="dttop-box">
            <form class="validforms" onsubmit="return false;">
                <div class="text-all dis-box j-text-all">
                    <a class="a-icon-back j-close-search close-popup"><i class="icon icon-left is-left-font"></i></a>
                    <div class="box-flex input-text">
                        <input id="newinput" name="name" class="j-input-text" type="text" placeholder="请输入搜索关键词！"
                               required>

                    </div>
                    <button @click="submit" class="btn-submit">搜索</button>
                </div>
            </form>
        </section>
        <section class="search-con">
            <div class="swiper-scroll history-search swiper-container-vertical swiper-container-free-mode">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-active">
                        <p>
                            <label class="fl">热门搜索</label>
                        </p>
                        <ul class="hot-search a-text-more">
                            <li class="w-3" v-for="keyword in keywords">
                                <a href="javascript:;" @click="search(keyword.search)"><span>{{ keyword.search }}</span></a>
                            </li>
                        </ul>
                        <p style="margin-top: 10px">
                            <label class="fl">我的搜索</label>
                        </p>
                        <ul class="hot-search a-text-more">
                            <li class="w-3" v-for="keyword in self_keywords">
                                <a href="javascript:;" @click="search(keyword)"><span>{{ keyword }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <footer class="close-search j-close-search close-popup">
            点击关闭
        </footer>
    </div>

</div>
<!--分类-->
<?php define('PAGE_URL', dirname(__FILE__));
include PAGE_URL . '/category.php'; ?>
<!--我的-->
<?php include PAGE_URL . '/user.php'; ?>
<!--购物车-->
<?php include PAGE_URL . '/cart.php'; ?>

<?php include PAGE_URL . '/address.php'; ?>
<?php include PAGE_URL . '/add_address.php'; ?>
<?php include PAGE_URL . '/order.php'; ?>
<?php include PAGE_URL . '/order_detail.php'; ?>
<?php include PAGE_URL . '/order_number.php'; ?>
<?php include PAGE_URL . '/product.php'; ?>
<?php include PAGE_URL . '/product_detail.php'; ?>
<?php include PAGE_URL . '/my_wallet.php'; ?>
<?php include PAGE_URL . '/user_info.php'; ?>
<?php include PAGE_URL . '/login.php'; ?>
<?php include PAGE_URL . '/message.php'; ?>
<?php include PAGE_URL . '/message_detail.php'; ?>
<!--余额提现-->
<?php include PAGE_URL . '/account_raply.php'; ?>
<?php include PAGE_URL . '/account_detail.php'; ?>
<?php include PAGE_URL . '/cash_detail.php'; ?>
<?php include PAGE_URL . '/recharge_list.php'; ?>
<?php include PAGE_URL . '/recharge.php'; ?>
<?php include PAGE_URL . '/setting.php'; ?>
<?php include PAGE_URL . '/pwd_edit.php'; ?>
<?php include PAGE_URL . '/order_logistics.php'; ?>

<!--搜索页-->


<!--全局引用-防止在子页面刷新-->
<?php if(DI()->config->get('sys.debug')):  ?>
    <script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/js/light7.js"></script>
<?php else: ?>
    <script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/js/light7.min.js"></script>
<?php endif;?>
<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/swiper/swiper-3.4.1.jquery.min.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Public/static/js/city.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Public/static/js/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/js/light7-city-picker.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/js/light7-swipeout.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/js/i18n/cn.min.js"></script>
<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/layui/layui.js"></script>
<?php if(DI()->config->get('sys.debug')): ?>
    <script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/js/vue.js"></script>
    <?php else: ?>
    <script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/js/vue.min.js"></script>
<?php endif;?>

<script src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/assets/js/app.js"></script>
<!--End 全局引用-->
</body>
</html>

