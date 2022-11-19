<?php

class Database
{
    private static $instance = null;
    private $pdo;
    private $query;
    private $count;
    private $result;
    private $error = false;

    private function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=components;charset=utf8", "root", "root");
        } catch (PDOException $exception) {
            $this->error = $exception->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {

            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = [])
    {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        if (count($params)) {

            $i = 1;
            foreach ($params as $param) {

                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        try {
            $this->query->execute();
            $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
        } catch (PDOException $exception) {

            $this->error = $exception->getMessage();
        }
        return $this;
    }

    public function error()
    {
        return $this->error;
    }

    public function result()
    {
        return $this->result;
    }

    public function count()
    {
        return $this->count;
    }

    public function get($table, $where = [])
    {
        if (count($where) == 3) {

            $operators = ['=', '>', '<', '>=', '<='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {

                $sql = "SELECT * FROM `{$table}` WHERE `{$field}` {$operator} ?";
                if (!$this->query($sql, [$value])->error()) {

                    return $this;
                };
            }
        }
        $this->error = 'There must be three parameters';
        return $this;
    }

    public function delete($table, $where = [])
    {
        if (count($where) == 3) {

            $operators = ['=', '>', '<', '>=', '<='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {

                $sql = "DELETE FROM `{$table}` WHERE `{$field}` {$operator} ?";
                if (!$this->query($sql, [$value])->error()) {

                    return $this;
                };
            }
        }
        $this->error = 'There must be three parameters';
        return $this;
    }
}
