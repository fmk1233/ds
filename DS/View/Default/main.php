<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style>
    .bootstrap-table table{
        display: table !important;
    }
</style>
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
                    <!--提示信息-->
                    <!--金额概要-->
                    <div class="row wallet-stat">
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-leiji ui-text-blue"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-blue">
                                        <small><?php echo T('￥'); ?></small>
                                        <span data-counter="counterup" data-value="<?php echo $reward_total; ?>"><?php echo $reward_total; ?></span>
                                    </h3>
                                    <p><?php echo T('奖金累计'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-yue ui-text-green"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-green">
                                        <small><?php echo T('￥'); ?></small>
                                        <span data-counter="counterup" data-value="<?php echo $user[BONUS_NAME.BONUS_STC]; ?>"><?php echo $user[BONUS_NAME.BONUS_STC]; ?></span>
                                    </h3>
                                    <p><?php echo T('余额'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-jifen ui-text-violet"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-violet">
                                        <small><?php echo T('￥'); ?></small>
                                        <span data-counter="counterup" data-value="<?php echo $user[BONUS_NAME.BONUS_GW]; ?>"><?php echo $user[BONUS_NAME.BONUS_GW]; ?></span>
                                    </h3>
                                    <p><?php echo T('购物币'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-shouru ui-text-Pink"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-Pink">
                                        <small><?php echo T('￥'); ?></small>
                                        <span data-counter="counterup" data-value="<?php echo $user[BONUS_NAME.BONUS_JHB]; ?>"><?php echo $user[BONUS_NAME.BONUS_JHB]; ?></span>
                                    </h3>
                                    <p><?php echo T('报单币'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-tixian ui-text-Wathet"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-Wathet">
                                        <small><?php echo T('￥'); ?></small>
                                        <span data-counter="counterup" data-value="<?php echo $cash_money; ?>"><?php echo $cash_money; ?></span>
                                    </h3>
                                    <p><?php echo T('已提现'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-tuijian ui-text-Pink"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-Pink">
                                        <span data-counter="counterup" data-value="<?php echo $tj_num; ?>"><?php echo $tj_num; ?></span>
                                        <small><?php echo T('人'); ?></small>
                                    </h3>
                                    <p><?php echo T('直推人数'); ?></p>
                                </div>

                            </div>
                        </div>

                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-tuandui ui-text-green"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-green">
                                        <span data-counter="counterup" data-value="<?php echo $active_num; ?>"><?php echo $active_num; ?></span>
                                        <small><?php echo T('人'); ?></small>
                                    </h3>
                                    <p><?php echo T('团队激活'); ?></p>
                                </div>

                            </div>
                        </div>
                        <div class="wallet-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="wallet-item-info">
                                <div class="icon">
                                    <i class="iconfont icon-huangguan ui-text-blue"></i>
                                </div>
                                <div class="number">
                                    <h3 class="ui-text-blue">
                                        <span data-counter="counterup" data-value="<?php echo $total_num; ?>"><?php echo $total_num; ?></span>
                                        <small><?php echo T('人'); ?></small>
                                    </h3>
                                    <p><?php echo T('推荐人数'); ?></p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--收入数据-->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-table ui-text-blue"></i>
                                        <span class="caption-subject ui-text-blue bold uppercase">收入数据</span>
                                    </div>
                                    <div class="actions">


                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                           data-container="false" data-placement="bottom" data-original-title="全屏"
                                           href="javascript:;"> </a>

                                    </div>
                                </div>
                                <div class="portlet-body">

                                    <table data-min-width="768" data-toggle="table" data-mobile-responsive="true" class="table-striped table-hover" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <?php $prices = Domain_Reward::rewardPrice(); foreach ($prices as $key=>$price):?>
                                                    <th><?php echo T($key); ?></th>
                                                <?php endforeach;?>
                                                <?php $fees = Domain_Reward::rewardFee(); foreach ($fees as $key=>$fee):?>
                                                    <th><?php echo T($key); ?></th>
                                                <?php endforeach;?>
                                                <th><?php echo T('实得'); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($reward_list as $key=>$reward):?>
                                            <tr>
                                                <?php  switch ($key){
                                                    case 0:
                                                        echo '<td>', T('今天'),'</td>';
                                                        break;
                                                    case 1:
                                                        echo '<td>', T('昨天'),'</td>';
                                                        break;
                                                    case 2:
                                                        echo '<td>', T('全部'),'</td>';
                                                        break;
                                                } ?>
                                                <?php $prices = Domain_Reward::rewardPrice(); foreach ($prices as $price):?>
                                                    <td><?php echo number_format($reward[$price],2); ?></td>
                                                <?php endforeach;?>
                                                <?php $fees = Domain_Reward::rewardFee(); foreach ($fees as $fee):?>
                                                    <td><?php echo number_format($reward[$fee],2);?></td>
                                                <?php endforeach;?>
                                                <td><?php echo number_format($reward['money'],2); ?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--收入情况-->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-area-chart ui-text-blue"></i>
                                        <span class="caption-subject ui-text-blue bold uppercase">收入情况</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-transparent grey-salsa btn-circle btn-sm" href="javascript:;">
                                            本周
                                        </a>

                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                                           data-container="false" data-placement="bottom" data-original-title="全屏"
                                           href="javascript:;"> </a>


                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="flot-chart">
                                        <div class="echarts fixed-border-container" id="axis2"
                                             style="height: 350px;"></div>
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
<?php $this->view('footer_js'); ?>

<!--折线图-->
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/echarts/echarts-all.js'); ?>" type="text/javascript"></script>
<!--折线图设置-->
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
            data: ['收入额'/*, '积分余额'*/]
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {
                    show: true,
                    type: ['line', 'bar']
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        grid: {
            x: 40,
            x2: 16,
            y: 60,
            y2: 40
        },


        xAxis: [
            {
                type: 'category',
                data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            }
        ],
        yAxis: [
            {
                type: 'value',
                splitArea: {
                    show: true
                }

            }
        ],
        series: [
            {
                name: '收入额',
                type: 'bar',
                stack: '总量',
                /* itemStyle: {
                     normal: {
                         color:'#91c7ae'
                     }
                 },
                 lineStyle: {
                     normal: {
                         color:'#91c7ae'
                     }
                 },
                 areaStyle: {
                     normal: {
                         color:'#91c7ae'
                     }
                 },*/
                data: <?php echo json_encode($week_reward); ?>
            }/*
            , {
                name: '积分余额',
                type: 'bar',
                data: [2.60, 5.90, 9.00, 26.40, 28.70, 70.70, 175.60]
            }*/

        ]
    };

    e.setOption(option);
    $(window).resize(e.resize);

</script>
</body>
</html>