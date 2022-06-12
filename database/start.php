<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/QueryBuilder.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/DBConnector.php';

return new QueryBuilder(DBConnector::make());
