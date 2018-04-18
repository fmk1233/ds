<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">

                    <h5>留言信息</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="user_name">会员名称</option>
                                                <option value="user_id">会员ID</option>
                                            </select>
                                        </span>
                                    <input type="text" class="form-control" id="qvalue" name="qvalue"
                                           placeholder="搜索相关数据...">
                                </div><!-- /input-group -->
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
                            <div class="form-group">
                                <label class="sr-only">类型</label>
                                <select name="reply" id="reply" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">待回复</option>
                                    <option value="1">已回复</option>
                                </select>
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
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'id',
            title: '编号',
        }, {
            field: 'user_name',
            title: '<i class="fa fa-users"></i> 会员编号'
        }, {
            field: 'msg_title',
            title: '<i class="fa fa-file-text-o"></i> 标题'
        }, {
            field: 'add_time',
            title: '<i class="fa fa-clock-o"></i> 发布时间',
            formatter: function (value) {
                return $.myTime.UnixToDate(value, true);
            }
        }, {
            field: 'action',
            title: '<i class="fa fa-gear"></i> 操作',
            formatter: function (value, d) {
                if (d.is_reply == 0) {
                    return '<a class="btn-warning btn btn-outline btn-xs" data-toggle="url" data-service="DMsg.msgDetail" data-msgId="'+d.id+'">回复</a>';
                } else {
                    return '<a class="btn-warning btn btn-outline btn-xs" data-toggle="url" data-service="DMsg.msgDetail" data-msgId="'+d.id+'">查看</a>'
                }

            }
        }];
        var querystrLock = "{service:'DMsg.GetMsgList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),reply:$('#reply').val()}";
        var optionsLock = {
            columns: $columnsLock,
            exportOptions: {fileName: '留言信息'}
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
    });

</script>

</html>
