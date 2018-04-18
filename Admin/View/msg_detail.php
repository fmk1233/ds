<!DOCTYPE html>
<html>


<?php $this->view('header');?>

<body class="gray-bg">
<link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>投诉详情</h5>
                </div>
                <div class="ibox-content" style="overflow: hidden;">
                    <form method="post" class="form-horizontal" onsubmit="return false;">
                        <input type="hidden" name="msgid" value="<?php echo $msg['id'];?>">
                        <input type="hidden" name="service" value="DMsg.msgReply">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $msg['msg_title'];?>" name="title" class="form-control" placeholder="请输入标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-9" id="eg">
                                     <?php echo html_entity_decode($msg['content']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">回复：</label>
                                <div class="col-sm-9" id="eg2">
                                    <div class="summernote"  style="height: 100px">
                                        <?php echo html_entity_decode($msg['reply']);?>
                                    </div>
                                    <input type="hidden" value="<?php echo html_entity_decode($msg['reply']); ?>" id="content" name="reply">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">回复</button>
                                <button type="button" class="btn btn-danger" onclick="javascript:history.back();">返回</button>
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
        $(".summernote").summernote({lang: "zh-CN",onImageUpload:function (files,d,b) {
            var callback=function (url) {
                d.insertImage(b,url);
            };
            uploadImage(files[0],callback);
        }});
        $('form').on('submit',function () {

            $("#eg2").removeClass("no-padding");
            var reply = $("#eg2 .summernote").code();
            $('#content').val(reply);
            var data = $(this).serializeObject();
            ds.sendAjax({
                data:data,
                success:function (data) {
                    if(data.code==40000){
                        successMsg('回复成功',function () {
                            location.href = ds.url({service:'DMsg.MsgList'});
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
