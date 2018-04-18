<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5>页面导航-<?php echo $data['id'] == 0 ? '新增' : '编辑'; ?></h5></div>
                <div class="ibox-content">
                    <div class="layui-form layui-box">
                        <input type="hidden" value="Navigation.DoInfo" name="service">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 导航类型</label>
                            <div class="layui-input-block">
                                <?php $locations = Domain_Navigation::navType();
                                foreach ($locations as $key => $location): ?>
                                    <input type="radio" name="type" lay-filter="type" value="<?php echo $key; ?>"
                                           title="<?php echo $location; ?>" <?php echo $key == $data['type'] ? 'checked=""' : ''; ?>>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" value="0" name="item_id[0]" id="item0"/>
                        <div class="layui-form-item <?php echo $data['type'] == 1 ? '' : 'layui-hide'; ?>" id="item1">
                            <label class="layui-form-label"> 商品分类</label>
                            <div class="layui-input-block">
                                <select name="item_id[2]" lay-verify="required" lay-search>
                                    <?php $article_lists = Domain_Goods::getAllList();
                                    foreach ($article_lists as $article_list): ?>
                                        <option value="<?php echo $article_list['id']; ?>"><?php echo $article_list['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item <?php echo $data['type'] == 2 ? '' : 'layui-hide'; ?>" id="item2">
                            <label class="layui-form-label"> 文章分类</label>
                            <div class="layui-input-block">
                                <select name="item_id[1]" lay-verify="required" lay-search>
                                    <?php $article_lists = Domain_ArticleClass::getAllList();
                                    foreach ($article_lists as $article_list): ?>
                                        <option value="<?php echo $article_list['id']; ?>"><?php echo $article_list['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                                       autocomplete="off" value="<?php echo $data['title']; ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 链接</label>
                            <div class="layui-input-inline">
                                <input type="text" name="url" placeholder=""
                                       autocomplete="off" value="<?php echo $data['url']; ?>" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">
                                当填写"链接"后点击文章标题将直接跳转至链接地址，不显示文章内容。链接格式请以http://开头
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 所在位置</label>
                            <div class="layui-input-block">
                                <?php $locations = Domain_Navigation::location();
                                foreach ($locations as $key => $location): ?>
                                    <input type="radio" name="location" value="<?php echo $key; ?>"
                                           title="<?php echo $location; ?>" <?php echo $key == $data['location'] ? 'checked=""' : ''; ?>>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"> 新窗口打开</label>
                            <div class="layui-input-block">
                                <input type="checkbox" name="new_open" lay-skin="switch"
                                       value="1" <?php echo $data['new_open'] == 1 ? 'checked' : ''; ?> lay-text="是|否">
                            </div>
                        </div>


                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 排序</label>
                            <div class="layui-input-inline">
                                <input type="number" value="<?php echo $data['sort']; ?>" name="sort" required
                                       lay-verify="required" placeholder="请输入排序" autocomplete="off"
                                       class="layui-input" max="255" min="1">
                            </div>
                            <div class="layui-form-mid layui-word-aux">排序，显示的时候越大的显示在前面，最大255</div>
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
    layui.use(['form'], function () {
        var form = layui.form();
        form.on('radio(type)', function (data) {
            $('#item0,#item1,#item2').addClass('layui-hide');
            $("#item" + data.value).removeClass('layui-hide');
        });
        //监听提交
        form.on('submit(formDemo)', function (data) {
            sendButtonAjax($(data.elem), data.field);
            return false;
        });
    });

</script>
</html>
