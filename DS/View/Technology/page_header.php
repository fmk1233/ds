<div class="row border-bottom white-bg top-nav" id="topMenu">
    <div class="bk-toolBar clearfix" id="pc-top">
        <ul class="pull-left" id="topMenuPrice">
            <li><p>&nbsp;&nbsp;<i class="fa fa-fire"></i>&nbsp;欢迎您！ <span class="text-warning color-yellow"><?php echo $user['user_name'];?></span></p></li>
            <li><p>&nbsp;&nbsp;这是您第 <span class="text-warning color-yellow"><?php echo $user['login_num'];?></span> 次登录系统</p></li>
            <li><p>&nbsp;&nbsp;您上次的登录时间是 <span class="text-warning color-yellow"><?php echo ($user['last_time']==0)?date('Y-m-d H:i:s',$user['login_time']): date('Y-m-d H:i:s',$user['last_time']) ;?></span> </p></li>

        </ul>

        <ul class="pull-right" id="topMenuNav" style="margin-top:1px;margin-right: 20px;">
            <li id="menuNew"><a data-service="News.newsList" data-toggle="url" target="_self"><span class="text-warning color-yellow">新闻公告<span class="badge"></span></span></a></li>
        </ul>
        <a id="btnRecommed" role="button" class="btn btn-primary btn-skew btn-sm pull-right" style="margin-top:4px;margin-right: 20px;" target="_self">
            <span><i class="fa fa-clock-o" ></i> <span id="timer"></span></span>
            <script language="javascript">
                document.getElementById('timer').innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());
                setInterval("document.getElementById('timer').innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
            </script>
        </a>
    </div>
    <nav class="navbar navbar-vertical-top " role="navigation">
        <div class="navbar-header">
            <a id="navbar-toggle" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </a>

            <script>
                $("#navbar-toggle").on("click", function () {
                    var menu = $("#navbar");
                    /*menu.css("display","none");*/

                    $("body").css("overflow", "inherit");

                    var menuBg = $(".page-header-menu-bg");
                    var $this = $(this);
                    menuBg.on('click', function () {
                        $this.trigger('click');
                    });
                    menuBg.css("display", "none");


                    if (menu.is(":visible")) {

                        //menu.find('ul.nav').hide()
                        menu.animate({
                            width: "hide",
                            paddingLeft: "hide",
                            paddingRight: "hide",
                            marginLeft: "hide",
                            marginRight: "hide"
                        }, 300);
                        // menu.slideUp(300);
                    } else {
                        $("body").css("overflow", "hidden");
                        $(".navbar-vertical-left").css("overflow", "scroll");
                        $(".page-header-menu-bg").css("display", "block");
                        //menu.find('ul.nav').show()
                        menu.animate({
                            width: "show",
                            paddingLeft: "show",
                            paddingRight: "show",
                            marginLeft: "show",
                            marginRight: "show"
                        }, 300);
                        // menu.slideDown(300);
                    }

                    $(window).resize(function () {
                        $("body").css("overflow", "inherit");
                        $(".page-header-menu-bg").css("display", "none");
                        menu.css("display", "none");
                    });

                });
            </script>
            <a href="#" class="navbar-brand"><?php echo T('title'); ?></a>
        </div>

        <div class="navbar-collapse collapse navbar-vertical-left" id="navbar">
            <ul class="nav navbar-nav nav-fixe">
                <?php
                $menus = DI()->config->get('home_power.menu');
//                var_dump($menus);
                $service_menu = $service . ',';
//                var_dump($service_menu);
                foreach ($menus as $key => $menu): ?>
                    <?php $power = implode(',', $menu) . ',';
//                    var_dump($power);
                    $active = !(stripos($power, $service_menu) === false) ? 'active' : '' ?>

                    <li class="dropdown">
                        <a aria-expanded="false" role="button" class="dropdown-toggle" <?php echo $active; ?>
                           data-toggle="dropdown">
                            <?php echo T($key); ?><span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu dropdown-menu-1">
                            <?php foreach ($menu as $title => $m): if(!USER_CAN_BD&&$user['bd_center']==0&&$m=='User.UserReg'){continue;} ?>
                                <li><a data-service="<?php echo $m; ?>" data-toggle="url"><?php echo T($title); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a data-toggle="url" data-service="Default.Logout"><?php echo T('安全退出'); ?></a>
                </li>
            </ul>
            <div class="fixe"></div>
        </div>
        <a href="javascript:;" class=" page-header-menu-bg"></a>
    </nav>
</div>