<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$db = include $_SERVER['DOCUMENT_ROOT'] . '/database/start.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>COMPONENTS</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-xxl">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">COMPONENTS</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main>
        <section style="padding-top:20px">
            <div class="container-xxl">
                <h1><?= $db->getOne('posts', $_GET['id'])['title'] ?></h1>
            </div>
        </section>
    </main>
</body>

</html>