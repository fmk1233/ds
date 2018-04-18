<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/article.css" rel="stylesheet" type="text/css"/>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

<!--帮助中心样式-->
<div class="Inside_pages clearfix ds-container" style="padding: 10px 0">
    <!--位置-->
    <div class="right" style="width: 1200px">
        <div class="ds-article-con">
            <h1><?php echo $article['news_title']; ?></h1>
            <h2><?php echo date('Y-m-d H:i', $article['add_time']); ?></h2>
            <div class="default">
                <p><?php echo $article['content']; ?></p>
            </div>
            <div class="more_article">
                <span class="fl">上一篇：
                    <?php if (count($pre_article) == 0): ?>
                        没有符合条件的公告
                    <?php else: ?>
                        <a href="<?php echo Common_Function::url(array('service' => 'Article.NewsDetail', 'id' => $pre_article[0]['id'])); ?>"><?php echo $pre_article[0]['news_title']; ?></a> <time><?php echo date('Y-m-d H:i', $pre_article[0]['add_time']); ?></time>
                    <?php endif; ?>
                </span>
                <span class="fr">下一篇：
                    <?php if (count($next_article) == 0): ?>
                        没有符合条件的公告
                    <?php else: ?>
                        <a href="<?php echo Common_Function::url(array('service' => 'Article.NewsDetail', 'id' => $next_article[0]['id'])); ?>"><?php echo $next_article[0]['news_title']; ?></a> <time><?php echo date('Y-m-d H:i', $next_article[0]['add_time']); ?></time>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>
</div>


<?php $this->view('common/footer'); ?>

