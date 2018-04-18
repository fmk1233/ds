<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>系统初始化</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="alert alert-danger">
                        <button aria-hidden="true" data-dismiss="alert " class="close" type="button">×</button>
                        执行此操作后部分数据将被清除！请谨慎操作！！！
                    </div>

                    <form method="post" id="setting" class="layui-form layui-box" onsubmit="return false;">
                        <input type="hidden" value="Setting.ClearData" name="service"/>
                        <input type="hidden" value="post" name="type"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label">清除验证</label>
                            <div class="layui-input-block">
                                <input type="password" name="password" required  lay-verify="required" placeholder="请输入二级密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block" style="text-align: center;">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">确定初始化数据</button>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block" style="text-align: center;">
                                v_1.1.7
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<?php $this->view('footer_js'); ?>
<script type="text/javascript">
    $(function () {
      layui.use('form',function () {
          var form = layui.form();
          //监听提交
          form.on('submit(formDemo)', function (data) {
              confirmMsg('您确认要清空数据，一经清空无法还原',function () {
                  sendButtonAjax($(data.elem),data.field);
              });
              return false;
          });
      });
    });
</script>

</html>
