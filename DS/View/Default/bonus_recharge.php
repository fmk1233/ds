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
                                        <div class="caption" style="padding: 2px 0;">
                                            <a href="javascript:;" class="application btn blue"><?php echo T('充值申请'); ?></a>&nbsp;&nbsp;&nbsp;
                                        </div>
                                        <!--  <div class="actions">
                                              <a href="javascript:history.go(-1)" class="table-btn">返回 <i
                                                          class="fa fa-arrow-circle-left"></i></a>
                                          </div>-->
                                    </div>
                                    <div class="portlet-body application_box animated fadeIn">
                                        <br>
                                        <div class="well">
                                            <p><b><?php echo T('充值'), T('说明'); ?>：</b></p>
                                            <p style="margin-top: 6px;"><?php echo T('请仔细核对下表所列的账户资料是否存在误填'); ?></p>
                                            <p style="margin-top: 6px;"><span
                                                        class="caption-subject font-red-sunglo"><?php $params = Common_Function::rechargeParams();
                                                    echo T('充值'), T('金额为{money}的整数倍', array('money' => $params['rule'])); ?></span>
                                            </p>
                                        </div>
                                        <form id="recharge" class="form-horizontal" onsubmit="return false;">
                                            <input type="hidden" value="Recharge.DoRecharge" name="service"/>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('充值'), T('金额'); ?>
                                                    ：</label>
                                                <div class="col-md-5">
                                                    <input type="text" name="amount" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('货币类型'); ?>:</label>
                                                <div class="col-md-5">
                                                    <select name="moneyType" id="type1" class="form-control">
                                                        <?php $bonus_names = Common_Function::getBonusName();
                                                        foreach ($bonus_names as $key => $bonus_name): ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $bonus_name; ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo T('备注'); ?>:</label>
                                                <div class="col-md-5">
                                                    <textarea type="text" name="memo" class="form-control"> </textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button class="btn blue mt-clipboard" type="submit"><i
                                                                    class="fa fa-check"></i> <?php echo T('确认'), T('充值'); ?>
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
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('充值'), T('记录'); ?></span>
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
                                                <div class="form-group">
                                                    <label class="sr-only"><?php echo T('货币类型'); ?></label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="-1"><?php echo T('全部'); ?></option>
                                                        <?php $bonus_names = Common_Function::getBonusName();
                                                        foreach ($bonus_names as $key => $bonus_name): ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $bonus_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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

<!--充值选择-->
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/zh_CN.js'); ?>"></script>
<script>
    $(function () {

        /*充值切换*/
        $(".application").click(function () {
            $(".online").removeClass("blue").addClass("btn-default");
            $(this).removeClass("btn-default").addClass("blue");
            $(".online_box").hide();
            $(".application_box").show();
        });
        $(".online").click(function () {
            $(".application").removeClass("blue").addClass("btn-default");
            $(this).removeClass("btn-default").addClass("blue");
            $(".application_box").hide();
            $(".online_box").show();
        });
        $('.user-money input').each(function () {
            var self = $(this),
                label = self.next(),
                label_text = label.text();

            label.remove();
            self.iCheck({
                // checkboxClass: 'icheckbox_sm-blue',
                radioClass: 'radio_sm-blue',
                insert: label_text
            });
        });


        $(".iCheck-helper").click(function () {
            if ($(this).prev().attr("id") == "money_else") {
                $(".else").css("display", "inline-block");
            } else {
                $(".else").hide();
            }
        });


        $(".alipay").click(function () {
            $(this).parent().next().find(".wxpay").removeClass("pay_type_checked");
            $(this).addClass("pay_type_checked");
            $("#paytype").val("alipay");
        });

        $(".wxpay").click(function () {
            $(this).parent().prev().find(".alipay").removeClass("pay_type_checked");
            $(this).addClass("pay_type_checked");
            $("#paytype").val("wxpay");
        });

        $("#sendUp_online_yes").click(function () {
            var money1 = $("input[name=radioMoney]:checked").val();
            var money2 = $("input[name=inputMoney]").val();
            var rmoney = money1 > 0 ? money1 : money2;
            var mtype = $("select[name=type2]").val();
            var ptype = $("input[name=paytype]").val();
            //注意:由于js不能联合php写数组，所以暂时以这种方式输出
            if (mtype == 0) {
                var typename = "奖金币";
            } else if (mtype == 1) {
                var typename = "报单币";
            } else {
                var typename = "无"
            }
            //
            if (ptype == "alipay") {
                var ptypename = "支付宝";
            } else if (ptype == "wxpay") {
                var ptypename = "微信";
            } else {
                var ptypename = "无"
            }
            $(".user_m").text(rmoney);
            $("input[name=user_m]").val(rmoney);
            $(".user_t").text(typename);
            $("input[name=user_t]").val(mtype);
            $(".user_p").text(ptypename);
            $("input[name=user_p]").val(ptype);
        });


        var bonus_names = JSON.parse('<?php echo json_encode(Common_Function::getBonusName()); ?>');
        var check_names = JSON.parse('<?php echo json_encode(Common_Function::getCheckName()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'recharge_sn',
            title: '<?php echo T('编号')?>'
        }, {
            field: 'money',
            title: '<?php echo T('充值'), T('金额')?>'
        }, {
            field: 'money_type',
            title: '<?php echo T('货币类型')?>',
            formatter: function (value) {
                return bonus_names[value];
            }
        }, {
            field: 'memo',
            title: '<?php echo T('备注')?>'
        }, {
            field: 'status',
            title: '<?php echo T('状态')?>',
            formatter: function (value) {
                var text = check_names[value]
                switch (parseInt(value)){
                    case 0:
                        return '<span class="label label-warning">'+text+'</span>';
                        break;
                    case 1:
                        return '<span class="label label-success">'+text+'</span>';
                        break;
                    case 2:
                        return '<span class="label label-danger">'+text+'</span>';
                        break;
                }
            }
        }, {
            field: 'add_time',
            title: '<?php echo T('申请时间')?>',
            formatter: function (value) {
                return showTime(value);
            }
        }];
        var querystrLock = "{service:'Recharge.GetRechargeList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),type:$('#type').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('#recharge').formValidation({
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
                            message: '<?php echo T('充值'), T('金额为{money}的整数倍', array('money' => $params['rule'])); ?>',
                            callback: function (value, validator, $field) {
                                var rule = parseInt('<?php echo $params['rule'];?>');
                                return value % rule == 0 && value>0;
                            }
                        }
                    }
                },
            }
        });

    })
</script>

</body>
</html>