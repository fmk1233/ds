<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title><?php echo T('title'); ?>后台登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo URL_ROOT; ?>/favicon.ico">
    <link href="<?php echo URL_ROOT . '/static/' ?>css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo URL_ROOT . '/static/' ?>css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT . '/static/'; ?>css/login.css">
    <link href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <script src="<?php echo URL_ROOT . '/static/'; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/ladda/spin.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/ladda/ladda.min.js"></script>
    <script>
        var baseURL = '<?php echo URL_ROOT;?>';
        var admin = true;
        $(document).ready(function () {
            $('#verify').on('click', function () {
                $('#verify').attr('src', '<?php echo Common_Function::url(array('service' => 'Public.verify')) ?>');
            });
        });
    </script>
    <script src="<?php echo URL_ROOT . '/static/'; ?>js/pass_aes.js"></script>
    <script src="<?php echo URL_ROOT . 'static/'; ?>js/base.js"></script>
</head>
<body>
<form onsubmit="return false" id="login">
    <div class="img">
<!--        <img src="--><?php //echo URL_ROOT . '/static/'; ?><!--image/15.png">-->
        <div class="img-login-box">
            <h2><span class="tite-2"><?php echo T('title'); ?></span></h2>
            <input type="hidden" name="service" value="DPublic.DoLogin">
            <ul class="login-box">
                <li class="user-h">
                    <span class="login-user2 "></span><input name="username" type="text" class="login-user " value="" placeholder="会员编号"  /></li>
                <li class="user-h">
                    <span class="login-pwd3 "></span>
                    <input name="password" type="password" class="login-pwd" value="" placeholder="密码" />
                </li>
                <li class="user-h">
                    <input name="verify" style="padding-left: 10px;" type="password"  value="" placeholder="验证码" />
                    <img id="verify" title="点击换一张" style="width: 60px !important;height: 40px;margin-left: 4px;" src="<?php echo Common_Function::url(array('service' => 'Public.verify')) ?>">
                </li>

                <li class="user-h1"><input name="" type="submit" class="login-btn" value="立即登录"/>
                <li>
            </ul>

        </div>
        <div class="loginbm"><?php echo DI()->config->get('sys_setting.copyright'); ?></div>
    </div>
</form>

</body>
<script type="text/javascript">
    $(function () {

        bindFormAjax($('#login'), function (d) {
            if (d.code == 40000) {
                successMsg(d);
            } else {
                $('#verify').trigger('click');
                alertMsg(d);
            }
        });
    });
</script>
</html>