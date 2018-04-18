<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary  pull-right"  data-toggle="url" data-service="Admin.addPower"  style="margin-top: -10px;"><i class="fa fa-plus-circle"></i> 添加部门</a>
                    <h5>部门管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <table class="table" data-mobile-responsive="true">
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
            field: 'dep_name',
            title: '部门名',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '无';
                    default:
                        return value;
                }
            }
        },{
            field: 'add_time',
            title: '添加时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },{
            field: 'action',
            title: '操作',
            formatter:function (value,data) {
                value = data.id;
                return '<a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="Admin.addPower" data-id="'+value+'" >修改</a> '+(value!=1?'<a class="btn btn-danger btn-outline btn-xs" del href="javascript:void(-1)" data-id="'+value+'">删除</a>':'');
            }
        }];
        var querystrLock = "{service:'Admin.GetPowerList'}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click','[del]',function () {
            var $this = $(this);
            confirmMsg('您确认要删除此部门列表',function () {
                ds.sendAjax({
                    data:{service:'Admin.DelPower',id:$this.data('id')},
                    success:function (d) {
                        if (d.code==40000){
                            successMsg(d);
                        }else{
                            alertMsg(d);
                        }
                    }
                })
            });
        });
    });

</script>

</html>
