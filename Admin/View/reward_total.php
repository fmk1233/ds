<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <h5>奖金汇总管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div class="clearfix">
                        <div id="toolbar">
                            <form class="form-inline" id="userSearch" role="form" onsubmit="return false;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                <option value="user_name">会员编号</option>
                                                <option value="true_name">会员姓名</option>
                                                <option value="user_id">会员ID</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control" id="qvalue" name="qvalue"
                                               placeholder="搜索相关数据...">
                                    </div><!-- /input-group -->
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="laydate-icon form-control " id="s_time" name="s_time"
                                               placeholder="开始时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                        <span class="input-group-addon">到</span>
                                        <input type="text" class="laydate-icon form-control " id="e_time" name="e_time"
                                               placeholder="结束时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">搜索</button>
                            </form>
                        </div>
                        <table class="table" data-mobile-responsive="true">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [ {
            field: 'id',
            title: 'ID',
        },{
            field: 'user_name',
            title: '会员编号'

        },{
            field: 'true_name',
            title: '会员姓名'

        },<?php $prices = Domain_Reward::rewardPrice(); foreach ($prices as $key=>$price):?>
            {
                field: '<?php echo $price ?>',
                title: '<?php echo T($key)?>'
            },
            <?php endforeach;?>
            <?php $fees = Domain_Reward::rewardFee(); foreach ($fees as $key=>$fee):?>
            {
                field: '<?php echo $fee ?>',
                title: '<?php echo T($key)?>'
            }, <?php endforeach;?>
            {
                field: 'money',
                title: '<?php echo T('实得')?>'
            },
            <?php $bonus_names = Common_Function::getBonusName(); foreach ($bonus_names as $key=>$bonus_name): ?>
            {
                field: '<?php echo BONUS_NAME.$key;?>',
                title: '<?php echo $bonus_name;?>'
            },
            <?php endforeach; ?>
            {
                field: 'cash_money',
                title: '<?php echo T('提现金额')?>'
            },{
                field: 'recharge_money',
                title: '<?php echo T('充值金额')?>'
            }];
        var querystrLock = "{service:'Reward.GetRewardTotalList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showExport: true,
            showColumns: true,
            exportOptions: {fileName: '奖金汇总明细'}
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#userSearch').on('submit', function () {
            oTableLock.load();
        });


    });

</script>

</html>
