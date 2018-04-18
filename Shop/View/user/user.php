<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/purebox-metro.css" rel="stylesheet" id="skin">
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<div class="user_style clearfix">
    <div class="user_center">
        <!--左侧菜单栏-->
        <div class="left_style">
            <?php $this->view('user/user_left');$notices = Domain_News::notice(); ?>
        </div>
        <!--右侧内容样式-->
        <div class="right_style">
            <div class="info_content">
                <div class="Notice"><span>系统最新公告:</span><?php if(count($notices)>0){echo $notices[0]['news_title'];} ?></div>

                <!--样式-->
                <div class="user_info_p_s  clearfix" style="width:980px;">
                    <!--订单记录-->
                    <div class="left_user_cont" style="width:980px;">
                        <div class="us_Orders left clearfix" style="width:980px;">
                            <div class="Orders_name">
                                <div class="title_name">
                                    <div class="Records">购买记录</div>
                                    <div class="right select">
                                        只记录你最近30天的购买记录   </div>
                                </div>
                            </div>
                            <table style="width:980px;">
                                <thead>
                                <tr>
                                    <th>产品名称</th>
                                    <th>数量</th>
                                    <th>价格</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list as $list_item): ?>
                                    <?php foreach($list_item['goods'] as $goods_item): ?>
                                        <tr>
                                            <td class="img_link">
                                                <a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['goods_id']; ?>" href="javascript::void(-1)" class="img"><img src="<?php echo Common_Function::GoodsPath($goods_item['goods_pic']); ?>" width="80" height="80"></a>
                                                <a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['goods_id']; ?>" href="javascript::void(-1)" class="title"><?php echo $goods_item['goods_name']; ?></a>
                                            </td>
                                            <td><?php echo $goods_item['total']; ?></td>
                                            <td><?php echo $goods_item['price']; ?></td>
                                            <td><a data-toggle="url" data-service="Goods.Product" data-id="<?php echo $goods_item['goods_id']; ?>" href="javascript::void(-1)" class="View">查看</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                           <?php $this->view('common/page') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>

