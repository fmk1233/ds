<?php $this->view('common/header'); ?>
<script src="<?php echo $path; ?>js/jquery.reveal.js" type="text/javascript"></script>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--个人信息样式-->
<div class="user_style clearfix">
    <div class="user_center">
        <div class="left_style">
            <?php $this->view('user/user_left') ?>
        </div>
        <!--右侧样式-->
        <div class="right_style">
            <div class="info_content">
                <!--资金管理-->
                <div class="title_Section"><span>资金管理</span></div>
                <div class="funds_style">
                    <div class="user_operating">
                        <div class="Balance"><img src="<?php echo $path;?>images/iconfont-zhanghuyue.png" /><h3>余额：<b><?php echo $user[BONUS_NAME.BONUS_GW]; ?></b></h3></div>
                        <!--<a href="#" class="Recharge_btn" id="Recharge" data-toggle="modal">充值</a>-->
                    </div>
                    <!--记录-->
                    <div class="Details_list">
                        <div class="hd"><ul><li>资金流水记录</li></ul></div>
                        <div class="bd">
                            <ul class="consumption_list">
                                <table>
                                    <thead>
                                    <tr><td class="label_1">操作时间</td><td class="label_2">类型</td><td class="label_3">金额</td><td class="label_4">备注</td></tr>
                                    </thead>
                                    <tbody>
                                    <?php $bonus_types= Domain_Bonus::getBonusTypeNames(); foreach($list as $list_item): ?>
                                        <tr><td><?php echo date('Y-m-d H:i:s',$list_item['add_time']); ?></td><td><?php echo $bonus_types[$list_item['bonus_type']]; ?></td><td><?php echo $list_item['money']; ?></td><td><?php echo $list_item['memo']; ?></td></tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <?php $this->view('common/page'); ?>
                            </ul>
                        </div>
                    </div>
                    <script>jQuery(".Details_list").slide({trigger:"click"});</script>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>

<script type="text/javascript">
    $(function(){
        $(':input').labelauty();
    });
 </script>