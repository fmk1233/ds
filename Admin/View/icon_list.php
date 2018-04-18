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
                <div class="ibox-title"><a class="btn btn-primary pull-right" style="margin-top: -10px"
                                           data-service="Icon.IconAdd" data-toggle="url">添加幻灯片</a><h5>幻灯片管理</h5></div>
                <div class="ibox-content table-responsive padding-top">
                    <table class="table" data-mobile-responsive="true">

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
        var category_names = JSON.parse('<?php echo json_encode(Domain_Icon::iconCategoryName()) ?>');

        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'name',
            title: '幻灯片名字'
        }, {
            field: 'url',
            title: '链接地址'
        }, {
            field: 'icon',
            title: '幻灯片图片',
            formatter: function (value) {
                return '<img src="' + goodsThumb(value) + '"/>';
            }
        }, {
            field: 'category',
            title: '类型',
            formatter: function (value) {
                return category_names[value];
            }
        }, {
            field: 'is_rec',
            title: '状态',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '<label class="label lable-default" >不推荐</label>';
                        break;
                    case 1:
                        return '<label class="label lable-danger" >推荐</label>';
                        break;
                }
            }
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                var html = '';
                html += ' <a class="btn btn-success btn-outline btn-xs" data-toggle="url" data-service="Icon.IconAdd" data-id="'+d.id+'">修改</a>';
                html += ' <a class="btn btn-danger btn-outline btn-xs" data-service="Icon.delIcon" data-id="' + d.id + '" href="javascript:void(1)" del >删除</a>';
                if (d.is_rec == 0) {
                    html += ' <a class="btn btn-warning btn-outline btn-xs" href="javascript:void(1)" data-service="Icon.chageStatus" data-id="' + d.id + '" data-is_rec="0"  change>推荐</a>'
                } else {
                    html += ' <a class="btn btn-warning btn-outline btn-xs" href="javascript:void(1)" data-service="Icon.chageStatus" data-id="' + d.id + '" data-is_rec="1" change>不推荐</a>'
                }
                return html;


            }
        }];
        var querystrLock = "{service:'Icon.getIconList'}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click', 'a[del]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确定要删除此项！', function () {
                ds.sendAjax({
                    data: data,
                    success: function (d) {
                        if (d.code == 40000) {
                            oTableLock.table.bootstrapTable('removeByUniqueId', data.id);
                        } else {
                            alertMsg(d);
                        }
                    }
                });
            }, {closeOnConfirm: true});
        });
        $('.table').on('click', 'a[change]', function () {
            var $this = $(this);
            var data = $this.data();
            ds.sendAjax({
                data: data,
                success: function (d) {
                    if (d.code == 40000) {
                        var row = $('.table tr[data-uniqueid="' + data.id + '"]');
                        var index = row.data('index');
                        var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.id);
                        rowData.is_rec = d.data;
                        oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                    } else {
                        alertMsg(d);
                    }
                }
            });
        });
        /* $('#userSearch').on('submit',function () {
             oTableLock.load();

         });*/

    });
</script>
</html>
