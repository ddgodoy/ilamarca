<?php if ($pager->haveToPaginate()): ?>
<!-- -->
<div class="paginacion">
        <ul>
            <?php if ($pager->getPage() != 1): ?>
                <li><a href="<?php echo url_for($url.'?page='.$pager->getPreviousPage().$params) ?>" class="fondo"><span class="prev"></span></a></li>
            <?php endif;?>
            <?php foreach($pager->getLinks() as $page): ?>
                <li><?php echo link_to($page, $url.'?page='.$page.$params) ?></li>
            <?php endforeach ?>
            <?php if ($pager->getPage() != $pager->getLastPage()): ?>
                <li><a href="<?php echo url_for($url.'?page='.$pager->getNextPage().$params) ?>" class="fondo"><span class="next"></span></a></li>
            <?php endif; ?>
        </ul>
</div>
<!-- -->
<?php else: ?>
<br />
<?php endif; ?>