<?php $shop_footer = DI()->cache->get('shop_footer'); ?>
<?php if (empty($shop_footer)): ob_flush();
    ob_start(); ?>
    <div class="slogen">
        <div class="index_style">
            <ul class="wrap">
                <li>
                    <a href="#"><img src="<?php echo $path; ?>images/slogen_34.png" data-bd-imgshare-binded="1"></a>
                    <b>安全保证</b>
                    <span>多重保障机制 认证商城</span>
                </li>
                <li><a href="#"><img src="<?php echo $path; ?>images/slogen_28.png" data-bd-imgshare-binded="2"></a>
                    <b>正品保证</b>
                    <span>正品行货 放心选购</span>
                </li>
                <li>
                    <a href="#"><img src="<?php echo $path; ?>images/slogen_30.png" data-bd-imgshare-binded="3"></a>
                    <b>七天无理由退换</b>
                    <span>七天无理由保障消费权益</span>
                </li>
                <li>
                    <a href="#"><img src="<?php echo $path; ?>images/slogen_31.png" data-bd-imgshare-binded="4"></a>
                    <b>天天低价</b>
                    <span>价格更低，质量更可靠</span>
                </li>
            </ul>
        </div>
    </div>
    <!--底部图层-->
    <div class="phone_style">
        <div class="index_style">
            <?php $shop_setting_model = new Model_ShopSetting();
            $shop_setting = $shop_setting_model->get(1); ?>
            <span class="phone_number"><em
                        class="iconfont icon-dianhua"> <?php echo $shop_setting['phone']; ?></em></span><span
                    class="phone_title"><?php echo $shop_setting['tips']; ?></span>
        </div>
    </div>
    <div class="footerbox clearfix">
        <div class="clearfix">
            <div class="">
                <?php $article_class_footers = Domain_ArticleClass::getshopFooterList();
                foreach ($article_class_footers as $key => $article_footers): ?>
                    <dl>
                        <dt><?php echo $key; ?></dt>
                        <?php foreach ($article_footers as $article_footer): ?>
                            <dd>
                                <a href="<?php echo Domain_Article::url($article_footer); ?>"><?php echo $article_footer['title']; ?></a>
                            </dd>
                        <?php endforeach; ?>
                    </dl>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text_link">
            <p>

                <a href="?service=Default.Index">返回首页</a>
                <?php $nav_footers = Domain_Navigation::getNavList(2);
                foreach ($nav_footers as $nav_footer): ?>
                    ｜ <a href="<?php echo Domain_Navigation::url($nav_footer); ?>"
                         target="<?php echo $nav_footer['new_open'] == 1 ? '_blank' : '_self'; ?>"><?php echo $nav_footer['title']; ?></a>
                <?php endforeach; ?>
            </p>
            <p><?php echo DI()->config->get('sys_setting.icp'); ?><?php echo DI()->config->get('sys_setting.copyright'); ?></p>
        </div>
    </div>
    <?php $shop_footer = ob_get_contents();
    ob_clean();
    DI()->cache->set('shop_footer', $shop_footer, CACHE_TIME); endif;
echo $shop_footer; ?>
<!--右侧菜单栏购物车样式-->
<?php $shop_setting_model = new Model_ShopSetting();
$shop_setting = $shop_setting_model->get(1); ?>
<div class="fixedBox">
    <ul class="fixedBoxList">
        <?php if (Common_Function::user_id() > 0): ?>
            <li class="fixeBoxLi user"><a data-toggle="url" data-service="User.User" href="javascript::void(-1)">
                    <span class="fixeBoxSpan iconfont icon-yonghu"></span> <strong><?php echo $user['user_name']; ?></strong></a></li>
        <?php endif; ?>
        <li class="fixeBoxLi Service "><span class="fixeBoxSpan iconfont icon-service"></span> <strong>客服</strong>
            <div class="ServiceBox">
                <div class="bjfffs"></div>
                <dl onclick="javascript:;">
                    <dt><img src="<?php echo $path; ?>images/people.png" style="width: 100%;height: 100%"></dt>
                    <dd><strong>QQ客服1</strong>
                        <p class="p1">9:00-22:00</p>
                        <p class="p2"><a
                                    href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $shop_setting['qq1']; ?>&amp;site=DGG三端同步&amp;menu=yes">点击交谈</a>
                        </p>
                    </dd>
                </dl>
                <dl onclick="javascript:;">
                    <dt><img src="<?php echo $path; ?>images/people.png" style="width: 100%;height: 100%"></dt>
                    <dd><strong>QQ客服1</strong>
                        <p class="p1">9:00-22:00</p>
                        <p class="p2"><a
                                    href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $shop_setting['qq2']; ?>&amp;site=DGG三端同步&amp;menu=yes">点击交谈</a>
                        </p>
                    </dd>
                </dl>
            </div>
        </li>
        <li class="fixeBoxLi code cart_bd " style="display:block;">
            <span class="fixeBoxSpan iconfont icon-erweima"></span> <strong>微信</strong>
            <div class="cartBox">
                <div class="bjfff"></div>
                <div class="QR_code">
                    <p><img src="<?php echo $path; ?>images/erweima.png" width="150px" height="150px"
                            style=" margin-top:10px;"/></p>
                    <p>微信扫一扫，关注我们</p>
                </div>
            </div>
        </li>
        <li class="fixeBoxLi BackToTop"><span class="fixeBoxSpan iconfont icon-top"></span> <strong>返回顶部</strong></li>
    </ul>
</div>
</body>
</html>