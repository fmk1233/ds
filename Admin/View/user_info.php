<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>会员资料修改</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content clr" >
                    <form class="form-horizontal col-md-9 col-md-offset-1" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="DUser.ChangeUserInfo" name="service"/>
                        <input type="hidden" value="<?php echo $user['id']; ?>" name="userid"/>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 会员编号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" readonly name="username" value="<?php echo $user['user_name'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户状态：</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline">
                                    <input type="radio" value="0" name="state" <?php if($user['state']==0){echo 'checked';}else{echo '';}?> >未激活</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="1" name="state" <?php if($user['state']==1){echo 'checked';}else{echo '';}?>>正常</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="2" name="state" <?php if($user['state']==2){echo 'checked';}else{echo '';}?>>冻结</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label"><span class="text-danger">*</span> 一级密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="password" name="password"
                                       placeholder="不填默认不修改">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="" id="password2" name="password2"
                                       placeholder="不填默认不修改">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('省份'),'、',T('城市'),'、',T('地区'); ?></label>

                            <div class="col-sm-10">
                                <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('性别'); ?></label>

                            <div class="col-sm-10">
                                <?php $sexs= DI()->config->get('app.sex'); foreach($sexs as $key=>$val): ?>
                                    <input name="sex" type="radio" value="<?php echo $key ?>" <?php echo  $key==$user['sex']?'checked':''; ?>> &nbsp;<?php echo $val; ?>
                                <?php endforeach;?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" value="<?php echo $user['mobile'];?>" >
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
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        new PCAS('province','city','area','<?php echo $user['province'];?>','<?php echo $user['city'];?>','<?php echo $user['area'];?>');
        bindFormAjax($('form'));
    });
</script>

</html>
