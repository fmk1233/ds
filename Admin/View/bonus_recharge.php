<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row animated fadeInUp">
        <div class="col-xs-12 col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        充值明细
                    </h5>
                        <a class="btn btn-danger pull-right" style="margin-top: -10px;" onclick="ajaxModel({service:'DBonus.doRecharge',action:'add'})"><i class="fa fa-money"></i> 充值</a>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>

                    <div class="alert alert-danger" style="margin-top: 10px">
                        <?php $bonus_names=Common_Function::getBonusName(); foreach($bonus_names as $key=>$bonus_name): ?>
                            <?php echo $bonus_name; ?>充值金额：<span id="recharge<?php echo $key; ?>"></span>
                        <?php endforeach;?>
                    </div>
                    <div id="toolbar">
                        <form class="form-inline" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="user_name">会员名称</option>
                                                <option value="true_name">会员姓名</option>
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
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script type="text/javascript">
    $(function () {

        var bonus_names = JSON.parse('<?php echo json_encode(Common_Function::getBonusName()) ?>');
        var $columnsLock = [{
            field: 'id',
            title: 'ID'
        }, {
            field: 'recharge_sn',
            title: '充值编号'
        }, {
            field: 'user_name',
            title: '会员名称'
        }, {
            field: 'true_name',
            title: '会员姓名'
        }, {
            field: 'money',
            title: '充值金额'
        },   {
            field: 'money_type',
            title: '充值金额类型',
            formatter: function (value) {
                return bonus_names[value];
            }
        },  {
            field: 'recharge_type',
            title: '充值方式',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '系统';
                    case 1:
                        return '会员';
                    case 2:
                        return '微信';
                    case 3:
                        return '支付宝';
                }
            }
        }, {
            field: 'status',
            title: '充值状态',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '待审核';
                    case 1:
                        return '已通过';
                    case 2:
                        return '拒绝';
                }
            }
        },{
            field: 'add_time',
            title: '申请时间',
            formatter: function (value) {
                return showTime(value);
            }
        },  {
            field: 'check_time',
            title: '处理时间',
            formatter: function (value) {
                return showTime(value);
            }
        },{
            field:'action',
            title:'操作',
            formatter: function (value,d) {
                var $html = '';
                if(d.status==0){
                    $html +='<a class="btn btn-danger btn-outline btn-xs" refuse data-service="DBonus.DealRecharge"  data-action="refuse" data-id="'+d.id+'"><i class="fa fa-ban"></i> 拒绝</a> ';
                    $html +='<a class="btn btn-primary btn-outline btn-xs" pass data-action="pass" data-service="DBonus.DealRecharge"  data-id="'+d.id+'"><i class="fa fa-check"></i> 通过</a> ';
                }else{
                    $html +='-';
                }
                return $html;
            }

        }];
        var querystrLock = "{service:'DBonus.RechargeList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
            onLoadDataSuccess:function (d) {
                for (var key in d){
                    if($('#'+key).length>0){
                        $('#'+key).html(d[key]);
                    }
                }
            }
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
        //拒绝充值订单
        $('.table').on('click','a[refuse]',function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要拒绝该充值订单',function () {
                sendButtonAjax(button, data, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.status = d.data;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
        //同意充值订单
        $('.table').on('click','a[pass]',function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要通过该充值订单',function () {
                sendButtonAjax(button, data, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.status = d.data;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
    });
</script>
</html>
