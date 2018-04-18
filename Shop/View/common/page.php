<?php $page_total = ceil($total/PAGENUM); if ($page_total > 0): ?>
    <div class="Paging">
        <div class="Pagination">
            <?php if ($page == 1): ?>
                <a href="javascript:;" class="pn-prev disabled">首页</a>
                <a href="javascript:;" class="pn-prev disabled">&lt;上一页</a>
            <?php else: ?>
                <a href="javascript:;" data-page="1">首页</a>
                <a href="javascript:;" data-page="<?php echo $page-1 ?>">&lt;上一页</a>
            <?php endif; ?>
            <?php for ($i = $begin = ($page>1?$page-1:$page), $len = ($begin + 3) > $page_total ? ($page_total) : ($begin + 3); $i <= $len; $i++): ?>
                <?php if ($i == $page): ?>
                    <a href="javascript:;" class="on disabled"><?php echo $i; ?></a>
                <?php else: ?>
                    <a href="javascript:;" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page == $page_total): ?>
                <a href="javascript:;" class="disabled" >下一页&gt;</a>
                <a href="javascript:"  class="disabled">尾页</a>
            <?php else: ?>
                <a href="javascript:;" data-page="<?php echo $page + 1; ?>">下一页&gt;</a>
                <a href="javascript:" data-page="<?php echo $page_total; ?>">尾页</a>
            <?php endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        $('.Pagination a,.s_Paging a').on('click', function () {
            if($(this).hasClass('disabled')){
                return;
            }
            var url = JSON.parse('<?php echo json_encode($url)?>');
            var page = parseInt($(this).data('page'));
            url.page = page;
            location.href = ds.url(url);
        });
    </script>
<?php endif; ?>