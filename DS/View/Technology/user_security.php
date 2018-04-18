<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style>
        .safety-box {
            padding: 40px 0;
        }

        .safety-box .safety-list {
            padding: 16px 0;
        }

        .safety-box .safety-hd {
            overflow: auto;
        }

        .safety-box i.fa {
            width: 50%;
            float: left;
            text-align: center;
            height: 50px;
            line-height: 50px;
            font-size: 50px;
            color: #98a1b3;
        }

        .safety-box .txt {
            width: 50%;
            float: left;
        }

        .safety-box .txt b {
            font-weight: normal;
            font-size: 18px;
            display: block;
            line-height: 30px;
        }

        .safety-box .txt .text-primary {
            color: #18a689;
        }

        .safety-box .txt .text-no {
            color: red;
        }

        @media (max-width: 768px) {
            .safety-box .safety-hd {
                padding: 20px 0;
            }

            .safety-box .safety-p {
                padding: 20px 0;
            }

            .safety-box .safety-btn {
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .safety-box i.fa {
                text-align: right;
                padding-right: 30px;
            }

            .safety-box .safety-p {
                border: 1px dashed #6c7380;
                margin-bottom: 20px;
                padding: 16px 10px;
            }
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
                    <h2><?php echo T('安全中心'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('资料管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('安全中心'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="row tdtj">
                        <div class="dol-lg-3 col-md-2">
                            <?php $this->view('user_slide.php');?>
                        </div>
                        <div class="dol-lg-9 col-md-10">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>安全管理</h3>
                                    <small><!-- 当前安全等级：<span class="ui-text-danger">中</span>--><!--（建议您开启全部安全设置，以保障账户及资金安全）--></small>

                                    <div class="safety-box">
                                        <div class="row safety-list">
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="safety-hd">
                                                    <i class="fa fa-lock" style="color: #ef4749"></i>
                                                    <div class="txt">
                                                        <b><?php echo T('一级密码'); ?></b>
                                                        <span class="text-primary"><?php echo T('已设置'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-7">
                                                <div class="safety-p">
                                                    安全性高的密码可以使账号更安全。建议您定期更换密码，且设置一个包含数字和字母，并长度超过6位以上的密码。
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="safety-btn">
                                                    <a data-toggle="url" data-service="User.PwdEdit" data-action="pwd"
                                                       class="btn btn-primary"><?php echo T('修改'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="row safety-list">
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="safety-hd"><i class="fa fa-lock" style="color: #1a8dd6"></i>
                                                    <div class="txt">
                                                        <b><?php echo T('安全密码'); ?></b>
                                                        <?php if ($user['sec_pwd']): ?>
                                                            <p class="text-primary"><?php echo T('已设置'); ?></p>
                                                        <?php else: ?>
                                                            <p class="text-no"><?php echo T('未设置'); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-7">
                                                <div class="safety-p">设置二级密码后，在初次访问页面，需二级密码验证。</div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="safety-btn">
                                                    <?php if ($user['sec_pwd']): ?>
                                                        <a data-toggle="url" data-service="User.PwdEdit"
                                                           data-action="sec_pwd"
                                                           class="btn btn-primary"><?php echo T('修改'); ?></a>
                                                    <?php else: ?>
                                                        <a data-toggle="url" data-service="User.PwdEdit"
                                                           data-action="sec_pwd"
                                                           class="btn btn-danger"><?php echo T('设置'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <!--<div class="row safety-list">
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="safety-hd"><i class="fa fa-credit-card" style="color:#fad229;"></i>
                                                    <div class="txt">
                                                        <b><?php /*echo T('银行账户信息'); */?></b>
                                                        <?php /*if ($user['bank_no']): */?>
                                                            <p class="text-primary"><?php /*echo T('已设置'); */?></p>
                                                        <?php /*else: */?>
                                                            <p class="text-no"><?php /*echo T('未设置'); */?></p>
                                                        <?php /*endif; */?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-7">
                                                <div class="safety-p">绑定银行卡信息。</div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="safety-btn">
                                                    <?php /*if ($user['bank_no']): */?>
                                                        <a data-toggle="url" data-service="User.BankInfoEdit"
                                                           class="btn btn-primary"><?php /*echo T('修改'); */?></a>
                                                    <?php /*else: */?>
                                                        <a data-toggle="url" data-service="User.BankInfoEdit"
                                                           class="btn btn-danger"><?php /*echo T('设置'); */?></a>
                                                    <?php /*endif; */?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="row safety-list">
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="safety-hd"><i class="fa fa-cart-plus"  style="font-size: 60px;color: #1ebe5a;"></i>
                                                    <div class="txt">
                                                        <b><?php /*echo T('收货地址'); */?></b>
                                                        <?php /*if ($address['id']): */?>
                                                            <p class="text-primary"><?php /*echo T('已设置'); */?></p>
                                                        <?php /*else: */?>
                                                            <p class="text-no"><?php /*echo T('未设置'); */?></p>
                                                        <?php /*endif; */?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-7">
                                                <div class="safety-p">绑定收货信息</div>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                                <?php /*if ($address['id']): */?>
                                                    <a data-toggle="url" data-service="User.AddressEdit"
                                                       class="btn btn-primary"><?php /*echo T('修改'); */?></a>
                                                <?php /*else: */?>
                                                    <a data-toggle="url" data-service="User.AddressEdit"
                                                       class="btn btn-danger"><?php /*echo T('设置'); */?></a>
                                                <?php /*endif; */?>
                                            </div>
                                        </div>-->


                                    </div>
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
