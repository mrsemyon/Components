<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/src/classes.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/config.php';

if (
    Cookie::exists(Config::get('cookie.cookieName')) &&
    (!Session::exists(Config::get('session.userSession')))
) {
    $hash = Cookie::get(Config::get('cookie.cookieName'));
    $hashCheck = Database::getInstance()->get('user_sessions', ['hash', '=', $hash]);
    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
