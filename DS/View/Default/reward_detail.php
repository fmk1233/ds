<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style type="text/css">
    .btn-white{color:inherit;background:#fff;border:1px solid #e7eaec}.btn-white.active,.btn-white:active,.btn-white:focus,.btn-white:hover,.open .dropdown-toggle.btn-white{color:inherit;border:1px solid #d2d2d2}.btn-white.active,.btn-white:active{box-shadow:0 2px 5px rgba(0,0,0,.15) inset}.btn-white.active,.btn-white:active,.open .dropdown-toggle.btn-white{background-image:none}.btn-white.active[disabled],.btn-white.disabled,.btn-white.disabled.active,.btn-white.disabled:active,.btn-white.disabled:focus,.btn-white.disabled:hover,.btn-white[disabled],.btn-white[disabled]:active,.btn-white[disabled]:focus,.btn-white[disabled]:hover,fieldset[disabled] .btn-white,fieldset[disabled] .btn-white.active,fieldset[disabled] .btn-white:active,fieldset[disabled] .btn-white:focus,fieldset[disabled] .btn-white:hover{color:#cacaca}
    .btn-white.active, .btn-white:active {
        background-color: #cacaca ;
    }
</style>

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
                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('奖金明细'); ?></span>
                                        </div>

                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                               data-container="false" data-placement="bottom" data-original-title="全屏"
                                               href="javascript:;"> </a>
                                            <div class="pull-right" id="group" style="margin-left: 15px;">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-white active" data-group="">条</button>
                                                    <button type="button" class="btn btn-xs btn-white" data-group="day">天</button>
                                                    <button type="button" class="btn btn-xs btn-white" data-group="week">周</button>
                                                    <button type="button" class="btn btn-xs btn-white" data-group="month">月</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <div id="toolbar">
                                            <form class="form-inline hidden" role="form" onsubmit="return false;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                 <option value="periods">奖金期数</option>
                                            </select>
                                        </span>
                                                        <input type="text" class="form-control" id="qvalue" name="qvalue"
                                                               placeholder="搜索相关数据...">
                                                    </div><!-- /input-group -->
                                                </div>
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
                                            <button type="button" class="btn btn-white" id="back" onclick="javascript:history.go(-1);"><i class="fa fa-reply"></i> 返回</button>
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
<style>
    .has-feedback label ~ .form-control-feedback {
        top: 33px;
    }
</style>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript"  src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script>
    $(function () {
        var group = '';
        //获取钱包列表数据
        var bonus_names = JSON.parse('<?php echo json_encode(Common_Function::getBonusName()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: '<?php echo T('ID')?>'
        },{
            field: 'periods',
            title: '<?php echo T('期数')?>'
        }, /*{
            field: 'user_name',
            title: ''
        }, {
            field: 'true_name',
            title: '
        },*/
            <?php $prices = Domain_Reward::rewardPrice(); foreach ($prices as $key=>$price):?>
            {
                field: '<?php echo $price ?>',
                title: '<?php echo T($key)?>'
            },
            <?php endforeach;?>
            <?php $fees = Domain_Reward::rewardFee(); foreach ($fees as $key=>$fee):?>
            {
                field: '<?php echo $fee ?>',
                title: '<?php echo T($key)?>'
            },
            <?php endforeach;?>
            {
                field: 'money',
                title: '<?php echo T('实得')?>'
            },
            {
                field: 'add_time',
                title: '<?php echo T('时间')?>',
                formatter: function (value,d) {
                    if (group != '') {
                        return d.days;
                    }
                    return showTime(value);
                }
            },{
                field: 'control',
                title: '操作',
                visible: false,
                formatter: function (value, d) {
                    if (group == '') {
                        return '-';
                    }else{
                        return ' <a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="Reward.RewardDetail" data-username="'+d.user_name+'" data-group="'+group+'" data-days="'+d.days+'">查看详情</a> ';
                    }
                }
            }];
        var querystrLock = "{service:'Reward.GetRewardList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),group:$('#group').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('#group .btn-group button').on('click', function () {
            var button = $(this);
            if(button.hasClass('active')){
                return;
            }
            $('.btn-group button').removeClass('active');
            button.addClass('active');
            group = button.data('group');
            $('#group').val(group);
            if(group!=''){
                oTableLock.table.bootstrapTable('showColumn','control');
            }else{
                oTableLock.table.bootstrapTable('hideColumn','control')
            }
            oTableLock.load();
        });

    })
</script>
</body>
</html>