<?php $this->view('common/header');?>
<link href="<?php echo $path; ?>css/article.css" rel="stylesheet" type="text/css" />
<!--顶部样式-->
<?php  $this->view('common/top');?>

<!--帮助中心样式-->
<div class="Inside_pages clearfix ds-container" style="padding: 10px 0">
    <!--位置-->
    <div class="left">
        <div class="ds-module ds-module-style01">
            <div class="title">
                <h3>文章分类</h3>
            </div>
            <div class="content">
                <div class="ds-sidebar-article-class">
                    <ul>
                        <?php foreach($article_class as $class): ?>
                            <li><a href="<?php echo Common_Function::url(array('service'=>'Article.Article','cid'=>$class['id'])); ?>"><?php echo $class['name']; ?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ds-module ds-module-style03">
            <div class="title">
                <h3>最新文章</h3>
            </div>
            <div class="content">
                <ul class="ds-sidebar-article-list">
                    <?php foreach($news_article as $article): ?>
                        <li><i></i><a href="<?php echo Common_Function::url(array('service'=>'Article.Show','id'=>$article['id'])); ?>"><?php echo $article['title']; ?></a></li>
                    <?php endforeach;?>
                    <?php if(count($news_article)==0): ?>
                        <li>没有最新文章</li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="ds-article-con">
            <div class="title-bar">
                <h3><?php echo $current_class['name']; ?></h3>
            </div>
            <ul class="ds-article-list">
                <?php foreach($list as $li): ?>
                    <li><i></i><a href="<?php echo Common_Function::url(array('service'=>'Article.Show','id'=>$li['id'])); ?>"><?php echo $li['title']; ?></a><time><?php echo date('Y-m-d H:i',$li['add_time']); ?></time></li>
                <?php endforeach;?>
                <?php if(count($list)==0): ?>
                    <li>没有符合条件的文章</li>
                <?php endif;?>
            </ul>
        </div>
        <?php $this->view('common/page') ?>
    </div>
</div>


<?php $this->view('common/footer');  ?>

