<!DOCTYPE html>
<html>
<link href="<?php echo URL_ROOT . '/static/'; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
<?php $this->view('header'); ?>
<style type="text/css">
    #bodys img {
        margin: 5px;
        width: auto;
        height: 40px;
    }

    .list {
        left: 0px;
        z-index: 1000000;
    }
    .keep-open.btn-group{
        display: none !important;
    }
    .columns .btn{
        -webkit-border-radius: 3px !important;
        -moz-border-radius: 3px !important;
        border-radius: 3px !important;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>商品订单管理</h5>
                </div>

                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" id="search" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="username">会员编号</option>
                                                <option value="ordersn">订单编号</option>
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
                                <label class="sr-only">会员等级</label>
                                <select name="order_state" id="order_state" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">待付款</option>
                                    <option value="1">待发货</option>
                                    <option value="2">待收货</option>
                                    <option value="3">已完成</option>
                                    <option value="4">已取消</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </div>
                    <table class="table table-responsive" id="bodys" v-cloak="">
                        <thead>
                        <tr>
                            <th data-align="left">商品</th>
                            <th data-align="right">单价/数量</th>
                            <th data-align="center">买家</th>
                            <th data-align="center">支付/配送</th>
                            <th data-align="center">价格</th>
                            <th data-align="center">下单时间</th>
                            <th data-align="center">状态</th>
                        </tr>
                        </thead>
                        <tbody v-for="(row ,index) in rows">
                        <tr>
                            <td colspan="4">订单编号：{{ row.order_sn }}</td>
                            <td colspan="3" class="text-right" style="padding-right: 20px !important;"
                                v-if="row.status==2||row.status==3"><a href="javascript:void(-1)"
                                                                       @click="logistics(row.delivery_code,row.delivery_sn,row.delivery_name)">查看物流</a>-<a
                                        data-toggle="url" data-service="GoodOrders.orderinfo" :data-id="row.id"
                                >查看详情</a></td>
                            <td colspan="3" class="text-right" style="padding-right: 20px !important;"
                                v-else-if="row.status==0"><a href="javascript:void(-1)"
                                                             @click="payOrder(index,row.id,2)">取消订单</a>-<a
                                        data-toggle="url" data-service="GoodOrders.OrderInfo" :data-id="row.id">查看详情</a>
                            </td>
                            <td colspan="3" class="text-right" style="padding-right: 20px !important;" v-else><a
                                        data-toggle="url" data-service="GoodOrders.OrderInfo" :data-id="row.id">查看详情</a>
                            </td>
                        </tr>
                        <tr class="text-center" v-for="(goods ,idx) in row.goods">
                            <td class="text-left"><img :src="goodsPic(goods.goods_pic)"> {{ goods.goods_name }}</td>
                            <td class="text-right">{{ goods.price }}<br>x {{ goods.total }}</td>
                            <td v-if="idx==0" :rowspan="row.goods.length">{{ row.buyer_name }}</td>
                            <td v-if="idx==0" :rowspan="row.goods.length">
                                <label class="label label-default">{{ row.pay_name }}</label><br>{{ row.delivery_name }}
                            </td>
                            <td v-if="idx==0" :rowspan="row.goods.length">{{ row.order_amount }}</td>
                            <td v-if="idx==0" :rowspan="row.goods.length" v-html="showTime(row.add_time)"></td>
                            <td v-if="row.status==0&&idx==0" :rowspan="row.goods.length"><span
                                        class="text-danger">待付款</span><br/><a class="btn btn-primary btn-xs"
                                                                              @click="payOrder(index,row.id,0)">确认付款</a>
                            </td>
                            <td v-else-if="row.status==1&&idx==0" :rowspan="row.goods.length"><span class="text-info">待发货</span><br/><a
                                        class="btn btn-primary btn-xs" @click="sendGoods(index,row.id)">确认发货</a></td>
                            <td v-else-if="row.status==2&&idx==0" :rowspan="row.goods.length"><span
                                        class="text-warning">待收货</span><br/><a class="btn btn-primary btn-xs"
                                                                               @click="payOrder(index,row.id,1)">确认收货</a>
                            </td>
                            <td v-else-if="row.status==3&&idx==0" :rowspan="row.goods.length"><span
                                        class="text-success">已完成</span></td>
                            <td v-else-if="row.status==4&&idx==0" :rowspan="row.goods.length"><span
                                        class="text-default">已取消</span></td>
                        </tr>

                        </tbody>
                        <tbody v-if="rows.length==0">
                        <tr class="no-records-found">
                            <td colspan="7">没有找到匹配的记录</td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<!--<script type="text/javascript" src="-->
<?php //echo URL_ROOT; ?><!--/static/js/plugins/chosen/chosen.jquery.js"></script>-->
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">

    $(function () {
        var data = {rows: []};
        var vue = new Vue({
            el: '#bodys',
            data: data,
            methods: {
                goodsPic: function (goods_pic) {
                    return goodsThumb(goods_pic);
                },
                showTime: function (time) {
                    return showTime(time);
                },
                payOrder: function (index, orderId, type) {
                    var msg = '', service = '';
                    if (type == 0) {
                        msg = '你确认支付此订单吗？';
                        service = 'GoodOrders.PayOrder';
                    } else if (type == 1) {
                        msg = '你确认此订单已经收货？';
                        service = 'GoodOrders.confirmOrder';
                    } else {
                        msg = '你确认要取消此订单？';
                        service = 'GoodOrders.cancelOrder';
                    }
                    confirmMsg(msg, function () {
                        ds.sendAjax({
                            data: {service: service, orderid: orderId},
                            success: function (d) {
                                if (d.code == 40000) {
                                    data.rows[index].status = d.data.status;
                                    successMsg(d, function () {
                                    });
                                } else {
                                    alertMsg(d);
                                }
                            }
                        })
                    });
                },
                sendGoods: function (index, orderId) {
                    var datas = {service: 'GoodOrders.sendGoods', id: orderId};
                    ajaxModel(datas);
                    $('#ajaxModel').on('submit', 'form', function () {
                        var datas = $(this).serializeObject();
                        ds.sendAjax({
                            data: datas,
                            success: function (d) {
                                data.rows[index].status = d.data.status;
                                $('#ajaxModel').modal('hide');
                                if (d.code == 40000) {
                                    successMsg(d, function () {
                                    });
                                } else {
                                    alertMsg(d);
                                }
                            }
                        });
                    });
                },
                logistics: function (delivery_code, delivery_sn, delivery_name) {
                    var datas = {
                        service: 'GoodOrders.LookDelivery',
                        code: delivery_code,
                        sn: delivery_sn,
                        com: delivery_name
                    };
                    ajaxModel(datas)
                }
            }

        });


        var querystrLock = "{service:'GoodOrders.GetOrderList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),order_state:$('#order_state').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            vueTable: true,
            showExport: false,
            showExportAll: true,
            onExportAll: function () {
                var str = eval('('+querystrLock+')');
                str.service='Export.OrderList';
                location.href = ds.url(str);
            },
            onLoadDataSuccess: function (d) {
                data.rows = d.rows;
            }
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#search').on('submit', function () {
            oTableLock.load();
        });


    });
</script>
</html>
