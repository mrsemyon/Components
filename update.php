<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$db = include $_SERVER['DOCUMENT_ROOT'] . '/database/start.php';

$db->update('posts', $_GET, $_POST);

header('Location: ' . '/index.php');
