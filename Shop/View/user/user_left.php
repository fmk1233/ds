<div class="menu_style">
    <div class="user_title">用户中心</div>
    <div class="user_Head">
        <div class="user_portrait">
            <a href="#" title="修改头像" class="btn_link"></a> <img src="<?php echo $path;?>images/people.png">
            <div class="background_img"></div>
        </div>
        <div class="user_name">
            <p><span class="name"><?php echo $user['user_name']; ?></span><a data-toggle="url" data-service="User.Pwd" href="javascript::void(-1)">[修改密码]</a></p>
            <p>访问时间：<?php echo date('Y-m-d H:i',$user['login_time']); ?></p>
            <p>余额：<?php echo $user[BONUS_NAME.BONUS_GW]; ?></p>
            <p>级别：<?php echo $user['rank_name']; ?></p>
        </div>
    </div>
    <div class="sideMen">
        <!--菜单列表图层-->
        <dl class="accountSideOption1">
            <dt class="transaction_manage"><em class="icon_1"></em>订单中心</dt>
            <dd>
                <ul>
                    <li> <a data-toggle="url" data-service="Order.OrderList" href="javascript::void(-1)"> 我的订单</a></li>
                    <li> <a data-toggle="url" data-service="User.Address" href="javascript::void(-1)">收货地址</a></li>
                    <li> <a href="index.php" target="_blank">会员中心</a></li>
                </ul>
            </dd>
        </dl>
    </div>
    <script>jQuery(".sideMen").slide({titCell:"dt", targetCell:"dd",trigger:"click",defaultIndex:0,effect:"slideDown",delayTime:300,returnDefault:false});</script>
</div>