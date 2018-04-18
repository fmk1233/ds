<!DOCTYPE html>
<html>


<?php $this->view('header');?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary  pull-right"  data-toggle="url" data-service="Admin.adminInfo" style="margin-top: -10px;"><i class="fa fa-plus-circle"></i> 添加管理员</a>
                    <h5>管理员管理</h5>
                </div>
                <div class="ibox-content padding-top" >
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
            field: 'admin_name',
            title: '管理员名'
        },{
            field: 'auth_name',
            title: '部门管理'
        },{
            field: 'add_time',
            title: '创建时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },{
            field: 'edit_time',
            title: '编辑时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        },{
            field: 'action',
            title: '操作',
            formatter:function (value,d) {
                value = d.id;
                return '<a class="btn btn-primary btn-outline btn-xs"  data-toggle="url" data-service="Admin.adminInfo" data-id="'+value+'" >修改</a> '+(value!=1?'<a del href="javascript:void(-1)" class="btn btn-danger btn-outline btn-xs"  data-id="'+value+'">删除</a>':'');
            }
        }];
        var querystrLock = "{service:'Admin.GetAdminList'}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click','[del]',function () {
            var $this = $(this);
            promoteMsg('您确认要删除此管理员','二级密码','请输入二级密码',function (inputValue) {
                if (inputValue === false) return false;
                ds.sendAjax({
                    data:{service:'Admin.DelAdmin',id:$this.data('id'),sec_pass:inputValue},
                    success:function (d) {
                        if (d.code==40000){
                            successMsg(d);
                        }else{
                            alertMsg(d);
                        }
                    }
                });
            });
        });
    });

</script>

</html>
