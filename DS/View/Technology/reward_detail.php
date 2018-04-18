<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style type="text/css">
        .btn-white{color:#333;background:#fff;border:1px solid #e7eaec}.btn-white.active,.btn-white:active,.btn-white:focus,.btn-white:hover,.open .dropdown-toggle.btn-white{color:inherit;border:1px solid #d2d2d2}.btn-white.active,.btn-white:active{box-shadow:0 2px 5px rgba(0,0,0,.15) inset}.btn-white.active,.btn-white:active,.open .dropdown-toggle.btn-white{background-image:none}.btn-white.active[disabled],.btn-white.disabled,.btn-white.disabled.active,.btn-white.disabled:active,.btn-white.disabled:focus,.btn-white.disabled:hover,.btn-white[disabled],.btn-white[disabled]:active,.btn-white[disabled]:focus,.btn-white[disabled]:hover,fieldset[disabled] .btn-white,fieldset[disabled] .btn-white.active,fieldset[disabled] .btn-white:active,fieldset[disabled] .btn-white:focus,fieldset[disabled] .btn-white:hover{color:#cacaca}
        .btn-white.active, .btn-white:active {
            background-color: #cacaca ;
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
                    <h2><?php echo T('奖金明细'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('财务管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('奖金明细'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?php echo T('奖金明细'); ?> </h5>
                                </div>
                                <div class="ibox-content sj-box-pad borderc">

                                    <div id="toolbar">
                                        <form class="form-inline hidden" id="userSearch" role="form" onsubmit="return false;">
                                            <div class="form-group">
                                                <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                <option value="user_name" selected>会员编号</option>
                                                <option value="true_name">会员姓名</option>
                                                <option value="user_id">会员ID</option>
                                            </select>
                                        </span>
                                                    <input type="text" class="form-control" id="qvalue" name="qvalue"  value="<?= $username;?>"
                                                           placeholder="搜索相关数据...">
                                                </div><!-- /input-group -->
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="laydate-icon form-control " id="s_time" name="s_time" value="<?= $s_time;?>"
                                                           placeholder="开始时间"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                    <span class="input-group-addon">到</span>
                                                    <input type="text" class="laydate-icon form-control " id="e_time" name="e_time" value="<?= $e_time;?>"
                                                           placeholder="结束时间"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                </div>
                                            </div>
                                            <input type="hidden" value="1" id="search_type"/>
                                            <input type="hidden" value="day" name="group"/>
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </form>
                                        <button type="button" class="btn btn-white" id="back" onclick="javascript:history.go(-1);"><i class="fa fa-reply"></i> 返回</button>
                                    </div>
                                    <table  class="table" data-mobile-responsive="true">
                                    </table>
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

<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script>
    $(function () {
        var group = '';
        //获取钱包列表数据
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
