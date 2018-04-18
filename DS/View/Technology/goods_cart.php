<!DOCTYPE html>
<html>

<head>
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
            border: 1px solid #ccc;
            border-right: 0;
        }
    </style>
    <link href="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css'); ?>">
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
                    <h2><?php echo T('我的购物车'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('订单管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('我的购物车'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="row tdtj">
                        <div class="dol-lg-3 col-md-2">
                            <div class="contact-box" style="min-height: 458px;overflow: hidden;">
                                <div class="grmsg-top">
                                    <h3 class="contact-dt"><?php echo T('个人信息'); ?></h3>

                                    <div>
                                        <div class="text-center">
                                            <img alt="image" class="img-circle m-t-xs img-responsive "
                                                 src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
                                                 width="100" id="headerImg"
                                                 style="margin: 0 auto; margin-bottom: 20px;">


                                            <div class="user-msgb"><span class="user-msgb-number"><?php echo T('用户编号'); ?>
                                                    <!--                                                        <i class="fa fa-user"></i>-->
                                                    <?php echo $user['true_name']; ?> </span></div>

                                            <div class="user-msgb"><span class="user-msgb-name"><?php echo T('用户姓名'); ?>
                                                    <!--                                                        <i class="fa fa-bookmark"></i>-->
                                                    <?php echo $user['user_name']; ?></span>
                                            </div>
                                            <div class="user-msgb">
                                                <span class="user-msgb-level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="grmsg-bottom">
                                    <div class="">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-primary pull-right"><?php echo T('余额'); ?></span>
                                                <h5><i class="fa fa-money"></i> <?php echo T('账户'); ?></h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">
                                                    <h2 class="no-margins fnts18">
                                                        <?php $bonus_names = Common_Function::getBonusName();
                                                        foreach ($bonus_names as $key => $bonus_name): ?>
                                                            <p><div style="display: inline-block;width: 80px;text-align: right"><?php echo $bonus_name, '：'?></div><?php echo $user[BONUS_NAME . $key]; ?></p>

                                                        <?php endforeach; ?>
                                                    </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="dol-lg-9 col-md-10">
                            <div class="ibox">
                                <div class="ibox-content sj-box-pad borderc">
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
                                                <label class="col-md-3 control-label"><?php echo T('详细地址'); ?></label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="address"
                                                           value="<?php echo $address['address']; ?>"
                                                           placeholder="<?php echo T('输入'), T('详细地址'); ?>">
                                                </div>
                                            </div>

                                            <div class="portlet-body goods_cart">
                                                <table data-min-width="768" data-valign="center"
                                                       data-mobile-responsive="true"
                                                       class="table">
                                                </table>
                                            </div>
                                            <div class="shop-car-box">
                                                <span class="btn pull-right pdlr0"><?php echo T('订单金额'); ?>
                                                    <i class="fa fa fa-cny" style="font-size: 26px;"></i>
                                                    <i id="total" style="color: red;font-size: 26px;font-style: normal">0</i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="shop-car-box">
                                                <button class="btn btn-primary pull-right " type="submit"><i
                                                        class="fa fa fa-shopping-cart"></i> <?php echo T('确定购物'); ?>
                                                </button>
                                                <a class="btn btn-white fr" data-toggle="url" data-service="Order.GoodsList" ><i
                                                        class="fa fa-arrow-left"></i> <?php echo T('继续购物'); ?></a>
                                                <div class="clearfix"></div>
                                            </div>
                                    </form>
                                </div>
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
                        },
                        callback: {
                            message: '手机号码格式不正确',
                            callback: function (value, validate) {
                                return /^1[34578]\d{9}$/.test(value);
                            }
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
