<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h2><?php echo $icon['id']==0?'添加':'修改'; ?>幻灯片</h2></div>
                <div class="ibox-content clr">
                    <form class="form-horizontal" role="form"
                          method="post" onsubmit="return false;" id="register-form" enctype="multipart/form-data" action="">
                        <input type="hidden" value="Icon.iconAddAc" name="service">
                        <input type="hidden" name="id" value="<?php echo $icon['id']; ?>"/>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">幻灯片排序</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="sort" name="sort" value="<?php echo $icon['sort']; ?>" placeholder="请输入幻灯片排序"><span class="input-group-addon">幻灯片的排序，显示的时候越大的显示在前面，最大127</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">幻灯片名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $icon['name']; ?>" placeholder="请输入幻灯片名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">幻灯片分类</label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control">
                                    <?php $caregorys=Domain_Icon::iconCategoryName(); foreach($caregorys as $key=>$caregory): ?>
                                        <option value="<?php echo $key; ?>" <?php echo $key==$icon['category']?'selected':''; ?>><?php echo $caregory; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">链接地址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url" value="<?php echo $icon['url']; ?>" placeholder="请输入链接地址，没有请留空">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">幻灯片图片</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="icon" name="icon" value="" placeholder="请输入幻灯片图片">
                                <input type="hidden" class="form-control" name="orgin_icon" value="<?php echo $icon['icon']; ?>" placeholder="请输入幻灯片图片">
                                <div class="help-block">
                                    <ul>
                                        <li>1.同一分类的图片尺寸应该一致</li>
                                        <li>2.PC端首页图片尺寸为1920*550等比例图片</li>
                                        <li>3.手机端(商城+WAP)首页图片尺寸为1080*531等比例图片</li>
                                        <li>4.PC端商城图片尺寸为820*460等比例图片</li>
                                        <li>5.手机端商城分类为手机端商城首页广告图，尺寸为300*130，数量最好为偶数</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">是否推荐</label>
                            <div class="col-sm-10">
                                <input type="radio" id="is_rec" name="is_rec" <?php if($icon['is_rec']==0)echo 'checked'; ?> value="0" >否
                                <input type="radio" id="is_rec" name="is_rec"  <?php if($icon['is_rec']==1)echo 'checked'; ?> value="1" >是
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success ladda-button" type="submit" data-style="zoom-in"><span class="ladda-label">确定提交</span></button>
                                <button class="btn btn-primary " type="button" onclick="javascript:history.back();">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>

<script type="text/javascript">
    $(function () {
        bindFormAjax($('form'),null,true);
    });
</script>
</html>
