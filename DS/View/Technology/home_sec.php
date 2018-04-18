<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style>
        .top-navigation .wrapper.wrapper-content {
            padding: 0;
        }
    </style>
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo T('安全密码'); ?>
                                </h5>
                            </div>
                            <div class="ibox-content">

                                <form role="form" class="form-inline" name="sendForm" onsubmit="return false;" method="post" >
                                    <input type="hidden" name="service" value="User.SecAc" >
                                    <div class="form-group">
                                        <label for="exampleInputPassword2" class="sr-only"><?php echo T('安全密码'); ?>：</label>
                                        <input name="password" type="password" placeholder="<?php echo T('请输入'),T('安全密码'); ?>" id="exampleInputPassword2"
                                               class="form-control">
                                    </div>
                                    <button class="btn btn-primary"  type="submit"><?php echo T('确认'); ?></button>

                                </form>
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
<script>
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</body>

</html>
