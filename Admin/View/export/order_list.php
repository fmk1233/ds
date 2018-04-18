<table style="WIDTH: 100%" cellspacing="1" cellpadding="1" border="1" bandno="0">
    <?php if ($this->page == 1): ?>
        <thead>
        <tr>
            <th>订单编号</th>
            <th>下单时间</th>
            <th>订单状态</th>
            <th>快递公司</th>
            <th>快递单号</th>
            <th>收货人</th>
            <th>收货电话</th>
            <th>收货地址</th>
            <th>商品名称</th>
            <th>单价/数量</th>
        </tr>
        </thead>
    <?php endif; ?>
    <tbody>
    <?php foreach ($lists as $list): ?>
        <?php $count = count($list['goods']);
        foreach ($list['goods'] as $key => $good): ?>
            <tr>
                <?php if ($key == 0): ?>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['order_sn']; ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo date('Y-m-d H:i:s', $list['add_time']); ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo Domain_ShopOrders::orderStatus($list['status']); ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['delivery_name']; ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['delivery_sn']; ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['address']['realname']; ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['address']['mobile']; ?></td>
                    <td rowspan="<?php echo $count; ?>"><?php echo $list['address']['province'], ' ', $list['address']['city'], ' ', $list['address']['area'], ' ', $list['address']['address']; ?></td>
                <?php endif; ?>
                <td><?php echo $good['goods_name'] . $good['guige']; ?></td>
                <td style="text-align: right"><?php echo $good['price'], '<br/>x', $good['total']; ?></td>
            </tr>
        <?php endforeach; ?>

    <?php endforeach; ?>
    </tbody>
</table>