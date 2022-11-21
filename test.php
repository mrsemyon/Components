<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/Session.php';

echo Session::flash('success');
