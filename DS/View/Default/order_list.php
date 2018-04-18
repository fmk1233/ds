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
                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('订单管理'); ?></span>
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
<style>
    .has-feedback label ~ .form-control-feedback {
        top: 33px;
    }
</style>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var order_status = JSON.parse('<?php echo json_encode(Domain_ShopOrders::orderStatus()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: '',
            visible: false
        }, {
            field: 'order_sn',
            title: '<?php echo T('编号')?>'
        }, {
            field: 'order_amount',
            title: '<?php echo T('订单金额')?>'
        }, {
            field: 'add_time',
            title: '<?php echo T('时间')?>',
            formatter: function (value) {
                return showTime(value);
            }
        }, {
            field: 'status',
            title: '<?php echo T('状态')?>',
            formatter: function (value) {
                return order_status[value];
            }
        }, {
            field: 'action',
            title: '<?php echo T('操作')?>',
            formatter: function (value, d) {
                var $html = '';
                switch (parseInt(d.status)) {
                    case 0:
                        $html += '<a class="btn btn-warning btn-outline btn-xs" data-service="Order.PayOrder" data-orderid="' + d.id + '" pay ><?php echo T('付款'); ?></a>';
                        $html += '<a class="btn btn-danger btn-outline btn-xs" data-service="Order.DelOrder" data-orderid="' + d.id + '" del><?php echo T('删除'); ?></a>';
                        break;
                    case 2:
                        $html += '<a class="btn btn-info btn-outline btn-xs" data-service="Order.ConfirmOrder" data-orderid="' + d.id + '" finish  ><?php echo T('收货'); ?></a>';
                    case 3:
                        $html += '<a class="btn btn-success btn-outline btn-xs"  data-code="' + d.delivery_code + '" data-com="' + d.delivery_name + '" data-sn="' + d.delivery_sn + '" look><?php echo T('物流'); ?></a>';
                        break;
                }
                $html += '<a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="Order.OrderInfo" data-id="'+ d.id +'" ><?php echo T('查看'); ?></a>';
                return $html;
            }
        }];
        var querystrLock = "{service:'Order.GetOrderList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[pay]', function () {
            var button = $(this);
            var params = button.data();
            confirmMsg('<?php echo T('你确认支付此订单吗') ?>', function () {
                sendButtonAjax(button, params, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + params.orderid + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', params.orderid);
                            rowData.status = d.data.status;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
        $('.table').on('click', 'a[finish]', function () {
            var button = $(this);
            var params = button.data();
            confirmMsg('<?php echo T('你确认此订单已收货吗') ?>', function () {
                sendButtonAjax(button, params, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            var row = $('.table tr[data-uniqueid="' + params.orderid + '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', params.orderid);
                            rowData.status = d.data.status;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        }
                    }
                });
            });
        });
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var params = button.data();
            confirmMsg('<?php echo T('你确认删除此订单吗') ?>', function () {
                sendButtonAjax(button, params, {
                    callback: function (d) {
                        if (d.code == 40000) {
//                            var row = $('.table tr[data-uniqueid="' + params.orderid + '"]');
//                            var index = row.data('index');
//                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', params.orderid);
//                            rowData.status = d.data.status;
                            oTableLock.table.bootstrapTable('removeByUniqueId',params.orderid);
                        }else{
                            alertMsg(d);
                        }
                    }
                });
            });
        });
        $('.table').on('click', 'a[look]', function () {
            var data = $(this).data();
            data.service = 'Order.Logistics';
            ajaxModel(data);
        });

    })
</script>
</body>
</html>