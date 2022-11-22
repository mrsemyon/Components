<?php

$GLOBALS['config'] = [
    'mysql'     => [
        'host'      => '127.0.0.1',
        'name'      => 'components',
        'user'      => 'root',
        'password'  => 'root',
        'charset'   => 'utf8',
        'opt'       => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ],
    ],
    'session'   => [
        'tokenName'     => 'token',
        'userSession'   => 'user',
    ],
    'cookie'    => [
        'cookieName'    => 'hash',
        'cookieExpiry'  => 604800,
    ]
];
