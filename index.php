<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
?>
<h1><?= Session::get(Config::get('session.userSession')) ?></h1>