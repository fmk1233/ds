<!DOCTYPE html>
<html>
<?php $this->view('header');?>
<style>
    .menu{
        margin-top: 8px;
    }
    .menu label{
        cursor: pointer;
        font-weight: normal
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h2>
                        <?php echo $power['id']==0?'添加部门信息':'修改部门信息'; ?>
                    </h2>
                </div>
                <div class="ibox-content clr">
                    <form class="form-horizontal" role="form"
                          method="post" onsubmit="return false;" id="register-form" action="">
                        <input type="hidden" value="Admin.PowerAddAC" name="service">
                        <input type="hidden" name="id" value="<?php echo $power['id']; ?>"/>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">部门名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $power['dep_name']; ?>" placeholder="请输入部门名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">部门权限</label>
                            <div class="col-sm-10 menu">

                                <?php foreach($menus as $key=>$menu): ?>
                                    <?php echo '<p><input id="'.$key.'" type="checkbox" name="power_all"><label for="'.$key.'">&nbsp;'.$key.' </label> <br/>'; ?>
                                    <?php foreach($menu as $key2=>$me): ?>
                                        <label for="<?= $me?>"><input id="<?= $me?>" type="checkbox" data-type="power" name="power[]" <?php if(in_array($me,$power['power']))echo 'checked'; ?> value="<?php echo $me; ?>"/><?php echo '  ',$key2; ?>&emsp;</label>
                                    <?php endforeach;?>
                                    </p><br/>
                                <?php endforeach;?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label hidden-xs"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-success" type="submit">确定提交</button>
                                <button class="btn btn-primary " type="button" onclick="javascript:history.back();">返回</button>
                            </div>
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
        const power_all = $('input[name=power_all]');
        const power = $('input[data-type=power]');
        $.each(power_all, function () {
            check_checked_all($(this));
        });
        //全选
        power_all.change(function () {
            $(this).parent().find('input[type=checkbox]').prop('checked',$(this).is(':checked'));
        });
        //单选
        power.change(function () {
            check_checked_all($(this).parent().prevAll('input[name=power_all]'));
        });
    });
    //判断全选按钮是否设置为全选状态
    function check_checked_all(power_all_obj) {     
        const length =power_all_obj.parent().find('input[data-type=power]').length;
        const check_length = power_all_obj.parent().find('input[data-type=power]:checked').length;
        power_all_obj.prop('checked',length==check_length);
    }
</script>
<script type="text/javascript">
    $(function () {
        bindFormAjax($('form'));
    });
</script>
</html>
