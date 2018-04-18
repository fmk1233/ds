<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<link href="<?php echo URL_ROOT.'/static/';?>css/plugins/switchery/switchery.css" rel="stylesheet">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>支付方式修改</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content clr" >
                    <form class="form-horizontal col-md-9 col-md-offset-1" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 支付方式</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="<?php echo $payment['payment_name'];?>" >
                            </div>
                            <input type="hidden" name="payment_id" value="<?php echo $payment['id'];?>">
                            <input type="hidden" name="service" value="Payment.DoPaymentInfo">
                        </div>

                        <?php foreach($payment['payment_config'] as $key=>$value): ?>
                            <div class="form-group" style="display: <?php echo ($key=='no')?'none':'block' ?>;" >
                                <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo $payment['config_name'][$key]; ?></label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control"  name="config[<?php echo $key; ?>]"  value="<?php echo $value; ?>" >
                                </div>
                            </div>
                        <?php endforeach;?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span> 支付方式</label>
                            <div class="col-sm-10">
                                <input type="checkbox" class="form-control" id="state" name="state"  value="1" <?php echo $payment['payment_state']==1?'checked':'';?>>
                            </div>
                        </div>

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
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/switchery/switchery.js"></script>
<script type="text/javascript">
    $(function () {
        new Switchery($('#state')[0], {color: "#1AB394"});
        bindFormAjax($('form'));
    });
</script>

</html>
