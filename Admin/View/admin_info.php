<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>后台资料</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content clr" >
                    <form class="form-horizontal col-md-9 col-md-offset-1" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 会员编号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="user_name"  name="user_name" value="<?php echo $admin['admin_name'];?>" placeholder="请输入会员编号">
                            </div>
                            <input type="hidden" name="adminid" value="<?php echo $admin['id'];?>">
                            <input type="hidden" name="service" value="Admin.changeAdminInfo">
                        </div>
                        <?php if($admin['id']!=1): ?>
                            <div class="form-group">
                                <label for="auth_id" class="col-sm-2 control-label"><span class="text-danger">*</span> 部门</label>
                                <div class="col-sm-10">
                                    <select name="auth_id" id="auth_id" class="form-control">
                                        <?php foreach($powers as $power): ?>
                                            <option value="<?php echo $power['id']; ?>" <?php if($power['id']==$admin['power_id'])echo 'selected';?>> <?php echo $power['dep_name']; ?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="newpassword" name="newpassword"
                                       placeholder="请输入密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="renewpassword" name="renewpassword"
                                       placeholder="请输入确认密码">
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 二级密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="sec_pwd" name="sec_pwd"
                                       placeholder="请输入二级密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 确认二级密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="resec_pwd" name="resec_pwd"
                                       placeholder="请输入确认二级密码">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success " type="submit">确定提交</button>
                                <button class="btn btn-primary " type="button" onclick="javascript:history.back();">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script type="text/javascript">
    $(function () {
        bindFormAjax($('form'));
    });
</script>

</html>
