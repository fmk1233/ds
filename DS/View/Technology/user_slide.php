<div class="contact-box" style="min-height: 458px;overflow: hidden;">
    <div class="grmsg-top">
        <h3 class="contact-dt"><?php echo T('个人信息'); ?></h3>

        <div>
            <div class="text-center">
                <img alt="image" class="img-circle m-t-xs img-responsive "
                     src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
                     width="100" id="headerImg"
                     style="margin: 0 auto; margin-bottom: 20px;">


                <div class="user-msgb"><span class="user-msgb-number"><?php echo T('用户编号'); ?>
                        <!--                                                        <i class="fa fa-user"></i>-->
                        <?php echo $user['user_name']; ?> </span></div>

                <div class="user-msgb"><span class="user-msgb-name"><?php echo T('用户姓名'); ?>
                        <!--                                                        <i class="fa fa-bookmark"></i>-->
                        <?php echo $user['true_name']; ?></span>
                </div>
                <div class="user-msgb">
                    <span class="user-msgb-level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                </div>

            </div>
        </div>
    </div>

    <div class="grmsg-bottom">
        <div class="">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"><?php echo T('激活'); ?></span>
                    <h5><i class="fa fa-users"></i> <?php echo T('团队'); ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <span> <?= $active_num;?> </span>
                        <i class="fa fa-users  pull-right"
                           style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>
                    <small><?php echo T('人数'); ?></small>
                </div>
            </div>
        </div>
    </div>

    <div class="grmsg-bottom">
        <div class="">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right"><?php echo T('直推'); ?></span>
                    <h5><i class="fa fa-user-plus"></i> <?php echo T('推荐'); ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <span> <?= $tj_num;?> </span>
                        <i class="fa fa-user-plus  pull-right"
                           style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>
                    <small><?php echo T('人数'); ?></small>
                </div>
            </div>
        </div>
    </div>

</div>