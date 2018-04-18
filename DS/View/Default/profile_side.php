<!-- PORTLET MAIN -->
<div class="portlet light profile-sidebar-portlet ">
    <!-- SIDEBAR USERPIC -->
    <div class="profile-userpic">
        <img src="<?php echo Common_Function::GoodsPath('/ds/img/avatar.jpg'); ?>"
             class="img-responsive" alt=""></div>
    <!-- END SIDEBAR USERPIC -->
    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <div class="profile-usertitle-name"><?php echo $user['user_name']; ?></div>
<!--        <div class="profile-usertitle-job"><i class="iconfont icon-price"></i> ID:--><?php //echo $user['id']; ?><!--</div>-->
        <div class="profile-usertitle-job"><i class="iconfont icon-price"></i><?php echo $user['true_name']; ?></div>
    </div>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->
    <div class="profile-userbuttons">
        <span class="btn blue  ladda-button btn-outline btn-circle"><?php echo Common_Function::getRankName($user['rank']); ?></span>
    </div>
    <!-- END SIDEBAR BUTTONS -->
    <!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
        <ul class="nav">
            <?php
            $menus = DI()->config->get('home_power.menu');
            $service_menu  =$service.',';
            foreach ($menus as $key => $menu): ?>
                <?php $power = implode(',',$menu).',';  if(stripos($power, $service_menu) === false){continue;} ?>

                <li>
                    <a href="javascript:void(-1);" class="menu-dropdown">
                        <i class="iconfont icon-geren"></i> <?php echo T($key); ?> </a>
                    <ul class="nav-menu">
                        <?php foreach ($menu as $title => $m):$active = strtolower($service)==strtolower($m)?'active':''; ?>
                            <li class="<?php echo $active; ?>"><a data-service="<?php echo $m; ?>" data-toggle="url"><?php echo T($title); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
    <!-- END MENU -->
</div>
<div class="portlet light ">

    <div>
        <h4 class="profile-desc-title"><?php echo T('联系方式'); ?></h4>
        <div class="margin-top-20 profile-desc-link">
            <i class="fa fa-phone-square"></i>
            <a href="#"><?php echo DI()->config->get('sys_setting.phone'); ?></a>
        </div>
        <div class="margin-top-20 profile-desc-link">
            <i class="fa fa-envelope"></i>
            <a href="#"><?php echo DI()->config->get('sys_setting.email'); ?></a>
        </div>
        <div class="margin-top-20 profile-desc-link">
            <i class="fa fa-qq"></i>
            <a href="#"><?php echo DI()->config->get('sys_setting.qq'); ?></a>
        </div>
        <div class="margin-top-20 profile-desc-link">
            <i class="fa fa-weixin"></i>
            <a href="#"><?php echo DI()->config->get('sys_setting.weixin'); ?></a>
        </div>
    </div>
</div>
<!-- END PORTLET MAIN -->