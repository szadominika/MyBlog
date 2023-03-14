<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

    $article = Article::getByID($conn, $_GET['id']);

    if ( ! $article) {
        die("article not found");
    }

} else {
    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        if (empty($_FILES)) {
            throw new Exception('Invalid upload');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
                break;

            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('File is too large (from the server settings)');
                break;

            default:
                throw new Exception('An error occurred');
        }

        // Restrict the file size
        if ($_FILES['file']['size'] > 1000000) {

            throw new Exception('File is too large');

        }

        // Restrict the file type
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if ( ! in_array($mime_type, $mime_types)) {

            throw new Exception('Invalid file type');

        }

        // Move the uploaded file
        $pathinfo = pathinfo($_FILES["file"]["name"]);

        $base = $pathinfo['filename'];

        // Replace any characters that aren't letters, numbers, underscores or hyphens with an underscore
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        // Restrict the filename to 200 characters
        $base = mb_substr($base, 0, 200);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = "../uploads/$filename";

        // Add a numeric suffix to the filename to avoid overwriting existing files
        $i = 1;

        while (file_exists($destination)) {

            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = "../uploads/$filename";

            $i++;
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            $previous_image = $article->image_file;

            if ($article->setImageFile($conn, $filename)) {

                if ($previous_image) {
                    unlink("../uploads/$previous_image");
                }

                Url::redirect("/admin/edit-article-image.php?id={$article->id}");
            }

        } else {

            throw new Exception('Unable to move uploaded file');

        }

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<?php require '../includes/header.php'; ?>

<h2 class = "mb-5">Edit article image</h2>

<?php if ($article->image_file) : ?>
    <img src="/uploads/<?= $article->image_file; ?>">
    <br>
    <a  class="delete m-4 likeAButton" href="delete-article-image.php?id=<?= $article->id; ?>">Delete</a>

<?php endif; ?>

<?php if (isset($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <div>
        <label for="file" class = "m-2">Image file</label>
        <input type="file" name="file" id="file">
    </div>

    <button class = "btn btn-light mt-5">Upload</button>

</form>

<?php require '../includes/footer.php'; ?>
