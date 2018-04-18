<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row animated fadeInUp" >
        <div class="col-xs-12 col-lg-12">

            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>订单匹配</h5>
                    <div class="ibox-tools" style="margin-bottom: 10px">
                        <a id="autoMatch" class="btn btn-primary btn-xs">自动匹配</a>
                    </div>
                </div>
                <div class="ibox-content clr">
                    <div class="alert alert-warning clr">

                        <form class="form-horizontal col-md-7" method="post"  id="pporder" action="" onsubmit="return false;">

                            <div class="form-group">
                                <label  class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-money"></i> 进场订单编号</label>
                                <div class="col-sm-9">

                                    <input type="text" name="codeIn" class="form-control" placeholder="请输入进场订单编号">

                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-money"></i> 出场订单编号</label>
                                <div class="col-sm-9">
                                    <input type="text" min="1" name="codeOut" class="form-control" placeholder="请输入出场订单编号">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label hidden-xs"></label>
                                <div class="col-sm-9">
                                    <div class="market">
                                        <button  class="orange btn btn-warning dim " type="submit" style="padding: 10px !important; "><div><i class="fa fa-trophy"></i> 确认匹配</div>
                                        </button>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>

            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>交易处理大厅</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content actuser-box clr">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#orderIn" aria-expanded="true"> 进场订单</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#orderOut" aria-expanded="false">出场订单</a>
                                <li class=""><a data-toggle="tab" href="#orderpp" aria-expanded="false">匹配信息</a>
                                </li>
                            </ul>
                            <div class="tab-content ">
                                <div id="orderIn" class="tab-pane active" >
                                    <div class="panel-body">

                                        <div class="alert alert-success">
                                            金额：￥ <em class="money">0</em>
                                        </div>
                                        <form class="form-inline" role="form" id="orderIn" onsubmit="return false;">
                                            <div class="form-group">
                                                <label class="sr-only" >会员ID</label>
                                                <input type="text" class="form-control" name="userId" placeholder="请输入会员ID">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >会员编号</label>
                                                <input type="text" class="form-control" name="username" placeholder="请输入会员编号">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >开始时间</label>
                                                <input type="text" class="laydate-icon form-control " name="s_time" placeholder="请输入开始时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >结束时间</label>
                                                <input type="text" class="laydate-icon form-control " name="e_time" placeholder="请输入结束时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                            </div>
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </form>
                                        <div  class="hr-line-dashed"></div>

                                        <table orderId="true" data-mobile-responsive="true">
                                        </table>
                                    </div>
                                </div>
                                <div id="orderOut" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="alert alert-success">
                                            金额：￥ <em class="money">0</em>
                                        </div>
                                        <form class="form-inline" role="form" id="orderOut" onsubmit="return false;">
                                            <div class="form-group">
                                              <label class="sr-only" >会员ID</label>
                                              <input type="text" class="form-control" name="userId" placeholder="请输入会员ID">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >会员编号</label>
                                                <input type="text" class="form-control" name="username" placeholder="请输入会员编号">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >开始时间</label>
                                                <input type="text" class="laydate-icon form-control " name="s_time" placeholder="请输入开始时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >结束时间</label>
                                                <input type="text" class="laydate-icon form-control " name="e_time" placeholder="请输入结束时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                            </div>
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </form>
                                        <hr/>
                                        <table orderOut="true" data-mobile-responsive="true">
                                        </table>
                                    </div>
                                </div>
                                <div id="orderpp" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-inline" role="form" id="orderP" onsubmit="return false;">
                                            <div class="form-group">
                                                <label class="sr-only" >会员ID</label>
                                                <input type="text" class="form-control" name="in_userId" placeholder="请输入进场会员ID">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >会员ID</label>
                                                <input type="text" class="form-control" name="out_userId" placeholder="请输入出场会员ID">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >会员ID</label>
                                                <input type="text" class="form-control" name="in_order_id" placeholder="请输入进场单号">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" >会员ID</label>
                                                <input type="text" class="form-control" name="out_order_id" placeholder="请输入出场单号">
                                            </div>
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </form>
                                        <hr/>
                                        <table orderpp="true" data-mobile-responsive="true">
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
            </div>

        </div>


    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script type="text/javascript" src="<?php echo URL_ROOT.'/static/';?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {

        $('#pporder').on('submit',function () {
            var button = $(this).find(":input[type='submit']");
            if(button.hasClass('disabled')){
                return false;
            }
            button.addClass('disabled');
            ds.sendAjax({
                data:{service:"DOrders.MatchOrder",inCode:$('#pporder input[name="codeIn"]').val(),outCode:$('#pporder input[name="codeOut"]').val()},
                success:function (data) {
                    button.removeClass('disabled');
                    if(data.code==40000){
                        successMsg('匹配成功',function () {
                            location.reload();
                        });
                    }else{
                        alertMsg(data);
                    }
                }
            });

        });

        $('#autoMatch').on('click',function () {
            var button = $(this);
            if(button.hasClass('disabled')){
                return false;
            }
            confirmMsg('您确认要自动匹配！！',function () {
                if(button.hasClass('disabled')){
                    return false;
                }
                button.addClass('disabled');
                ds.sendAjax({
                    data:{service:'DOrders.AutoMatch'},
                    dataType:'json',
                    success:function (data) {
                        button.removeClass('disabled');
                        if(data.code==40000){
                            successMsg('自动匹配成功',function () {
                                location.reload();
                            });
                        }else{
                            alertMsg(data);
                        }
                    }
                });
            },{showLoaderOnConfirm:true});

        });

        var $columnsIn = [{
            field: 'id',
            title: '<i class="fa fa-clock-o"></i> 编号'
        },{
            field: 'order_id',
            title: '<i class="fa fa-clock-o"></i> 订单编号'
        },{
            field: 'user_name',
            title: '<i class="fa fa-clock-o"></i> 会员账号'
        },{
            field: 'bank_user',
            title: '<i class="fa fa-clock-o"></i> 会员姓名'
        }, {
            field: 'addtime',
            title: '<i class="fa fa-clock-o"></i> 日期',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        }, {
            field: 'money',
            title: '<i class="fa fa-money"></i> 挂单金额',
            formatter:function (value) {
                return '<span class="text-warning">'+value+'</span>';
            }
        },{
            field: 'money_two',
            title: '<i class="fa fa-money"></i> 未匹配金额',
            formatter:function (value) {
                return '<span class="text-danger">'+value+'</span>';
            }
        },{
            field: 'is_sh',
            title: '<i class="fa fa-exclamation"></i> 匹配状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<span class="text-primary">未匹配</span>';
                        break;
                    case 1:
                        return '<span class="text-warning">部分匹配</span>';
                        break;
                    case 2:
                        return '<span class="text-danger">完全匹配</span>';
                        break;
                }
            }
        },  {
            field: 'is_pay',
            title: '<i class="fa fa-exclamation"></i> 订单状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<span >正常</span>';
                        break;
                    case 2:
                        return '<span class="text-error" >冻结</span>&nbsp;&nbsp<a class="btn-danger btn unfrezze">解冻</a>';
                        break;
                    default:
                        return '<span class="text-success">交易完成</span>';
                }

            }
        },{
            field: 'meno',
            title: '<i class="fa fa-clock-o"></i> 备注单号'
        }];
        var querystrIn = "{s_type:0,userId:$('#orderIn :input[name=\"userId\"]').val(),userName:$('#orderIn :input[name=\"username\"]').val(),s_time:$('#orderIn :input[name=\"s_time\"]').val(),e_time:$('#orderIn :input[name=\"e_time\"]').val()}";
        var optionsIn = {
            url: '?service=DOrders.OrderList',
            columns: $columnsIn,
            onLoadDataSuccess:function (d) {
                $('#orderIn .money').text(d.money);
            }
        };
        var oTableIn = $('table[orderId]').tableInit(optionsIn, querystrIn);
        oTableIn.Init();
        $('#orderIn').on('submit',function () {
            oTableIn.load();
        });


        var $columnsOut = [{
            field: 'id',
            title: '<i class="fa fa-clock-o"></i> 编号',
            formatter:function (value) {
                return '<a href="javascript:void(-1);">'+value+'</a>';
            }

        },{
            field: 'order_id',
            title: '<i class="fa fa-clock-o"></i> 订单编号'
        },{
            field: 'user_name',
            title: '<i class="fa fa-clock-o"></i> 会员账号'
        },{
            field: 'bank_user',
            title: '<i class="fa fa-clock-o"></i> 会员姓名'
        }, {
            field: 'addtime',
            title: '<i class="fa fa-clock-o"></i> 日期',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        }, {
            field: 'money',
            title: '<i class="fa fa-money"></i> 挂单金额',
            formatter:function (value) {
                return '<span class="text-warning">'+value+'</span>';
            }
        },{
            field: 'money_two',
            title: '<i class="fa fa-money"></i> 未匹配金额',
            formatter:function (value) {
                return '<span class="text-danger">'+value+'</span>';
            }
        },{
            field: 'is_sh',
            title: '<i class="fa fa-exclamation"></i> 匹配状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<span class="text-primary">未匹配</span>';
                        break;
                    case 1:
                        return '<span class="text-warning">部分匹配</span>';
                        break;
                    case 2:
                        return '<span class="text-danger">完全匹配</span>';
                        break;
                }
            }
        },  {
            field: 'is_pay',
            title: '<i class="fa fa-exclamation"></i> 订单状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<span >正常</span>';
                        break;
                    case 2:
                        return '<span class="text-error" >冻结</span>&nbsp;&nbsp;<a class="btn-danger btn unfrezze">解冻</a>';
                        break;
                    default:
                        return '<span class="text-success">交易完成</span>';
                }

            }
        },{
            field: 'money_type',
            title: '<i class="fa fa-clock-o"></i> 钱包类型',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 1:
                        return '<span class="text-error" ><?php echo T('推广钱包'); ?></span>';
                        break;
                    case 5:
                        return '<span class="text-error" ><?php echo T('本金钱包'); ?></span>';
                        break;
                    default:
                        return '<span class="text-success"><?php echo T('余额'); ?></span>';
                }

            }
        },{
            field: 'is_q',
            title: '<i class="fa fa-exclamation"></i> 抢单池',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<a class="btn-info btn" inQ>进入</a>';
                        break;
                    default:
                        return '<a class="btn-danger btn" outQ>退出</a>';
                }
            }
        }];
        var querystrOut = "{s_type:1,userId:$('#orderOut :input[name=\"userId\"]').val(),userName:$('#orderOut :input[name=\"username\"]').val(),s_time:$('#orderOut :input[name=\"s_time\"]').val(),e_time:$('#orderOut :input[name=\"e_time\"]').val()}";
        var optionsOut = {
            url: '?service=DOrders.OrderList',
            columns: $columnsOut,
            onLoadDataSuccess:function (d) {
                $('#orderOut .money').text(d.money);
            }

        };
        var oTableOut = $('table[orderOut]').tableInit(optionsOut, querystrOut);
        oTableOut.Init();
        $('#orderOut').on('submit',function () {
            oTableOut.load();
        });


        $('table[orderOut]').on('click','a[inQ]',function () {
            var button = $(this);
            if(button.hasClass('disabled')){
                return false;
            }
            button.addClass('disabled');
            ds.sendAjax({
                data:{service:"DOrders.InQOrder",orderId:button.parents('tr').find('a').html()},
                success:function (data) {
                    button.removeClass('disabled');
                    if(data.code==40000){
                        successMsg('进入抢单池成功',function () {
                            oTableOut.load();
                        });
                    }else{
                        alertMsg(data);
                    }
                }
            });

        });
        $('table[orderOut]').on('click','a[outQ]',function () {
            var button = $(this);
            if(button.hasClass('disabled')){
                return false;
            }
            button.addClass('disabled');
            ds.sendAjax({
                data:{service:"DOrders.OutQOrder",orderId:button.parents('tr').find('a').html()},
                success:function (data) {
                    button.removeClass('disabled');
                    if(data.code==40000){
                        successMsg('退出抢单池成功',function () {
                            oTableOut.load();
                        });
                    }else{
                        alertMsg(data);
                    }
                }
            });

        });


        var $columnsPP = [{
            field: 'id',
            title: '<i class="fa fa-file-text-o"></i> 匹配单编号'
        }, {
            field: 'order_id',
            title: '<i class="fa fa-file-text-o"></i> 进场单编号',

        }, {
            field: 'uid',
            title: '<i class="fa fa-user"></i> 进场用户编号',

        },{
            field: 'b_order_id',
            title: '<i class="fa fa-file-text-o"></i> 出场单编号'
        }, {
            field: 'b_uid',
            title: '<i class="fa fa-user"></i> 出场用户编号',

        },  {
            field: 'addtime',
            title: '<i class="fa fa-clock-o"></i> 创建时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },  {
            field: 'okdt',
            title: '<i class="fa fa-clock-o"></i> 结束时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },  {
            field: 'money',
            title: '<i class="fa fa-money"></i> 匹配金额',
            formatter:function (value) {
                return '<span class="text-warning">'+value+'</span>'
            }
        },  {
            field: 'is_buy',
            title: '<i class="fa fa-exclamation"></i> 状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 1:
                        return '<span class="text-danger">等待确认打款</span>&nbsp;<a class="btn-danger btn" deletePP data-type="0">取消匹配</a>&nbsp;<a class="btn-danger btn" deletePP data-type="1">未打款</a>';
                        break;
                    case 2:
                        return '<span class="text-danger">等待确认收款</span>&nbsp;<a class="btn-danger btn " deletePP data-type="0">假凭证</a>&nbsp;<a class="btn-danger btn " deletePP data-type="1">取消匹配</a>';
                        break;
                    case 3:
                        return '<span class="text-green">交易成功</span>';
                        break;
                }
            }
        }];
        var querystrPP = "{in_userId:$('#orderpp :input[name=\"in_userId\"]').val(),out_userId:$('#orderpp :input[name=\"out_userId\"]').val(),in_order_id:$('#orderpp :input[name=\"in_order_id\"]').val(),out_order_id:$('#orderpp :input[name=\"out_order_id\"]').val()}";
        var optionsPP= {
            url: '?service=DOrders.PPOrderList',
            columns: $columnsPP
        };

        var oTablePP= $('table[orderpp]').tableInit(optionsPP, querystrPP);
        oTablePP.Init();
        $('#orderP').on('submit',function () {
            oTablePP.load();
        });
        $('table[orderpp]').on('click','a[deletePP]',function () {
            var button = $(this);
            if(button.hasClass('disabled')){
                return false;
            }
            var ppid = button.parent().parent().find('td:first-child').html();
            var type = button.data('type');
            confirmMsg('您确认要撤销此次匹配',function () {
                if(button.hasClass('disabled')){
                    return false;
                }
                button.addClass('disabled');
                ds.sendAjax({
                    data: {service: "DOrders.DeletePP", ppid: ppid, type: type},
                    success: function (data) {
                        button.removeClass('disabled');
                        if (data.code == 40000) {
                            successMsg('撤销匹配成功', function () {
                                location.reload();
                            });
                        } else {
                            alertMsg(data);
                        }
                    }
                });
            });

        });


        $('table').on('click','.unfrezze',function () {
            var button = $(this);
            if(button.hasClass('disabled')){
                return false;
            }
            var orderId = button.parent().parent().find('td:first-child').html();
            confirmMsg('您确认要解冻此订单',function () {
                if(button.hasClass('disabled')){
                    return false;
                }
                button.addClass('disabled');
                ds.sendAjax({
                    data:{service:"DOrders.unfrezzeOrder",orderId:orderId},
                    success:function (data) {
                        button.removeClass('disabled');
                        if(data.code==40000){
                            successMsg('解冻成功',function () {
                                location.reload();
                            });
                        }else{
                            alertMsg(data);
                        }
                    }
                });
            });

        });

    });
</script>

</html>
