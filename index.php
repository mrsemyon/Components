<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();

if ($user->isLoggedIn()) {
    echo 'Hi, ' . $user->data()->username . '!';
    echo '<br>';
    echo "<a href='/logout.php'>Logout</a>";
} else {
    echo "<a href='/register.php'>Register</a>";
    echo "<br>";
    echo "<a href='/login.php'>Login</a>";
}
