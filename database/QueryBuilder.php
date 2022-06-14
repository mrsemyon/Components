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
        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->query($sql);
        return $statement->fetchAll();
    }

    public function getOne($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }

    public function create($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function update($table, $id, $data)
    {
        $keys = array_keys($data);
        $sql = "UPDATE $table SET ";
        foreach ($keys as $key) {
            $sql .= $key .  '=:' . $key . ', ';
        }
        $sql = rtrim($sql, ', ') . ' WHERE id=:id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_merge($id, $data));
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($id);
    }
}