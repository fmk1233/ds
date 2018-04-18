<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5>文章-<?php echo $data['id'] == 0 ? '新增' : '编辑'; ?></h5></div>
                <div class="ibox-content">
                    <div class="layui-form layui-box">
                        <input type="hidden" value="Article.DoInfo" name="service">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                                       autocomplete="off" value="<?php echo $data['title']; ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 所属分类</label>
                            <div class="layui-input-block">
                                <select name="cid" lay-verify="required" lay-search>
                                    <?php foreach ($data['categorys'] as $category): ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $data['c_id'] ? 'selected' : '' ?>><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 链接</label>
                            <div class="layui-input-inline">
                                <input type="text" name="url"  placeholder=""
                                       autocomplete="off" value="<?php echo $data['url']; ?>" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">当填写"链接"后点击文章标题将直接跳转至链接地址，不显示文章内容。链接格式请以http://开头</div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 显示</label>
                            <div class="layui-input-block">
                                <input type="checkbox" name="ar_show" lay-skin="switch" value="1" <?php echo $data['ar_show']==1?'checked':''; ?> lay-text="是|否">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 排序</label>
                            <div class="layui-input-inline">
                                <input type="number" value="<?php echo $data['sort']; ?>" name="sort" required
                                       lay-verify="required" placeholder="请输入排序" autocomplete="off"
                                       class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">排序，显示的时候越大的显示在前面，最大255</div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 文章内容</label>
                            <div class="layui-input-block">
                                <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo $data['content']; ?></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" id="submit" lay-submit lay-filter="formDemo">确认提交</button>
                                <button class="layui-btn layui-btn-primary" onclick="javascript:history.back()">返回
                                </button>
                            </div>
                        </div>
                    </div>
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
    layui.use(['form','layedit'], function () {
        var form = layui.form() ,layedit = layui.layedit;
        layedit.set({
            uploadImage: {
                url: ds.url({service:'Public.UploadImage',path:'editor',json:3}) //接口url
            }
        });
        var editIndex = layedit.build('LAY_demo_editor');
        form.verify({
            content: function(value){
                layedit.sync(editIndex);
            }
        });
        //监听提交
        form.on('submit(formDemo)', function (data) {
            sendButtonAjax($(data.elem), data.field);
            return false;
        });
    });

</script>
</html>
