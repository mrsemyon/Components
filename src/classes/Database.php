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
            $parameters = "mysql:host=" . Config::get('mysql.host') . ";dbname=" . Config::get('mysql.name') . ";charset=" . Config::get('mysql.charset');
            $this->pdo = new PDO($parameters, "root", "root");
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
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where = [])
    {
        return $this->action('DELETE', $table, $where);
    }

    public function action($action, $table, $where = [])
    {
        if (count($where) == 3) {

            $operators = ['=', '>', '<', '>=', '<='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {

                $sql = "{$action} FROM `{$table}` WHERE `{$field}` {$operator} ?";
                if (!$this->query($sql, [$value])->error()) {

                    return $this;
                };
            }
        }
        $this->error = 'There must be three parameters';
        return $this;
    }

    public function insert($table, $fields = [])
    {
        $values = '';
        foreach ($fields as $field) {
            $values .= '?, ';
        }
        $sql = "INSERT INTO `{$table}` (`" . implode('`, `', array_keys($fields)) . "`) VALUES (" . rtrim($values, ', ') . ")";
        if (!$this->query($sql, $fields)->error()) {
            return $this;
        }
        $this->error = 'Something went wrong while adding data';
        return $this;
    }

    public function update($table, $id, $fields = [])
    {

        $sql = "UPDATE `{$table}` SET ";
        foreach ($fields as $key => $value) {
            $sql .= "`" . $key . "` = ?, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE `id` = ?";
        $fields['id'] = $id;
        if (!$this->query($sql, $fields)->error()) {
            return $this;
        }
        $this->error = 'Something went wrong while updating data';
        return $this;
    }

    public function first()
    {
        if (!empty($this->result())) {
            return $this->result()[0];
        }
    }
}
