<pre>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();
echo Session::flash('success');
echo '<br>';

if ($user->isLoggedIn()) {
    if ($user->hasPermissions('admin')) {
        echo 'You are admin!';
    }
    echo 'Hi, ' . $user->data()->username . '!';
    echo '<br>';
    echo "<a href='/logout.php'>Logout</a>";
    echo "<br>";
    echo "<a href='/update.php'>Update</a>";
    echo "<br>";
    echo "<a href='/updatepassword.php'>Update password</a>";
} else {
    echo "<a href='/register.php'>Register</a>";
    echo "<br>";
    echo "<a href='/login.php'>Login</a>";
}
