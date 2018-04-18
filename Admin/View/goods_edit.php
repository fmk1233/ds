<!DOCTYPE html>
<html>
<link href="<?php echo URL_ROOT . '/static/'; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
<?php $this->view('header'); ?>
<link href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<?php if ($goods['id'] > 0): ?>
    <link href="<?php echo URL_ROOT . '/static/'; ?>css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <style type="text/css">
        .lightBoxGallery img {
            margin: 5px;
            width: auto;
            height: 160px;
        }

        .lightBoxGallery a {
            position: relative;
            display: inline-block;
        }
    </style>
<?php endif; ?>
<script src="<?php echo URL_ROOT.'/static/'?>js/jquery.min.js?v=2.1.4"></script>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">

                <div class="ibox-title"><h5><?php echo $goods['id'] == 0 ? '添加商品' : '修改商品' ?></h5></div>
                <div class="ibox-content">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form"
                          method="post" onsubmit="return false;" id="form" action="">

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab_base" aria-expanded="true">基本信息</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab_option" aria-expanded="false">库存/规格</a>
                                <li class=""><a data-toggle="tab" href="#tab_des" aria-expanded="false">详情</a>
                                </li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab_base" class="tab-pane active">
                                    <div class="panel-body">
                                        <input type="hidden" value="Goods.AddGoodsAC" name="service">
                                        <input type="hidden" name="id" value="<?php echo $goods['id']; ?>"/>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品排序</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="sort" name="sort"
                                                           value="<?php echo $goods['sort']; ?>"
                                                           placeholder="请输入分类排序"><span class="input-group-addon">商品的排序，显示的时候越大的显示在前面，最大127</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品分类</label>
                                            <div class="col-sm-10">
                                                <select name="categoryId" id="categoryId" tabindex="2"
                                                        class="chosen-select form-control">
                                                    <option value="">请选择商品分类</option>
                                                    <?php foreach ((array)$categorys as $category): ?>
                                                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $goods['category_id'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品名称</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="title"
                                                       value="<?php echo $goods['goods_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品图片</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="pic" id="pics" multiple="multiple"
                                                       class="form-control">
                                                <input type="hidden" id="goods_pics" name="goods_pics" value="">
                                                <?php if ($goods['id'] > 0): ?>
                                                    <input type="hidden" id="orgin_goods_pics" name="orgin_goods_pics"
                                                           value="<?php echo $goods['goods_pics']; ?>">
                                                    <input type="hidden" id="old_goods_pics" name="old_goods_pics"
                                                           value="<?php echo $goods['goods_pics']; ?>">
                                                    <span class="help-block lightBoxGallery">
                                        <?php $pics = explode(',', $goods['goods_pics']);
                                        foreach ($pics as $key => $pic): ?>
                                            <a href="<?php echo Common_Function::GoodsPath($pic); ?>" title="图片"
                                               data-gallery=""><button type="button" class="close"
                                                                       data-index="<?php echo $key; ?>"
                                                                       style="float: none;position: absolute;top: 0px;right: 0px"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button><img
                                                        src="<?php echo Common_Function::GoodsPath($pic); ?>"></a>
                                        <?php endforeach; ?>
                                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                            <div class="slides" style="display: block"></div>
                                            <h3 class="title" style="display: block"></h3>
                                            <a class="prev" style="display: block"><</a>
                                            <a class="next" style="display: block">></a>
                                            <a class="close" style="display: block">×</a>
                                            <a class="play-pause" style="display: block"></a>
                                            <ol class="indicator" style="display: block"></ol>
                                        </div>
                                    </span>
                                                <?php endif; ?>
                                                <span class="help-block">
                                    图片请上传正方形图片，图片分辨率为：430*430
                                </span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品价格</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon">市场价：</span><input type="text"
                                                                                                      class="form-control"
                                                                                                      name="market_price"
                                                                                                      value="<?php echo $goods['market_price']; ?>"><span
                                                            class="input-group-addon">会员价：</span><input type="text"
                                                                                                        class="form-control"
                                                                                                        name="price"
                                                                                                        value="<?php echo $goods['price']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">商品库存</label>
                                            <div class="col-sm-10" id="area">
                                                <div class="col-sm-3" style="padding-left: 0px">
                                                    <select class="country form-control " data-value="中国" ></select>
                                                </div>
                                                <div class="col-sm-3" style="padding-left: 0px">
                                                    <select class="province form-control" ></select>
                                                </div>
                                                <div class="col-sm-3" style="padding-left: 0px">
                                                    <select class="city form-control" ></select>
                                                </div>
                                                <div class="col-sm-3" style="padding-left: 0px">
                                                    <select class="area form-control" ></select>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">商品属性</label>
                                            <div class="col-sm-10">
                                                <label class="control-label"
                                                       style="margin-right: 10px;">推荐</label><input type="checkbox"
                                                                                                    name="is_rec"
                                                                                                    class="js-switch" <?php echo $goods['is_rec'] == 1 ? 'checked' : ''; ?> />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="tab_option" class="tab-pane">
                                    <div class="panel-body">
                                        <?php $this->assign('goods_option',json_encode($goods['goods_option'])); $this->view('shop/tpl/goods_option') ?>
                                    </div>
                                </div>
                                <div id="tab_des" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">详情</label>
                                            <div class="col-sm-10" id="eg2">
                                                <textarea id="memo" cols="20" rows="2" name="memo" class="form-control"><?php  echo html_entity_decode($goods['memo']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-warning" type="submit">确定提交</button>
                                <button class="btn btn-primary" type="button" onclick="javascript:history.back();">返回
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
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/chosen/chosen.jquery.js"></script>
<!--<script type="text/javascript" src="-->
<?php //echo URL_ROOT; ?><!--/static/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>-->
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/fileinput/js/local/zh.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/switchery/switchery.js"></script>
<!--<script type="text/javascript" src="-->
<?php //echo URL_ROOT; ?><!--/static/js/plugins/cxSelect/jquery.cxselect.min.js"></script>-->
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/ckeditor/ckeditor.js"></script>
<?php if ($goods['id'] > 0): ?>
    <script type="text/javascript"
            src="<?php echo URL_ROOT; ?>/static/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<?php endif; ?>
<script type="text/javascript">

    $(function () {
        var config = {
            ".chosen-select": {no_results_text: "没有找到数据", search_contains: true}
        };
        for (var selector in config)$(selector).chosen(config[selector]);
        var ck =CKEDITOR.replace('memo');

        $("#pics").fileinput({
            uploadUrl: ds.url({service:'Goods.UploadFile'}),
            language: 'zh',
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            showUpload: false, //是否显示上传按钮
            maxFileCount: 6,
            browseClass: "btn btn-primary", //按钮样式
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值6！"
        }).on("fileuploaded", function (event, data) {
            var json = data.response;
            if (json) {
                if (json.code == 40000) {
                    var goodpic = $("#goods_pics").val();
                    $("#goods_pics").val(goodpic ? (goodpic + ',' + json.info) : json.info);
                }
            } else {
                alertMsg('上传失败')
            }
        }).on('filesuccessremove', function (event, files, s) {
            var goodpics = $("#goods_pics").val();
            var goodArray = goodpics.split(',');
            var removePic = goodArray[s];
            ds.sendAjax({
                data: {service: 'Goods.removeFile', pic: removePic},
                success: function (data) {
                    goodArray.splice(s, 1);
                    $("#goods_pics").val(goodArray.join(','));
                }
            });
        }).on('filecleared', function () {
            var goodpics = $("#goods_pics").val();
            ds.sendAjax({
                data: {service: 'Goods.removeFile', pic: goodpics},
                success: function (data) {
                    $("#goods_pics").val('');
                }
            })
        });

        $('.lightBoxGallery .close').on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            var $this = $(this);
            var goodpics = $("#orgin_goods_pics").val();
            var goodArray = goodpics.split(',');
            var index = $(this).data('index');
            goodArray.splice(index, 1);
            $("#orgin_goods_pics").val(goodArray.join(','));
            $this.parent().remove();
        });



        $('#form').on('submit', function () {
            optionArray();
            $('#memo').val(ck.getData());
            sendFormAjax($(this));
            return false;
        });
    });

    function optionArray()
    {
        var option_stock = new Array();
        $('.option_stock').each(function (index,item) {
            option_stock.push($(item).val());
        });

        var option_id = new Array();
        $('.option_id').each(function (index,item) {
            option_id.push($(item).val());
        });

        var option_ids = new Array();
        $('.option_ids').each(function (index,item) {
            option_ids.push($(item).val());
        });

        var option_title = new Array();
        $('.option_title').each(function (index,item) {
            option_title.push($(item).val());
        });

        var option_marketprice = new Array();
        $('.option_marketprice').each(function (index,item) {
            option_marketprice.push($(item).val());
        });

        var option_productprice = new Array();
        $('.option_productprice').each(function (index,item) {
            option_productprice.push($(item).val());
        });


        var option_goodssn = new Array();
        $('.option_goodssn').each(function (index,item) {
            option_goodssn.push($(item).val());
        });

        var option_productsn = new Array();
        $('.option_productsn').each(function (index,item) {
            option_productsn.push($(item).val());
        });

        var option_weight = new Array();
        $('.option_weight').each(function (index,item) {
            option_weight.push($(item).val());
        });

        var options = {
            option_stock : option_stock,
            option_id : option_id,
            option_ids : option_ids,
            option_title : option_title,
            option_marketprice : option_marketprice,
            option_productprice : option_productprice,
            option_goodssn : option_goodssn,
            option_productsn : option_productsn,
            option_weight : option_weight,
        };
        $("input[name='optionArray']").val(JSON.stringify(options));
    }
</script>
</html>
