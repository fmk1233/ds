<!DOCTYPE html>
<html>


<?php $this->view('header');?>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>数据库备份管理</h5>
                    <div class="ibox-tools">
                        <a href="javascript:void(-1)" id="backup" class="btn btn-primary" style="margin-top: -10px;><i class="fa fa-database"></i> 备份数据</a>
                    </div>
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
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="closeButton2">&times;</span><span class="sr-only">Close</span></button>
                <!--  <i class="fa fa-money modal-icon"></i>-->
                <h4 class="modal-title">正在备份，请稍后...</h4>
                <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active">
                    <div style="width: 0%" aria-valuemax="100" data-width="0" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-primary" id="progressbar">
                        <span class="" id="showNum">0%</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary" data-dismiss="modal">确认</button>-->
                <!--<button type="button" class="ladda-button ladda-button-demo btn btn-primary" id="sendUp"  data-style="zoom-in">确认</button>-->
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
            title: '编号',
        },{
            field: 'title',
            title: '<i class="fa fa-file-text-o"></i> 	名称'
        }, {
            field: 'size',
            title: '<i class="fa fa-file-text-o"></i> 	大小'
        },{
            field: 'addtime',
            title: '<i class="fa fa-clock-o"></i> 时间',
            formatter:function (value) {
                return $.myTime.UnixToDate(value,true);
            }
        }, {
            field: 'title',
            title: '<i class="fa fa-gear"></i> 操作',
            formatter:function (value) {
                return '<a class="btn-primary btn  btn-xs btn-outline " data-toggle="url" data-service="DB.Download" data-filename="'+value+'"   >下载</a> <a class="btn-warning btn  btn-xs btn-outline " restore="true" data-id="'+value+'">还原</a> <a class="btn-danger btn btn-xs btn-outline" delete="true" data-id="'+value+'">删除</a>'
            }
        }];
        var querystrLock = "{service:'DB.DbbackupList'}";
        var optionsLock = {
            columns: $columnsLock,
//            sidePagination:'client'
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click','a[restore]',function () {
            var newsId = $(this).data('id');
            confirmMsg('您确认还原该数据库备份',function () {
                ds.sendAjax({
                    data:{service:'DB.Restore',filename:newsId},
                    success:function (data) {
                        if(data.code ==40000){
                            successMsg(data);
                        }else{
                            alertMsg(data);
                        }
                    }
                });
            },{showLoaderOnConfirm:true});
        });
        $('.table').on('click','a[delete]',function () {
            var newsId = $(this).data('id');
            confirmMsg('您确认删除该数据库备份',function () {
                ds.sendAjax({
                    data:{service:'DB.Del',filename:newsId},
                    success:function (data) {
                        if(data.code ==40000){
                            successMsg(data);
                        }else{
                            alertMsg(data);
                        }
                    }
                });
            },{showLoaderOnConfirm:true});
        });
        $('#backup').on('click',function () {
            confirmMsg('确认备份当前数据？',function () {
                var interval;
                ds.sendAjax({
                    data:{service:'DB.Backup'},
                    beforeSend:function () {
                        sweetAlert.close();
                        $('#myModal2').modal('show');
                        interval = setInterval(function () {

                            var width = $("#progressbar").data('width');
                            if(width>=100){
                                if(width==100) {
                                    $('#showNum').html('正在进行最后处理，请稍后...');
                                }
                                clearInterval(interval);
                                return;
                            }
                            $('#progressbar').data('width',width+1);
                            $('#progressbar').css('width',(width+1)+'%');
                            $('#showNum').html((width+1)+'%');

                        }, 100);
                    },
                    success:function (data) {
                        clearInterval(interval);
                        interval = setInterval(function () {

                            var width = $("#progressbar").data('width');
                            if(data.code !=40000){
                                clearInterval(interval);
                                $("#myModal2").modal('hide');
                                alertMsg(data);
                            }
                            if(width>=100){
                                clearInterval(interval);
                                $("#myModal2").modal('hide');
                                if(data.code ==40000){
                                    successMsg(data.msg);
                                }
                            }
                            $('#progressbar').data('width',width+1);
                            $('#progressbar').css('width',(width+1)+'%');
                            $('#showNum').html((width+1)+'%');

                        }, 100);

                    }
                });
            });

        });
    });

</script>

</html>
