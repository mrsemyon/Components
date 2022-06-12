<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll($table)
    {
        $sql = "select * from $table";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}