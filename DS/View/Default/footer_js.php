<!--[if lt IE 9]>
<script src="<?php echo URL_ROOT.'/static/';?>js/respond.min.js"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/excanvas.min.js"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/ie8.fix.min.js"></script>
<![endif]-->

<!-- BEGIN 核心插件 -->
<script src="<?php echo URL_ROOT.'/static/';?>js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>-->
<script src="<?php echo URL_ROOT.'/static/';?>js/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!--<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>-->
<!--<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
<!-- END 核心插件 -->
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/moment.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/morris/morris.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/morris/raphael.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.waypoints.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/counterup/jquery.counterup.min.js'); ?>" type="text/javascript"></script>

<!-- BEGIN 全局脚本 -->
<script src="<?php echo URL_ROOT.'/static/';?>js/default/app.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/default/dashboard.min.js" type="text/javascript"></script>
<!-- END 全局脚本 -->

<!-- BEGIN 主题布局脚本 -->
<script src="<?php echo URL_ROOT.'/static/';?>js/layout/layout.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/layout/demo.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/layout/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/layout/quick-nav.min.js" type="text/javascript"></script>
<!-- END 主题布局脚本 -->
<script>
    //窗口滚动后，导航悬浮
    /*resize*/
    $(function(){
        scrollTops();
        $(".page-header-menu-bg").css("display","none");
        $('.Language-menu a').on('click',function () {
            var data = $(this).data();
            ds.sendAjax({data:data,success:function () {
                location.reload();
            }});
        });
    });
    var scrolls = function () {
        if ($(window).scrollTop() > 0) {
            $(".index-header-top").removeClass('top-bg');
        } else {
            $(".index-header-top").addClass('top-bg');
        }
    }
    function scrollTops() {
        var wbox = $(window).width();
        if (wbox > 992){
            $(window).bind('scroll',scrolls);
        }else{
            $(window).unbind('scroll',scrolls);
        }
    }

    $(window).resize(function(){
        scrollTops();
        $("body").css("overflow","inherit");
        $(".page-header-menu-bg").css("display","none");
    });


</script>

<!--bootstrap-table-->
<script src="<?php echo URL_ROOT.'/static/';?>js/plugins/bootstrap-table/bootstrap-table.min.js" ></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/plugins/bootstrap-table/bootstrap-table-mobile.min.js" ></script>
<script src="<?php echo URL_ROOT.'/static/';?>js/plugins/bootstrap-table/locale/bootstrap-table-<?php echo $_SESSION['lang']; ?>.js" ></script>
<!--notify.js-->
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/bootstrap-notify.min.js"></script>
<!--sweet-alert.js-->
<script src="<?php echo URL_ROOT.'/static/';?>js/sweet-alert.min.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/ladda/spin.min.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/plugins/ladda/ladda.min.js"></script>
<!--base.js-->
<script src="<?php echo Common_Function::GoodsPath('/js/pass_aes.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/base.js'); ?>"></script>
