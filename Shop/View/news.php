<?php $this->view('common/header');?>
<link href="<?php echo $path; ?>css/article.css" rel="stylesheet" type="text/css" />
<!--顶部样式-->
<?php  $this->view('common/top');?>

<!--帮助中心样式-->
<div class="Inside_pages clearfix ds-container" style="padding: 10px 0">
    <!--位置-->
    <div class="right" style="width: 1200px">
        <div class="ds-article-con">
            <div class="title-bar">
                <h3><?php echo '官方公告'; ?></h3>
            </div>
            <ul class="ds-article-list">
                <?php foreach($list as $li): ?>
                    <li><i></i><a href="<?php echo Common_Function::url(array('service'=>'Article.NewsDetail','id'=>$li['id'])); ?>"><?php echo $li['news_title']; ?></a><time><?php echo date('Y-m-d H:i',$li['add_time']); ?></time></li>
                <?php endforeach;?>
                <?php if(count($list)==0): ?>
                    <li>暂无公告</li>
                <?php endif;?>
            </ul>
        </div>
        <?php $this->view('common/page') ?>
    </div>
</div>


<?php $this->view('common/footer');  ?>

