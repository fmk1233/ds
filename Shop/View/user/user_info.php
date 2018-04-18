<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--个人信息样式-->
<div class="user_style clearfix">
    <div class="user_center">
        <div class="left_style">
            <?php $this->view('user/user_left'); ?>
        </div>
        <!--右侧样式-->
        <div class="right_style">
            <div class="info_content">
                <!--个人信息-->
                <form class="Personal_info layui-form" id="Personal" onsubmit="return false;">
                    <div class="title_Section"><span>个人信息</span></div>

                    <div class="xinxi">
                        <input type="hidden" value="User.ChangeInfo" name="service"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label">用户性别：</label>
                            <div class="layui-input-block">
                                <input type="radio" name="sex" value="1" title="男" <?php echo $user['sex']==1?'checked':''; ?>>
                                <input type="radio" name="sex" value="2" title="女" <?php echo $user['sex']==2?'checked':''; ?>>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">身份证号：</label>
                            <div class="layui-input-block">
                                <input type="text" name="idcard" placeholder="请输入身份证号" autocomplete="off" class="layui-input" value="<?php echo $user['idcard']; ?>" >
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">支付宝号：</label>
                            <div class="layui-input-block">
                                <input type="text" name="alipay" placeholder="请输入支付宝号" autocomplete="off" class="layui-input"  value="<?php echo $user['alipay']; ?>" >
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">微信号：</label>
                            <div class="layui-input-block">
                                <input type="text" name="weixin" placeholder="请输入微信号" autocomplete="off" class="layui-input"  value="<?php echo $user['weixin']; ?>" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">QQ号：</label>
                            <div class="layui-input-block">
                                <input type="text" name="qq" placeholder="请输入QQ号" autocomplete="off" class="layui-input"  value="<?php echo $user['qq']; ?>" />
                            </div>
                        </div>
                        <div class="bottom">
                            <input  lay-submit lay-filter="formDemo" type="submit" value="确认修改" class="confirm"/></div>
                    </div>
                    <ul class="Head_portrait">
                        <li class="User_avatar"><img src="<?php echo $path; ?>images/people.png"/></li>
                        <li><input  type="submit" value="上传头像" class="submit"/></li>
                    </ul>
                </form>
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

