<?php
require_once 'connect.php';
require_once 'dao/UserDaoMysql.php';
require_once 'models/Auth.php';

$usuarioDao = new UserDaoMysql($pdo);

$nomeUsuario = filter_input(INPUT_POST, 'nome');
$emailUsuario = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senhaUsuario = filter_input(INPUT_POST, 'senha');

if($nomeUsuario && $emailUsuario && $senhaUsuario){

    if($usuarioDao->findByEmail($emailUsuario)===false){
        $hash= password_hash($senhaUsuario, PASSWORD_DEFAULT);

        $novoUsuario = new User();
        $novoUsuario->setNome($nomeUsuario);
        $novoUsuario->setEmail($emailUsuario);
        $novoUsuario->setSenha($hash);

        $usuarioDao->addUser($novoUsuario);
    
        header("Location: ".$base);
        exit;
    }else {
        header("Location: addUsuario.php");
        exit;
    }
} else {
    header("Location: addUsuario.php");
    exit;
}
