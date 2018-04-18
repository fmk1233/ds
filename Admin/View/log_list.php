<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>日志管理</h5>
                </div>
                <div class="ibox-content padding-top">

                    <div class="clearfix">
                        <?php $this->view('tips'); ?>
                        <div id="toolbar">
                            <form class="form-inline" role="form" onsubmit="return false;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" id="qtype">
                                                <option value="member-operator_name">操作人</option>
                                                <option value="member-memo">内容</option>
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
                                    <select name="log-type" id="log-type" class="form-control">
                                        <option value="-1">全部</option>
                                        <option value="0">系统</option>
                                        <option value="1">管理员</option>
                                        <option value="2">用户</option>
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
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var $columnsLock = [{
            field: 'id',
            title: 'ID'
        }, {
            field: 'operator_name',
            title: '操作人'
        }, {
            field: 'memo',
            title: '内容'
        }, {
            field: 'operator_ip',
            title: 'IP地址'
        }, {
            field: 'log_type',
            title: '操作类型',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '系统';
                    case 1:
                        return '管理员';
                    case 2:
                        return '会员';
                }
            }
        }, {
            field: 'operator_url',
            title: '操作地址'
        }, {
            field: 'add_time',
            title: '添加时间',
            formatter: function (value) {
                return $.myTime.UnixToDate(value, true);
            }
        }];
        var querystrLock = "{service:'Log.logList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),log_type:$('#log-type').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showExport: true,
            showColumns: true
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
    });

</script>

</html>
