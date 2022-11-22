<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Session::flash('danger', 'You need to log in for edit user\'s info.');
    Redirect::to('login.php');
} else {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                'username' => [
                    'required'  => true,
                    'min'       => 2,
                    'max'       => 15,
                ]
            ]);

            if ($validation->passed()) {
                $user = new User();

                $updateUser = $user->update(['username' => Input::get('username')]);
                if ($updateUser) {
                    Session::flash('success', 'User info updated successfully');
                    Redirect::to('/index.php');
                } else {
                    echo 'update failed';
                }
            } else {

                foreach ($validation->errors() as $error) {
                    echo $error . '<br>';
                }
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
            <label for="username">Username</label>
            <input type="username" name="username" placeholder="<?= $user->data()->username ?>">
        </div>
        <input type="hidden" name="token" value="<?= Token::generate() ?>">
        <div class="field">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>