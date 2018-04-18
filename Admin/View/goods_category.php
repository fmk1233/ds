<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<style type="text/css">
    .table img{
        margin: 5px;
        width: auto;
        height: 40px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;" data-toggle="url" data-service="Goods.AddCategory" >添加分类</a>
                    <h5>商品分类管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <table class="table table-responsive">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'category_name',
            title: '分类标题'
        }, {
            field: 'icon',
            title: '分类图片',
            formatter:function (value) {
                if(value==''){
                    return '-';
                }
                return '<img src="'+goodsThumb(value)+'"/>';
            }
        },{
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                $html +='<a class="btn btn-primary btn-outline btn-xs"  data-toggle="url" data-service="Goods.AddCategory" data-pid="'+value+'"  ><i class="fa fa-plus-circle"></i> 添加子分类</a> ';
                $html +='<a class="btn btn-warning btn-outline btn-xs" data-toggle="url" data-service="Goods.AddCategory" data-id="'+value+'"><i class="fa fa-edit"></i> 修改</a> ';
                $html +='<a class="btn btn-danger btn-outline btn-xs" href="javascript:void(-1);" data-service="Goods.DelCategory"  del data-id=' + value + ' ><i class="fa fa-trash"></i> 删除</a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'Goods.GoodsCategoryList'}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var data = button.data();
            sendButtonAjax(button,data,function () {
                oTableLock.table.bootstrapTable('removeByUniqueId',data.id);
            });

        });
    });
</script>
</html>
