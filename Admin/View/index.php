<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle"
                                   src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>" width="64"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong
                                           class="font-bold"><?php echo $admin['admin_name']; ?></strong></span>
                                    <?php if ($admin['id'] == 1): ?> <span class="text-muted text-xs block">超级管理员<b
                                                class="caret"></b></span><?php endif; ?>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a  data-toggle="url" data-service="Admin.Logout"><?php echo T('安全退出'); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">DS
                    </div>
                </li>
                <li>
                    <a class="J_menuItem" data-service="DIndex.Index1"><i class="fa fa-home"></i> <span
                                class="nav-label">首页</span></a>
                </li>
                <?php  foreach($menus as $key=>$menu): ?>
                    <li>
                        <a href="#">
                            <i class="fa  <?php echo $icons[$key]['icon']; ?>"></i>
                            <span class="nav-label"><?php echo $key; ?></span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php foreach($menu as $k=>$m): if(POSNUM<=1&&strtolower($m)=='duser.prenet'){continue;} ?>
                                <li><a class="J_menuItem" data-service="<?php echo $m; ?>" ><i class="fa <?php echo $icons[$key]['icons'][$k]; ?>"></i><?php echo $k; ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <!--   <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                               <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                           </a>-->
                        <!-- <ul class="dropdown-menu dropdown-messages">
                             <li class="m-t-xs">
                                 <div class="dropdown-messages-box">
                                     <a href="profile.html" class="pull-left">
                                         <img alt="image" class="img-circle" src="img/a7.jpg">
                                     </a>
                                     <div class="media-body">
                                         <small class="pull-right">46小时前</small>
                                         <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                         <br>
                                         <small class="text-muted">3天前 2014.11.8</small>
                                     </div>
                                 </div>
                             </li>
                             <li class="divider"></li>
                             <li>
                                 <div class="dropdown-messages-box">
                                     <a href="profile.html" class="pull-left">
                                         <img alt="image" class="img-circle" src="img/a4.jpg">
                                     </a>
                                     <div class="media-body ">
                                         <small class="pull-right text-navy">25小时前</small>
                                         <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                         <br>
                                         <small class="text-muted">昨天</small>
                                     </div>
                                 </div>
                             </li>
                             <li class="divider"></li>
                             <li>
                                 <div class="text-center link-block">
                                     <a class="J_menuItem" href="mailbox.html">
                                         <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                     </a>
                                 </div>
                             </li>
                         </ul>-->
                    </li>
                    <li class="dropdown">
                        <!--    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>-->
                        <!--     <ul class="dropdown-menu dropdown-alerts">
                                 <li>
                                     <a href="mailbox.html">
                                         <div>
                                             <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                             <span class="pull-right text-muted small">4分钟前</span>
                                         </div>
                                     </a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                     <a href="profile.html">
                                         <div>
                                             <i class="fa fa-qq fa-fw"></i> 3条新回复
                                             <span class="pull-right text-muted small">12分钟钱</span>
                                         </div>
                                     </a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                     <div class="text-center link-block">
                                         <a class="J_menuItem" href="notifications.html">
                                             <strong>查看所有 </strong>
                                             <i class="fa fa-angle-right"></i>
                                         </a>
                                     </div>
                                 </li>
                             </ul>-->
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="DIndex.Index1">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight" style="right: 200px;"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right" style="right: 120px;">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="roll-nav roll-right J_tabExit" style="right: 60px;" onclick="refresh();"><i class="fa fa fa-refresh"></i> 刷新 </a>
            <a  data-service="Admin.Logout" data-toggle="url" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i>
                退出</a>
        </div>

        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo Common_Function::url(array('service'=>'DIndex.Index1')); ?>" data-id="DIndex.Index1" frameborder="0" seamless></iframe>
        </div>

        <?php $this->view('footer'); ?>
    </div>
</div>

</body>
<?php $this->view('footer_js'); ?>

</html>
