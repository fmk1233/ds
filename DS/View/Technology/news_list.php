<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo T('新闻公告'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('信息管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('新闻公告'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content sj-box-pad borderc">

                                    <div id="toolbar">
                                        <form class="form-inline" role="form" onsubmit="return false;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="laydate-icon form-control "
                                                           id="s_time" name="s_time"
                                                           placeholder="<?php echo T('开始时间'); ?>"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                    <span class="input-group-addon"><?php echo T('到'); ?></span>
                                                    <input type="text" class="laydate-icon form-control "
                                                           id="e_time" name="e_time"
                                                           placeholder="<?php echo T('结束时间'); ?>"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                    class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                        </form>
                                    </div>
                                    <table  class="table" data-mobile-responsive="true">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var category_names = JSON.parse('<?php echo json_encode(Domain_News::newsCategoryParams()); ?>');
        var top_names = JSON.parse('<?php echo json_encode(Domain_News::isTopParams()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'category',
            title: '<?php echo T('类型'); ?>',
            formatter: function (value) {
                return category_names[value];
            }
        }, {
            field: 'news_title',
            title: '<?php echo T('标题'); ?>'
        }, {
            field: 'add_time',
            title: '<?php echo T('发布时间'); ?>',
            formatter: function (value) {
                return showTime(value);
            }
        }, {
            field: 'is_top',
            title: '<?php echo T('置顶'); ?>',
            formatter: function (value) {
                return top_names[value];
            }
        }, {
            field: 'action',
            title: '<?php echo T('操作'); ?>',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                $html += '<a class="btn btn-primary btn-outline btn-xs" refuse data-toggle="url" data-service="News.NewsDetail" data-news_id="'+value+'"><i class="fa fa-eye"></i> <?php echo T('查看') ?></a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'News.GetNewsList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });

    })
</script>
</body>

</html>
