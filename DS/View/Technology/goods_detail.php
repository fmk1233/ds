<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <script src="<?php echo Common_Function::GoodsPath('/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
    <script src="<?php echo Common_Function::GoodsPath('/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo Common_Function::GoodsPath('/js/inspinia.js'); ?>"></script>
    <style>
        .xs-ts {
            margin-left: 10px;
        }

        .ibox-title {
            padding-left: 32px !important;
            padding-right: 32px !important;
            padding-top: 20px !important;
        }

        .product-desc .btn-primary {
            color: #1a8dd6 !important;
            border: 1px solid #1a8dd6;
        }

        .product-desc .btn-primary:hover {
            background: transparent;
            color: #14c1b3 !important;
            border: 1px solid #14c1b3;
        }

        .ft-cor {
            color: #ccc;
            font-weight: normal;
            line-height: 14px;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .ft-cor:hover {
            color: #fff;
            background-color: rgba(112, 36, 153, 0.9);
        }

        .product-name:hover {
            color: #fff;
        }

        .collapse-link span:hover {
            color: #fff;
        }

        @media (max-width: 767px) {
            .tj-title span, .float-e-margins .btn {
                font-size: 14px;
            }
        }

        .btn-sm {
            padding: 8px 12px;
        }

        .l-bgw {
            padding-bottom: 1px;
        }

        .btn-white {
            color: #98a1b3;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(225, 225, 225, 0.1);
        }

        .font-gary {
            color: #98a1b3;
        }

        body {
            background: transparent !important;
        }

        .ibox-title, .ibox-content {
            padding-left: 32px !important;
            padding-right: 32px !important;
        }

        .col-xs-12 {
            margin-top: 40px;
        }

        .text-center {
            margin-top: 20px;
        }

        .col-xs-12 h4 {
            font-size: 16px;
            color: #14c1b3;
            border-bottom: 1px solid #14c1b3;
            line-height: 36px;
            width: 100%;
            font-weight: normal;
            margin: auto;
        }

        /*å›¾ç‰‡*/
        .ncs-goods-picture .gallery img {
            width: 90%;
            border: 6px solid rgba(225, 225, 225, 0.2);
        }

        .ncs-meta .price strong {
            font: 700 30px/25px Tahoma;
            vertical-align: middle;
            text-shadow: 0 1px 0 #6C0900;
            color: #c00;
        }

        .ncs-meta dl dt {
            line-height: 30px;
            height: 30px;
            font-family: "Microsoft YaHei", "\5FAE\8F6F\96C5\9ED1" !important;
            font: 12px/1.5 Arial;
        }

        .ncs-goods-summary dl dd, .ncs-goods-summary dl dt {
            vertical-align: top;
            letter-spacing: normal;
            word-spacing: normal;
            display: inline-block;
            min-height: 24px;
            padding: 6px 0 0;
        }

        .ncs-goods-summary dl {
            margin-bottom: 10px;
        }

        .ncs-goods-summary dt {
            text-align: left;
            width: 76px;
            margin-right: 6px;
        }

        .ncs-meta .cost-price strong {
            text-decoration: line-through;
            color: #c00;
        }

        .ncs-goods-code img {
            max-width: 100px;
            max-height: 100px;
        }

        .ncs-goods-code {
            width: 100px;
            position: absolute;
            z-index: 1;
            top: 12px;
            right: 12px;
        }

        .ncs-goods-code p {
            margin-bottom: 4px;
        }

        .ncs-goods-code-note {
            font-size: 12px;
        }

        .ncs-meta {
            /*background-color: rgba(225, 225, 225, 0.2);*/
            background-size: cover;
            padding: 15px 0;
            position: relative;
            z-index: 3;
        }

        .ncs-freight {
            padding: 6px 0;
        }

        .ncs-goods-summary dt {
            text-align: left;
            width: 76px;
            margin-right: 6px;
        }

        .ncs-freight_box {
            display: block;
            position: relative;
            z-index: 80;
        }

        .ncs-freight-select {
            height: 28px;
            float: left;
            margin-right: 6px;
            position: relative;
            z-index: 3;
        }

        #ncs-freight-prompt {
            line-height: 28px;
            color: #999;
            float: left;
        }

        .ncs-freight-select .content {
            background-color: #FFF;
            display: none;
            width: 512px;
            padding: 0;
            border: 1px solid #D7D7D7;
            position: absolute;
            z-index: 2;
            top: 0;
            left: 0;
            box-shadow: 4px 4px 0 rgba(0, 0, 0, .05);
        }

        .ncs-freight-select .ncs-stock {
            position: relative;
        }

        .ncs-freight-select .close {
            font-size: 12px;
            line-height: 20px;
            display: none;
            width: 24px;
            height: 20px;
            position: absolute;
            z-index: 2;
            top: 4px;
            left: 480px;
            cursor: pointer;
        }

        /*é€‰é¡¹éž‹å­å°ºç */
        .ncs-key dl {
            padding: 8px 0 0;
        }

        .ncs-goods-summary dl dd, .ncs-goods-summary dl dt {
            font-size: 12px;
            line-height: 24px;
            vertical-align: top;
            letter-spacing: normal;
            word-spacing: normal;
            display: inline-block;
            min-height: 24px;
            padding: 6px 0 0;
        }

        .ncs-key ul li {
            vertical-align: top;
            letter-spacing: normal;
            word-spacing: normal;
            display: inline-block;
            margin: 0 6px 6px 0;
            position: relative;
            z-index: 1;
        }

        .ncs-key ul li.sp-img div {
            background-color: #FFF;
            font-size: 12px;
        }

        .ncs-key ul li div {
            white-space: nowrap;
            display: block;
            min-height: 24px;
            padding: 1px;
            border: 1px solid #eee;
            cursor: pointer;
        }

        .ncs-key ul li.sp-img div img {
            vertical-align: middle;
            display: inline-block;
            max-width: 24px;
            max-height: 24px;
            margin-right: 5px;
        }

        .ncs-key ul li.sp-img div img {
            vertical-align: middle;
            display: inline-block;
            max-width: 24px;
            max-height: 24px;
            margin-right: 5px;
        }

        /*.ncs-key ul li.sp-img div.hovered, .ncs-key ul li.sp-img div:hover {*/
        /*color: #F32613;*/
        /*text-decoration: none;*/
        /*border: 2px solid #F32613;*/
        /*padding: 0 4px 0 0;*/
        /*}*/
        .ncs-buy {
            display: block;
            clear: both;
            padding: 20px 0 20px 0px;
            position: relative;
            z-index: 1;
        }

        .select, select {
            color: #777;
            background-color: #FFF;
            height: 41px;
            vertical-align: middle;
            padding: 0 4px;
            border: solid 1px #E6E9EE;
            margin-right: 5px;
        }

        select option {
            line-height: 20px;
            display: block;
            height: 20px;
            padding: 4px;
        }

        .ncs-figure-input {
            vertical-align: top;
            display: inline-block;
            width: 65px;
            position: relative;
            z-index: 1;
        }

        .ncs-figure-input .input-text {
            color: #333;
            font-family: Tahoma;
            font-size: 16px;
            font-weight: 600;
            line-height: 41px;
            text-align: center;
            height: 41px;
            width: 41px;
            padding: 0;
            border: solid 1px #eee;
        }

        .ncs-figure-input a.increase {
            background-position: -100px -100px;
            top: 0;
            background-color: #fff;
        }

        .ncs-figure-input a.decrease {
            background-position: -120px -100px;
            top: 21px;
            background-color: #fff;
        }

        .ncs-figure-input {
            vertical-align: top;
            display: inline-block;
            width: 65px;
            position: relative;
            z-index: 1;
        }

        .ncs-goods-summary .ncs-btn {
            vertical-align: top;
            display: inline-block;
            height: 42px;
            position: relative;
            z-index: 70;
            zoom: 1;
        }

        .ncs-goods-summary .ncs-btn a.buynow {
            background-color: #BA7538;
        }

        .ncs-goods-summary .ncs-btn a.buynow {
            font: 700 16px/32px "Microsoft Yahei";
            color: #FFF;
            text-align: center;
            display: inline-block;
            height: 42px;
            padding: 5px 12px;
            margin-right: 5px;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
        }

        /*åº—é“ºä¿¡æ¯*/
        .ncs-info .title {
            background-color: #FFF;
            padding: 26px 10px;
            text-align: center;
            border: solid 1px #eee;
        }

        .shopwwi-ownshop {
            display: block;
            margin: 5px auto;
            height: 36px;
            color: #F30;
            font: 700 12px "å¾®è½¯é›…é»‘";
            line-height: 36px;
            text-align: center;
        }

        .ncs-info .btns {
            font-size: 0;
            text-align: center;
            padding-bottom: 12px;
            border-bottom: solid 1px #eee;
        }

        .ncs-info .btns a.goto {
            color: #FFF;
            background-color: #333;
            border-color: #333;
            margin-right: 10px;
        }

        .ncs-info .btns a {
            font-size: 12px;
            line-height: 20px;
            color: #333;
            background-color: #F5F5F5;
            vertical-align: top;
            text-align: center;
            display: inline-block;
            height: 20px;
            padding: 0px 10px;
            border: solid 1px #CCC;
        }

        .lxdh-box {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            /*background: url(../../../../images/images/dh.png) center rgba(0,0,0,.2) no-repeat;*/
            background-color: rgba(255, 255, 255, .2);
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .icheckbox_sm-blue, .radio_sm-blue {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 36px;
            color: #999;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            cursor: pointer;
            text-align: center;
            border: 2px solid #CCCCCC;
            background: #fff;
        }

        .icheckbox_sm-blue:hover, .radio_sm-blue:hover {
            border: #0095ff solid 2px;
            color: #333;
        }

        .icheckbox_sm-blue.checked, .radio_sm-blue.checked {
            border: 2px solid #0095ff;
            color: #0095ff;
            background: #fff !important;
        }

        .icheckbox_sm-blue.disabled, .radio_sm-blue.disabled {
            opacity: 0.6;
            cursor: default;
        }

        .icheckbox_sm-blue.disabled:hover, .radio_sm-blue.disabled:hover {
            border-color: #ccc;
        }

        .icheckbox_sm-blue.checked:hover, .radio_sm-blue.checked:hover {
            border-color: #0095ff;
        }

        .sex {
            height: 40px;
            display: inline-block;
            margin-right: 6px;
        }



    </style>
    <link href="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css'); ?>">
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo T('产品详情'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('订单管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('产品详情'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight pd-t-b">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="ibox product-detail">
                            <div class="ibox-title">
                                <h5 class="bdl-green"><?php echo T('产品详情'); ?><a href="javascript:history.go(-1)" style="margin-left: 15px
;" class="table-btn"><?php echo T('返回'); ?> <i
                                            class="fa fa-arrow-circle-left"></i></a></h5>
                                <div class="ibox-tools">
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div class="ncs-detail ownshop row">
                                    <!-- 焦点图 -->
                                    <div id="ncs-goods-picture" class="ncs-goods-picture col-md-4">
                                        <div class="gallery_wrap">
                                            <div class="gallery"><img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~"
                                                                      src="<?php $goods_pic = explode(',', $goods['goods_pics']);
                                                                      echo Common_Function::GoodsPath($goods_pic[0]); ?>"
                                                                      class="cloudzoom" data-cloudzoom="zoomImage: 't'">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- //焦点图 -->
                                    <div class="col-md-6 pdlr0">
                                        <!-- S 商品基本信息 -->
                                        <div class="ncs-goods-summary ">
                                            <div class="name">
                                                <h2><?php echo $goods['goods_name']; ?></h2>

                                                <strong></strong></div>
                                            <div class="ncs-meta">
                                                <!-- S 商品参考价格 -->
                                                <dl>
                                                    <dt>商&nbsp;&nbsp;城&nbsp;&nbsp;价：</dt>
                                                    <dd class="price"><strong
                                                                id="price">¥<?php echo $goods['price']; ?></strong></dd>
                                                </dl>
                                                <!-- E 商品参考价格 -->
                                                <!-- S 商品发布价格 -->
                                                <dl>
                                                    <dt>市&nbsp;&nbsp;场&nbsp;&nbsp;价：</dt>
                                                    <dd class="cost-price">
                                                        <strong id="market_price">¥<?php echo $goods['market_price']; ?></strong>
                                                    </dd>
                                                </dl>


                                            </div>

                                            <?php if($goods['has_option']==1): ?>
                                                <div class="ncs-key">

                                                    <!-- S 商品规格值-->
                                                    <hr>
                                                    <div class="user-money">
                                                        <?php foreach ($goods['option_title'] as $options): ?>
                                                            <dl>
                                                                <dt><?php echo $options['title']; ?>：</dt>
                                                                <dd>
                                                                    <div class="user-sex">
                                                                        <?php foreach ($options['items'] as $key => $item): ?>

                                                                            <div class="sex">
                                                                                <input type="radio" <?php if ($key == 0) {
                                                                                    echo 'checked';
                                                                                } ?> name="<?php echo $options['id']; ?>"
                                                                                       value="<?php echo $item['id']; ?>">
                                                                                <label for="sex-man"><?php echo $item['title']; ?></label>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </dd>
                                                            </dl>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <!-- E 商品规格值-->
                                                </div>
                                            <?php endif;?>

                                            <input type="hidden" value="" name="optionid" id="optionid"/>

                                            <!-- S 购买数量及库存 -->
                                            <div class="ncs-buy">

                                                <!-- S 购买按钮 -->
                                                <div class="ncs-btn">
                                                    <!-- 立即购买-->
                                                    <a href="javascript:void(0);" id="add_to_cart"  data-id="<?php echo $goods['id']; ?>"  class="buynow " title="立即购买">立即购买</a>

                                                </div>
                                                <!-- E 购买按钮 -->
                                            </div>

                                        </div>

                                    </div>

                                    <!--S 店铺信息-->
                                    <div class="col-md-2 pdlr0">
                                        <div class="ibox" style="padding: 6px;background: rgba(0,0,0,.2)">
                                            <div style="border: 1px dashed rgba(255,255,255,.1);">
                                                <div class="ibox-title"
                                                     style="padding:10px!important;min-height:32px;font-size: 14px;text-align: center;background: transparent;color: #14c1b3;font-weight: bold">
                                                    联系电话
                                                </div>
                                                <div class="ibox-content"
                                                     style="padding:10px 10px 40px 10px!important;background: transparent">
                                                    <div class="lxdh-box">
                                                        <img src="<?php echo Common_Function::GoodsPath('/image/dh.png'); ?>"
                                                             alt=" <?= $shop_setting['phone'];?>" width="80%"
                                                             style="float: left;margin-top: 10px;margin-left: 10px;">
                                                    </div>
                                                    <h3 class="sj-size18 text-center"> <?= $shop_setting['phone'];?></h3>
                                                    <div class="small sj-size14"
                                                         style="text-align: center;margin-top: 14px!important;">
                                                        <?= $shop_setting['tips'];?>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 pdlr0 mgt0">
                                        <div class="cpms-bdbox"><h4><?php echo T('产品描述'); ?></h4></div>
                                        <div class="small text-muted text-left cpms-cbdbox">
                                            <div class="cpms-box">
                                                <?php echo html_entity_decode($goods['memo']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php $this->view('footer'); ?>
        </div>
    </div>
</div>

<?php $this->view('footer_js'); ?>
<script type="text/javascript"
        src="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
    $(function () {
        var goods_options = JSON.parse('<?php echo json_encode($goods['goods_option']); ?>');
        if (goods_options.length > 0) {
            selectType();
        }
        $('.user-money input').each(function () {
            var self = $(this),
                label = self.next(),
                label_text = label.text();
            label.remove();
            self.iCheck({
                // checkboxClass: 'icheckbox_sm-blue',
                radioClass: 'radio_sm-blue',
                insert: label_text
            });
        });
        function selectType() {
            var options = [];
            $('input[type="radio"]:checked').each(function () {
                options.push($(this).val());
            });
            for (var i = 0, len = goods_options.length; i < len; i++) {
                var goods_options_all = goods_options[i].option_ids.split('_');
                if (goods_options_all.sort().toString() == options.sort().toString()) {
                    $('#price').html(goods_options[i].option_price);
                    $('#market_price').html(goods_options[i].option_marketprice);
                    $('#stock').html(goods_options[i].option_stock);
                    $('#optionid').val(goods_options[i].option_id);
                    break;
                }
            }
        }

        $('input').on('ifChecked', function (event) {
            selectType();
        });
        $(".touchspin1").TouchSpin({
            min: 1,
            max:<?php echo $goods['stock']; ?>,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: 'btn btn-default',
            buttonup_class: 'btn btn-default'
        });
        $('#add_to_cart').on('click', function () {
            var button = $(this);
            var params = {
                service: 'Order.AddCart',
                goodsid: button.data('id'),
                num: 1,
                optionid: $('#optionid').val()
            };
            sendButtonAjax(button, params, {
                callback: function (d) {
                    setTimeout(function () {
                        location.href = '<?php echo Common_Function::url(array('service'=>'Order.CartList')); ?>'
                    },1000);
                }
            });
        });


    })
</script>
</body>

</html>
