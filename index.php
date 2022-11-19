<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Database.php';

$users = Database::getInstance()->query('SELECT * FROM `users` WHERE `username` IN (?, ?)', ['John Doe', 'Jane Koe']);

if ($users->error()) {
    echo $users->error();
} else {
    foreach ($users->result() as $user) {
        echo $user->username . '<br>';
    }
}
