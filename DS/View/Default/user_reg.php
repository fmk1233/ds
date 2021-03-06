<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<link href="<?php echo Common_Function::GoodsPath('/css/plugins/city-picker/city-picker.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<script type="text/javascript">
    var isUser = true;
</script>
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
                        <div class="page-content-title">
                            <h1> <?php echo T('会员申请'); ?>
                                <small>（<?php echo T('打{type}号为必填项',array('type'=>'<i class="ui-text-danger">*</i>')); ?>）</small>
                            </h1>
                            <!--<a href="javascript:history.go(-1)" class="table-btn"><?php /*echo T('返回'); */?><i
                                    class="fa fa-arrow-circle-left"></i></a>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal  layui-form" id="form1" onsubmit="return false;">
                                    <input type="hidden" value="User.Register" name="service"/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><i class="ui-text-danger">*</i> <?php echo T('会员编号'); ?> </label>
                                        <div class="col-sm-8">
                                            <input name="username" type="text" required lay-verify="required" class="form-control" value="<?php echo $user_name; ?>" placeholder="<?php echo T('输入'), T('会员编号'); ?>"  <?php $user_regs = Domain_System::getUserReg(); echo $user_regs['open']==1?'readonly':''; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><i class="ui-text-danger">*</i> <?php echo T('会员姓名'); ?> </label>
                                        <div class="col-sm-8">
                                            <input name="realname" type="text" required lay-verify="required" class="form-control" value="" placeholder="<?php echo T('输入'), T('会员姓名'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('一级密码'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="123456" name="password" placeholder="<?php echo T('输入'), T('一级密码'); ?>"><span class="input-group-addon"><?php echo T('默认密码'); ?>：123456</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('确认'), T('一级密码'); ?></label>
                                        <div class="col-sm-8">
                                                <input type="password" class="form-control" value="123456" name="repassword" placeholder="<?php echo T('输入'),T('确认'), T('一级密码'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('安全密码'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="123456" name="password2" placeholder="<?php echo T('输入'), T('安全密码'); ?>"><span class="input-group-addon"><?php echo T('默认密码'); ?>：123456</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('确认'), T('安全密码'); ?></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" value="123456" name="repassword2" placeholder="<?php echo T('输入'),T('确认'), T('安全密码'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('会员级别'); ?></label>
                                        <div class="col-sm-8">
                                            <select name="rank" class="form-control">
                                                <?php $grades=Common_Function::getRankName(); foreach($grades as $key=>$grade): ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $grade; ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('推荐人编号'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $user_pid; ?>"  name="p_user_name" id="p_user_name" placeholder="<?php echo T('输入'),T('推荐人编号'); ?>">
                                            <div class="help-block info"></div>
                                        </div>
                                    </div>
                                    <?php if(POSNUM > 1): ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('接点人编号'); ?></label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?php echo $user_rid; ?>" id="r_user_name" name="r_user_name"  placeholder="<?php echo T('输入'),T('接点人编号'); ?>">
                                                <div class="help-block info"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('市场位置'); ?></label>
                                            <div class="col-sm-8">
                                                <select name="pos" class="form-control">
                                                    <?php  $posNames = Common_Function::getPosName(); foreach($posNames as $key=>$posName): ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $key==$pos?'selected':''; ?>><?php echo $posName; ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo T('性别'); ?></label>

                                        <div class="col-sm-8">
                                            <?php $sexs= DI()->config->get('app.sex'); foreach($sexs as $key=>$val): ?>
                                                <input name="sex" type="radio"
                                                       value="<?php echo $key; ?>" <?php echo $key == 1 ? 'checked' : ''; ?>
                                                       title="<?php echo $val; ?>">
                                            <?php endforeach;?>
                                          
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span
                                                    class="text-danger">*</span> <?php echo T('省市区')?>
                                        </label>

                                        <div class="col-sm-8">
                                            <select name="province" lay-ignore class="form-control" style="width: 20%;float: left;"></select>
                                            <select name="city" lay-ignore class="form-control" style="width: 20%;float: left;"></select>
                                            <select name="area" lay-ignore class="form-control" style="width: 39%;float: left;"></select>
                                        </div>
                                    </div>
                                    <?php $regs = DI()->config->get('user_reg.会员注册是否显示项');
                                    foreach ($regs as $key => $reg): ?>
                                        <?php if (in_array($reg, $user_regs['power_1'])):?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">
                                                    <?php $flag = false;
                                                    if (in_array($reg, $user_regs['power_2'])): $flag = true; ?>
                                                        <span class="text-danger">*</span>
                                                    <?php endif; ?>
                                                    <?php echo T($key); ?></label>
                                                <div class="col-sm-8">
                                                    <input type="text" <?php echo $reg == 'mobile'&&$flag ? 'required lay-verify="phone" ' : ($flag ? ('required lay-verify="required" ') : ''); ?>
                                                           class="form-control" name="<?php echo $reg; ?>"
                                                           placeholder="<?php echo T('输入'), T($key); ?>">
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php if($protocol['state'] == 1){?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span
                                                        class="text-danger">*</span> <?php echo T($protocol['title']); ?></label>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <div class="panel-group" id="accordion">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false"><?php echo T('点击查看协议详情'); ?></a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="panel-body">
                                                                    <?= html_entity_decode($protocol['content']);?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>

                                            <div class="col-sm-8">
                                                <input name="agree" required lay-verify="required" type="checkbox" value="1" checked>
                                                <?php echo T('我已阅读并同意以上协议'); ?>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn blue mt-clipboard"  type="button" lay-submit lay-filter="formDemo"><i
                                                        class="fa fa-check"></i> <?php echo T('注册'); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
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
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/app/user_reg.js'); ?>"></script>
</body>
</html>