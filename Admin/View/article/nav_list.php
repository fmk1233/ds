<!DOCTYPE html>
<html>
<?php $this->view('header'); ?>
<style type="text/css">
    .table img {
        margin: 5px;
        width: auto;
        height: 40px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;" data-toggle="url"
                       data-service="Navigation.InfoView">添加导航</a>
                    <h5>页面导航管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div id="toolbar">
                        <form class="form-inline" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon" select>
                                            <select name="qtype" lay-ignore id="qtype">
                                                <option value="title">标题</option>
                                            </select>
                                        </span>
                                    <input type="text" class="form-control" id="qvalue" name="qvalue"
                                           placeholder="搜索相关数据...">
                                </div><!-- /input-group -->
                            </div>
                            <button type="submit" class="btn btn-primary" lay-submit lay-filter="formDemo">搜索</button>
                        </form>
                    </div>
                    <table class="table table-responsive">
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
        var locations = JSON.parse('<?php echo json_encode(Domain_Navigation::location()) ?>');
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
            visible:'hidden'
        }, {
            field: 'title',
            title: '标题'
        }, {
            field: 'sort',
            title: '排序'
        }, {
            field: 'url',
            title: '链接'
        }, {
            field: 'location',
            title: '所在位置',
            formatter: function (value) {
               return locations[value];
            }
        }, {
            field: 'new_open',
            title: '新窗口打开',
            formatter: function (value) {
                if (value == '0') {
                    return '<span><i class="fa fa-ban"></i> 否</span>';
                } else {
                    return '<span class="text-navy"><i class="fa fa-check-circle"></i> 是</span>';
                }
            }
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                $html += '<a class="btn btn-warning btn-outline btn-xs" data-toggle="url" data-service="Navigation.InfoView" data-id="' + value + '"><i class="fa fa-edit"></i> 修改</a> ';
                $html += '<a class="btn btn-danger btn-outline btn-xs" href="javascript:void(-1);" data-service="Navigation.DelInfo"  del data-id=' + value + ' ><i class="fa fa-trash"></i> 删除</a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'Navigation.ListData',qtype:$('#qtype').val(),qvalue:$('#qvalue').val()}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[del]', function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('删除后将不能恢复，确认删除这 1 项吗？',function () {
                sendButtonAjax(button, data, function () {
                    oTableLock.table.bootstrapTable('removeByUniqueId', data.id);
                });
            })
        });
    });
</script>
</html>
