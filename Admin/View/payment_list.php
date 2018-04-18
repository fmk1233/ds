<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>支付方式设置</h5>
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
            field: 'payment_name',
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
            field: 'payment_state',
            title: '状态',
            formatter:function (value) {
                switch (parseInt(value)){
                    case 0:
                        return '<span class="text-muted"><i class="fa fa-ban"></i> 关闭中</span>';
                        break;
                    case 1:
                        return '<span class="text-info"><i class="fa fa-check-circle-o"></i> 开启中</span>';
                        break;
                }
                return '';
            }
        },{
            field: 'action',
            title: '操作',
            formatter:function (value,data) {
                value = data.id;
                return '<a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="Payment.PaymentInfoView" data-payment_id="'+value+'" >设置</a> ';
            }
        }];
        var querystrLock = "{service:'Payment.PaymentList'}";
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
