<pre>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

$GLOBALS['config'] = [
    'mysql' => [
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
];
$users = Database::getInstance()->query('SELECT * FROM `users` WHERE `username` = ?', ['John Doe']);
//$users = Database::getInstance()->get('users', ['id', '>', '0']);
//Database::getInstance()->delete('users', ['id', '=', '1']);
//Database::getInstance()->insert('users', ['username' => 'Anna Law', 'password' => '1234']);
//Database::getInstance()->update('users', 5, ['username' => 'Adam Eve', 'password' => '1234']);
//echo Database::getInstance()->first()->username;
if ($users->error()) {
    echo $users->error();
} else {
    foreach ($users->result() as $user) {
        echo $user->id . ' ' . $user->username . '<br>';
    }
}
