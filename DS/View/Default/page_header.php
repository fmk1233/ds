<div class="page-wrapper-row">
    <div class="page-wrapper-top">
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top fixed ">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a  data-service="Default.Index" data-toggle="url" >
                            <img src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>" alt="logo"
                                 class="logo-default">
                            <span class="logo-text"><?php echo T('title'); ?></span>
                        </a>
                    </div>
                    <div class="menu-toggler-btn"><a href="javascript:;" class="menu-toggler"></a></div>
                    <!--BEGIN 已经登录状态-->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a  data-toggle="url" data-service="User.Main" class="dropdown-toggle">
                                    <img alt="" class="img-circle"
                                         src="<?php echo Common_Function::GoodsPath('/ds/img/avatar.jpg'); ?>">
                                    <span class="username"><?php echo $user['user_name']; ?></span>
                                </a>

                            </li>
                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>
                            </li>
                            <li class="dropdown dropdown-extended out-sidebar-toggler">
                                <i class="iconfont icon-tuichu"></i>
                                <span class="out" ><a  data-service="<?php echo 'Default.Logout'; ?>" data-toggle="url" ><?php echo T('安全退出'); ?></a></span>

                            </li>
                            <li class="dropdown dropdown-user dropdown-dark Language-box">
                                <a href="javascript:;" class="dropdown-Language" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true"><span class="span-cn-flag"></span></a>
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
                    <!--END 已经登录状态-->

                </div>
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
                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                <a  data-service="<?php echo 'Default.Index'; ?>" data-toggle="url"> <!--<i class="iconfont icon-shouye"></i>--> <?php echo T('首页'); ?> </a>
                            </li>

                            <?php
                            $menus = DI()->config->get('home_power.menu');
                            $service_menu  =$service.',';
                            foreach ($menus as $key => $menu): ?>
                                <?php $power = implode(',',$menu).','; $active=!(stripos($power, $service_menu) === false)?'active':'' ?>

                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown <?php echo $active; ?>">
                                    <a href="javascript:;"><!--<i class="iconfont icon-tuandui"></i>--> <?php echo T($key); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <?php foreach ($menu as $title => $m): if(!USER_CAN_BD&&$user['bd_center']==0&&$m=='User.UserReg'){continue;} ?>
                                            <li aria-haspopup="true" class=" ">
                                                <a data-service="<?php echo $m; ?>" data-toggle="url" class="nav-link"><?php echo T($title); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <a href="javascript:;" class=" page-header-menu-bg"></a>
            </div>
            <!-- END HEADER TOP -->
        </div>
        <!-- END HEADER -->
    </div>
</div>