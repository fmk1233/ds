<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>系统参数设置</h5>
                </div>
                <div class="ibox-content" style="overflow:hidden;">
                    <div class="clients-list">
                        <form method="post" id="setting" enctype="multipart/form-data" class="form-horizontal"
                              onsubmit="return false;">
                            <input type="hidden" value="Setting.DoSysSetting" name="service"/>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统名称：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[name]"
                                               value="<?php echo isset($setting['name']) ? $setting['name'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统简介：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[des]"
                                               value="<?php echo isset($setting['des']) ? $setting['des'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统ico图标：</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="ico">
                                        <div class="help-block"><img style="max-height: 60px"
                                                                     src="<?php echo Common_Function::GoodsPath('/../favicon.ico') ?>">请上传<b class="text-danger">正方形</b>ICO图标
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统logo：</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="logo">
                                        <div class="help-block"><img style="max-height: 60px"
                                                                     src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png') ?>">请上传<b class="text-danger">正方形</b>png图片
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">电话：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[phone]"
                                               value="<?php echo isset($setting['phone']) ? $setting['phone'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[email]"
                                               value="<?php echo isset($setting['email']) ? $setting['email'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">QQ号：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[qq]"
                                               value="<?php echo isset($setting['qq']) ? $setting['qq'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[weixin]"
                                               value="<?php echo isset($setting['weixin']) ? $setting['weixin'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">备案号ICP：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[icp]"
                                               value="<?php echo isset($setting['icp']) ? $setting['icp'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">版权：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[copyright]"
                                               value="<?php echo isset($setting['copyright']) ? $setting['copyright'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">前端登录页标题：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[home_title]"
                                               value="<?php echo isset($setting['home_title']) ? $setting['home_title'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">后端登录页标题：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[admin_title]"
                                               value="<?php echo isset($setting['admin_title']) ? $setting['admin_title'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">登陆输入验证码：</label>
                                    <div class="col-sm-10">
                                        <input type="radio" name="sys[home_verify]"
                                               value="0" <?php echo empty($setting['home_verify']) ? 'checked' : '' ?>/>不验证
                                        <input type="radio" name="sys[home_verify]"
                                               value="1" <?php echo empty($setting['home_verify']) ? '' : 'checked' ?>/>验证

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统状态：</label>
                                    <div class="col-sm-10">
                                        <input type="radio" name="sys[open]"
                                               value="0" <?php echo empty($setting['open']) ? 'checked' : '' ?>/>关闭
                                        <input type="radio" name="sys[open]"
                                               value="1" <?php echo empty($setting['open']) ? '' : 'checked' ?>/>开启

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">系统关闭提示语：</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sys[close_tips]"
                                               value="<?php echo isset($setting['close_tips']) ? $setting['close_tips'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">后台登录页：</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="admin_bg">
                                        <div class="help-block"><img style="max-height: 60px" src="<?php echo Common_Function::GoodsPath('/image/15.png') ?>">后台登录页背景图1154*768
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn-primary btn">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript">
    $(function () {
        bindFormAjax($('#setting'), null, true);
    });
</script>

</html>
