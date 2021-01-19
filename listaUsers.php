<?php
require 'connect.php';
require 'dao/UserDaoMysql.php';

$usuarioDao = new UserDaoMysql($pdo);
$lista = $usuarioDao->findAll();

if($_SESSION['cargo']==1):
?>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>SENHA</th>
        <th>ACTIONS</th>
    </tr>

<?php foreach ($lista as $usuario):?>
    <tr>
        <td><?=$usuario->getId();?></td>
        <td><?=$usuario->getNome();?></td>
        <td><?=$usuario->getEmail();?></td>
        <td><?=$usuario->getSenha();?></td>
        <td>
            <a href="edit.php?id=<?=$usuario->getId();?>">Editar</a>
            <a href="exclude.php?id=<?=$usuario->getId();?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            
    </tr>
<?php endforeach; ?>
</table>
<a href="addUsuario.php">Adicionar</a><br><br>
<a href= <?=$base;?>>HOME</a>

<?php else:
    header("Location: login.php");
    exit;

endif;
?>

