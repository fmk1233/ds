<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style>
        .user-msgb-grade {
            background-color: transparent;
            padding: 0;
            color: #ef4749;
        }

        .user-msgb-level {
            background-color: #14c1b3;
        }

        .top-navigation .table > tbody > tr > td {
            border-top: transparent;
            border-bottom: transparent;
        }

        .table-boxs-1 .no-margins {
            border: 1px solid #e5e6e7;
            text-align: center;
            padding: 6px 12px;
            color: #14c1b3;
            border-radius: 4px;
            background-color: #eee;
        }

        .table-boxs-1 {
            padding-right: 4%;
        !important
        }

        .m-t-xs {
            float: left;
        }

        .msgb-right {
            float: left;
            margin-left: 20px;
        }

        .text-center {
            text-align: left;
            padding-left: 28px;
        }

        .table-boxs {
            margin: 0;
        }

        .table-boxs {
            padding: 0
        }

        .mation-box {
            padding: 10px 0;
        }

        .user-msgb-number {
            padding: 0;
            font-size: 18px;
        }

        .user-msgb {
            margin: 8px 0;
        }

        .user-msgb-level {
            padding: 2px 6px;
        }

        .vertical-container {
            width: auto;
        }

        .ibox-data {
            margin-bottom: 0;
        }

        @media (max-width: 767px) {
            .mation-box-1, .ibox-data-1 {
                padding: 0;
            }

            /*.ibox-data-1{ margin: 0;}*/
            .table-boxs-1 {
                padding-right: 0;
            }

            .text-center {
                text-align: left;
                padding-left: 10px;
            }

            .top-navigation .table > tbody > tr > td {
                padding-left: 7px;
                padding-right: 7px;
            }

            .table-boxs-1 {
                padding-right: 7px;
                padding-left: 7px;
            }

            .vertical-timeline-icon {
                width: 30px;
                height: 30px;
                line-height: 30px;;
            }

            #vertical-timeline::before {
                left: 14px;
                width: 2px;
            }

            .img-responsive {
                width: 60px;
            }

            .ibox-content {
                padding-left: 15px;
            }

        }

        .w25 {
            width: 65px;
            display: inline-block;
            text-align: right;
            margin-bottom: 5px;
        }
    </style>
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
                    <h2><?php echo T('资料查看'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('我的资料'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('资料查看'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row m-b-lg m-t-lg mation-box ">

                        <div class="text-center col-md-4"><img alt="image" class=" m-t-xs"
                                                               src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
                                                               width="100" id="headerImg" style="">
                            <div class="msgb-right">
                                <div class="user-msgb">
                                                <span class="user-msgb-number">
                                                    <?php echo $user['true_name']; ?>
                                                </span>
                                </div>
                                <div class="user-msgb">
                                    <?php echo T('会员等级'); ?>：<span
                                            class="user-msgb-level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                                </div>
                                <div class="user-msgb">
                                    <?php echo T('会员编号'); ?>：<span class="user-msgb-grade"><?php echo $user['user_name']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 table-boxs">
                            <table class="table small m-b-xs">
                                <tbody>
                                <tr>
                                    <td>
                                        <strong><?php echo T('推荐人'); ?>:</strong> <?php echo $tjrname; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo T('注册时间'); ?>:</strong>
                                        <?php echo date('Y-m-d H:i:s', $user['reg_time']); ?>
                                    </td>


                                </tr>
                                <tr>
                                    <?php if (POSNUM > 1): ?>
                                        <td>
                                            <strong><?php echo T('接点人'); ?>:</strong> <?php echo $prename; ?>
                                        </td>
                                        <td>
                                            <strong><?php echo T('市场位置'); ?>:</strong>
                                            <?php echo Common_Function::getPosName($user['pos']); ?>
                                        </td>
                                    <?php endif; ?>

                                </tr>
<!--                                <tr>-->
<!--                                    --><?php //if (CAN_BD): ?>
<!--                                        <td>-->
<!--                                            <strong>--><?php //echo T('报单中心'); ?>
<!--                                                ：</strong> --><?php //echo empty($user['zmd_name']) ?
//                                                '无' : $user['zmd_name']; ?>
<!--                                        </td>-->
<!--                                    --><?php //endif; ?>
<!--                                    --><?php //if (CAN_BD): ?>
<!--                                        <td>-->
<!--                                        </td>-->
<!--                                    --><?php //endif; ?>
<!---->
<!---->
<!--                                </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 table-boxs-1">
                            <small><?php echo T('账户余额'); ?></small>
                            <h2 class="no-margins fnts18"><p><?php $bonus_names = Common_Function::getBonusName(); echo $bonus_names[0],'：', $user[BONUS_NAME . 0];;  ?></p></h2>
                            <div id="sparkline1"></div>
                        </div>


                    </div>
                    <div class="row mation-box mation-box-1"
                         style="background-color: transparent; padding-top: 0; margin-bottom: 0;">
                        <div class="col-lg-12 ibox-data mation-box-1" style="padding-left: 0">

                            <div class="">
                                <div class="ibox-content">
                                    <h3><?php echo T('基本信息'); ?></h3>

                                    <div class="small">
                                        <div class="w25"> <?php echo T('性别'); ?></div>
                                        ：
                                        <?php $sexs = DI()->config->get('app.sex');
                                        echo $sexs[$user['sex']]; ?><br/>
                                        <div class="w25"> <?php echo T('身份证号'); ?></div>
                                        ：
                                        <?php echo $user['idcard']; ?><br/>
                                        <div class="w25"> <?php echo T('手机号码'); ?></div>
                                        ：
                                        <?php echo $user['mobile'];; ?><br/>
                                        <div class="w25"> <?php echo T('所在地'); ?></div>
                                        ：
                                        <?php echo $user['province'], '--', $user['city'], '--', $user['area']; ?><br/>
                                    </div>

                                    <!--                                    <p class="small font-bold">-->
                                    <!--                                        <span><i class="fa fa-circle text-navy"></i> 在线</span>-->
                                    <!--                                    </p>-->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    <?php $this->view('footer'); ?>
                </div>
            </div>
        </div>

        <?php $this->view('footer_js'); ?>
</body>

</html>
