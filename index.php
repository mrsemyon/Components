<pre>
<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Input.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Validate.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Token.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Session.php';

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
        'tokenName' => 'token'
    ]
];

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();

        $validation = $validate->check($_POST, [
            'username' => [
                'required'  => true,
                'min'       => 2,
                'max'       => 15,
                'unique'    => 'users'
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
            echo 'passed';
        } else {
            foreach ($validation->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}

?>

<form action="/" method="POST">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= Input::get('username') ?>">
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