<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = 'select * from posts';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}