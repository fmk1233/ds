<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>

<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">
            <!-- BEGIN HEADER -->
            <div class="page-header">
                <!-- BEGIN HEADER TOP -->
                <div class="page-header-top index-header-top fixed top-bg">
                    <div class="container">
                        <!-- BEGIN LOGO -->
                        <div class="page-logo">
                            <a data-service="Default.Index" data-toggle="url">
                                <img src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
                                     alt="logo" class="logo-default">
                                <span class="logo-text"><?php echo T('title'); ?></span>
                            </a>
                        </div>

                        <?php if (Common_Function::user_id()): ?>
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="dropdown dropdown-user">
                                        <a  data-toggle="url" data-service="User.Main" class="dropdown-toggle">
                                            <img alt="" class="img-circle" src="<?php echo Common_Function::GoodsPath('/ds/img/avatar.jpg'); ?>">
                                            <span class="username"><?php echo $user['user_name']; ?></span>
                                        </a>

                                    </li>
                                    <li class="droddown dropdown-separator">
                                        <span class="separator"></span>
                                    </li>
                                    <li class="dropdown dropdown-extended out-sidebar-toggler">
                                        <i class="iconfont icon-tuichu"></i>
                                        <span class="out" ><a  data-toggle="url" data-service="Default.Logout" ><?php echo T('安全退出'); ?></a></span>

                                    </li>
                                    <li class="dropdown dropdown-user dropdown-dark Language-box">
                                        <a href="javascript:;" class="dropdown-Language" data-toggle="dropdown"
                                           data-hover="dropdown" data-close-others="true"><span
                                                    class="span-cn-flag"></span></a>
                                        <ul class="dropdown-menu Language-menu">
                                            <li>
                                                <a href="javascript:;" data-service="Default.SetLang" data-lang="zh_cn">简体中文<span class="span-cn-flag"></span></a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-service="Default.SetLang" data-lang="en">English<span class="span-en-flag"></span></a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-service="Default.SetLang" data-lang="zh_tw">繁體中文<span class="span-tw-flag"></span></a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <!--BEGIN 未登录状态在手机模式下不显示-->
                            <!--<div class="top-menu hidden-xs hidden-sm">
                                <ul class="nav-info pull-right">
                                    <li class="nav-top-phone">
                                        <i class="fa fa-phone"></i>
                                        <span class="out"> </span></li>
                                    <li>
                                        <a href="#" class="btn btn-link"><?php /*echo T('登录'); */?></a>
                                        <a href="#" class="btn default btn-outline"><?php /*echo T('注册'); */?></a>

                                    </li>
                                </ul>
                            </div>-->
                            <!--END 未登录状态-->

                        <?php endif; ?>

                    </div>

                    <?php if (Common_Function::user_id()): ?>
                        <!--BEGIN 已经登录状态-->
                        <div class="page-header-menu">
                            <div class="hor-menu ">
                                <div class="menu-info hidden-md hidden-lg">
                                    <div class="fl"><img alt="" class="img"
                                                         src="<?php echo Common_Function::GoodsPath('/ds/img/avatar.jpg'); ?>">
                                    </div>
                                    <div class="fr">
                                        <span class="username"><?php echo $user['user_name']; ?></span>
                                        <span class="number"><i class="iconfont icon-price"></i> ID:<?php echo $user['id']; ?></span>
                                        <span class="level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                                    </div>

                                </div>
                                <ul class="nav navbar-nav">
                                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                        <a data-service="Default.Index" data-toggle="url"> <i class="iconfont icon-shouye"></i> <?php echo T('首页'); ?> </a>
                                    </li>

                                    <?php
                                    $menus = DI()->config->get('home_power.menu');
                                    $service_menu  =$service.',';
                                    foreach ($menus as $key => $menu): ?>
                                        <?php $power = implode(',',$menu).','; ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="javascript:;"><i class="iconfont icon-tuandui"></i> <?php echo T($key); ?>
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <?php foreach ($menu as $title => $m):if(!USER_CAN_BD&&$user['bd_center']==0&&$m=='User.UserReg'){continue;} ?>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a data-service="<?php echo $m; ?>" data-toggle="url"
                                                           class="nav-link"><?php echo T($title); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <a href="javascript:;" class=" page-header-menu-bg"></a>
                        <!--END 已登录状态-->
                    <?php endif; ?>
                </div>
                <!-- END HEADER TOP -->
                <div id="myCarousel" class="carousel slide">
                    <div class="home-loing">
                        <div class="home-loing-bg"></div>
                        <div class="home-loing-box">
                            <div class="container">
                                <div class="introslogan animated fadeInDown">
                                    <h2>承载用户的信赖与支持</h2>
                                    <p>无论经历多少风雨我们始终坚持，用户满意才是我们真正的成功！</p>
                                </div>
                                <div class="portlet-body animated fadeInUp">

                                    <?php if (Common_Function::user_id()): ?>
                                        <!--BEGIN 已经登录-->
                                        <div class="form-group text-center"><a  data-service="User.Main" data-toggle="url" class="btn btn-primary btn-login">进入财富中心</a>
                                        </div>
                                        <!--END 已经登录-->
                                    <?php else: ?>
                                        <!-- BEGIN FORM-->
                                        <form id="defaultForm" class="form-horizontal index-login"
                                              onsubmit="return false;">
                                            <input type="hidden" value="Default.DoLogin" name="service"/>
                                            <div class="col-sm-12 col-md-5">
                                                <div class="form-group"><input type="text" class="form-control"
                                                                               name="username"
                                                                               placeholder="<?php echo T('请输入'),T('会员编号'); ?>"/></div>
                                            </div>
                                            <div class="col-sm-12 col-md-5">
                                                <div class="form-group"><input type="password" class="form-control"
                                                                               name="password" placeholder="<?php echo T('请输入'),T('一级密码'); ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary" name="signup"
                                                            value=""><?php echo T('登录'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END FORM-->
                                    <?php endif; ?>

                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- 轮播（Carousel）指标 -->
                    <ol class="carousel-indicators hidden-xs hidden-sm">
                        <?php foreach($advs as $key=>$adv): ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" <?php echo $key==0?'class="active"':'' ?>></li>
                        <?php endforeach;?>
                    </ol>
                    <!-- 轮播（Carousel）项目 -->
                    <div class="carousel-inner">
                        <?php foreach($advs as $key=>$adv): ?>
                            <div class="item <?php echo $key==0?'active':''; ?>"  style="background-image: url('<?php echo Common_Function::GoodsPath($adv['icon']); ?>')"></div>
                        <?php endforeach;?>
                    </div>
                    <!-- 轮播（Carousel）导航 -->
                    <a class="carousel-control left" href="#myCarousel"
                       data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel"
                       data-slide="next">&rsaquo;</a>
                </div>

            </div>
            <!-- END HEADER -->
        </div>
    </div>
    <!--END 头部-->
    <!--BEGIN 公告-->
    <div class="page-wrapper-row">
        <div class="index-info">
            <div class="container">
                <div class="index-info-text col-xs-9">
                    <i class="iconfont icon-gonggao"></i><?php echo T('最新动态'); ?>: <?php echo count($notices)>0?$notices[0]['news_title']:''; ?>
                </div>
                <div class="index-info-btn col-xs-3">
                    <a data-service="News.NewsList" data-toggle="url"><?php echo T('更多'); ?>..</a>
                </div>

            </div>
        </div>
    </div>
    <!--END 公告-->
    <!--BEGIN 优势-->
    <div class="page-wrapper-row">
        <div class="index-introduce">
            <div class="container">
                <h1 class="int-top-h">专业的财富管理平台</h1>
                <p class="int-top-p">我们拥有安全的机制、可靠的技术、贴心的服务</p>
                <div class="row int-list">
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="iconfont icon-suo"></i>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <h2>系统可靠</h2>
                            <p>银行级用户数据加密、动态身份验证，多级风险识别控制，保障交易安全</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="iconfont icon-zhangdan2"></i>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <h2>资金安全</h2>
                            <p>钱包多层加密，离线存储于银行保险柜，资金第三方托管，确保安全</p>
                        </div>
                    </div>
                </div>
                <div class="row int-list">
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="iconfont icon-fuwu"></i>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <h2>服务专业</h2>
                            <p>专业的客服团队，400电话和24小时在线QQ，VIP一对一专业服务</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="iconfont icon-diannao"></i>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <h2>快捷方便</h2>
                            <p>充值即时、提现迅速，每秒万单的高性能交易引擎，保证一切快捷方便</p>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!--END 优势-->
    <!--BEGIN 实力-->
    <div class="page-wrapper-row">
        <div class="index-strength">
            <div class="container">
                <h1 class="int-top-h">帮助你成就更多可能</h1>
                <div class="row int-list">
                    <div class="col-xs-6 col-md-3">
                        <a href="javascipt:;">
                            <img src="<?php echo Common_Function::GoodsPath('/ds/jspic/p1.jpg'); ?>"
                                 class="int-list-img"/>
                            <h2>优秀的团队</h2>
                            <p>资金流转快速，用心服务每一天</p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="javascipt:;">
                            <img src="<?php echo Common_Function::GoodsPath('/ds/jspic/p2.jpg'); ?>"
                                 class="int-list-img"/>
                            <h2>卓越的技术</h2>
                            <p>专业金融安全级别，重金多重安全防护</p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="javascipt:;">
                            <img src="<?php echo Common_Function::GoodsPath('/ds/jspic/p3.jpg'); ?>"
                                 class="int-list-img"/>
                            <h2>丰厚的实力</h2>
                            <p>优质的合作伙伴，提供全方位的服务</p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="javascipt:;">
                            <img src="<?php echo Common_Function::GoodsPath('/ds/jspic/p4.jpg'); ?>"
                                 class="int-list-img"/>
                            <h2>简便的操作</h2>
                            <p>是时候跟繁琐的操作流程说再见了</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--END 实力-->
    <!--BEGIN 新闻-->
    <div class="page-wrapper-row" style="background: #fff">
        <div class="container">
            <div class="row index-news">
                <div class="col-xs-12 col-md-6">

                    <div class="hd clearfix">
                        <h3 class="pull-left"><?php echo T('官方公告'); ?></h3>
                        <a class="pull-right" data-toggle="url" data-service="News.NewsList"><?php echo T('更多'); ?>&gt;&gt;</a>
                    </div>
                    <div class="bd">
                        <ul>
                            <?php  foreach($notices as $notice): ?>
                                <li><a data-toggle="url" data-service="News.NewsDetail" data-news_id="<?php echo $notice['id']; ?>" title="" ><?php echo $notice['news_title']; ?></a></li>
                            <?php endforeach;?>
                        </ul>

                    </div>

                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="hd clearfix">
                        <h3 class="pull-left"><?php echo T('业内动态'); ?></h3>
                        <a class="pull-right" data-toggle="url" data-service="Msg.MsgList" ><?php echo T('更多'); ?>&gt;&gt;</a>
                    </div>
                    <div class="bd">
                        <ul>
                            <?php foreach($news as $new): ?>
                                <li><a title="" target="_self" data-toggle="url" data-service="News.NewsDetail" data-news_id="<?php echo $notice['id']; ?>" title="" ><?php echo $new['news_title']; ?></a></li>
                            <?php endforeach;?>
                        </ul>

                    </div>

                </div>


            </div>
        </div>
    </div>
    <!--END 新闻-->
    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->


</div>

<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/zh_CN.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#defaultForm').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            onSuccess: function (e) {
                e.preventDefault();
                var $form = $(e.target);
                sendFormAjax($form);
            },
            fields: {

                username: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请输入'),T('会员编号'); ?>'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请输入'),T('一级密码'); ?>'
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>