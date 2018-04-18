<!DOCTYPE html>
<html>
<link href="<?php echo URL_ROOT . '/static/'; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
<?php $this->view('header'); ?>
<style type="text/css">
    .list img {
        margin: 5px;
        width: auto;
        height: 80px;
    }

    .list {
        left: 0px;
        z-index: 1000000;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><a class="btn btn-primary  pull-right" style="margin-top: -10px"
                                           data-toggle="url" data-service="Goods.AddGoods"><i
                                class="fa fa-plus-circle"></i>添加商品</a><h5>
                        商品管理</h5></div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" id="search" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="sr-only">商品分类</label>
                                <select name="categoryId" id="categoryId" tabindex="2"
                                        class="chosen-select form-control">
                                    <option value="">请选择商品分类</option>
                                    <?php foreach ((array)$categorys as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">商品名称</label>
                                <input class="form-control" type="text" id="goodsName" placeholder="请输入商品名称">
                            </div>
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </div>

                    <table class="table table-responsive" data-mobile-responsive="true">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/tooltips.js"></script>
<script type="text/javascript">
    var config = {
        ".chosen-select": {no_results_text: "没有找到数据", search_contains: true}
    };
    for (var selector in config)$(selector).chosen(config[selector]);
    $(function () {
        function price(goods, type) {
            var options_title = JSON.parse(goods.option_title);
            var price = goods.price;
            var stock = goods.stock;
            var market_price = goods.market_price;
            if (goods.has_option == 1) {
                if (options_title.length > 0) {
                    var goods_options = JSON.parse(goods.goods_option);
                    price = goods_options[0].option_price;
                    stock = goods_options[0].option_stock;
                    market_price = goods_options[0].option_marketprice;
                }
            }
            switch (type) {
                case 'price':
                    return parseFloat(price).toFixed(2);
                    break;
                case 'market_price':
                    return parseFloat(market_price).toFixed(2);
                    break;
                case 'stock':
                    return parseInt(stock);
                    break;
            }
        }

        var $columnsLock = [
            {
                field: 'id',
                title: 'ID',
            }, {
                field: 'goods_name',
                title: '商品名称',
                class: 'hover',
                formatter: function (value, row) {
                    var goodsPics = row.goods_pics.split(',');
                    var html = '';
                    html += '<a href="javascript:void(-1)" onMouseOver="toolTip(\'<img tooltip src=' + goodsThumb(goodsPics[0]) + '>\')" onMouseOut="toolTip()">' + value + '</a>';
                    return html;
                }
            }, {
                field: 'category_name',
                title: '所属分类'
            }, {
                field: 'price',
                title: '价格',
                formatter: function (value, goods) {
                    return price(goods, 'price');
                }
            }, {
                field: 'market_price',
                title: '市场价',
                formatter: function (value, goods) {
                    return price(goods, 'market_price');
                }
            }, {
                field: 'stock',
                title: '库存',
                formatter: function (value, goods) {
                    return price(goods, 'stock');
                }
            }, {
                field: 'action',
                title: '操作',
                formatter: function (value, d) {

                    return '<a class="btn btn-warning btn-outline btn-xs"  data-toggle="url" data-service="Goods.AddGoods" data-id="' + d.id + '" ><i class="fa fa-edit"></i> 修改</a> <a class="btn btn-danger btn-outline btn-xs" href="javascript:void(-1);" data-service="Goods.ChangeStatusGoods" change data-id="' + d.id + '" data-status="' + d.status + '" >' + (d.status == 0 ? '<i class="fa fa-cloud-upload"></i>上架' : '<i class="fa fa-cloud-download"></i>下架') + '</a><a class="hidden goods_pics" data-pics="' + d.goods_pics + '"></a>' + ' <a class="btn btn-danger btn-outline btn-xs" data-service="Goods.DelGoods"  data-id="' + d.id + '"  del><i class="fa fa-trash"></i> 删除</a>';
                }
            }
        ];
        var querystrLock = "{service:'Goods.GetGoodsList',categoryId:$('#categoryId').val(),goodsName:$('#goodsName').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#search').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[change]', function () {
            var button = $(this);
            var data = button.data();
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
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要删除该商品，一经删除不能还原！', function () {
                sendButtonAjax(button, data, {
                    callback: function (d) {
                        if (d.code == 40000) {
                            oTableLock.table.bootstrapTable('removeByUniqueId', data.id);
                        }
                    }
                });
            })

        });
    });
</script>
</html>
