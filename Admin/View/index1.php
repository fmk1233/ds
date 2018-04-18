<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<style type="text/css">
    #comlogo img {
        margin-top: 20px;
        width: 400px;
        border-radius: 5px;
        opacity: 0.7;
    }
</style>
<body class="gray-bg" style="background-image:url('<?php echo Common_Function::GoodsPath('/image/word_map.png') ?>')">
   <div class="wrapper wrapper-content">
    <div class="row" style="text-align: center">
        <h2><?php echo T('title'); ?></h2>
        <div id="comlogo">
            <img src="<?php echo Common_Function::GoodsPath('/ds/img/logo-default.png'); ?>" alt="公司LOGO">
        </div>
    </div>
</div>
</body>
</html>
