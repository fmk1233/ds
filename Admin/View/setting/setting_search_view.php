<!DOCTYPE html>
<html>

<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>热门搜索词 - 设置</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="layui-form layui-box" action="">
                        <input type="hidden" value="Setting.DoSearch" name="service"/>
                        <input type="hidden" value="post" name="type"/>
                        <input type="hidden" value="<?php echo $rec_search['id']; ?>" name="id"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: #f00">*</i> 搜索词</label>
                            <div class="layui-input-block">
                                <input type="text" name="search" required lay-verify="required" placeholder=""
                                       autocomplete="off" value="<?php echo $rec_search['search']; ?>" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">
搜索词参于搜索，例：童装
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: #f00">*</i> 显示词</label>
                            <div class="layui-input-block">
                                <input type="text" name="display" required lay-verify="required" placeholder=""
                                       autocomplete="off" value="<?php echo $rec_search['display']; ?>" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">
                                显示词不参于搜索，只起显示作用，例：61儿童节，童装5折狂甩
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" id="submit" lay-submit lay-filter="formDemo">立即提交</button>
                                <button class="layui-btn layui-btn-primary" onclick="history.back()">返回</button>
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
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script>

    //Demo
    layui.use('form', function () {
        var form = layui.form();
        //监听提交
        form.on('submit(formDemo)', function (data) {
            sendButtonAjax($("#submit"),data.field);
            return false;
        });
    });

</script>

</html>
