<?php

class User
{
    private $db;
    private $data;
    private $sessionName;
    private $cookieName;
    private $isLoggedIn;

    public function __construct($user = null)
    {
        $this->db = Database::getInstance();
        $this->sessionName = Config::get('session.userSession');
        $this->cookieName = Config::get('cookie.cookieName');
        if (!$user) {
            if (Session::exists($this->sessionName)) {
                $user = Session::get($this->sessionName);
                if ($this->find($user)) {
                    $this->isLoggedIn = true;
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = [])
    {
        $this->db->insert('users', $fields);
    }

    public function login($email = null, $password = null, $remember = false)
    {

        if (!$email && !$password && $this->exists()) {

            Session::put($this->sessionName, $this->data()->id);
        } else {

            $user = $this->find($email);
            if ($user) {

                if (password_verify($password, $this->data()->password)) {
                    Session::put($this->sessionName, $this->data()->id);

                    if ($remember) {

                        $hash = hash('sha256', uniqid());

                        $hashCheck = $this->db->get('user_sessions', ['user_id', '=', $this->data()->id]);

                        if (!$hashCheck->count()) {
                            $this->db->insert('user_sessions', [
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ]);
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->cookieName, $hash, Config::get('cookie.cookieExpiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function find($value = null)
    {
        if (is_numeric($value)) {
            $this->data = $this->db->get('users', ['id', '=', $value])->first();
        } else {
            $this->data = $this->db->get('users', ['email', '=', $value])->first();
        }
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

    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function logout()
    {
        $this->db->delete('user_sessions', ['hash', '=', Cookie::get($this->data()->id)]);
        Cookie::delete($this->cookieName);
        return Session::delete($this->sessionName);
    }

    public function exists()
    {
        return (!empty($this->data())) ? true : false;
    }

    public function update($fields = [])
    {
        return $this->db->update('users', $this->data()->id, $fields);
    }
}
