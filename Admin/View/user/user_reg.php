<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<link href="<?php echo Common_Function::GoodsPath('/css/plugins/city-picker/city-picker.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5><?php echo $market ? '市场注册' : '会员注册'; ?></h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content clr">
                    <form class="form-horizontal col-md-9 col-md-offset-1 layui-form" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="DUser.userRegAC" name="service">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 会员编号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" required lay-verify="required"
                                       name="username" value="<?= $user_name; ?>"
                                       placeholder="请输入会员编号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 会员姓名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="realname" required
                                       lay-verify="required" name="realname" value=""
                                       placeholder="请输入会员姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label"><span class="text-danger">*</span> 一级密码</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" value="123456" id="password"
                                           name="password" placeholder="请输入一级密码"><span class="input-group-addon">默认密码：123456</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repassword" class="col-sm-2 control-label"><span class="text-danger">*</span>
                                一级确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" value="123456" id="repassword"
                                       name="repassword"
                                       placeholder="请输入一级确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span>
                                安全密码</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" value="123456" id="password2"
                                           name="password2" placeholder="请输入一级密码"><span class="input-group-addon">默认密码：123456</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repassword2" class="col-sm-2 control-label"><span class="text-danger">*</span>
                                确认安全密码</label>
                            <div class="col-sm-10">

                                <input type="password" class="form-control" value="123456" id="repassword2"
                                       name="repassword2" placeholder="请输入安全确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span>
                                会员等级</label>
                            <div class="col-sm-10">
                                <select name="rank" class="form-control">
                                    <?php $grades = Common_Function::getRankName();
                                    foreach ($grades as $key => $grade): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $grade; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if ($market): ?>
                            <input type="hidden" value="1" name="market"/>
                            <!--<div class="form-group">
                                <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 市场</label>
                                <div class="col-sm-10">
                                    <select name="market" class="form-control">
                                        <option value="1">中国</option>
                                    </select>
                                </div>
                            </div>-->
                        <?php else:; ?>
                            <div class="form-group" style="margin-bottom: 0">
                                <label class="col-sm-2 control-label"><span class="text-danger">*</span> 推荐人编号</label>

                                <div class="col-sm-10">
                                    <input type="text" required lay-verify="required" class="form-control"
                                           value="<?php echo $user_pid; ?>"
                                           id="p_user_name" name="p_user_name"
                                           placeholder="请输入推荐人编号">
                                    <div class="help-block info"></div>
                                </div>
                            </div>
                            <?php if (POSNUM > 1): ?>
                                <div class="form-group" style="margin-bottom: 0">
                                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>
                                        接点人会员编号</label>

                                    <div class="col-sm-10">
                                        <input type="text" required lay-verify="required" class="form-control"
                                               value="<?php echo $user_rid; ?>" id="r_user_name" name="r_user_name"
                                               placeholder="请输入接点人会员编号">
                                        <div class="help-block info"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password2" class="col-sm-2 control-label"><span
                                                class="text-danger">*</span> 位置</label>
                                    <div class="col-sm-10">
                                        <select name="pos" class="form-control">
                                            <?php $posNames = Common_Function::getPosName();
                                            foreach ($posNames as $key => $posName): ?>
                                                <option value="<?php echo $key; ?>" <?php echo $key == $pos ? 'selected' : ''; ?>><?php echo $posName; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>


                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span
                                        class="text-danger">*</span> <?php echo T('省市区') ?>
                            </label>

                            <div class="col-sm-10">
                                <select name="province" lay-ignore class="form-control"
                                        style="width: 33.33333333%;float: left;"></select>
                                <select name="city" lay-ignore class="form-control"
                                        style="width: 33.33333333%;float: left;"></select>
                                <select name="area" lay-ignore class="form-control"
                                        style="width: 33.33333333%;float: left;"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span
                                        class="text-danger">*</span> <?php echo T('性别'); ?></label>

                            <div class="col-sm-10">
                                <?php $sexs = DI()->config->get('app.sex');
                                foreach ($sexs as $key => $val): ?>
                                    <input name="sex" type="radio"
                                           value="<?php echo $key; ?>" <?php echo $key == 1 ? 'checked' : ''; ?>
                                           title="<?php echo $val; ?>">
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <?php $regs = DI()->config->get('user_reg.会员注册是否显示项');
                        $user_regs = Domain_System::getUserReg();
                        foreach ($regs as $key => $reg): ?>
                            <?php if (in_array($reg, $user_regs['power_1'])):if ($reg == 'zmd_name' && $market) {
                                continue;
                            } ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <?php $flag = false;
                                        if (in_array($reg, $user_regs['power_2'])): $flag = true; ?>
                                            <span class="text-danger">*</span>
                                        <?php endif; ?>
                                        <?php echo T($key); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" <?php echo $reg == 'mobile'&&$flag ? 'required lay-verify="phone" ' : ($flag ? ('required lay-verify="required" ') : ''); ?>
                                               class="form-control" name="<?php echo $reg; ?>"
                                               placeholder="<?php echo T('输入'), T($key); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success " type="button" lay-submit lay-filter="formDemo">确定提交
                                </button>
                                <button class="btn btn-primary " type="button" onclick="javascript:history.back();">返回
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/app/user_reg.js'); ?>"></script>

</html>
