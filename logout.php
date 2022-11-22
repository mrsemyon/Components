<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();

$user->logout();

Redirect::to('index.php');
