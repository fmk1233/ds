<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row animated fadeInUp">
        <div class="col-xs-12 col-lg-12">

            <div class="ibox actuser-box">
                <div class="ibox-title">
                    <h5>
                        平台银行信息管理
                    </h5>
                    <div class="ibox-tools"><a href="javascript:void(-1)" data-service="Bank.InfoView" data-toggle="url" class="btn btn-primary" style="margin-top: -10px"> <i class="fa fa-plus"></i> 新增</a></div>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" role="form" id="bonusSearch" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="zhanghao">银行账号</option>
                                                <option value="bank">银行名称</option>
                                            </select>
                                        </span>
                                    <input type="text" class="form-control w125" id="qvalue" name="qvalue" placeholder="搜索相关数据...">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="laydate-icon form-control " id="s_time" name="s_time"
                                           placeholder="开始时间"
                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="laydate-icon form-control " id="e_time" name="e_time"
                                           placeholder="结束时间"
                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>

                    </div>
                    <table class="table" data-mobile-responsive="true">
                    </table>

                </div>
            </div>

        </div>


    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT.'/static/';?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'bank',
            title: '银行名称'
        }, {
            field: 'zhanghao',
            title: '银行账号'
        }, {
            field: 'huzhu',
            title: '户主'
        },{
            field: 'add_time',
            title: '添加时间',
            formatter: function (value) {
                return $.myTime.UnixToDate(value, true);
            }
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value,d) {
                var control = '';
                control +='<a class="btn btn-danger btn-outline btn-xs" del  data-service="Bank.Del" data-id="'+d.id+'"><i class="fa fa-trash"></i> 删除</a> ';
                return control;
            }
        }];
        var querystrLock = "{service:'Bank.ListData',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#bonusSearch').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[del]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确认此项！',function(){
                ds.sendAjax({
                    data: data,
                    success: function (d) {
                        if (d.code == 40000) {
                            successMsg(d.msg,function () {
                                oTableLock.table.bootstrapTable('removeByUniqueId',data.id);
                            });
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
