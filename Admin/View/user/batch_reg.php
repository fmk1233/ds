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
                    <h5>批量注册</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" id="setting" class="layui-form layui-box" onsubmit="return false;">
                        <input type="hidden" value="DUser.BatchReg" name="service"/>
                        <input type="hidden" value="post" name="action"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label">注册人数</label>
                            <div class="layui-input-block">
                                <input type="text" name="num" required lay-verify="required|number"
                                       placeholder="请输入注册人数" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">推荐人编号</label>
                            <div class="layui-input-block">
                                <input type="text" name="username" placeholder="请输入推荐人编号" autocomplete="off"
                                       class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block" style="text-align: center;">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">确定</button>
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
        layui.use('form', function () {
            var form = layui.form();
            //监听提交
            form.on('submit(formDemo)', function (data) {
                sendButtonAjax($(data.elem), data.field);
                return false;
            });
        });
    });
</script>

</html>
