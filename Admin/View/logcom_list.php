<!DOCTYPE html>
<html>
<?php $this->view('header');?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;"  data-toggle="url" data-service="Logistics.logcomAdd"  >添加物流公司</a>
                    <h5>物流公司管理</h5>
                </div>
                <div class="ibox-content" style="padding-top: 10px">
                    <?php $this->view('tips'); ?>
                    <div class="alert alert-info" style="margin-bottom: 0px;margin-top: 10px">公司代号需填写正确，否则无法正确获取物流信息。快递代号对应公司请参考<strong><a data-toggle="url" data-service="Logistics.DownComcode">《所支持的快递公司及参数说明》</a></strong>
                    </div>
                    <table class="table table-responsive">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        },{
            field: 'company',
            title: '物流公司名称'
        },{
            field: 'code',
            title: '物流公司代码'
        },{
            field: 'address',
            title: '物流公司地址'
        },{
            field: 'contact',
            title: '联系人'
        },{
            field: 'tel',
            title: '联系电话'
        },{
            field: 'url',
            title: '公司网址'
        },{
            field: 'action',
            title: '操作',
            formatter:function (value,d) {
                return '<a class="btn btn-warning btn-outline btn-xs"  data-toggle="url" data-service="Logistics.logcomAdd"  data-id="'+d.id+'"  ><i class="fa fa-edit"></i> 修改</a> <a class="btn btn-danger  btn-outline btn-xs" href="javascript:void(-1);" data-service="Logistics.DelLogcom" del data-id='+d.id+' ><i class="fa fa-trash"></i> 删除</a>';
            }
        }];
        var querystrLock = "{service:'Logistics.getLogcomList'}";
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
