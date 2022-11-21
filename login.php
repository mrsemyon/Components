<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, [
            'email' => [
                'required'  => true,
                'email'     => true,
            ],
            'password' => [
                'required'  => true,
            ]
        ]);

        if ($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('email'), Input::get('password'));
            if ($login) {
                Session::flash('success', 'Login completed successfully');
                Redirect::to('/index.php');
            } else {
                echo 'login failed';
            }
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
    <title>Login</title>
</head>

<body>
    <pre>
    <form action="" method="POST">
        <div class="field">
            <label for="username">Email</label>
            <input type="text" name="email" value="<?= Input::get('email') ?>">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <input type="hidden" name="token" value="<?= Token::generate() ?>">
        <div class="field">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>