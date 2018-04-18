<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>平台银行信息<?php $info['id']==0?'添加':'修改'?></h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <?php $info_names = array(
                    '银行名称'=>'bank',
                    '银行账号'=>'zhanghao',
                    '户主'=>'huzhu',
                );
                ?>
                <div class="ibox-content clr" >
                    <form class="form-horizontal col-md-9 col-md-offset-1" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="<?php echo $info['id']; ?>" name="id"/>
                        <input type="hidden" value="Bank.Update" name="service"/>
                        <?php foreach($info_names as $key=>$info_name): ?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo $key; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="<?php echo $info_name; ?>" value="<?php echo $info[$info_name];?>">
                                </div>
                            </div>
                        <?php endforeach;?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success " type="submit">确定提交</button>
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
<!-- 省市区插件-->
<script type="text/javascript">
    $(function () {
//        new PCAS('province','city','area',0,0,0);
        bindFormAjax($('form'),false,true);
    });
</script>

</html>
