<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>

<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <!--左侧导航-手机不显示-->
                <div class="col-xs-12 zs-md-2 hidden-xs hidden-sm">
                    <div class="profile-sidebar">
                        <?php $this->view('profile_side') ?>
                    </div>

                </div>
                <!--右侧内容-->
                <div class="col-xs-12 zs-md-10">
                    <!--资料-->
                    <div class="page-content-border">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-table ui-text-blue"></i>
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('新闻公告'); ?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                               data-container="false" data-placement="bottom" data-original-title="全屏"
                                               href="javascript:;"> </a>

                                        </div>
                                    </div>
                                    <div class="portlet-body">

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
                                        <table data-min-width="768" class="table" data-mobile-responsive="true"
                                               class="table-striped table-hover">
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!--END 主体-->
    </div>
    <!--END 主体-->

    <!--BEGIN 底部-->
    <?php $this->view('footer'); ?>
    <!--END 底部-->

</div>
<style>
    .has-feedback label ~ .form-control-feedback {
        top: 33px;
    }
</style>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
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