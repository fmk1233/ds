<?php $this->view('common/header'); ?>
<link href="<?php echo $path; ?>css/article.css" rel="stylesheet" type="text/css"/>
<!--顶部样式-->
<?php $this->view('common/top'); ?>

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
                        <?php foreach ($article_class as $class): ?>
                            <li>
                                <a href="<?php echo Common_Function::url(array('service' => 'Article.Article', 'cid' => $class['id'])); ?>"><?php echo $class['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
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
                    <?php foreach ($news_article as $new_ar): ?>
                        <li><i></i><a
                                    href="<?php echo Common_Function::url(array('service' => 'Article.Show', 'id' => $new_ar['id'])); ?>"><?php echo $new_ar['title']; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <?php if (count($news_article) == 0): ?>
                        <li>没有最新文章</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="ds-article-con">
            <h1><?php echo $article['title']; ?></h1>
            <h2><?php echo date('Y-m-d H:i', $article['add_time']); ?></h2>
            <div class="default">
                <p><?php echo $article['content']; ?></p>
            </div>
            <div class="more_article">
                <span class="fl">上一篇：
                    <?php if (count($pre_article) == 0): ?>
                        没有符合条件的文章
                        <?php else: ?>
                        <a href="<?php echo Common_Function::url(array('service' => 'Article.Show', 'id' => $pre_article[0]['id'])); ?>"><?php echo $pre_article[0]['title']; ?></a> <time><?php echo date('Y-m-d H:i', $pre_article[0]['add_time']); ?></time>
                    <?php endif; ?>
                </span>
                <span class="fr">下一篇：
                    <?php if (count($next_article) == 0): ?>
                        没有符合条件的文章
                    <?php else: ?>
                        <a href="<?php echo Common_Function::url(array('service' => 'Article.Show', 'id' => $next_article[0]['id'])); ?>"><?php echo $next_article[0]['title']; ?></a> <time><?php echo date('Y-m-d H:i', $next_article[0]['add_time']); ?></time>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>
</div>


<?php $this->view('common/footer'); ?>

