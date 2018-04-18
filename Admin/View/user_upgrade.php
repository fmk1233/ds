<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <h5>会员升级管理</h5>
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
        var check_names = JSON.parse('<?php echo json_encode(Common_Function::getCheckName()); ?>');
        var rank_names = JSON.parse('<?php echo json_encode(Common_Function::getRankName()); ?>');
        var up_names = JSON.parse('<?php echo json_encode(Common_Function::upgradeName()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: 'ID'
        },{
            field:'user_name',
            title:'会员编号'
        },{
            field:'real_name',
            title:'会员姓名'
        },{
            field: 'old_rank',
            title: '<?php echo T('原级别')?>',
            formatter: function (value) {
                return rank_names[value];
            }
        }, {
            field: 'new_rank',
            title: '<?php echo T('申请级别')?>',
            formatter: function (value) {
                return rank_names[value];
            }
        },  {
            field: 'up_type',
            title: '<?php echo T('类型')?>',
            formatter:function (value) {
                return up_names[value];
            }
        }, {
            field: 'status',
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
            title: '<?php echo T('时间');?>',
            formatter: function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },{
            field:'action',
            title:'<?php echo T('操作') ?>',
            formatter:function (value,d) {
                var $html = '';
                if(d.status==0){
                    $html +='<a class="btn btn-danger btn-outline btn-xs" refuse data-service="DUser.DealUpgrade"  data-action="refuse" data-id="'+d.id+'"><i class="fa fa-ban"></i> 拒绝</a> ';
                    $html +='<a class="btn btn-primary btn-outline btn-xs" pass data-action="pass" data-service="DUser.DealUpgrade"  data-id="'+d.id+'"><i class="fa fa-check"></i> 通过</a> ';
                }else{
                    $html +='-';
                }
                return $html;
            }
        }];
        var querystrLock = "{service:'DUser.GetUpgradeList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
            exportOptions: {fileName: '会员升级信息'}
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });

        $('.table').on('click', 'a[refuse]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确认要拒绝该升级订单',function(){
                sendButtonAjax($this,data,{
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.status = d.data.status;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });

        });
        $('.table').on('click', 'a[pass]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确认要通过该升级订单',function(){
                sendButtonAjax($this,data,{
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.status = d.data.status;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });


    });

</script>

</html>
