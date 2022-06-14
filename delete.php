<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$db = include $_SERVER['DOCUMENT_ROOT'] . '/database/start.php';

$db->delete('posts', $_GET);

header('Location: ' . '/index.php');
