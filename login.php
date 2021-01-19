<?php
require_once 'connect.php';

?>
<form method="POST" action="login_action.php">
    <label for="">
        Email: 
        <input type="text" name="email">
    </label>
    <label for="">
        Senha:
        <input type="password" name="senha">
    </label>
    
    <input type="submit" value="Enviar">
</form>
<a href="addUsuario.php">Adicionar Usuário</a>