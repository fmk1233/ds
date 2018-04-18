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
                                            <span class="caption-subject ui-text-blue bold uppercase"><?php echo T('新闻公告详情'); ?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                               data-container="false" data-placement="bottom" data-original-title="全屏"
                                               href="javascript:;"> </a>

                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="text-center article-title">
                                                    <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('Y-m-d H:i:s',$news['add_time']); ?></span>
                                                    <h3><?php echo $news['news_title']; ?></h3>
                                                    <h4><i class="fa fa-user"></i> <?php echo $news['admin_name']; ?></h4>
                                                </div>
                                                <?php echo html_entity_decode($news['content']); ?>
                                                <hr>
                                                <div class="row">
                                                    <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?><i
                                                            class="fa fa-arrow-circle-left"></i></a>
                                                </div>

                                            </div>
                                        </div>

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
<script>
    $(function () {


    })
</script>
</body>
</html>