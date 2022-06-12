<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$db = include $_SERVER['DOCUMENT_ROOT'] . '/database/start.php';

$posts = $db->getAll();

include 'index.view.php';
