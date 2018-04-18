<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>

<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <!--左侧导航-手机不显示-->
                <div class="col-xs-12 zs-md-2 hidden-xs hidden-sm">
                    <div class="profile-sidebar">
                        <?php $this->view('profile_side') ?>
                    </div>

                </div>
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="row">
                            <div class="col-xs-12 profile-info summary-info">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <a href="javascript:;"
                                               class="ui-text-blue"><?php echo T('余额'), T('提现'); ?></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <br>
                                        <div class="well">
                                            <p><b><?php echo T('提现'), T('说明'); ?>：</b></p>
                                            <p style="margin-top: 6px;"><?php echo T('请仔细核对下表所列的账户资料是否存在误填'); ?></p>
                                            <p style="margin-top: 6px;"><span class="caption-subject font-red-sunglo">
                                                    <?php $params = Common_Function::cashParams();
                                                    echo T('提现'), T('金额为{money}的整数倍', array('money' => $params['rule'])); ?></span>
                                            </p>
                                            <p style="margin-top: 6px;"><span
                                                        class="caption-subject font-red-sunglo"> <?php echo T('余额'); ?>
                                                    ： <?php echo number_format($user[BONUS_NAME . BONUS_STC]), ' ', T('手续费'); ?>
                                                    :<?php echo $params['fee']; ?>% </span</p>
                                        </div>
                                        <form class="form-horizontal" id="cash" onsubmit="return false;">
                                            <input type="hidden" value="Bonus.AddCash" name="service">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('提现'), T('金额'); ?>
                                                    ：</label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="amount" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('开户银行'); ?>：</label>
                                                <div class="col-md-5">
<!--                                                    <input type="text" class="form-control" name="bank_name" value="--><?php //echo $user['bank_name']; ?><!--">-->
                                                    <select class="form-control" name="bank_name">
                                                        <?php if(!empty($bank_list)):?>
                                                            <?php foreach ($bank_list as $key => $value): ?>
                                                                <option value="<?php echo $value['bank']; ?>">
                                                                    <?php echo $value['bank']; ?>
                                                                </option>
                                                            <?php endforeach;?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('开户姓名'); ?>：</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="bank_user" value="<?php echo $user['bank_user']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('银行卡号'); ?>：</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="bank_no" value="<?php echo $user['bank_no']; ?>">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('银行地址'); ?>：</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="bank_address"
                                                           value="<?php echo $user['bank_address']; ?>"></div>
                                            </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button class="btn blue mt-clipboard" type="submit"><i
                                                                    class="fa fa-check"></i><?php echo T('确认'), T('提现'); ?>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                        <br>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('提现'), T('记录'); ?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                               data-container="false" data-placement="bottom" data-original-title="全屏"
                                               href="javascript:;"> </a>

                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <div id="toolbar">
                                            <form class="form-inline" role="form" onsubmit="return false;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="laydate-icon form-control "
                                                               id="s_time" name="s_time"
                                                               placeholder="<?php echo T('开始时间'); ?>"
                                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                        <span class="input-group-addon"><?php echo T('到'); ?></span>
                                                        <input type="text" class="laydate-icon form-control "
                                                               id="e_time" name="e_time"
                                                               placeholder="<?php echo T('结束时间'); ?>"
                                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                        class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                            </form>
                                        </div>
                                        <table data-min-width="768" class="table" data-mobile-responsive="true"
                                               class="table-striped table-hover">
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>


        </div>
        <!--END 主体-->
    </div>
    <!--END 主体-->

    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->


</div>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var check_names = JSON.parse('<?php echo json_encode(Common_Function::getCheckName()); ?>');
        var money = '<?php echo  $user[BONUS_NAME . BONUS_STC];?>';
        //获取充值列表数据
        var $columnsLock = [{
            field: 'cash_sn',
            title: '<?php echo T('编号')?>'
        }, {
            field: 'amount',
            title: '<?php echo T('提现'), T('金额')?>'
        }, {
            field: 'fee',
            title: '<?php echo T('手续费')?>'
        }, {
            field: 'bank_name',
            title: '<?php echo T('开户银行')?>'
        }, {
            field: 'bank_user',
            title: '<?php echo T('开户姓名')?>'
        }, {
            field: 'bank_no',
            title: '<?php echo T('银行卡号')?>'
        }, {
            field: 'bank_address',
            title: '<?php echo T('银行地址')?>'
        }, {
            field: 'payment_state',
            title: '<?php echo T('状态')?>',
            formatter: function (value) {
                var text = check_names[value]
                switch (parseInt(value)) {
                    case 0:
                        return '<span class="label label-warning">' + text + '</span>';
                        break;
                    case 1:
                        return '<span class="label label-success">' + text + '</span>';
                        break;
                    case 2:
                        return '<span class="label label-danger">' + text + '</span>';
                        break;
                }
            }
        }, {
            field: 'add_time',
            title: '<?php echo T('申请时间')?>',
            formatter: function (value) {
                return $.myTime.UnixToDate(value);
            }
        }];
        var querystrLock = "{service:'Bonus.GetCashList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('#cash').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            onSuccess: function (e) {
                e.preventDefault();
                var $form = $(e.target);
                sendFormAjax($form);
            },
            fields: {
                amount: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                var rule = parseInt('<?php echo $params['rule'];?>');
                                if(value % rule != 0|| value<=0){
                                    return {
                                        valid:false,
                                        message:'<?php echo T('提现'), T('金额为{money}的整数倍', array('money' => $params['rule'])) ?>'
                                    }
                                }
                                if(value>parseFloat(money)){
                                    return {
                                        valid:false,
                                        message:'<?php echo  T('钱包金额不足'); ?>'
                                    }
                                }
                                return true;
                            }
                        }
                    }
                },
                bank_name: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('开户银行') ?>',
                        }
                    }
                },
                bank_user: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('开户姓名') ?>',
                        }
                    }
                },
                bank_no: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('银行卡号') ?>',
                        }
                    }
                },
                bank_address: {
                    validators: {
                        notEmpty:{
                            message: '<?php echo T('请填写'), T('银行地址') ?>',
                        }
                    }
                },

            }
        });
    })
</script>
</body>
</html>