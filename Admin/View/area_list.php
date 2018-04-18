<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;" data-toggle="url" data-service="Area.DoAreaView" >添加省份</a>
                    <h5>地区信息管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <button type="button" class="btn btn-info" id="back" style="display: none;"><i class="fa fa-reply"></i> 返回上一级</button>
                    </div>
                    <input type="hidden" value="1" id="pid" name="pid"/>
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
        var pids = [1];
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'area_name',
            title: '地区名称'
        },{
            field: 'code',
            title: '地区码'
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                if(d.level>=2&&d.level<=3){
                    var name = '添加市'
                    if(d.level==3){
                        var name = '添加市'
                    }
                    $html +='<a class="btn btn-primary btn-outline btn-xs"  data-toggle="url" data-service="Area.DoAreaView" data-pid="'+value+'"  ><i class="fa fa-plus-circle"></i> '+name+'</a> ';

                    $html +='<a class="btn btn-info btn-outline btn-xs"   data-service="Area.AreaList" data-pid="'+value+'"  look ><i class="fa fa-arrow-circle-right"></i> 下级列表</a> ';
                }
                $html +='<a class="btn btn-warning btn-outline btn-xs" data-toggle="url" data-service="Area.DoAreaView" data-id="'+value+'"><i class="fa fa-edit"></i> 修改</a> ';
                $html +='<a class="btn btn-danger btn-outline btn-xs" href="javascript:void(-1);" data-service="Area.DelArea"  del data-id=' + value + ' ><i class="fa fa-trash"></i> 删除</a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'Area.AreaList',pid:$('#pid').val()}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('.table').on('click', 'a[look]', function () {
            var button = $(this);
            var data = button.data();
            pids.push(data.pid);
            $('#pid').val(data.pid);
            $('#back').show();
            oTableLock.load();
        });
        $('#back').on('click',function () {
            pids.pop();
            if(pids.length==1){
                $('#back').hide();
            }
            $('#pid').val(pids[pids.length-1]);
            oTableLock.load();
        });
//        $('.table').on('click', 'a[del]', function () {
//            var button = $(this);
//            var data = button.data();
//            sendButtonAjax(button,data,function () {
//                oTableLock.table.bootstrapTable('removeByUniqueId',data.id);
//            });
//
//        });
        $('.table').on('click','a[del]',function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('确认删除这条信息？',function () {
                sendButtonAjax(button,data,{
                    callback: function (d) {
                        if (d.code == 40000) {
                                oTableLock.table.bootstrapTable('removeByUniqueId',data.id);
                        } else {
                            alertMsg(d);
                        }
                    }
                });
            });
        });
    });
</script>
</html>
