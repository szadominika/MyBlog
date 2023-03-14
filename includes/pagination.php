<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<div class="">
    <ul class="container pagination text-center col-xs-8 col-md-8 col-lg-6">
        <li class="page-item m-auto">
            <?php if ($paginator->previous): ?>
                <a class="page-link m-4" href="<?= $base; ?>?page=<?= $paginator->previous; ?>">Previous</a>
            <?php else: ?>
                <a class="page-link m-4" > Previous</a>
            <?php endif; ?>
        </li>
        <li class="page-item m-auto">
            <?php if ($paginator->next): ?>
                <a class="page-link m-4" href="<?= $base; ?>?page=<?= $paginator->next; ?>">Next</a>
            <?php else: ?>
                <a class="page-link m-4" >Next</a>
            <?php endif; ?>
        </li>
    </ul>
</div>
