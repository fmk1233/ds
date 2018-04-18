<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h4 class="modal-title">查看物流--<?php echo $com; ?></h4>
</div>
<style type="text/css">
    .vertical-container{width:90%;max-width:1170px;margin:0 auto}.lazur-bg{background-color:#23c6c8;color:#fff}.vertical-container::after{content:'';display:table;clear:both}#vertical-timeline{position:relative;padding:0;margin-top:2em;margin-bottom:2em}#vertical-timeline::before{content:'';position:absolute;top:0;left:18px;height:100%;width:4px;background:#f1f1f1}.vertical-timeline-content .btn{float:right}#vertical-timeline.light-timeline:before{background:#e7eaec}.dark-timeline .vertical-timeline-content:before{border-color:transparent #f5f5f5 transparent transparent}.dark-timeline.center-orientation .vertical-timeline-content:before{border-color:transparent transparent transparent #f5f5f5}.dark-timeline .vertical-timeline-block:nth-child(2n) .vertical-timeline-content:before,.dark-timeline.center-orientation .vertical-timeline-block:nth-child(2n) .vertical-timeline-content:before{border-color:transparent #f5f5f5 transparent transparent}.dark-timeline .vertical-timeline-content,.dark-timeline.center-orientation .vertical-timeline-content{background:#f5f5f5}@media only screen and (min-width:1170px){#vertical-timeline.center-orientation{margin-top:3em;margin-bottom:3em}#vertical-timeline.center-orientation:before{left:50%;margin-left:-2px}}@media only screen and (max-width:1170px){.center-orientation.dark-timeline .vertical-timeline-content:before{border-color:transparent #f5f5f5 transparent transparent}}.vertical-timeline-block{position:relative;margin:2em 0}.vertical-timeline-block:after{content:"";display:table;clear:both}.vertical-timeline-block:first-child{margin-top:0}.vertical-timeline-block:last-child{margin-bottom:0}@media only screen and (min-width:1170px){.center-orientation .vertical-timeline-block{margin:4em 0}.center-orientation .vertical-timeline-block:first-child{margin-top:0}.center-orientation .vertical-timeline-block:last-child{margin-bottom:0}}.vertical-timeline-icon{position:absolute;top:0;left:0;width:40px;height:40px;border-radius:50%;font-size:16px;border:3px solid #f1f1f1;text-align:center}.vertical-timeline-icon i{display:block;width:24px;height:24px;position:relative;left:50%;top:2px;margin-left:-25px}@media only screen and (min-width:1170px){.center-orientation .vertical-timeline-icon{width:50px;height:50px;left:50%;margin-left:-25px;-webkit-transform:translateZ(0);-webkit-backface-visibility:hidden;font-size:19px}.center-orientation .vertical-timeline-icon i{margin-left:-12px;margin-top:-10px}.center-orientation .cssanimations .vertical-timeline-icon.is-hidden{visibility:hidden}}.vertical-timeline-content{position:relative;margin-left:60px;background:#fff;border-radius:.25em;padding:1em}.vertical-timeline-content:after{content:"";display:table;clear:both}.vertical-timeline-content h2{font-weight:400;margin-top:4px}.vertical-timeline-content p{margin:1em 0;line-height:1.6}.vertical-timeline-content .vertical-date{float:left;font-weight:500}.vertical-date small{color:#1ab394;font-weight:400}.vertical-timeline-content::before{content:'';position:absolute;top:16px;right:100%;height:0;width:0;border:7px solid transparent;border-right:7px solid #fff}@media only screen and (min-width:768px){.vertical-timeline-content h2{font-size:18px}.vertical-timeline-content p{font-size:13px}}@media only screen and (min-width:1170px){.center-orientation .vertical-timeline-content{margin-left:0;padding:1.6em;width:45%}.center-orientation .vertical-timeline-content::before{top:24px;left:100%;border-color:transparent;border-left-color:#fff}.center-orientation .vertical-timeline-content .btn{float:left}.center-orientation .vertical-timeline-content .vertical-date{position:absolute;width:100%;left:122%;top:2px;font-size:14px}.center-orientation .vertical-timeline-block:nth-child(even) .vertical-timeline-content{float:right}.center-orientation .vertical-timeline-block:nth-child(even) .vertical-timeline-content::before{top:24px;left:auto;right:100%;border-color:transparent;border-right-color:#fff}.center-orientation .vertical-timeline-block:nth-child(even) .vertical-timeline-content .btn{float:right}.center-orientation .vertical-timeline-block:nth-child(even) .vertical-timeline-content .vertical-date{left:auto;right:122%;text-align:right}.center-orientation .cssanimations .vertical-timeline-content.is-hidden{visibility:hidden}}.vertical-timeline-content{padding:0}.vertical-timeline-block{margin:0}.vertical-timeline-icon{width:30px;height:30px;left:5px}
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