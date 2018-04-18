<?php
if (!defined('URL_ROOT')) {
    exit('error');
}
$base_root = dirname(__FILE__) . '/page/'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DS管理系统</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection"/>
    <meta name="full-screen" content="yes"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="shortcut icon" href="<?php echo URL_ROOT; ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>css/mui.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>fonts/iconfont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>css/mui.picker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>/static/css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>css/app.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>css/mob_login.css">
    <style type="text/css">
        #productview .mui-collapse-content img {
            max-width: 100%;
        }
        body > iframe{
            opacity:0;
            display:none;
        }
        .mui-pull-caption{
            font-weight:normal;
        }
        .ui-foot-content{
            position: absolute;
        }
        [data-pullrefresh] .mui-scrollbar-vertical{
            opacity: 0 !important;
        }
    </style>
</head>
<body class="mui-fullscreen">

<!--页面主结构开始-->
<div id="app" class="mui-views">
    <div class="mui-view">
        <div class="mui-navbar">
        </div>
        <div class="mui-pages">
        </div>
    </div>
</div>
<!--页面主结构结束-->
<!--单页面开始-->
<div id="Index" class="mui-page">
    <!--一级页面导航-->
    <nav class="mui-bar mui-bar-tab">
        <a class="mui-tab-item mui-active" href="#Home">
            <i class="mui-icon icon icon-home"></i>
            <span class="mui-tab-label">首页</span>
        </a>
        <a class="mui-tab-item " href="#Team">
            <i class="mui-icon icon icon-tuandui"></i>
            <span class="mui-tab-label">团队</span>
        </a>
        <a class="mui-tab-item" href="#finance">
            <i class="mui-icon icon icon-caiwu1"></i>
            <span class="mui-tab-label">财务</span>
        </a>
        <a class="mui-tab-item" href="#shop">
            <i class="mui-icon icon icon-shangcheng"></i>
            <span class="mui-tab-label">购物</span>
        </a>
        <a class="mui-tab-item" href="#user">
            <i class="mui-icon icon icon-wode"></i>
            <span class="mui-tab-label">我的</span>
        </a>
    </nav>
    <!--页面标题栏开始-->
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <h1 class="mui-center mui-title" id="title">首页</h1>
    </div>
    <!--页面标题栏结束-->
    <!--页面主内容区开始-->

    <div class="mui-page-content">
        <div class="mui-content">
            <!--首页-->
            <div id="Home" v-cloak class="mui-control-content mui-active mui-page-content">
                <?php include $base_root . 'home.php'; ?>
            </div>
            <!--团队-->
            <div id="Team" v-cloak class="mui-control-content mui-page-content">
                <?php include $base_root . 'team.php'; ?>
            </div>
            <!--财务-->
            <div id="finance" class="mui-control-content mui-page-content">
                <?php include $base_root . 'finance.php'; ?>
            </div>
            <!--商城-->
            <div id="shop" class="mui-control-content mui-page-content">
                <?php include $base_root . 'shop.php'; ?>
            </div>
            <!--我的-->
            <div id="user" class="mui-control-content mui-page-content">
                <?php include $base_root . 'user.php'; ?>
            </div>
        </div>
    </div>
    <!--页面主内容区结束-->
</div>
<!--单页面结束-->
<!--查看资料-->
<div id="user_view" class="mui-page">
    <?php include $base_root . 'user_view.php'; ?>
</div>
<!--修改资料-->
<div id="zledit" class="mui-page">
    <?php include $base_root . 'zledit.php'; ?>
</div>
<!--收入数据-->
<div id="income" class="mui-page">
    <?php include $base_root . 'income.php'; ?>
</div>

<!--会员升级-->
<div id="upgrade" class="mui-page">
    <?php include $base_root . 'upgrade.php'; ?>
</div>
<!--会员升级-记录-->
<div id="upgradelist" class="mui-page">
    <?php include $base_root . 'upgradelist.php'; ?>
</div>
<!--申请会员-->
<div id="userreg" class="mui-page">
    <?php include $base_root . 'userreg.php'; ?>
</div>
<!--未激活会员-->
<div id="audit" class="mui-page">
    <?php include $base_root . 'audit.php'; ?>
</div>
<!--已激活会员-->
<!--<div id="through" class="mui-page">
    <?php /*include $base_root.'audit.php'; */ ?>
</div>-->

<!--申请报单中心-记录-->
<div id="manager" class="mui-page">
    <?php include $base_root . 'manager.php'; ?>
</div>
<div id="apply_m" class="mui-page">
    <?php include $base_root . 'apply_m.php'; ?>

