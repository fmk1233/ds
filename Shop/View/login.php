<?php $this->view('common/header') ?>
<link href="<?php echo $path; ?>css/Orders.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path; ?>css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="<?php echo $path; ?>js/jquery.reveal.js" type="text/javascript"></script>
<style type="text/css">
    .Reg_log-box{background-color: #cf000e; width: 100%; padding: 50px 0;}
    .Reg_log-left{float: left;}
    .Reg_log_style{float: right; width: 460px;}
    .center-reg-box{width: 1200px; margin: 0 auto;}
    .Reg_log_style .login_style .title_name span{  left: 155px;  }
    .Reg_log_style .login_style .add_login{width: 400px;}
    .Reg_log_style .frame_style{width:388px; }
    .Reg_log_style .frame_style.form_error i{display: none;}
    .Reg_log_style .frame_style input{width: 307px;}
    .Login_Method{background-color: #FFF;}
    .Reg_log-left{margin-top: 20px;}
    .header_top-1 #header{height: 90px;}
    .header_top-1 .Right{float: right; margin-top: 76px;}
</style>
<div id="header_top" class=" header_top-1">
    <div id="header" class="header page_style">
        <div class="logo"><a data-toggle="url" data-service="Default.Index"><img src="<?php echo $path; ?>images/logo.png"></a></div>
        <div id="" class="nav Right">
            <a data-toggle="url" data-service="Default.Index">返回首页</a>
        </div>
    </div>
</div>
<div class="Reg_log-box">
    <div class="center-reg-box">
        <div class="Reg_log-left"><img src="<?php echo $path; ?>images/h-gou.png"></div>
        <div class="Reg_log_style">
            <div class="login_style">
                <!--<div class="right_img"><img src="images/bg_name_05.png" /></div>-->
                <form  class="sign_area layui-form" autocomplete="off" onsubmit="return false;">
                    <input type="hidden" value="Default.DoLogin" name="service"/>
                    <div class="title_name"><span>登录</span></div>
                    <div class="login_m_1">
                        <div class="add_login">
                            <ul>
                                <li class="frame_style">
                                    <label class="user_icon"></label>
                                    <input name="username" type="text" id="user_text"/>
                                    <i>用户名/邮箱</i>
                                </li>
                                <li class="frame_style">
                                    <label class="password_icon"></label>
                                    <input name="password" type="password" id="tbPassword"/>
                                    <i>密码</i>
                                </li>
                            </ul>
                          <!--  <div class="auto_login clearfix">
                                <p class="clearfix">
                                    <a id="check_agreement" href="#" class="check_agreement">自动登录</a>
                                    <input id="autoLoginCheck" type="hidden">
                                    <span id="agreement_tips" class="auto_tips" style="">请勿在公用电脑上启用</span>
                                </p>
                                <div class="forget_pswd" >
                                    <a href="Registered.html" tabindex="-1">注册</a> |
                                    <a href="#" tabindex="-1">忘记密码？</a>
                                </div>
                            </div>-->
                            <div class="center clearfix" >
                                <a class="btn_pink" id="btn_signin" lay-submit lay-filter="login" href="javascript:void(0)">立即登录</a>
                            </div>


                            <div class="Login_Method">
                               <!-- <div class="title">
                                    <span>第三方登录方式</span>
                                </div>
                                <div>
                                    <a href="#">
                                        <img src="<?php /*echo $path; */?>images/l_1.png" />
                                    </a>
                                    <a href="#">
                                        <img src="<?php /*echo $path; */?>images/l_2.png" />
                                    </a>
                                    <a href="#">
                                        <img src="<?php /*echo $path; */?>images/l_4.png" />
                                    </a>
                                </div>-->
                            </div>
                        </div>
                    </div>

                </form>
                <!--其他登录方式-->

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php $this->view('common/footer.php');  ?>
<script type="text/javascript">
    $(function () {
       layui.use('form',function () {
            var form = layui.form();
            form.on('submit(login)',function (data) {
                sendButtonAjax(data.elem,data.field);
                return false;
            })
       });
    });
</script>