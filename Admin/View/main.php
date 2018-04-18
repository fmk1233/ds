<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">历史</span>
                    <h5><i class="fa fa-cny"></i> 收入</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins" data-counter="counterup"
                        data-value="<?php echo $bdmoney['total']; ?>"><?php echo $bdmoney['total']; ?></h1>
                    <div class="stat-percent font-bold text-success"><?php echo $bdmoney['ratio']; ?>% <i
                                class="fa fa-bolt"></i></div>
                    <small>总收入</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">待办</span>
                    <h5><i class="fa fa-exclamation"></i> 提醒</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="no-margins" data-counter="counterup"
                                data-value="<?php echo $cash['wait']; ?>"><?php echo $cash['wait']; ?></h1>
                            <div class="font-bold text-navy"><?php echo $cash['ratio']; ?>%<i
                                        class="fa fa-level-up"></i>
                                <small>新提现</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="no-margins" data-counter="counterup"
                                data-value="<?php echo $msg['wait']; ?>"><?php echo $msg['wait']; ?></h1>
                            <div class="font-bold text-navy"><?php echo $msg['ratio']; ?>% <i
                                        class="fa fa-level-up"></i>
                                <small>未读留言</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">会员</span>
                    <h5><i class="fa fa-check-circle-o"></i> 审核</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins" data-counter="counterup"
                        data-value="<?php echo $wait_user['wait']; ?>"><?php echo $wait_user['wait']; ?></h1>
                    <div class="stat-percent font-bold text-info"><?php echo $wait_user['ratio']; ?>% <i
                                class="fa fa-level-up"></i></div>
                    <small>待审核</small>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">今日</span>
                    <h5><i class="fa fa-user"></i> 会员</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins" data-counter="counterup"
                        data-value="<?php echo $user['today']; ?>"><?php echo $user['today']; ?></h1>
                    <div class="stat-percent font-bold text-navy"><?php echo $user['ratio']; ?>% <i
                                class="fa fa-level-up"></i></div>
                    <small>新会员</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">实时</span>
                    <h5><i class="fa fa-paw"></i> 拨出统计</h5>
                </div>
                <?php foreach ($statistical as $key => $statistic): ?>
                    <div class="ibox-content" style="padding-bottom: 12px;">

                        <div class="row">
                            <div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
                                <h3 class="no-margins" style="border-bottom: 1px dashed #e7eaec">
                                    <span><b style="font-size: 30px;font-weight: 500"><?php echo $statistic['shouru'] > 0 ? number_format(($statistic['zhichu']) / $statistic['shouru'] * 100, 2) : 0; ?>
                                            %</b>（<?php echo $key == 'total' ? '总拨出率' : '环比'; ?>）</span>
                                </h3>
                                <div style="margin-top: 5px;">
                                    <div class="stat-percent font-bold text-navy"><i
                                                class="fa fa-cny"></i><?php echo $statistic['zhichu']; ?> </div>
                                    <small class="font-bold text-navy"><?php echo $key == 'total' ? '全盘拨出' : '今日拨出'; ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">收入</small>
                                <h4 data-counter="counterup"
                                    data-value="<?php echo $statistic['shouru']; ?>"><?php echo $statistic['shouru']; ?> </h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">拨出</small>
                                <h4 data-counter="counterup"
                                    data-value="<?php echo $statistic['zhichu']; ?>"><?php echo $statistic['zhichu']; ?> </h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">利润</small>
                                <h4 data-counter="counterup"
                                    data-value="<?php echo $statistic['shouru'] - $statistic['zhichu']; ?>"><?php echo $statistic['shouru'] - $statistic['zhichu']; ?> </h4>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-area-chart"></i> 拨出额</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">本周</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content" style="min-height: 282px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flot-chart">
                                <div class="echarts" id="axis2"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">分布</span>
                    <h5><i class="fa fa-users"></i> 会员统计</h5>
                </div>
                <div class="ibox-content" style="min-height: 280px;padding-bottom: 1px;">
                    <table data-toggle="table" data-mobile-responsive="true" class="table-striped table-hover">
                        <?php foreach ($user_statistic as $key => $statistic): ?>
                        <?php if ($key == 0): ?>
                        <thead>
                        <tr>
                            <?php foreach ($statistic as $item): ?>
                                <th><?php echo $item; ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php else: ?>
                            <tr>
                                <?php foreach ($statistic as $item): ?>

                                    <td><?php echo $item; ?></td>

                                <?php endforeach; ?>
                            </tr>
                        <?php endif; ?>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-area-chart"></i> 会员数</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">本周</button>
                            <!--<button type="button" class="btn btn-xs btn-white">月度</button>-->
                            <!--<button type="button" class="btn btn-xs btn-white">年度</button>-->
                        </div>
                    </div>
                </div>
                <div class="ibox-content" style="min-height: 280px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flot-chart">
                                <div class="echarts" id="axis"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><i class="fa fa-bar-chart"></i> 数据统计</h5>
        </div>
        <div class="ibox-content" style="min-height: 280px;padding-bottom: 1px;">
            <table data-toggle="table" data-mobile-responsive="true" class="table-striped table-hover">
                <?php foreach ($sys_statistic as $key => $statistic): ?>
                <?php if ($key == 0): ?>
                <thead>
                <tr>
                    <?php foreach ($statistic as $item): ?>
                        <th><?php echo $item; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php else: ?>
                    <tr>
                        <?php foreach ($statistic as $item): ?>

                            <td><?php echo $item; ?></td>

                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->view('footer_js'); ?>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.waypoints.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.counterup.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/echarts/echarts-all.js'); ?>"
        type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var e = echarts.init(document.getElementById("axis2"));
        var option = {
            title: {
                text: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['拨出额']
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
                    name: '拨出额',
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
                    data:<?php echo json_encode($week_reward) ?>
                }

            ]
        };
        e.setOption(option), $(window).resize(e.resize);

        var e2 = echarts.init(document.getElementById("axis"));
        option2 = {
            title: {
                text: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['会员数']
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
                    name: '会员数',
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
                            color: '#d48265'
                        }
                    },
                    lineStyle: {
                        normal: {
                            color: '#d48265'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#d48265'
                        }
                    },
                    data:<?php echo json_encode($week_user); ?>
                }

            ]
        };

        e2.setOption(option2), $(window).resize(e2.resize);
    });

</script>
</body>
</html>
