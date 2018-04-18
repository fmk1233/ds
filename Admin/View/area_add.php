<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5><?php echo $area['id']==0?'添加地区':'修改地区'; ?></h5></div>
                <div class="ibox-content clr">
                    <form class="form-horizontal" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="Area.DoArea" name="service">
                        <input type="hidden" name="pid" value="<?php echo $area['pid']; ?>"/>
                        <input type="hidden" name="id" value="<?php echo $area['id']; ?>"/>
                        <input type="hidden" name="level" value="<?php echo $area['level']; ?>"/>
                        <?php if($area['pid']>1): ?>
                            <div class="form-group">
                                <label for="password2" class="col-sm-2 control-label"><span class="text-danger">*</span> 上级分类</label>
                                <div class="col-sm-10">
                                    <span class="form-control"><?php echo $area['p_name']; ?></span>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">地区名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="areaname" name="areaname" value="<?php echo $area['area_name']; ?>" placeholder="请输入地区名称">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">地区编码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="areacode" name="areacode" value="<?php echo $area['code']; ?>" placeholder="请输入地区编码">
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
        bindFormAjax($('form'));
    });
</script>
</html>