</div>
<!--查看用户资料-->
<div id="auditview" class="mui-page">
    <?php include $base_root . 'audit_view.php'; ?>
</div>
<!--安置图-->
<div id="azfig" class="mui-page">
    <?php include $base_root . 'az_fig.php'; ?>
</div>
<!--推荐图-->
<!--<div id="tjfig" class="mui-page">
</div>-->

<!--奖金明细-->
<div id="bonuseetails" class="mui-page">
    <?php include $base_root . 'bonuseetails.php'; ?>
</div>
<!--奖金明细-详情-->
<div id="bonusview" class="mui-page">
    <?php include $base_root . 'bonusview.php'; ?>
</div>
<!--奖金记录-->
<div id="billing" class="mui-page">
    <?php include $base_root . 'billing.php'; ?>
</div>
<!--奖金转出-->
<div id="moneyout" class="mui-page">
    <?php include $base_root . 'moneyout.php'; ?>
</div>
<!--我要转账-->
<div id="transfer" class="mui-page">
    <?php include $base_root . 'transfer.php'; ?>
</div>
<!--奖金转入-->
<div id="moneyinto" class="mui-page">
    <?php include $base_root . 'moneyinto.php'; ?>
</div>
<!--奖金提现-确认资料-->
<div id="takeconfirm" class="mui-page">
    <?php include $base_root . 'takeconfirm.php'; ?>
</div>
<!--奖金提现-->
<div id="take" class="mui-page">
    <?php include $base_root . 'take.php'; ?>
</div>
<!--奖金转换-->
<div id="conversion" class="mui-page">
</div>
<!--钱包互转转换记录-->
<div id="inner_transfer" class="mui-page">
    <?php include $base_root . 'inner_transfer.php'; ?>
</div>
<!--奖金转换-->
<div id="to_transfer" class="mui-page">
    <?php include $base_root . 'to_transfer.php'; ?>
</div>

<!--商品详情-->
<div id="productview" class="mui-page">
    <?php include $base_root . 'product_view.php'; ?>
</div>
<!--购物车-->
<div id="shoppingcart" class="mui-page">
    <?php include $base_root . 'shopping_cart.php'; ?>
</div>
<!--我的订单-->
<div id="orders" class="mui-page">
    <?php include $base_root . 'orders.php'; ?>
</div>
<!--我的订单-详情-->
<div id="ordersview" class="mui-page">
    <?php include $base_root . 'order_view.php'; ?>
</div>

<!--收货信息-->
<div id="shipping" class="mui-page">
    <?php include $base_root . 'shipping.php'; ?>
</div>
<div id="shippingedit" class="mui-page">
    <?php include $base_root . 'shippingedit.php'; ?>
</div>
<!--修改密码-->
<div id="pwdedit" class="mui-page">
    <?php include $base_root . 'pwdedit.php'; ?>
</div>
<!--新闻公告-->
<div id="announces" class="mui-page">
    <?php include $base_root . 'announces.php'; ?>
</div>
<!--新闻公告-详情-->
<div id="announceview" class="mui-page">
    <?php include $base_root . 'announce_view.php'; ?>
</div>
<!--我要留言-->
<div id="writemail" class="mui-page">
    <?php include $base_root . 'writemail.php'; ?>
</div>
<!--留言信息-->
<div id="mailbox" class="mui-page">
    <?php include $base_root . 'mailbox.php'; ?>
</div>
<!--收到留言-详情-->
<div id="mailboxview" class="mui-page">
    <?php include $base_root . 'mailboxview.php'; ?>
</div>
<div id="recharge" class="mui-page">
    <?php include $base_root . 'recharge.php'; ?>
</div>
<!--安全确认-->
<div id="safety" class="mui-page ">
</div>
<!--登录-->
<div id="login" class="mui-modal">
    <div class="mui-page-content">
        <div class="mui-navbar-inner mui-bar mui-bar-nav">
            <h1 class="mui-center mui-title">登录</h1>
        </div>
        <div class="mui-scroll-wrapper" style="top: 48px">
            <div class="mui-scroll">
                <dl class="ui-prompt">
                    <dt><img src="<?php echo URL_ROOT; ?>/static/ds/img/logo-default.png" style="width: 80px;"></dt>
                    <dd><h3>DS管理系统</h3></dd>
                </dl>
                <form onsubmit="return false;">
                    <input type="hidden" value="Default.DoLogin" name="service"/>
                    <ul class="mui-input-group ui-login">
                        <li class="mui-input-row">
                            <label><i class="icon icon-touxiang"></i></label>
                            <input type="text" class="mui-input-clear mui-input" name="username" placeholder="请输入会员编号">
                        </li>
                        <li class="mui-input-row mui-password">
                            <label><i class="icon icon-mima"></i></label><input name="password" type="password"
                                                                                class="mui-input-password"
                                                                                placeholder="请输入密码">
                        </li>
                    </ul>
                    <div class="mui-content-padded">
                        <button type="submit" id="confirmBtn" class="mui-btn mui-btn-primary ui-btn-block">登录</button>
                        <!--<a href="index.html" class="mui-btn mui-btn-primary ui-btn-block">登录</a>-->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--<div id="loading" class="mui-modal">
    <div class="mui-pull-loading mui-icon mui-spinner mui-visibility"></div>
