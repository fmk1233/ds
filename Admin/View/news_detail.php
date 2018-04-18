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
                    <h5><?php echo $news['id']==0?'添加新闻公告':'修改新闻公告'; ?></h5>
                </div>
                <div class="ibox-content" style="overflow: hidden;">
                    <form method="post" class="form-horizontal" onsubmit="return false;">
                        <input type="hidden" name="newsid" value="<?php echo $news['id'];?>">
                        <input type="hidden" name="service" value="DNews.NewsInsert">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类：</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category">
                                        <?php $news_categorys = Domain_News::newsCategoryParams(); foreach($news_categorys as $key=>$news_category): ?>
                                            <option value="<?php echo $key; ?>" <?php if($news['category']==$key){echo 'selected';}?>><?php echo $news_category; ?></option>

                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $news['news_title'];?>" name="title" class="form-control" placeholder="请输入标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否置顶：</label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="isTop" <?php if($news['is_top']==0){echo 'checked';}else{echo '';}?> >否</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="isTop" <?php if($news['is_top']==1){echo 'checked';}else{echo '';}?>>是</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-9" id="eg">
                                    <div id="summernote" style="height: 200px">
                                        <?php echo html_entity_decode($news['content']);?>
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
            var newsId = $(':input[name="newsId"]').val();
            $("#eg").removeClass("no-padding");
            var content = $("#eg #summernote").code();
            var data = $(this).serializeObject();
            data.content  = content;
            ds.sendAjax({
                data:data,
                success:function (data) {
                    if(data.code==40000){
                        var msg ='添加成功';
                        if(newsId>0){
                            msg = '修改成功';
                        }
                        successMsg(msg,function () {
                            location.href = ds.url({service:'DNews.news'});
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
