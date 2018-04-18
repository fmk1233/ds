<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<style type="text/css">
    .table img {
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
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;" data-toggle="url"
                       data-service="ArticleClass.InfoView">添加分类</a>
                    <h5>文章分类管理</h5>
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
            field: 'name',
            title: '分类名称'
        }, {
            field: 'sort',
            title: '排序'
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                if (d.pid == 0) {
                    $html += '<a class="btn btn-primary btn-outline btn-xs"  data-toggle="url" data-service="ArticleClass.InfoView" data-pid="' + value + '"  ><i class="fa fa-plus-circle"></i> 添加子分类</a> ';
                }
                $html += '<a class="btn btn-warning btn-outline btn-xs" data-toggle="url" data-service="ArticleClass.InfoView" data-id="' + value + '"><i class="fa fa-edit"></i> 修改</a> ';
                if (d.code == '') {
                    $html += '<a class="btn btn-danger btn-outline btn-xs" href="javascript:void(-1);" data-service="ArticleClass.DelInfo"  del data-id=' + value + ' ><i class="fa fa-trash"></i> 删除</a> ';
                }
                return $html;
            }
        }];
        var querystrLock = "{service:'ArticleClass.ListData'}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('删除该分类将会同时删除该分类的所有下级分类，您确定要删除吗', function () {
                sendButtonAjax(button, data, function () {
                    location.reload();
                });
            });
        });
    });
</script>
</html>
