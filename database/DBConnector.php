<?php

class DBConnector
{
    public static function make($config)
    {
        return new PDO(
            "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}",
            $config['user'],
            $config['pass'],
            $config['opt']
        );
    }
}
