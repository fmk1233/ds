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
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <!--左侧导航-手机不显示-->
                <div class="col-xs-12 zs-md-2 hidden-xs hidden-sm">
                    <div class="profile-sidebar">
                        <?php $this->view('profile_side') ?>
                    </div>

                </div>
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('安全密码'); ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <form class="form-inline col-md-9 col-md-offset-1" role="form" class="form" onsubmit="return false;" method="post" action="">

                                            <input type="hidden" name="service" value="User.SecAc" >
                                            <div class="form-group">
                                                <label for="password">* <?php echo T('安全密码'); ?> </label>
                                                <input type="password" class="form-control"  name="password" placeholder="<?php echo T('请输入'),T('安全密码'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only"></label>
                                                <button type="submit" class="btn-success btn"><?php echo T('确认'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!--END 主体-->
    </div>
    <!--END 主体-->

    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->

</div>
<?php $this->view('footer_js'); ?>
<script>
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</body>
</html>