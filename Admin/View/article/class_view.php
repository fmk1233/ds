<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5>文章分类<?php echo $data['id']==0?'新增':'编辑'; ?></h5></div>
                <div class="ibox-content">
                    <div class="layui-form layui-box">
                        <input type="hidden" value="ArticleClass.DoInfo" name="service">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span>  分类名称</label>
                            <div class="layui-input-block">
                                <input type="text"  name="title" required lay-verify="required" placeholder="请输入分类名称" autocomplete="off"  value="<?php echo $data['name']; ?>" class="layui-input">
                            </div>
                        </div>
                        <?php if($data['id']==0): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><span class="text-danger">*</span>  上级分类</label>
                                <div class="layui-input-block">
                                    <select name="pid" lay-verify="required">
                                        <option value="0">-请选择-</option>
                                        <?php foreach($data['categorys'] as $category): ?>
                                            <option value="<?php echo $category['id']; ?>" <?php echo $category['id']==$pid?'selected':'' ?>><?php echo $category['name']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 分类排序</label>
                            <div class="layui-input-inline">
                                <input type="number" value="<?php echo $data['sort']; ?>" name="sort" required lay-verify="required" placeholder="请输入分类排序" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">分类的排序，显示的时候越大的显示在前面，最大255</div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" id="submit" lay-submit lay-filter="formDemo">确认提交</button>
                                <button class="layui-btn layui-btn-primary" onclick="javascript:history.back()">返回</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script>

    //Demo
    layui.use(['form'], function () {
        var form = layui.form();
        //监听提交
        form.on('submit(formDemo)', function (data) {
//            layer.msg(JSON.stringify(data.field));return false;
            sendButtonAjax($(data.elem),data.field);
            return false;
        });
    });

</script>
</html>
