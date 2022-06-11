<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$posts = getAllPosts();

include 'index.view.php';
