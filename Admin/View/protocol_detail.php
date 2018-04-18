<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5><?php echo $protocol['id']==0?'添加系统协议':'修改系统协议'; ?></h5>
                </div>
                <div class="ibox-content" style="overflow: hidden;">
                    <form method="post" class="form-horizontal" onsubmit="return false;">
                        <input type="hidden" name="protocolid" value="<?php echo $protocol['id'];?>">
                        <input type="hidden" name="service" value="DProtocol.ProtocolInsert">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $protocol['title'];?>" name="title" class="form-control" placeholder="请输入标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否启用：</label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="state" <?php if($protocol['state']==0){echo 'checked';}else{echo '';}?> >否</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="state" <?php if($protocol['state']==1){echo 'checked';}else{echo '';}?>>是</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-9" id="eg">
                                    <div id="summernote" style="height: 200px">
                                        <?php echo html_entity_decode($protocol['content']);?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">发布</button>
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
<script src="<?php echo URL_ROOT.'/static/'?>js/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo URL_ROOT.'/static/'?>js/plugins/summernote/summernote-zh-CN.js"></script>
<script type="text/javascript">
    $(function () {
        $("#summernote").summernote({lang: "zh-CN",onImageUpload:function (files,d,b) {
            var callback=function (url) {
                d.insertImage(b,url);
            };
            uploadImage(files[0],callback);
        }});
        $('form').on('submit',function () {
            var protocolId = $(':input[name="protocolId"]').val();
            $("#eg").removeClass("no-padding");
            var content = $("#eg #summernote").code();
            var data = $(this).serializeObject();
            data.content  = content;
            ds.sendAjax({
                data:data,
                success:function (data) {
                    if(data.code==40000){
                        var msg ='添加成功';
                        if(protocolId>0){
                            msg = '修改成功';
                        }
                        successMsg(msg,function () {
                            location.href = ds.url({service:'DProtocol.protocol'});
                        })
                    }else{
                        alertMsg(data);
                    }
                }
            });
        });
    });
</script>

</html>
