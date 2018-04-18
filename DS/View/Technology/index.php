<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php $this->view('header') ?>
    <link href="<?php echo URL_ROOT . '/static/'; ?>ds/technology/css/login.css" rel="stylesheet">
    <link href="<?php echo URL_ROOT . '/static/'; ?>css/components-rounded.min.css" rel="stylesheet"
          id="style_components" type="text/css"/>
</head>

<body class="login" style="overflow: hidden;">

<div class="logo">
    <a href="" target="_parent"
       style="display: block; margin: 0px 0 0 37%; line-height: 50px; height: 50px; overflow: hidden;">
        <img src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
             style="width:50px; margin-right: 20px; height: 50px; float: left; "/>
        <b style="font-size: 30px;color:#FFF;  float: left;margin-left: 2%;"><?php echo DI()->config->get('sys_setting.home_title') ?></b>
    </a>
</div>

<div class="content" style="min-width: 300px; background-color: #FFF;opacity: 0.9;">

    <form class="login-form" method="post" style="margin:0px; padding:0px" onsubmit="return false;" id=loginform>
        <h3 class="form-title"><?php echo T('会员登陆'); ?></h3>
        <input type="hidden" value="Default.DoLogin" name="service"/>
        <div class="form-group">

            <label class="control-label visible-ie8 visible-ie9"><i class="fa fa-user"></i><?php echo T('会员编号'); ?>
            </label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off"
                   placeholder="<?php echo T('请输入'), T('会员编号'); ?>" value="" name="username"
                   style="background-color: #f1f3f8"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo T('一级密码'); ?></label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off"
                   placeholder="<?php echo T('请输入'), T('一级密码'); ?>" name="password" value=""
                   style="background-color: #f1f3f8"/>
        </div>
        <?php $verify = DI()->config->get('sys_setting.home_verify');
        if (!empty($verify)): ?>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">验证码</label>
                <div class="row">
                    <div class="col-xs-6">
                        <input style="background-color: #f1f3f8"
                               class="form-control form-control-solid placeholder-no-fix"
                               type="text" autocomplete="off" placeholder="验证码" name="verifycode"/>
                    </div>
                    <div class="col-xs-6">
                        <div class="fr"><img
                                    src="<?php echo Common_Function::url(array('service' => 'Public.verify')); ?>"
                                    width="100" height="40" align="absmiddle"
                                    onClick="<?php echo Common_Function::url(array('service' => 'Public.verify')) ?>"
                                    alt="<?php echo T('点击换一张'); ?>"
                                    style="cursor:pointer; padding-top: 0px;margin-left: 25px"/></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-actions" style="border-bottom: none;padding-top: 0;padding-bottom: 5px;">
            <button type="submit" class="btn btn-success uppercase" style="width: 100%"><?php echo T('登录'); ?></button>
            <label class="rememberme check">为获得最佳使用体验，请使用Chrome浏览器</label>
        </div>
    </form>
</div>
<div class="copyright" style="color:#FFF">
    <?php echo DI()->config->get('sys_setting.copyright'); ?>
</div>

<?php $this->view('footer_js'); ?>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/backstretch/jquery.backstretch.min.js'); ?>"
        type="text/javascript"></script>
<script>
    $(function () {

        <?php if(count($advs)>0): ?>
        $.backstretch([
                <?php foreach($advs as $adv): ?>
                "<?php echo Common_Function::GoodsPath($adv['icon']); ?>",
                <?php endforeach;?>
            ], {
                fade: 1000,
                duration: 8000
            }
        );
        <?php endif; ?>
        bindFormAjax($('#loginform'), function (d) {
            if (d.code == 40000) {
                successMsg(d, function () {
                    location.href = '<?php echo Common_Function::url(array('service' => 'User.Main')); ?>';
                });
            } else {
                alertMsg(d);
            }
        });
    });
</script>
</body>
<!-- END BODY -->
</html>