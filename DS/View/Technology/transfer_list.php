<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <link href="<?php echo Common_Function::GoodsPath('/css/components-rounded.min.css'); ?>" rel="stylesheet" type="text/css">
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
                    <h2>   <?php echo T('会员转账'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('财务管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong>   <?php echo T('会员转账'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-xs-12">
                            <?php $bonus_names = Common_Function::getBonusName();
                            foreach ($bonus_names as $key => $bonus_name): ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number" data-counter="counterup"
                                                 data-value="<?php echo number_format($user[BONUS_NAME . $key], 2); ?>"> <?php echo number_format($user[BONUS_NAME . $key], 2); ?> </div>
                                            <div class="desc">
                                                <?php echo $bonus_name; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins pdlr15">
                                <div class="ibox-title">
                                    <h5><?php echo T('奖金转入转出记录'); ?> </h5>
                                </div>
                                <div class="ibox-content sj-box-pad jhhy-border">
                                    <ul class="nav nav-tabs" id="change">
                                        <li class="active"><a data-toggle="tab" href="#tab-1" data-id="1" aria-expanded="false"><?php echo T('奖金转出记录'); ?></a>
                                        </li>
                                        <li class=""><a data-toggle="tab" data-id="2" href="#tab-2"  aria-expanded="true"><?php echo T('奖金转入记录'); ?></a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
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
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#myModal"><?php echo T('我要转账'); ?>
                                                    </button>
                                                </form>
                                            </div>
                                            <table data-min-width="768" class="table" data-mobile-responsive="true">
                                            </table>
                                        </div>
                                        <div id="tab-2" class="tab-pane ">
                                            <div id="toolbar2">
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
                                                    <button type="submit" class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                                </form>
                                            </div>
                                            <table data-min-width="768" class="table" data-mobile-responsive="true">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
</div>
<!--转账弹出框-->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog summary-info">
        <div class="modal-content animated bounceInDown portlet light">
            <div class="modal-header portlet-title">
                <div class="caption">
                    <span class="ui-text-blue"><?php echo T('会员转账'); ?></span>
                </div>

                <div class="actions">
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>

            </div>
            <form role="form" id="sendForm" method="post" onsubmit="return false;">
                <div class="modal-body portlet-body">
                    <div class="alert alert-info">
                        <p><b><?php echo T('转账'), T('说明'); ?>：</b></p>
                        <p style="margin-top: 6px;"><span
                                class="caption-subject font-red-sunglo"><?php $params = Common_Function::transferParams();
                                echo T('转账'), T('金额为{money}的整数倍', array('money' => $params['rule'])); ?></span>
                        </p>
                    </div>
                    <input type="hidden" name="service" value="Transfer.AddTransfer">
                    <div class="form-group"><label><?php echo T('货币类型'); ?></label>
                        <select name="zztype" class="form-control" style="border: 1px solid rgb(204,204,204)">
                            <?php foreach ($bonus_names as $key => $bonus_name): ?>
                                <option value="<?php echo $key; ?>"><?php echo $bonus_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group"><label><?php echo T('转入'), T('会员编号'); ?><span id="showName"
                                                                                          style="color: #1ab394"></span></label>
                        <input type="text" style="border: 1px solid rgb(204,204,204)" placeholder="" class="form-control" name="tousername" value=""
                               id="tousername">

                    </div>
                    <div class="form-group"><label><?php echo T('转出'), T('金额'); ?></label>
                        <div id="price_slider"></div>
                        <input type="text" style="border: 1px solid rgb(204,204,204)" placeholder="" class="form-control" name="amount" value="" id="amount">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline grey-salsa"
                            data-dismiss="modal"><?php echo T('取消'); ?></button>
                    <button type="submit" class="btn blue mt-clipboard" ><i class="fa fa-check"></i><?php echo T('确认转账'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.waypoints.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.counterup.min.js'); ?>"
        type="text/javascript"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var bonus_names = JSON.parse('<?php echo json_encode(Common_Function::getBonusName()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: '<?php echo T('ID')?>'
        }, {
            field: 't_user_name',
            title: '<?php echo T('转入'), T('会员编号');?>'
        }, {
            field: 't_true_name',
            title: '<?php echo T('转入'), T('会员姓名');?>'
        }, {
            field: 'money_type',
            title: '<?php echo T('货币类型')?>',
            formatter: function (value) {
                return bonus_names[value];
            }
        }, {
            field: 'money',
            title: '<?php echo T('金额')?>'
        }, {
            field: 'add_time',
            title: '<?php echo T('时间')?>',
            formatter: function (value) {
                return showTime(value);
            }
        }];
        var querystrLock = "{service:'Transfer.GetTransferList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),type:1}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('#tab-1 .table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();

        var $columns2 = [{
            field: 'id',
            title: '<?php echo T('ID')?>'
        }, {
            field: 'f_user_name',
            title: '<?php echo T('转出'), T('会员编号');?>'
        }, {
            field: 'f_true_name',
            title: '<?php echo T('转出'), T('会员姓名');?>'
        }, {
            field: 'money_type',
            title: '<?php echo T('货币类型')?>',
            formatter: function (value) {
                return bonus_names[value];
            }
        }, {
            field: 'money',
            title: '<?php echo T('金额')?>'
        }, {
            field: 'add_time',
            title: '<?php echo T('时间')?>',
            formatter: function (value) {
                return showTime(value);
            }
        }];
        var options2= {
            columns: $columns2,
            toolbar:'#toolbar2'
        };
        var querystr2 = "{service:'Transfer.GetTransferList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),type:2}";
        var oTable2 = $('#tab-2 .table').tableInit(options2, querystr2);
        oTable2.Init();

        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('#toolbar2 form').on('submit',function () {
            oTableLock.load();
        });
        var bonus = {<?php foreach ($bonus_names as $key=>$bonus_name){ echo $key,':',$user[BONUS_NAME.$key],',';} ?>};
        $('#myModal form').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            trigger:'blur',
            onSuccess: function (e) {
                e.preventDefault();
                var $form = $(e.target);
                sendFormAjax($form);
                $("#myModal").modal('hide');
            },
            fields: {
                amount: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                var rule = parseInt('<?php echo $params['rule'];?>');
                                var money_type =  validator.getFieldElements('zztype').val();
                                if(value % rule != 0|| value<=0){
                                    return {
                                        valid:false,
                                        message:'<?php echo T('转账'), T('金额为{money}的整数倍', array('money' => $params['rule'])) ?>'
                                    }
                                }
                                if(value>bonus[money_type]){
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
                tousername: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('会员编号') ?>'
                        },
                        remote:{
                            url:baseUrl,
                            type: 'POST',
                            data:function (validator, $field, value) {
                                return {field:'username',value: validator.getFieldElements('tousername').val(),service:'Public.CheckUserField'};
                            },
                            callback:function (d) {
                                if(d.code==40000){
                                    $('#showName').show();
                                    $('#showName').html(d.data.true_name);
                                }else{
                                    $('#showName').hide();
                                    $('#showName').html('');
                                }
                            },
                            message:'<?php echo  T('用户不存在');?>'
                        }
                    }
                }

            }
        });
    })
</script>
</body>

</html>