</div>-->
</body>

<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>js/mui.js "></script><!--框架主组件-->
<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>js/mui.view.js "></script>
<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>libs/echarts-all.js"></script>
<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>js/mui.picker.min.js"></script><!--选择器组件-->
<script src="<?php echo URL_ROOT; ?>/static/js/city.js" type="text/javascript" charset="utf-8"></script><!--三级城市联动-->
<script src="<?php echo URL_ROOT; ?>/static/js/area.js"></script>
<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>js/layui/layui.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT . '../DS/Wap/Mobi/'; ?>js/vue.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT; ?>/static/js/swiper.min.js"></script>
<style>
    #login.mui-modal {
        position: fixed;
        z-index: 999;
        top: 0;
        overflow: hidden;
        width: 100%;
        min-height: 100%;
        -webkit-transition: -webkit-transform .50s, opacity 1ms .50s;
        transition: transform .50s, opacity 1ms .50s;
        -webkit-transition-timing-function: cubic-bezier(.1, .5, .1, 1);
        transition-timing-function: cubic-bezier(.1, .5, .1, 1);
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0);
        opacity: 0;
        background-color: #fff;
    }

    #login.mui-modal.mui-active {
        height: 100%;
        -webkit-transition: -webkit-transform .50s;
        transition: transform .50s;
        -webkit-transition-timing-function: cubic-bezier(.1, .5, .1, 1);
        transition-timing-function: cubic-bezier(.1, .5, .1, 1);
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }

    .team-level li {
        width: 25%;
        float: left;
    }
</style>
<script>
    mui.init({
        swipeBack: true //启用右滑关闭功能
    });
    //初始化单页view
    var viewApi = mui('#app').view({
        defaultPage: '#Index'
    });

    //当前激活选项
    var subpages = ['#Home', '#Team', '#finance', '#shop', '#user'];
    var activeTab = subpages[0];
    var title = document.getElementById("title");

    layui.use(['login'], function () {
    });
    //选项卡点击事件
    mui('.mui-bar-tab').on('tap', 'a', function (e) {
        var targetTab = this.getAttribute('href');
        if (targetTab == activeTab) {
            return;
        }
        //更换标题
        title.innerHTML = this.querySelector('.mui-tab-label').innerHTML;
        //显示目标选项卡
        //若为iOS平台或非首次显示，则直接显示
        if (typeof plus !== 'undefined') {
            if (mui.os.ios || aniShow[targetTab]) {
                plus.webview.show(targetTab);
            } else {
                //否则，使用fade-in动画，且保存变量
                var temp = {};
                temp[targetTab] = "true";
                mui.extend(aniShow, temp);
                plus.webview.show(targetTab, "fade-in", 300);
            }
            //隐藏当前;
            plus.webview.hide(activeTab);
        }
        //更改当前活跃的选项卡
        activeTab = targetTab;
    });

    var view = viewApi.view;
    (function ($) {
        layui.use(['team', 'finance', 'shop', 'user', 'zledit', 'income', 'upgrade', 'upgradelist', 'userreg', 'audit', 'manager', 'auditview', 'azfig', 'bonuseetails', 'bonusview', 'billing', 'moneyout', 'transfer', 'moneyinto', 'takeconfirm', 'take', 'conversion', 'productview', 'shoppingcart', 'orders', 'ordersview', 'shipping', 'shippingedit', 'pwdedit', 'announces', 'announceview', 'writemail', 'mailbox', 'safety', 'user_view', 'mailboxview', 'recharge', 'apply_m', 'inner_transfer', 'to_transfer'], function () {
            $('.mui-input-row input').input();
        });
        //处理view的后退与webview后退
        var oldBack = $.back;
        $.back = function () {
            if (viewApi.canBack()) { //如果view可以后退，则执行view的后退
                viewApi.back();
            } else { //执行webview后退
                oldBack();
            }
        };
    })(mui);

</script>
</html>
