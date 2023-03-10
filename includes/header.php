<!doctype html>
<html lang="en">
<head>
    <title>My blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css"/ >
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>My blog</h1>
        </header>

        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>

                <?php if (Auth::isLoggedIn()) : ?>
                    
                    <li class="nav-item"><a class="nav-link" href="/admin/">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout.php">Log out</a></li>

                <?php else : ?>
                    
                    <li class="nav-item"><a class="nav-link" href="/login.php">Log in</a></li>

                <?php endif; ?>

                    <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
            </ul>
        </nav>

        <main>
