<?php

class User
{
    private $db;
    private $data;
    private $sessionName;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->sessionName = Config::get('session.userSession');
    }

    public function create($fields = [])
    {
        $this->db->insert('users', $fields);
    }

    public function login($email = null, $password = null)
    {
        if ($email) {
            $user = $this->find($email);
            if ($user) {
                if (password_verify($password, $this->data()->password)) {
                    Session::put($this->sessionName, $this->data()->id);
                    return true;
                }
            }
        }
        return false;
    }

    public function find($email = null)
    {
        $this->data = $this->db->get('users', ['email', '=', $email])->first();
        if ($this->data) {
            return true;
        } else {
            return false;
        }
    }

    public function data()
    {
        return $this->data;
    }
}
