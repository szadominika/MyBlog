<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<nav>
    <ul class="pagination">
        <li class="page-item">
            <?php if ($paginator->previous): ?>
                <a class="page-link" href="<?= $base; ?>?page=<?= $paginator->previous; ?>">Previous</a>
            <?php else: ?>
                Previous
            <?php endif; ?>
        </li>
        <li class="page-item">
            <?php if ($paginator->next): ?>
                <a class="page-link" href="<?= $base; ?>?page=<?= $paginator->next; ?>">Next</a>
            <?php else: ?>
                Next
            <?php endif; ?>
        </li>
    </ul>
</nav>
