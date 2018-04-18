<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->view('header'); ?>
<style type="text/css">
    .money{
        width: auto;
    }
</style>
<link href="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css'); ?>">
<body class="page-container-bg-solid">
<div class="page-wrapper">
    <!--BEGIN 头部-->
    <?php $this->view('page_header'); ?>
    <!--END 头部-->

    <!--BEGIN 主体-->
    <div class="page-wrapper main-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class=" page-content-border">
                        <div class="page-content-title">
                            <h1><?php echo T('产品详情'); ?>
                                <small><!--介绍--></small>
                            </h1>
                            <a href="javascript:history.go(-1)" class="table-btn"><?php echo T('返回'); ?> <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="ibox product-detail">
                                    <div class="ibox-content product-main-text">
                                        <div class="row">
                                            <div class="col-md-5">


                                                <div class="product-images">
                                                    <div class="image-imitation">
                                                        <img src="<?php $goods_pic = explode(',', $goods['goods_pics']);
                                                        echo Common_Function::GoodsPath($goods_pic[0]); ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-7 ">

                                                <h2 class="font-bold m-b-xs text-bt"><?php echo $goods['goods_name']; ?></h2>

                                                <div class="m-t-md">
                                                    <h2 class="product-main-price"><b class="text-danger text-jg"><i
                                                                    class="fa fa fa-cny "></i><span
                                                                    id="price"><?php echo $goods['price']; ?></span></b>
                                                        <small class="text-muted text-xcj"><?php echo T('市场价'); ?> <i
                                                                    class="fa fa fa-cny "></i><span
                                                                    id="market_price"><?php echo $goods['market_price']; ?></span>
                                                        </small>
                                                    </h2>
                                                </div>
                                                <hr>
                                                <div class="user-money">
                                                    <?php foreach ($goods['option_title'] as $options): ?>
                                                        <h3 class="product-main-price">
                                                            <span class="text-success text-cs"><?php echo $options['title']; ?>
                                                                ： </span>
                                                            <?php foreach ($options['items'] as $key => $item): ?>
                                                                <div class="money fl">
                                                                    <input type="radio" <?php if ($key == 0) {
                                                                        echo 'checked';
                                                                    } ?> name="<?php echo $options['id']; ?>"
                                                                           value="<?php echo $item['id']; ?>">
                                                                    <label ><?php echo $item['title']; ?></label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </h3>
                                                    <?php endforeach; ?>
                                                </div>
                                                <h3 class="product-main-price">
                                                    <span class="text-info text-cs"><?php echo T('库存'); ?>： </span>
                                                    <span class="text-muted text-sj"
                                                          id="stock"> <?php echo $goods['stock']; ?></span>
                                                </h3>
                                                <hr>
                                                <form class="form-horizontal" name="form1" onsubmit="return false;">
                                                    <div class="form-group">
                                                        <!--<label class="col-sm-2 control-label">数量：</label>-->

                                                        <div class="col-sm-3">
                                                            <input class="touchspin1" id="num" type="text" value="1"
                                                                   name="num">
                                                            <input type="hidden" id="optionid"/>
                                                        </div>
                                                    </div>

                                                    <div>

                                                        <button class="btn blue" data-id="<?php echo $goods['id']; ?>"
                                                                id="add_to_cart" type="button"><i
                                                                    class="fa fa-cart-plus"></i> <?php echo T('加入购物车'); ?>
                                                        </button>
                                                        <a class="btn btn-default" data-toggle="url" data-service="Order.CartList"
                                                           > <?php echo T('查看购物车'); ?></a>

                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="text-ms"><?php echo T('产品描述'); ?></h4>

                                                <div class="small text-muted text-xq">
                                                    <!--内容-->
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
<!--增加数量-->
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js'); ?>"></script>
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
                num: $('#num').val(),
                optionid: $('#optionid').val()
            };
            sendButtonAjax(button, params, {
                callback: function (d) {
                }
            });
        })


    })
</script>
</body>
</html>