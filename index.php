<pre>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Database.php';

//$users = Database::getInstance()->query('SELECT * FROM `users` WHERE `username` = ?', ['John Doe']);
$users = Database::getInstance()->get('users', ['id', '>', '0']);
//Database::getInstance()->delete('users', ['id', '=', '1']);
//Database::getInstance()->insert('users', ['username' => 'Anna Law', 'password' => '1234']);
//Database::getInstance()->update('users', 5, ['username' => 'Adam Eve', 'password' => '1234']);

// if ($users->error()) {
//     echo $users->error();
// } else {
//     foreach ($users->result() as $user) {
//         echo $user->id . ' ' . $user->username . '<br>';
//     }
// }

echo $users->first()->username;
