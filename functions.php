<?php

function dd($ar)
{
    echo '<pre>';
    var_dump($ar);
    echo '</pre>';
    die;
}

function createPDO()
{
    $host = '127.0.0.1';
    $db   = 'oop';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    return new PDO($dsn, $user, $pass, $opt);
}

function getAllPosts()
{
    $pdo = createPDO();
    $sql = 'select * from posts';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}