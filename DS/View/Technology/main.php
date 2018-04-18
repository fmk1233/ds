<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <link rel="stylesheet" href="<?php echo Common_Function::GoodsPath('/css/swiper.min.css'); ?>">
    <style>
        .swiper-container {
            height: 280px;
        }

        .swiper-slide img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            position: absolute;
            left: 50%;
            top: 50%;
        }

        .mes-box {
            margin-top: 16px;
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

            <div class="container">
                <div class="wrapper wrapper-content">

                    <div class="">

                        <div class="row dui-row" style="margin-top: 20px;">
                            <div class="dol-lg-3 col-md-2">
                                <div class="contact-box" style="min-height: 458px;overflow: hidden;height: 458px">
                                    <div class="grmsg-top">
                                        <h3 class="contact-dt"><?php echo T('个人信息'); ?></h3>

                                        <div>
                                            <div class="text-center">
                                                <img alt="image" class="img-circle m-t-xs img-responsive "
                                                     src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>"
                                                     width="100" id="headerImg"
                                                     style="margin: 0 auto; margin-bottom: 20px;">


                                                <div class="user-msgb"><span class="user-msgb-number">用户编号
                                                        <!--                                                        <i class="fa fa-user"></i>-->
                                                        <?php echo $user['user_name']; ?> </span></div>

                                                <div class="user-msgb"><span class="user-msgb-name">用户姓名
                                                        <!--                                                        <i class="fa fa-bookmark"></i>-->
                                                        <?php echo $user['true_name']; ?></span>
                                                </div>
                                                <div class="user-msgb">
                                                    <span class="user-msgb-level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="grmsg-bottom">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="border: none">
                                                <span class="label label-success pull-right">余额</span>
                                                <h5><i class="fa fa-money"></i> 账户</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="no-margins">
                                                    <?php $bonus_names = Common_Function::getBonusName();
                                                    foreach ($bonus_names as $key => $bonus_name): ?>
                                                        <p><div style="display: inline-block;width: 55px;text-align: right"><?php echo $bonus_name, '：'?></div><?php echo $user[BONUS_NAME . $key]; ?></p>

                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="dol-lg-9 col-md-10">
                                <div class="bgc-oblack">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($advs as $adv): ?>
                                                <div class="swiper-slide"><img
                                                            src="<?php echo Common_Function::GoodsPath($adv['icon']); ?>">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- 如果需要分页器 -->
                                        <div class="swiper-pagination swiper-button-white"></div>

                                        <!-- 如果需要导航按钮 -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next "></div>
                                    </div>
                                </div>

                                <div class="row mes-box">
                                    <div class="col-lg-3 col-sm-6 msg-box-mgb box-mgb-1">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right">历史</span>
                                                <h5><i class="fa fa-cny"></i> 收入</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">
                                                    <span><?php echo $reward_total; ?></span>
                                                    <i class="fa fa-cny  pull-right"
                                                       style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>
                                                <small>总收入</small>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="col-lg-3 col-sm-6 msg-box-mgb box-mgb-1">-->
<!--                                        <div class="ibox float-e-margins">-->
<!--                                            <div class="ibox-title">-->
<!--                                                <span class="label label-info pull-right">--><?php //echo T('金额'); ?><!--</span>-->
<!--                                                <h5><i class="fa fa-creative-commons"></i>--><?php //echo T('提现'); ?><!-- </h5>-->
<!--                                            </div>-->
<!--                                            <div class="ibox-content">-->
<!--                                                <h1 class="no-margins">-->
<!--                                                    <span data-counter="counterup"-->
<!--                                                          data-value="--><?php //echo $cash_money; ?><!--">--><?php //echo $cash_money; ?><!--</span>-->
<!--                                                    <i class="fa fa-creative-commons  pull-right"-->
<!--                                                       style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>-->
<!--                                                <small>--><?php //echo T('已提现'); ?><!--</small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <div class="col-lg-3 col-sm-6 msg-box-mgb box-mgb-1">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-primary pull-right">激活</span>
                                                <h5><i class="fa fa-users"></i> 团队</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">
                                                    <span><?php echo $active_num; ?></span>
                                                    <i class="fa fa-users  pull-right"
                                                       style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>
                                                <small>人数</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 msg-box-mgb box-mgb-1">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-danger pull-right">直推</span>
                                                <h5><i class="fa fa-user-plus"></i> 推荐</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">
                                                    <span><?php echo $tj_num; ?></span>
                                                    <i class="fa fa-user-plus  pull-right"
                                                       style="font-size: 1.5em;color: #eee;opacity: 0.2"></i></h1>
                                                <small>人数</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row dui-row">
                            <div class="dol-lg-3  col-md-2 contact-box-d">
                                <div class="contact-box2" style="min-height: 332px;overflow: hidden;margin-bottom: 0;">
                                    <div class="contact-dt">
                                        <a data-service="News.NewsList" data-toggle="url"><span class="label label-primary pull-right bgc-green margin-jj"> <?php echo T('获取更多'); ?></span> </a><h3> <?php echo T('新闻公告'); ?></h3></div>

                                    <ul class="list-group clear-list news-cbox">
                                        <?php foreach ($notices as $key=>$notice){?>
                                            <li class="list-group-item">
                                                <span class="label label-group news-box">1</span>
                                                <a data-toggle="url" data-service="News.NewsDetail" data-news_id="<?= $notice['id'];?>"><?= $notice['news_title'];?></a>
                                            </li>
                                        <?php }?>
                                    </ul>

                                </div>
                            </div>
                            <div class="dol-lg-9 col-md-10">
                                <div class="tabs-container" style="min-height: 270px;">
                                    <ul class="data-box">
                                        <li class="active"><a class="data-box-c1" data-toggle="tab" href="#tab-1"
                                                              aria-expanded="true"><i class="fa fa-area-chart"
                                                                                      style="margin-right: 4px;"></i>收入情况</a>
                                        </li>
                                        <li class=""><a class="data-box-c1" data-toggle="tab" href="#tab-2"
                                                        aria-expanded="false"><i class="fa fa-table"
                                                                                 style="margin-right: 4px;"></i>收入数据</a>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active data-box-cnt" id="tab-1">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content" style="min-height: 285px;border-top:0;">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="flot-chart">
                                                                <div class="echarts" id="axis2"
                                                                     style="height: 250px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane data-box-cnt" id="tab-2">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content"
                                                     style="min-height: 285px;border-top: 0;border-top-right-radius: 6px;">
                                                    <table data-toggle="table" data-mobile-responsive="true"
                                                           >
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <?php $prices = Domain_Reward::rewardPrice();
                                                            foreach ($prices as $key => $price): ?>
                                                                <th><?php echo T($key); ?></th>
                                                            <?php endforeach; ?>
                                                            <?php $fees = Domain_Reward::rewardFee();
                                                            foreach ($fees as $key => $fee): ?>
                                                                <th><?php echo T($key); ?></th>
                                                            <?php endforeach; ?>
                                                            <th><?php echo T('实得'); ?></th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($reward_list as $key => $reward): ?>
                                                            <tr>
                                                                <?php switch ($key) {
                                                                    case 0:
                                                                        echo '<td>', T('今天'), '</td>';
                                                                        break;
                                                                    case 1:
                                                                        echo '<td>', T('昨天'), '</td>';
                                                                        break;
                                                                    case 2:
                                                                        echo '<td>', T('全部'), '</td>';
                                                                        break;
                                                                } ?>
                                                                <?php $prices = Domain_Reward::rewardPrice();
                                                                foreach ($prices as $price): ?>
                                                                    <td><?php echo number_format($reward[$price], 2); ?></td>
                                                                <?php endforeach; ?>
                                                                <?php $fees = Domain_Reward::rewardFee();
                                                                foreach ($fees as $fee): ?>
                                                                    <td><?php echo number_format($reward[$fee], 2); ?></td>
                                                                <?php endforeach; ?>
                                                                <td><?php echo number_format($reward['money'], 2); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>


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
    </div>
</div>

<?php $this->view('footer_js'); ?>
<script src="<?php echo Common_Function::GoodsPath('/js/swiper.min.js'); ?>"
        type="text/javascript"></script>
<script>

    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: 2500,
        autoplayDisableOnInteraction: false,
        paginationClickable: true,
        centeredSlides: true,
        // 如果需要分页器
        pagination: '.swiper-pagination',
        // 如果需要前进后退按钮
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    });
</script>
<!--折线图-->
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.waypoints.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.counterup.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/echarts/echarts-all.js'); ?>"
        type="text/javascript"></script>
<script type="text/javascript">
    var e = echarts.init(document.getElementById("axis2"));
    option = {
        title: {
            text: ''
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['收入额']
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                splitLine: {show: false},
                data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: '收入额',
                type: 'line',
                stack: '总量',
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#91c7ae'
                    }
                },
                lineStyle: {
                    normal: {
                        color: '#91c7ae'
                    }
                },
                areaStyle: {
                    normal: {
                        color: '#91c7ae'
                    }
                },
                data:<?php echo json_encode($week_reward); ?>
            }

        ]
    };

    e.setOption(option);
    $(window).resize(e.resize);

</script>

</body>

</html>
