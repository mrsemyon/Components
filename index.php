<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/QueryBuilder.php';


$db = new QueryBuilder(createPDO());
$posts = $db->getAll();

include 'index.view.php';
