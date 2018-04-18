<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<link rel="stylesheet" href="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/css/layui.css">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h5>热门搜索</h5></div>
                <div class="ibox-content ">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <a class="layui-btn"  data-toggle="url" data-service="Setting.DoSearch"  data-id="0">
                            <i class="layui-icon">&#xe608;</i> 添加
                        </a>
                    </div>
                    <table class="table" data-mobile-responsive="true">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/layui/layui.js"></script>
<script>
    $(function () {
        var $columnsLock = [{
            field: 'search',
            title: '搜索词'
        },{
            field: 'display',
            title: '显示词'
        },{
            field: 'action',
            title: '操作',
            formatter:function (value,d) {
                return '<a class="btn btn-warning btn-outline btn-xs"  data-toggle="url" data-service="Setting.DoSearch"  data-id="'+d.id+'"   ><i class="fa fa-edit"></i> 修改</a> <a class="btn btn-danger  btn-outline btn-xs" href="javascript:void(-1);" data-service="Setting.DelSearch" del data-id='+d.id+' ><i class="fa fa-trash"></i> 删除</a>';
            }
        }];
        var querystrLock = "{service:'Setting.HotSearch'}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        /* $('#userSearch').on('submit',function () {
             oTableLock.load();
         });*/
        $('.table').on('click','a[del]',function () {
            var button = $(this);
            var data = button.data();
            sendButtonAjax(button,data,function () {
                oTableLock.table.bootstrapTable('removeByUniqueId',data.id);
            });
        });
    });
</script>
</html>
