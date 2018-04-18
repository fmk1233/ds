<!DOCTYPE html>
<html>
<?php $this->view('header');?>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title"><h2>二级密码</h2></div>
                <div class="ibox-content clr">
                    <form class="form-inline col-md-9 col-md-offset-1" role="form" class="form" onsubmit="return false;" method="post" action="">

                        <input type="hidden" name="service" value="Admin.secAc" >
                        <div class="form-group">
                            <label for="password">* <?php echo '二级密码'; ?> </label>
                            <input type="password" class="form-control"  name="password" placeholder="请输入二级密码">
                        </div>
                        <div class="form-group">
                            <label class="sr-only"></label>
                            <button type="submit" class="btn-success btn"><?php echo T('确认'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<script>
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</html>
