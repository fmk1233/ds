<?php $this->view('common/header') ?>
<link href="<?php echo $path; ?>css/Orders.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $path; ?>css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="<?php echo $path; ?>js/jquery.reveal.js" type="text/javascript"></script>
<style type="text/css">
    .header_top-1 #header {
        height: 100px;
    }

    .header_top-1 .Right {
        float: right;
        margin-top: 86px;
    }

    .h_Reg_log {
        width: 1200px;
        margin: 0 auto;
        border: 1px solid #d7d7d7;
        padding: 10px 0px 30px;
    }

    .h_Reg_log_box {
        width: 100%;
    }

    .Reg_log_style .login_style .login_m_1, .Reg_log_style .regist_style .regist_m_1 {
        border: none;
        padding: 10px 20px 20px;
    }

    .Reg_log_style .login_style .title_name, .Reg_log_style .regist_style .title_name {
        border-bottom: none;
        position: relative;
        height: 70px;
    }

    .Reg_log_style .login_style .title_name span, .Reg_log_style .regist_style .title_name span {
        width: 150px;
        color: #333;
        height: 70px;
        border: none;
        text-align: center;
        line-height: 70px;
        left: 0;
        display: block;
        background: transparent;
        font-size: 24px;
    }

    .Reg_log-right {
        float: right;
    }

    .Reg_log-right img {
        width: 520px;
        margin-top: 60px;
        margin-right: 30px;
    }

    .Reg_log_style {
        float: left;
    }

    .Reg_log_style .frame_style.form_error i {
        display: none;
    }
    .Reg_log_style .frame_style select {
        height: 40px;
        padding: 5px 20px;
        border: 0px;
        width: 300px;
        font-size: 16px;
    }
    .Reg_log_style .frame_style .Codes_region span{
        margin-left: 10px;
        font-size: 15px;
        line-height: 52px;
    }
</style>
<div id="header_top" class=" header_top-1">
    <div id="header" class="header page_style">
        <div class="logo"><a data-toggle="url" data-service="Default.Index"><img
                        src="<?php echo $path; ?>images/logo.png"></a></div>
        <div id="" class="nav Right">
            <a data-toggle="url" data-service="Default.Login" tabindex="-1"><img class="rgt-zcimg" alt="登录"
                                                                                 src="<?php echo $path; ?>images/login-2.png">登录</a>
            |
            <a data-toggle="url" data-service="Default.Index">返回首页</a>
            <!--|-->
            <!--<a href="help.html" target="_blank">帮助中心</a>-->
        </div>
    </div>
</div>
<div class="h_Reg_log_box">
    <div class="h_Reg_log">
        <div class="Reg_log_style">
            <div class="regist_style">
                <form id="register" class="sign_area" autocomplete="off">
                    <div class="title_name"><span>注册</span></div>
                    <div class="regist_m_1">
                        <div class="add_regist">
                            <ul>
                                <li class="frame_style"><label class="user_icon"></label><input name="" type="text"
                                                                                                id="user_text"/><i>用户名</i>
                                </li>
                                <li class="frame_style"><label class="password_icon"></label>
                                    <input name="tbPassword"  type="password" id="tbPassword" class="ywz_zhuce_kuangwenzi1 text_Password"/><i class="tx_password">6-16位，由字母（区分大小写）、数字、符号组成</i> <div class="Codes_region">3の3333</div></li>
                                <div class="ywz_zhuce_xiaoxiaobao">
                                    <div class="ywz_zhuce_huixian" id="pwdLevel_1">弱</div>
                                    <div class="ywz_zhuce_huixian" id="pwdLevel_2">中</div>
                                    <div class="ywz_zhuce_huixian" id="pwdLevel_3">强</div>
                                </div>
                                <li class="frame_style">
                                    <select name="e">
                                        <option value="0">大</option>
                                        <option value="1">大</option>
                                        <option value="2">大</option>
                                    </select>
                                    <div class="Codes_region"><span>看到了</span></div>
                                </li>
                                <li class="frame_style"><label class="Codes_icon"></label>
                                    <input name="" type="text" /><i>独守空房</i>
                                    <div class="Codes_region"></div>
                                </li>
                            </ul>
                            <div class="auto_login clearfix">
                                <p class="clearfix">
                                    <a id="check_agreement" href="#" class="check_agreement">我已阅读相关规定</a>
                                    <input id="autoLoginCheck" type="hidden">
                                    <span id="agreement_tips" class="auto_tips" style=""></span>
                                </p>
                                <a href="#" target="_blank" class="forget_pswd" tabindex="-1">《商城用户协议》</a>
                            </div>
                            <div class="center clearfix"><a class="btn_pink" id="btn_signin" href="javascript:void(0)">立即注册</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="Reg_log-right"><img src="<?php echo $path; ?>images/h-gou.png"></div>
        <div class="clearfix"></div>
    </div>
</div>

<?php $this->view('common/footer.php'); ?>
<script type="text/javascript">
    $(function () {
        layui.use('form', function () {
            var form = layui.form();
            form.on('submit(login)', function (data) {
                sendButtonAjax(data.elem, data.field);
                return false;
            })
        });
    });
</script>