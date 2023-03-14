<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>
<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>

    <div class="col-xs-8 col-md-8 col-lg-6 m-auto ">
        <article class = "mt-5">
            <h2><?= htmlspecialchars($article[0]['title']); ?></h2>

            <?php if ($article[0]['published_at']) : ?>
                <time><?= $article[0]['published_at'] ?></time>
            <?php else : ?>
                Unpublished
            <?php endif; ?>

            <?php if ($article[0]['category_name']) : ?>
                <p>Categories:
                    <?php foreach ($article as $a) : ?>
                        <?= htmlspecialchars($a['category_name']); ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>

            <?php if ($article[0]['image_file']) : ?>
                <img src="/uploads/<?= $article[0]['image_file']; ?>">
            <?php endif; ?>

            <p><?= htmlspecialchars($article[0]['content']); ?></p>
        </article>
    </div>

    <a class="likeAButton m-4" href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
    <a class="delete likeAButton m-4" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
    <a class="likeAButton m-4" href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit image</a>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>
