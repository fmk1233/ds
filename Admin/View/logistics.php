<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h4 class="modal-title">查看物流--<?php echo $com; ?></h4>
</div>
<style type="text/css">
    .vertical-timeline-content{
        padding: 0px;
    }
    .vertical-timeline-block{
        margin: 0px;
    }
    .vertical-timeline-icon{
        width: 30px;
        height: 30px;
        left: 5px;
    }
    .vertical-timeline-icon i{
        margin-top：-8px;
    }

</style>
<div class="modal-body">
    <div id="vertical-timeline" class="vertical-container light-timeline">

        <?php $count = count($result['data']); foreach($result['data'] as $key=>$value): ?>
            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon lazur-bg">
                    <?php if($result['state']==3&&$key==0): ?>
                        <i class="fa fa-check"></i>
                        <?php elseif ($count==$key+1):?>
                        <i class="fa fa-circle"></i>
                        <?php else:?>
                        <i class="fa fa-angle-up"></i>
                    <?php endif;?>

                </div>
                <div class="vertical-timeline-content">
                    <p><?php echo $value['context']; ?></p>
                    <span class="vertical-date"><small><?php echo $value['time']; ?></small></span>
                </div>
            </div>
        <?php endforeach;?>

    </div>
</div>
<div class="modal-footer">
    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
</div>