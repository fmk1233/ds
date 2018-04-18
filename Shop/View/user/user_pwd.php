<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--个人信息样式-->
<div class="user_style clearfix">
    <div class="user_center">
        <div class="left_style">
            <?php $this->view('user/user_left') ?>
        </div>
        <!--右侧样式-->
        <div class="right_style">
            <div class="info_content layui-form">
                <!--修改密码样式-->
                <div class="change_Password">
                    <input type="hidden" name="service" value="User.PwdEdit"/>
                    <input type="hidden" name="action" value="pwd"/>
                    <div class="title_Section"><span>修改密码</span></div>
                    <ul class="p_modify">
                        <div class="Note">暂只支持原密码修改，不支持邮箱电话验证密码修改</div>
                        <li><label>原密码</label><input name="old_pass" type="Password" class="text_Password"/></li>
                        <li class="new_password">
                            <label>新密码</label>
                            <div class="ywz_zhuce_xiaoxiaobao">
                                <div class="ywz_zhuce_kuangzi"><input name="password" type="password" id="tbPassword"
                                                                      class="ywz_zhuce_kuangwenzi1 text_Password"></div>
                                <div class="ywz_zhuce_huixian padl10" id="pwdLevel_1">弱</div>
                                <div class="ywz_zhuce_huixian" id="pwdLevel_2">中</div>
                                <div class="ywz_zhuce_huixian" id="pwdLevel_3">强</div>
                            </div>
                            <div class="ywz_zhuce_yongyu1">
                                <span id="pwd_err" style="color: rgb(255, 0, 0)">6-16位，由字母（区分大小写）、数字、符号组成</span>
                            </div>
                        </li>
                        <li><label>确认密码</label><input name="confirm_password" type="Password" class="text_Password"/></li>
                        <li><input lay-submit lay-filter="formDemo" type="submit" class="bnt_blue_1" style="border:none;" value="确认修改">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript">
    $(function () {
        layui.use('form', function () {
            var form = layui.form();
            form.on('submit(formDemo)',function (data) {
                sendButtonAjax($(data.elem),data.field);
                return false;
            });
        });
    })
</script>

