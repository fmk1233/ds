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
                        <div class="page-content-title">
                            <h1>
                                <?php switch($money_type):
                                    case 0:
                                        echo T('余额钱包');
                                        break;
                                    case 3:
                                        echo T('报单币钱包');
                                        break;
                                    case 4:
                                        echo T('购物币钱包');
                                        break;
                                endswitch;?>
                                <small></small>
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-briefcase fa-icon-medium"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number" data-counter="counterup" data-value="<?php echo $in_total; ?>"> <?php echo $in_total; ?> </div>
                                            <div class="desc">
                                                <?php switch($money_type):
                                                    case 0:
                                                        echo T('余额'),T('收入合计');
                                                        break;
                                                    case 3:
                                                        echo T('报单币'),T('收入合计');
                                                        break;
                                                    case 4:
                                                        echo T('购物币'),T('收入合计');
                                                        break;
                                                endswitch;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number" data-counter="counterup" data-value="<?php echo $user[BONUS_NAME.$money_type]; ?>"> <?php echo number_format($user[BONUS_NAME.$money_type],2); ?> </div>
                                            <div class="desc">
                                                <?php switch($money_type):
                                                    case 0:
                                                        echo T('余额');
                                                        break;
                                                    case 3:
                                                        echo T('报单币');
                                                        break;
                                                    case 4:
                                                        echo T('购物币');
                                                        break;
                                                endswitch;?>  </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat green">
                                        <div class="visual">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number" data-counter="counterup" data-value="<?php echo $out_total; ?>"> <?php echo $out_total; ?> </div>
                                            <div class="desc">
                                                <?php switch($money_type):
                                                    case 0:
                                                        echo T('余额'),T('支出合计');
                                                        break;
                                                    case 3:
                                                        echo T('报单币'),T('支出合计');
                                                        break;
                                                    case 4:
                                                        echo T('购物币'),T('支出合计');
                                                        break;
                                                endswitch;?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase">
                                                <?php switch($money_type):
                                                    case 0:
                                                        echo T('余额钱包'),T('记录');
                                                        break;
                                                    case 3:
                                                        echo T('报单币钱包'),T('记录');
                                                        break;
                                                    case 4:
                                                        echo T('购物币钱包'),T('记录');
                                                        break;
                                                endswitch;?>
                                            </span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" data-original-title="全屏" href="javascript:;"> </a>

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
                                                <button type="submit" class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                            </form>
                                        </div>
                                        <table data-min-width="768"   data-mobile-responsive="true" class="table table-hover" >
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
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/zh_CN.js'); ?>"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var bonus_types = JSON.parse('<?php echo json_encode(Domain_Bonus::getBonusTypeNames()); ?>');
        var $columnsLock = [{
            field: 'add_time',
            title: '<?php echo T('日期')?>',
            formatter: function (value) {
                return $.myTime.UnixToDate(value);
            }
        }, {
            field: 'bonus_type',
            title: '<?php echo T('类型')?>',
            formatter: function (value) {
                return bonus_types[value];
            }
        },  {
            field: 'memo',
            title: '<?php echo T('说明')?>'
        },  {
            field: 'is_out',
            title: '<?php echo T('收入')?>',
            formatter: function (value,d) {
                var money = value==0?d.money:0;
                return '<span class="label label-info">'+money+'</span>';
            }
        }, {
            field: 'money',
            title: '<?php echo T('支出')?>',
            formatter: function (value,d) {
                var money = d.is_out==0?0:value;
                return '<span class="label label-danger">'+money+'</span>';
            }
        }];
        var querystrLock = "{service:'Bonus.GetBonusList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),money_type:<?php echo $money_type ?>}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });

    })
</script>
</body>
</html>