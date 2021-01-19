<?php
require_once 'connect.php';
require_once 'models/Auth.php';
require_once 'models/Movimento.php';
require_once 'dao/MovimentoDaoMysql.php';

$info = new UserDaoMysql($pdo);
$infoUser = $info->findByToken($_SESSION['token']);
$movimentoDao = new MovimentoDaoMysql($pdo);


$valor = filter_input(INPUT_POST, 'valor');
$tipo = filter_input(INPUT_POST, 'tipo');
$descricao = filter_input(INPUT_POST, 'nome');
$data = filter_input(INPUT_POST, 'data');
$idUsuario = $infoUser->getId();
$valorReal;

if($tipo==='Débito'){
    $valorReal=(-1)*$valor;
}else{
    $valorReal=$valor;
}


if ($valor && $descricao && $data){
    $movimento = new Movimento();
    $movimento->setValor($valorReal);
    $movimento->setTipo($tipo);
    $movimento->setNome($descricao);
    $movimento->setData($data);
    $movimento->setIdUser($idUsuario);

    $movimentoDao->addMov($movimento);

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    $auth->updateSaldo($userInfo->getToken());

    

    

    header ("Location: ".$base);
    exit;
}
header("Location: addMov.php");
exit;


?>

