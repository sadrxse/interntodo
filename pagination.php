<nav aria-label="...">
    <!-- 前のページへ戻る -->
    <ul class="pagination">
        <?php if($page!=1): ?>
        <li class="page-item">
        <a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a>
        </li>
    <?php endif; ?>
    <!-- 各ページへのリンク -->
    <?php for($x=1;$x<=$pagination;$x++):?>
        <!-- アクティブページ -->
        <?php if($x==$page){ ?>
            <li class="page-item active" aria-current="page">
            <a class="page-link" href="#"><?php echo $x; ?></a>
            </li>
        <!-- アクティブでないページ -->
        <?php } else { ?>
            <!-- 検索ページのとき -->
            <?php if($page_title == "search"){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $x; ?>&keyword=<?php echo $keyword; ?>"><?php echo $x; ?></a></li>
            <!-- 一覧ページのとき -->
            <?php } else { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $x; ?>"><?php echo $x; ?></a></li>
            <?php } ?>
        <?php } ?>
    <?php endfor; ?>
    <!-- 次のページへ進む -->
    <?php if($page!=$pagination): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a>
        </li>
    <?php endif; ?>
    </ul>
</nav>