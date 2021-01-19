<?php
require 'connect.php';
require 'models/Auth.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if($email && $senha){
    $auth = new Auth($pdo, $base);

    if($auth->validateLogin($email, $senha)){
        header("Location: ".$base);
        exit;
    }
}

header("Location: login.php");
exit;