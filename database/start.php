<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/QueryBuilder.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/DBConnector.php';
$config = include $_SERVER['DOCUMENT_ROOT'] . '/database/config.php';

return new QueryBuilder(DBConnector::make($config['database']));
