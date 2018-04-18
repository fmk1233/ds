<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>新闻公告管理</h5>
                    <div class="ibox-tools">
                        <a data-toggle="url" data-service="DNews.newsAdd" style="margin-top: -10px" class="btn btn-primary"><i
                                    class="fa fa-plus-circle"></i> 添加公告</a>
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
                                                <option value="news_title">标题</option>
                                                <option value="content">内容</option>
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
        var category_names = JSON.parse('<?php echo json_encode(Domain_News::newsCategoryParams()); ?>');
        var top_names = JSON.parse('<?php echo json_encode(Domain_News::isTopParams()); ?>');
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'category',
            title: '类型',
            formatter: function (value) {
                return category_names[value];
            }
        }, {
            field: 'news_title',
            title: '标题'
        }, {
            field: 'add_time',
            title: '发布时间',
            formatter: function (value) {
                return $.myTime.UnixToDate(value, true);
            }
        }, {
            field: 'is_top',
            title: '置顶',
            formatter: function (value) {
                return top_names[value];

            }
        }, {
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                $html += '<a class="btn btn-primary btn-outline btn-xs"  data-toggle="url" data-service="DNews.newsAdd" data-newsId="'+value+'"><i class="fa fa-edit"></i> 修改</a> ';
                $html += '<a class="btn btn-danger btn-outline btn-xs" delete  data-service="DNews.NewsDelete"  data-news_id="' + d.id + '"><i class="fa fa-trash"></i> 删除</a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'DNews.newsList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[delete]', function () {
            var button = $(this);
            var data = button.data();
            confirmMsg('您确认要删除该公告',function () {
                sendButtonAjax(button,data,function () {
                    oTableLock.table.bootstrapTable('removeByUniqueId',data.news_id);
                });
            });
        });
    });

</script>

</html>
