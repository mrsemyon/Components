<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$db = include $_SERVER['DOCUMENT_ROOT'] . '/database/start.php';

$post = $db->getOne('posts', 1);

$posts = $db->getAll('posts');

include 'index.view.php';
