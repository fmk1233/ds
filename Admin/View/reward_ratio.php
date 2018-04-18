<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <h5>奖金总拨比率</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div class="clearfix">
                        <table class="table" data-mobile-responsive="true">
                            <thead>
                            <tr>
                                <th>类型</th>
                                <th>总额</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($reward as $key=>$rew): ?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $rew; ?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript">
    $(function () {


    });

</script>

</html>
