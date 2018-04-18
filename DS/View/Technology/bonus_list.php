<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
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
                    <h2> <?php switch($money_type):
                            case 0:
                                echo T('余额钱包');
                                break;
                            case 3:
                                echo T('报单币钱包');
                                break;
                            case 4:
                                echo T('购物币钱包');
                                break;
                        endswitch;?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('财务管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong> <?php switch($money_type):
                                    case 0:
                                        echo T('余额钱包');
                                        break;
                                    case 3:
                                        echo T('报单币钱包');
                                        break;
                                    case 4:
                                        echo T('购物币钱包');
                                        break;
                                endswitch;?></strong>
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
                                    <h5><?php switch($money_type):
                                            case 0:
                                                echo T('余额钱包'),T('记录');
                                                break;
                                            case 3:
                                                echo T('报单币钱包'),T('记录');
                                                break;
                                            case 4:
                                                echo T('购物币钱包'),T('记录');
                                                break;
                                        endswitch;?> </h5>

                                </div>
                                <div class="ibox-content sj-box-pad borderc">
                                    <div class="alert alert-danger" style="margin-top: 10px">
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
                                        endswitch;?>：<span id="recharge0" data-counter="counterup" data-value="<?php echo $in_total; ?>"><?php echo $in_total; ?></span>
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
                                        endswitch;?>：<span id="recharge3" data-counter="counterup" data-value="<?php echo $out_total; ?>"><?php echo $out_total; ?></span>
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
                                        endswitch;?>：<span id="recharge4" data-counter="counterup" data-value="<?php echo $user[BONUS_NAME.$money_type]; ?>"> <?php echo number_format($user[BONUS_NAME.$money_type],2); ?></span>
                                    </div>
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
                                    <table  class="table table-bordered table-condensed" data-mobile-responsive="true" >
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
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.waypoints.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.counterup.min.js'); ?>"
        type="text/javascript"></script>
<script>
    $(function () {
        //获取钱包列表数据
        var bonus_types = JSON.parse('<?php echo json_encode(Domain_Bonus::getBonusTypeNames()); ?>');
        var $columnsLock = [{
            field: 'add_time',
            title: '<?php echo T('日期')?>',
            formatter: function (value) {
                return $.myTime.UnixToDate(value,true);
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
