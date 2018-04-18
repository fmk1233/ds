<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>提现管理</h5>
                </div>
                <div class="ibox-content padding-top">

                    <?php $this->view('tips'); ?>
                    <div class="alert alert-danger" style="margin-top: 10px">
                        已提现金额：<span id="pass_cash"></span> 待提现金额：<span id="wait_cash"></span> 拒绝提现金额：<span id="refuse_cash"></span>
                    </div>
                    <div id="toolbar">
                        <form class="form-inline" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="user_name">会员名称</option>
                                                <option value="user_id">会员ID</option>
                                                <option value="cash_sn">提现编号</option>
                                                <option value="id">提现ID</option>
                                                <option value="payment_admin">管理员</option>
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
                             <div class="form-group">
                                 <label class="sr-only">类型</label>
                                 <select name="state" id="state" class="form-control">
                                     <option value="-1">全部</option>
                                     <option value="0">未支付</option>
                                     <option value="1">已支付</option>
                                     <option value="2">系统拒绝</option>
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
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'id',
            title: 'ID'
        }, {
            field: 'cash_sn',
            title: '提现编号'
        }, {
            field: 'user_id',
            title: '会员ID'
        }, {
            field: 'user_name',
            title: '会员名称'
        }, {
            field: 'amount',
            title: '金额'
        }, {
            field: 'fee',
            title: '手续费'
        }, {
            field: 'add_time',
            title: '申请时间',
            formatter: function (value) {
                return  showTime(value);
            }
        }, {
            field: 'bank_name',
            title: '收款银行'
        }, {
            field: 'bank_no',
            title: '收款账号'
        },  {
            field: 'bank_user',
            title: '开户姓名'
        }, {
            field: 'payment_state',
            title: '支付状态',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '未支付';
                    case 1:
                        return '已支付';
                    case 2:
                        return '系统拒绝';
                }
            }
        },  {
            field: 'payment_admin',
            title: '管理员'
        }, {
            field: 'payment_time',
            title: '处理时间',
            formatter: function (value) {
                return showTime(value);
            }
        },{
            field:'action',
            title:'操作',
            formatter: function (value,d) {
                var $html = '';
                if(d.payment_state==0) {
                    $html += '<a class="btn btn-danger btn-outline btn-xs" data-action="refuse" data-service="DCash.DealCash"  data-id="' + d.id + '"><i class="fa fa-ban"></i> 拒绝</a> ';
                    $html += '<a class="btn btn-primary btn-outline btn-xs" data-action="pass" data-service="DCash.DealCash" data-id="' + d.id + '"><i class="fa fa-check"></i> 通过</a> ';
                }
                return $html;
            }

        }];
        var querystrLock = "{service:'DCash.GetCashList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),state:$('#state').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showExport:false,
            showExportAll:true,
            onExportAll:function () {
                var str = eval('('+querystrLock+')');
                str.service='Export.OrderList';
                location.href = (ds.url(str));
            },
            onLoadDataSuccess:function (d) {
                $('#pass_cash').html(d.pass_cash);
                $('#wait_cash').html(d.wait_cash);
                $('#refuse_cash').html(d.refuse_cash);
            }

        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click','a[data-action="refuse"]',function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要拒绝此提现订单，该提现订单金额将返还到余额中',function () {
                sendButtonAjax(button,data,{
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.payment_state = d.data;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
        $('.table').on('click','a[data-action="pass"]',function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要通过此提现订单',function () {
                sendButtonAjax(button,data,{
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                            rowData.payment_state = d.data;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
    });

</script>

</html>
