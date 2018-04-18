<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<style type="text/css">
    .site-demo-upload,
    .site-demo-upload img {
        width: 200px;
        height: 200px;
        border-radius: 100%;
    }

    .site-demo-upload {
        position: relative;
        background: #e2e2e2;
    }

    .site-demo-upload .site-demo-upbar {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -18px 0 0 -56px;
    }

    .site-demo-upload .layui-upload-button {
        background-color: rgba(0, 0, 0, .2);
        color: rgba(255, 255, 255, 1);
    }

    .show_img, .show_img img {
        width: 150px;
        height: 150px;
        display: inline-block;
    }

    .ad, .ad img {
        width: 600px;
        height: 60px;
    }

    .ad {
        position: relative;
        padding: 0 2px 5px 2px;
    }

    .show_img {
        position: relative;
        padding: 0 2px 5px 2px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5><?php echo $id == 0 ? '添加商品分类' : '修改商品分类'; ?></h5></div>
                <div class="ibox-content">
                    <div class="layui-form layui-box">
                        <input type="hidden" value="Goods.AddGoodsCategoryAC" name="service">
                        <input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <?php if ($pid): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><span class="text-danger">*</span> 上级分类</label>
                                <div class="layui-input-block">
                                    <input type="text" disabled placeholder="请输入标题" autocomplete="off"
                                           value="<?php echo $category_name; ?>" class="layui-input">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 分类排序</label>
                            <div class="layui-input-inline">
                                <input type="number" value="<?php echo isset($category) ? $category['sort'] : 127; ?>"
                                       name="sort" required lay-verify="required" placeholder="请输入分类排序"
                                       autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">分类的排序，显示的时候越大的显示在前面，最大127</div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 分类名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入分类名称"
                                       autocomplete="off"
                                       value="<?php echo isset($category) ? $category['category_name'] : ''; ?>"
                                       class="layui-input">
                            </div>
                        </div>
                        <input type="hidden" name="pic" lay-verify="pic"
                               value="<?php echo isset($category) ? $category['icon'] : ''; ?>"/>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><span class="text-danger">*</span> 分类图片</label>
                            <div class="layui-input-block">
                                <div class="site-demo-upload">
                                    <?php if (isset($category)): ?>
                                        <img id="LAY_demo_upload"
                                             src="<?php echo Common_Function::GoodsPath($category['icon']); ?>">
                                    <?php else: ?>
                                        <img id="LAY_demo_upload">
                                    <?php endif; ?>

                                    <div class="site-demo-upbar">
                                        <div class="layui-box layui-upload-button">
                                            <input type="file" id="pic" name="file" class="layui-upload-file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($pid == 0): ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><span class="text-danger">*</span> 分类广告图</label>
                                <div class="layui-input-inline">
                                    <input type="file" name="file" id="ad_file" class="layui-upload-file">
                                </div>
                                <div class="layui-form-mid layui-word-aux">分类广告图尺寸1200*120,如更换请删除下图</div>
                            </div>
                            <div class="layui-input-block" id="ad" style="min-height: 0px">
                                <?php if (isset($category) && !empty($category['ad'])): ?>
                                    <div class="ad">
                                     <span class="layui-layer-setwin">
                                        <a class="layui-layer-ico layui-layer-close layui-layer-close2"
                                           href="javascript:;"></a>
                                    </span>
                                        <img src="<?php echo Common_Function::GoodsPath($category['ad']); ?>">
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><span class="text-danger">*</span> 左侧广告图</label>
                                <div class="layui-input-inline">
                                    <input type="file" name="file" id="left_ad_file" class="layui-upload-file">
                                </div>
                                <div class="layui-form-mid layui-word-aux">分类左侧广告图尺寸298*489</div>
                            </div>
                            <div class="layui-input-block" id="left_ad" style="min-height: 0px">
                                <?php if (isset($category) && !empty($category['left_ad'])): $ad_lefts = explode(',', $category['left_ad']); ?>
                                    <?php foreach ($ad_lefts as $ad_left): ?>
                                        <div class="show_img">
                                     <span class="layui-layer-setwin" >
                                        <a class="layui-layer-ico layui-layer-close layui-layer-close2"
                                           href="javascript:;" style="z-index: 10"></a>
                                    </span>
                                            <img src="<?php echo Common_Function::GoodsPath($ad_left); ?>">
                                        </div>
                                    <?php endforeach; ?>

                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="ad"
                                   value="<?php echo isset($category) ? $category['ad'] : ''; ?>"/>
                            <input type="hidden" name="left_ad"
                                   value="<?php echo isset($category) ? ',' . $category['left_ad'] : ''; ?>"/>
                            <div class="layui-form-item">
                                <label class="layui-form-label"><span class="text-danger">*</span>显示</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="is_show" value="1"
                                           lay-skin="switch" <?php echo empty($category['is_show']) ? '' : 'checked'; ?>
                                           lay-text="是|否">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" id="submit" lay-submit lay-filter="formDemo">立即提交</button>
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
    layui.use(['form', 'upload'], function () {
        var form = layui.form();
        var uploadData = ds.url({service: 'Public.UploadImage', path: 'temp', json: 2});
        layui.upload({
            url: uploadData,
            elem: '#pic'
            , success: function (res) { //上传成功后的回调
                if (res.code == 40000) {
                    $('#LAY_demo_upload').attr('src', goodsThumb(res.data));
                    $("input[name='pic']").val(res.data);
                } else {
                    alertMsg(res);
                }
            }
        });
        var uploadData2 = ds.url({service: 'Public.UploadImage', path: 'ad', json: 2});
        //首页分类上部广告图
        layui.upload({
            url: uploadData2,
            elem: '#ad_file'
            , success: function (res) { //上传成功后的回调
                if (res.code == 40000) {
                    if ($('#ad').find('.show_img').length == 0) {
                        $('#ad').html('  <div class="ad"><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close2" href="javascript:;"></a></span><img src="' + goodsThumb(res.data) + '"> </div>');
                    } else {
                        $('#ad').find('.show_img img').attr('src', goodsThumb(res.data));
                    }
                    $("input[name='ad']").val(res.data);
                } else {
                    alertMsg(res);
                }
            }
        });
        $('#ad').on('click', '.layui-layer-close', function () {
            var $this = $(this);
            var path = $this.parent().next().attr('src').replace(baseURL + 'static', '');
            ds.sendAjax({
                data: {service: 'Public.RemoveFile', path: path},
                success: function (d) {
                    $("input[name='ad']").val('');
                    $this.parent().parent().remove();
                }
            })
        });
        //首页左侧广告图
        layui.upload({
            url: uploadData2,
            elem: '#left_ad_file'
            , success: function (res) { //上传成功后的回调
                if (res.code == 40000) {
                    $('#left_ad').append('<div class="show_img"><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close2" href="javascript:;"></a></span><img src="' + goodsThumb(res.data) + '"> </div>');
                    var value = $("input[name='left_ad']").val();
                    value += ',' + res.data;
                    $("input[name='left_ad']").val(value);
                } else {
                    alertMsg(res);
                }
            }
        });
        $('#left_ad').on('click', '.layui-layer-close', function () {
            var $this = $(this);
            var path = $this.parent().next().attr('src').replace(baseURL + 'static', '');
            ds.sendAjax({
                data: {service: 'Public.RemoveFile', path: path},
                success: function (d) {
                    var value = $("input[name='left_ad']").val();
                    value = value.replace(',' + path, '');
                    $("input[name='left_ad']").val(value);
                    $this.parent().parent().remove();
                }
            })
        });
        form.verify({
            pic: function (value) {
                if (value == '') {
                    return '请上传图片';
                }
            }
        })
        //监听提交
        form.on('submit(formDemo)', function (data) {
            sendButtonAjax($("#submit"), data.field);
            return false;
        });
    });

</script>
</html>
