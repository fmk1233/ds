<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row animated fadeInUp">
        <div class="col-xs-12 col-lg-12">

            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>
                        财务明细
                    </h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" role="form" id="bonusSearch" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="member-user_name">会员编号</option>
                                            </select>
                                        </span>
                                    <input type="text" class="form-control w125" id="qvalue" name="qvalue" placeholder="搜索相关数据...">
                                </div>
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
                            <div class="form-group">
                                <label class="sr-only">奖金类型</label>
                                <select name="bonusType" id="bonusType" class="form-control">
                                    <option value="-1">全部</option>
                                    <?php $bonus_types = Domain_Bonus::getBonusTypeNames();foreach ($bonus_types as $key=>$bonus_type):  ?>
                                        <option value="<?php echo $key; ?>"><?php echo $bonus_type; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT.'/static/';?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var bonus_types = JSON.parse('<?php echo json_encode(Domain_Bonus::getBonusTypeNames()); ?>');
        var $columnsLock = [{
            field: 'add_time',
            title: '交易时间',
            formatter: function (value) {
                return $.myTime.UnixToDate(value, true);
            }
        }, {
            field: 'user_name',
            title: '用户编号',
            formatter: function (value) {
                return '<span class="text-primary">' + value + '</span>';
            }
        }, {
            field: 'money',
            title: '金额',
            formatter: function (value) {
                return '<span class="text-danger">' + value + '</span>';
            }
        }, {
            field: 'bonus_type',
            title: '类型',
            formatter: function (value) {
                return '<span class="text-info">'+bonus_types[value]+'</span>';
            }
        }, {
            field: 'frezze_state',
            title: '状态',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '<span >正常</span>';
                        break;
                    default:
                        return '<span class="text-success">冻结</span>';
                }

            }
        }, {
            field: 'memo',
            title: '备注'
        }];
        var querystrLock = "{service:'DBonus.BonusListAC',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),log_type:$('#log-type').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),bonusType:$('#bonusType').val(),memo:$('#memo').val()}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#bonusSearch').on('submit', function () {
            oTableLock.load();
        });
    });
</script>

</html>
