<div id="header_top">
    <div id="top">
        <div class="Inside_pages">
            <div class="Collection" style="color: #777">
                <?php if (Common_Function::user_id() > 0): ?>
                    您好 <a data-toggle="url" data-service="User.User" href="javascript::void(-1)"
                          style="color: #232323"><?php echo $user['user_name']; ?></a>  <a
                            style="    font: 600 italic 12px/16px Georgia,Arial; text-shadow: 1px 1px 0 rgba(0,0,0,.25); color: #FFF4F4; background-color: #F33; vertical-align: middle; display: inline-block;height: 16px;padding: 1px 3px;border-radius: 2px;cursor: pointer"><?php echo $user['rank_name'] ?></a>
                    <a data-toggle="url" data-service="Default.Logout" href="javascript::void(-1)">[退出]</a>
                <?php endif; ?>
                欢迎来到<?php echo DI()->config->get('sys_setting.name'); ?></div>
            <div class="hd_top_manu clearfix">
                <ul class="clearfix">
                    <?php if (Common_Function::user_id() == 0): ?>
                    <li class="hd_menu_tit zhuce" data-addclass="hd_menu_hover">欢迎光临本店！<a class="red" data-toggle="url"
                                                                                          data-service="Default.Login"
                                                                                          href="javascript::void(-1);">[请登录]</a> 新用户<a data-toggle="url" data-service="Default.Register" href="javascript::void(-1);" class="red">[免费注册]</a>
                        <?php else: ?>
                        <?php endif; ?> </li>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a data-toggle="url"
                                                                             data-service="Order.OrderList"
                                                                             href="javascript::void(-1)">我的订单</a></li>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a data-toggle="url"
                                                                             data-service="Order.CartList"
                                                                             href="javascript::void(-1)">购物车</a></li>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="javascript::void(-1);"
                                                                             data-toggle="url"
                                                                             data-service="Article.Article"
                                                                             data-cid="7">联系我们</a></li>
                    <li class="hd_menu_tit list_name" data-addclass="hd_menu_hover"><a href="help.html" class="hd_menu">客户服务</a>
                        <div class="hd_menu_list">
                            <ul>
                                <li><a href="javascript::void(-1);" data-toggle="url" data-service="Article.Article"
                                       data-cid="2">帮助中心</a></li>
                                <li><a href="javascript::void(-1);" data-toggle="url" data-service="Article.Article"
                                       data-cid="5">售后服务</a></li>
                                <li><a href="javascript::void(-1);" data-toggle="url" data-service="Article.Article"
                                       data-cid="6">客服中心</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="hd_menu_tit phone_c" data-addclass="hd_menu_hover"><a href="#" class="hd_menu "><em
                                    class="iconfont icon-shouji"></em>手机版</a>
                        <div class="hd_menu_list erweima">
                            <ul>
                                <img src="<?php echo $path; ?>images/erweima.png" width="100px" height="100"/>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--顶部样式1-->
    <div id="header" class="header page_style">
        <div class="logo"><a href="?service=Default.Index"><img src="<?php echo $path; ?>images/logo.png"/></a></div>
        <!--结束图层-->
        <div class="Search">
            <p><input name="" type="text" value="<?php echo isset($keyword)?$keyword:''; ?>" class="text"/><input name="" type="submit" value="搜 索" id="serarchall" class="Search_btn "/>
            </p>
            <p class="Words">
                <?php $setting = Domain_System::getSetting(); $rec_search = unserialize($setting['rec_search']);  ?>
                <?php foreach($rec_search as $rec_search_item): ?>
                <a data-toggle="url" data-service="Goods.ProductList" data-keyword="<?php echo $rec_search_item['search']; ?>" href="javascript::void(-1)"><?php echo $rec_search_item['display']; ?></a>
                <?php endforeach;?>
            </p>
        </div>
        <!--购物车样式-->
        <div class="hd_Shopping_list" id="Shopping_list">
        </div>
    </div>
    <!--菜单导航样式-->
    <div id="Menu" class="clearfix">
        <div class="index_style clearfix">
            <div id="allSortOuterbox" <?php echo isset($show_menu) ? '' : 'class="display"' ?>>
                <div class="t_menu_img"></div>
                <div class="Category"><a href="#"><em></em>所有产品分类</a></div>
                <div class="hd_allsort_out_box_new">
                    <!--左侧栏目开始-->
                    <ul class="Menu_list">
                        <?php $shop_goods_categorys_lists = Domain_GoodsClass::getShopCategoryList();
                        foreach ($shop_goods_categorys_lists as $shop_goods_categorys_list): ?>
                            <li class="name">
                                <div class="Menu_name"><a data-toggle="url" data-service="Goods.ProductList"
                                                          data-cid="<?php echo $shop_goods_categorys_list['id']; ?>"
                                                          href="javascript::void(-1)"><?php echo $shop_goods_categorys_list['category_name']; ?></a>
                                    <span>&lt;</span></div>
                                <div class="link_name">
                                    <!-- <p><a href="Product_Detailed.html">茅台</a>  <a href="#">五粮液</a>  <a href="#">郎酒</a>  <a  href="#">剑南春</a></p>-->
                                </div>
                                <div class="menv_Detail">
                                    <div class="cat_pannel clearfix">
                                        <div class="hd_sort_list">
                                            <?php $shop_goods_categorys_list['child'] = isset($shop_goods_categorys_list['child']) ? $shop_goods_categorys_list['child'] : array();
                                            foreach ($shop_goods_categorys_list['child'] as $f_child_item): ?>
                                                <dl class="clearfix" data-tpc="1">
                                                    <dt><a data-toggle="url" data-service="Goods.ProductList"
                                                           data-cid="<?php echo $f_child_item['id']; ?>"
                                                           href="javascript::void(-1)"><?php echo $f_child_item['category_name']; ?>
                                                            <i>></i></a></dt>
                                                    <dd>
                                                        <?php $f_child_item['child'] = isset($f_child_item['child']) ? $f_child_item['child'] : array();
                                                        foreach ($f_child_item['child'] as $s_child_item): ?>
                                                            <a data-toggle="url" data-service="Goods.ProductList"
                                                               data-cid="<?php echo $s_child_item['id']; ?>"
                                                               href="javascript::void(-1)"><?php echo $s_child_item['category_name']; ?></a>
                                                        <?php endforeach; ?>
                                                </dl>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!--品牌-->
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php if (isset($show_menu)): ?>
                <div class="msg-right-box">
                    <div class="login-box">
                        <div class="top-box">
                            <div class="tx-box fl"><img width="100%" src="<?php echo $path; ?>images/l_login.png"
                                                        alt="登录头像"></div>
                            <?php if (Common_Function::user_id() > 0): ?>
                                <div class="text-box fl">
                                    <h1>Hi~ <?php echo $user['user_name']; ?></h1>
                                    <h2>欢迎您登录</h2>
                                </div>
                            <?php endif; ?>
                            <div class="clx"></div>
                        </div>
                        <?php if (Common_Function::user_id() == 0): ?>
                            <div class="bottom-box">
                                <button onclick="login_box()" style="cursor: pointer;">登录</button>
                                <!--                            <button>注册</button>-->
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="news-box">
                        <div class="news-title">
                            <i class="iconfont icon-gg1 fl"></i>
                            <span class="fl">公告</span>
                            <h2 class="fr"><a data-toggle="url" data-service="Article.News" href="javascript::void(-1)">更多></a>
                            </h2>
                        </div>
                        <ul class="news-ulbox">
                            <?php $notices = Domain_News::notice(); ?>
                            <?php foreach ($notices as $notice): ?>
                                <li><a data-toggle="url" data-service="Article.NewsDetail"
                                       data-id="<?php echo $notice['id']; ?>"
                                       href="javascript::void(-1)"><i></i><?php echo $notice['news_title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <script>$("#allSortOuterbox").slide({titCell: ".Menu_list li", mainCell: ".menv_Detail",});</script>
            <!--菜单栏-->
            <div class="Navigation" id="Navigation">
                <ul class="Navigation_name">
                    <li><a data-toggle="url" data-service="Default.Index" href="javascript::void(-1)">首页</a></li>
                    <?php $top_navs = Domain_Navigation::getNavList(0);
                    foreach ($top_navs as $top_nav): ?>
                        <li><a href="<?php echo Domain_Navigation::url($top_nav); ?>"
                               target="<?php echo $top_nav['new_open'] == 1 ? '_blank' : '_self'; ?>"><?php echo $top_nav['title']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <script>$("#Navigation").slide({titCell: ".Navigation_name li"});</script>
            <!-- <a href="#" class="link_bg"><img src="<?php echo $path; ?>images/link_bg_03.png" /></a>-->
        </div>
    </div>
</div>
<script type="text/javascript">
    function cart_list() {
        ds.sendAjax({
            data: {service: 'Default.CartList'},
            dataType: 'json',
            success: function (d) {
                $('#Shopping_list').html(d.data.top);
            }
        })
    }
    $(function () {
        cart_list();
        $('#serarchall').on('click',function () {
            var value = $(this).prev().val();
            var url = {service:'Goods.ProductList'};
            url.keyword = value;
            location.href = ds.url(url);
        });
    });

</script>
<?php if (Common_Function::user_id() == 0): ?>
    <script type="text/javascript">
        function login_box() {
            layui.use(['layer', 'form'], function () {
                var form = layui.form();
                layer.open({
                    type: 1,
                    shade: 0.3,
                    skin: 'layui-layer-molv',
                    title: '登录', //不显示标题
                    content: $('#login_box'),
                    success: function (layero, index) {
                        form.on('submit(login)', function (data) {
                            sendButtonAjax($(data.elem), data.field);
                            return false;
                        });

                    }
                });
            })
        }
    </script>
    <div id="login_box" style="display: none;padding: 20px 10px 10px 10px ;width: 300px">
        <form onsubmit="return false;" class="layui-form layui-form-pane">
            <input type="hidden" value="Default.Dologin" name="service"/>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="text-align: center">
                <button class="layui-btn layui-btn-danger" lay-submit="" lay-filter="login">登 录</button>
            </div>
        </form>
    </div>
<?php endif; ?>