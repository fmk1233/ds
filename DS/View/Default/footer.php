<div class="page-wrapper-row">
    <div class="page-wrapper-bottom">
        <!-- BEGIN FOOTER -->
        <!-- BEGIN PRE-FOOTER -->
        <div class="page-prefooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 footer-block">
                        <h2><?php echo T('title'); ?></h2>
                        <p><?php echo DI()->config->get('sys_setting.des'); ?></p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 footer-block">
                        <h2><?php echo T('联系我们'); ?></h2>
                        <p><?php echo T('电话'); ?>：<?php echo DI()->config->get('sys_setting.phone'); ?></p>
                        <p><?php echo T('邮箱'); ?>：<?php echo DI()->config->get('sys_setting.email'); ?></p>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 footer-block img-icon-box hidden-xs hidden-sm">
                        <a href="javascript:;" class="img-icon-aq"></a>
                        <a href="javascript:;" class="img-icon-cx"></a>
                        <a href="javascript:;" class="img-icon-ba"></a>
                        <a href="javascript:;" class="img-icon-360"></a>


                    </div>
                </div>
                <div class="row index-foot">
                    <?php echo DI()->config->get('sys_setting.copyright'); ?> <?php echo DI()->config->get('sys_setting.icp'); ?>
                </div>
            </div>
        </div>
        <!-- END PRE-FOOTER -->
        <!-- BEGIN INNER FOOTER -->

        <div class="scroll-to-top" style="display: block;">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END INNER FOOTER -->
        <!-- END FOOTER -->
    </div>
</div>