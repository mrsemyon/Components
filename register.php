<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, [
            'username' => [
                'required'  => true,
                'min'       => 2,
                'max'       => 15,
            ],
            'email' => [
                'required'  => true,
                'email'     => true,
                'unique'    => 'users',
            ],
            'password' => [
                'required'  => true,
                'min'       => 3
            ],
            'password_again' => [
                'required'  => true,
                'matches'   => 'password'
            ]
        ]);

        if ($validation->passed()) {

            $user = new User();
            $user->create([
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
            ]);

            Session::flash('success', 'Registration completed successfully');
            Redirect::to('/test.php');
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <pre>
<form action="" method="POST">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= Input::get('username') ?>">
    </div>
    <div class="field">
        <label for="username">Email</label>
        <input type="text" name="email" value="<?= Input::get('email') ?>">
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <div class="field">
        <label for="password_again">Password again</label>
        <input type="password" name="password_again">
    </div>
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>