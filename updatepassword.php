<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Session::flash('danger', 'You need to log in for edit user\'s password.');
    Redirect::to('login.php');
} else {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                'password' => [
                    'required'  => true,
                    'min'       => 3
                ],
                'password_again' => [
                    'required'  => true,
                    'matches'   => 'password'
                ]
            ]);

            $passwordAccept = password_verify(Input::get('current_password'), $user->data()->password);

            if ($passwordAccept) {
                if ($validation->passed()) {
                    $user = new User();

                    $updatePassword = $user->update(['password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)]);

                    if ($updatePassword) {
                        Session::flash('success', 'User password updated successfully');
                        Redirect::to('/index.php');
                    } else {
                        echo 'update failed';
                    }
                } else {

                    foreach ($validation->errors() as $error) {
                        echo $error . '<br>';
                    }
                }
            } else {
                echo 'current password not valid';
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
    <title>Update</title>
</head>

<body>
    <form action="" method="POST">
        <div class="field">
            <label for="current_password">Current password</label>
            <input type="password" name="current_password">
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