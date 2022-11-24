<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Components</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Components</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($user->isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout.php">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Login</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </div>
    </nav>
    <div class="col-md-6">
        <div id="panel-1" class="panel">
            <div class="container justify-center">
                <div class="panel-content">
                    <?php if (Session::exists('success')) : ?>
                        <div class="alert alert-success fade show" role="alert">
                            <?= Session::flash('success') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($user->isLoggedIn()) : ?>
                        <?php if ($user->hasPermissions('admin')) : ?>
                            <p>You are admin!</p>
                        <?php endif ?>
                        <p>Hi, <?= $user->data()->username ?>!</p>
                        <a href='/update.php'>Update</a>
                        <br>
                        <a href='/updatepassword.php'>Update password</a>
                    <?php endif ?>
                    <script http="bootstrap.bundle.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>