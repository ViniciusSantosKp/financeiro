<?php

require_once 'connect.php';
require_once 'models/Auth.php';
require_once 'dao/MovimentoDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$movDao = new MovimentoDaoMysql($pdo);
$lista = $movDao->findByIdUser($userInfo->getId());


?>

<h1>Bem vindo <?=$userInfo->getNome();?></h1>

<a href="addMov.php">Adicionar Movimentação</a><br><br>
<a href="logout.php">Sair</a><br><br><br><br>
<h5>Saldo: R$ <?=$userInfo->getSaldo();?>.</h5><br><br><br><br>


<table border="1" width="40%">
    <tr>
        <th>NOME</th>
        <th>Valor</th>
        <th>Tipo</th>
        <th>Data</th>        
    </tr>

<?php foreach ($lista as $movimento):?>
    <tr>
        <td><?=$movimento->getNome();?></td>
        <td>R$ <?=$movimento->getValor();?></td>
        <td><?=$movimento->getTipo();?></td>
        <td><?=$movimento->getData();?></td>
    </tr>
<?php endforeach; ?>
</table><br><br><br><br>

<?php if($userInfo->getCargo()==1):?>

    <?php $_SESSION['cargo'] = $userInfo->getCargo();?>
    <a href="listaUsers.php">Gerenciar Usuários</a>

<?php endif;?>
