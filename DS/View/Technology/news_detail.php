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
                    <h2><?php echo T('新闻公告详情'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('信息管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('新闻公告详情'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="text-center article-title">
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('Y-m-d H:i:s',$news['add_time']); ?></span>
                                        <h3><?php echo $news['news_title']; ?></h3>
                                        <h4><i class="fa fa-user"></i> <?php echo $news['admin_name']; ?></h4>
                                    </div>
                                    <?php echo html_entity_decode($news['content']); ?>
                                    <hr>
                                    <div class="row maglr0">
                                        <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?><i
                                                class="fa fa-arrow-circle-left"></i></a>
                                    </div>
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
</body>

</html>
