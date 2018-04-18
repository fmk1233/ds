<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style type="text/css">
        #type_url{padding-top: 10px;}
        #type_url button{font-size:15px}
        .pay_type{
            padding: 11px;
            margin: 0 2px 0;
        }
        .log li{
            padding: 10px 0;
        }
        .log li b{
            color:red;
        }
        /*.btn-primary{margin-left: 10px;margin-right: 10px;}*/
        .radio_sm-blue{
            background-color: #14c1b3!important;color: #fff!important;border: none!important;
            line-height: 30px!important;
        }
        .money{margin-right: 6px!important;}
        .ibox-content .sendForm1box {
            border-right: none;
        }
        .ibox-content .row{ margin-bottom: 20px;}
        @media (max-width: 767px){
            .ibox-content .sendForm1box {
                border:0;
            }
        }
        .ny-top{
            margin:0 40px!important;
            /*padding-top: 30px!important;*/
        }
        .czsq{
            color: #98a1b3;font-size: 24px;
        }
        .mgl50{
            margin-left: 50px!important;
            /*border-bottom: 2px solid #98a1b3;*/
            margin-right: 50px!important;
        }
        .data-box li{
            width:inherit!important;
            margin-right: 0!important;
            line-height: 30px!important;
            height: 30px!important;
        }
        .data-box .active{
            background-color: transparent!important;
        }
        .data-box .active a{
            background-color: transparent!important;
            color: #14c1b3!important;
            border-bottom: 1px solid #14c1b3;
            padding-bottom: 8px;
        }
        .ibox-title h5{float: none!important;}
        .b-r{border: 0!important;}
        .user-money{margin: 0!important;}
        .wrapper-content{
            /*padding-top:30px!important;*/
            padding-bottom:0!important;
        }
        .ny-top{margin: 0!important;}

        .ibox-title,.ibox-content{
            padding-left:32px!important;padding-right: 32px!important;
        }
        .label-primary{
            background: transparent!important;
            border: 1px solid #14c1b3;
            color: #14c1b3!important;
        }
        .col-lg-7 .msg-box{
            padding-right: 15px; color: #98a1b3;background-color: rgba(0,0,0,.2);padding-left: 15px;padding-top: 20px;padding-bottom: 20px;min-height: 432px;
        }
        .col-lg-7 .msg-box1{
            padding-right: 15px; color: #98a1b3;background-color: rgba(0,0,0,.2);padding-left: 15px;padding-top: 20px;padding-bottom: 20px;min-height: 627px;
        }
    </style>
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo T('余额'), T('提现'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('财务管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('余额'), T('提现'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container application_box" id="tab-4">
                <div class="wrapper active wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5 class="bdl-green"><?php echo T('余额'), T('提现'); ?> </h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-md-12 b-r col-xs-12 sendForm1box">
                                            <div class="well">
                                                <p><b><?php echo T('提现'), T('说明'); ?>：</b></p>
                                                <p style="margin-top: 6px;"><?php echo T('请仔细核对下表所列的账户资料是否存在误填'); ?></p>
                                                <p style="margin-top: 6px;"><span
                                                        class="caption-subject font-red-sunglo"><?php $params = Common_Function::cashParams();
                                                        echo T('提现'), T('金额为{money}的整数倍', array('money' => $params['rule'])); ?></span>
                                                </p>
                                            </div>
                                            <form class="form-horizontal" id="cash" onsubmit="return false;">
                                                <input type="hidden" value="Bonus.AddCash" name="service">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo T('提现'), T('金额'); ?>：</label>
                                                    <input type="number" class="form-control" name="amount" value="">

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo T('开户银行'); ?>：</label>
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
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo T('开户姓名'); ?>：</label>
                                                    <input type="text" class="form-control" name="bank_user" value="<?php echo $user['bank_user']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo T('银行卡号'); ?>：</label>
                                                    <input type="text" class="form-control" name="bank_no" value="<?php echo $user['bank_no']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo T('银行地址'); ?>：</label>
                                                    <input type="text" class="form-control" name="bank_address"
                                                           value="<?php echo $user['bank_address']; ?>">
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-lg-offset-5 col-lg-7">
                                                            <button class="btn blue mt-clipboard" type="submit"><i
                                                                    class="fa fa-check"></i><?php echo T('确认'), T('提现'); ?>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 pdl0">

                            <div class="msg-box txbg-white">
                                <div class="tx-bdt" style="margin-bottom: 0!important; margin-top: 0px!important;background-color: transparent!important;border: 0!important;color: #98a1b3!important; padding: 0!important;" >
                                    <span class="czjl" style="float: none;"><?php echo T('提现'), T('记录'); ?></span>
                                </div>
                                <div id="toolbar" class="123">
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
                                     >
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
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
