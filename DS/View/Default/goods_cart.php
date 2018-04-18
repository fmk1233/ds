<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style type="text/css">
    .goods_cart img {
        max-width: 80px;
        max-height: 80px;
    }

    .text-navy {
        color: #1ab394;
    }

    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        vertical-align: middle;
    }

    .fixed-table-pagination {
        display: none !important;
    }

    .btn-white {
        color: inherit;
        background: white;
        border: 1px solid #e7eaec;
    }
</style>
<link href="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css'); ?>">
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
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="page-content-title">
                            <h1><?php echo T('我的购物车'); ?>
                                <small></small>
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <form class="form-horizontal" id="cash" onsubmit="return false;">
                                    <div class="portlet light">
                                        <input type="hidden" name="service" value="Order.AddOrders"/>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><span
                                                        class="text-danger">*</span> <?php echo T('联系人'); ?></label>

                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="realname"
                                                       value="<?php echo $address['realname']; ?>"
                                                       placeholder="<?php echo T('输入'), T('联系人'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><span
                                                        class="text-danger">*</span> <?php echo T('手机号码'); ?></label>

                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="phone"
                                                       value="<?php echo $address['mobile']; ?>"
                                                       placeholder="<?php echo T('输入'), T('手机号码'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><span
                                                        class="text-danger">*</span> <?php echo T('省市区'); ?>
                                            </label>

                                            <div class="col-md-5">
                                                <select name="province" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="city" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                                <select name="area" class="form-control" style="width: 33.33333333%;float: left;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo T('详细地址'); ?>：</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="address"
                                                       value="<?php echo $address['address']; ?>"
                                                       placeholder="<?php echo T('输入'), T('详细地址'); ?>">
                                            </div>
                                        </div>

                                        <div class="portlet-body goods_cart">
                                            <table data-min-width="768" data-valign="center"
                                                   data-mobile-responsive="true"
                                                   class="table table-striped table-hover">
                                            </table>
                                        </div>
                                        <div style="margin-top: 20px">
                                            <button class="btn btn-primary pull-right" type="submit"><i
                                                        class="fa fa fa-shopping-cart"></i> <?php echo T('确定购物'); ?>
                                            </button>
                                            <span class="btn pull-right"><?php echo T('订单金额'); ?> <i
                                                        class="fa fa fa-cny "></i> <i id="total"
                                                                                      style="color: red">0</i></span>
                                            <a class="btn btn-white" data-toggle="url" data-service="Order.GoodsList" ><i
                                                        class="fa fa-arrow-left"></i> <?php echo T('继续购物'); ?></a>
                                        </div>
                                </form>
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
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js'); ?>"></script>
<!-- 省市区插件-->
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        var data = [];
        new PCAS('province','city','area','<?php echo $address['province'];?>','<?php echo $address['city'];?>','<?php echo $address['area'];?>');
        function changeNum() {
            $(".touchspin1").TouchSpin({
                min: 1,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: 'btn btn-default',
                buttonup_class: 'btn btn-default'
            });
            $('.touchspin1').on('change', function () {
                var $this = $(this);
                var value = $this.val();
                ds.sendAjax({
                    data: {service: 'Order.ChangeCart', cartid: $this.data('id'), num: value},
                    success: function (d) {
                        if (d.code == 40000) {
                            if (d.data && d.data.total) {
                                $this.val(d.data.total);
                                alertMsg(d);
                            } else {
                                var index = $('tr[data-uniqueid="' + $this.data('id') + '"]').data('index');
                                data[index]['total'] = value;
                                oTableLock.table.bootstrapTable('updateRow', {index: index, row: data[index]});
                                calcTotal(data);
                            }
                        } else {
                            alertMsg(d);
                        }
                    }
                })
            });
        }

        function calcTotal(d) {
            var total = 0;
            for (var i = 0, len = d.length; i < len; i++) {
                var goods = d[i];
                var price = goods.price;
                if (goods['option_id'] != '') {
                    var goods_options = JSON.parse(d[i]['goods_option']);
                    for (var j = 0, lens = goods_options.length; j < lens; j++) {
                        if (goods_options[j]['option_id'] == goods['option_id']) {
                            price = goods_options[j]['option_price'];
                            break;
                        }
                    }
                }
                total += price * d[i]['total'];
            }
            $('#total').html(parseFloat(total).toFixed(2));
        }

        var $columnsLock = [{
            field: 'id',
            title: '',
            visible: false
        }, {
            field: 'goods_name',
            title: '',
            formatter: function (value, d) {
                var option = d.option_id;
                var name = d.goods_name;
                if (option != '') {
                    var goods_options = JSON.parse(d.goods_option);
                    for (var i = 0, len = goods_options.length; i < len; i++) {
                        if (goods_options[i]['option_id'] == option) {
                            name += '('+goods_options[i]['option_title']+')';
                            break;
                        }
                    }
                }
                var $html = '';
                $html += '<div style="display: inline-block;padding: 5px;vertical-align: middle"><img src="' + goodsThumb(d.goods_pics.split(',')[0]) + '"></div>';
                $html += '<div style="display: inline-block;padding: 5px;vertical-align: middle"><h4><a data-toggle="url" data-service="Order.GoodsDetail" data-goodsid="'+d.goods_id+'" class="text-navy">' + name + '</a></h4><div class="m-t-sm"><a class="text-muted" del data-service="Order.DelCart" data-cartid="' + d.id + '"><i class="fa fa-trash"></i> <?php echo T('移出购物车') ?></a></div>';
                return $html;
            }
        }, {
            field: 'price',
            title: '',
            formatter: function (value, d) {
                var option = d.option_id;
                var price = value;
                var market_price = d.market_price;
                if (option != '') {
                    var goods_options = JSON.parse(d.goods_option);
                    for (var i = 0, len = goods_options.length; i < len; i++) {
                        if (goods_options[i]['option_id'] == option) {
                            price = goods_options[i]['option_price'];
                            market_price = goods_options[i]['option_marketprice'];
                            break;
                        }
                    }
                }
                var $html = '';
                $html += '<i class="fa fa fa-cny "></i>' + price + '<br/>';
                $html += '<s class="small text-muted"><i class="fa fa fa-cny "></i>' + market_price + '</s>';
                return $html;
            }
        }, {
            field: 'total',
            title: '',
            width: '150px',
            formatter: function (value, d) {
                var $html = '';
                $html += '<input class="touchspin1" id="num" type="text" value="' + value + '" data-id="' + d.id + '" name="num">';
                return $html;
            }
        }, {
            field: 'subtotal',
            title: '',
            formatter: function (value, d) {
                var option = d.option_id;
                var price = d.price;
                if (option != '') {
                    var goods_options = JSON.parse(d.goods_option);
                    for (var i = 0, len = goods_options.length; i < len; i++) {
                        if (goods_options[i]['option_id'] == option) {
                            price = goods_options[i]['option_price'];
                            break;
                        }
                    }
                }

                return '<i class="fa fa fa-cny "></i>' + (price * d.total) + '<br/>';
            }
        }];
        var querystrLock = "{service:'Order.GetCartList'}";
        var optionsLock = {
            columns: $columnsLock,
            showColumns: false,
            showHeader: false,
            onPostBody: function () {
                changeNum();

            },
            onLoadDataSuccess: function (d) {
                data = d.rows;
                calcTotal(d.rows);
            }
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#cash').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            onSuccess: function (e) {
                e.preventDefault();
                var $form = $(e.target);
                sendFormAjax($form);
            },
            fields: {
                realname: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('联系人') ?>',
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('手机号码') ?>',
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('详细地址') ?>',
                        }
                    }
                },

            }
        });
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var params = button.data();
            sendButtonAjax(button, params, {
                callback: function (d) {
                    if (d.code == 40000) {
                        oTableLock.table.bootstrapTable('removeByUniqueId',params.cartid);
                        calcTotal(oTableLock.table.bootstrapTable('getData'))
                    }
                }
            });
        });
    });
</script>
</body>
</html>