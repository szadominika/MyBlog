<?php

require 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require 'includes/db.php';

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        
        Auth::login();

        Url::redirect('/');

    } else {
        
        $error = "login incorrect";

    }
}

?>
<?php require 'includes/header.php'; ?>

<h2>Login</h2>

<?php if (! empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<div class="col-xs-8 col-md-8 col-lg-6 m-auto ">
    <form method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" id="username" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-light mt-5" type="submit" >Log in</button>

    </form>

</div>

<?php require 'includes/footer.php'; ?>
