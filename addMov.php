<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="addMov_action.php">
    <label>
        Valor: 
        <input type="text" name="valor" pattern="[0-9.,]{1,}">
    </label><br><br>
    <label>
        Descrição: 
        <input type="text" name="nome">
    </label><br><br>
    <label>
        Tipo: 
        <select name="tipo" id="">
            <option value="Débito">Débito</option>
            <option value="Crédito">Crédito</option>
        </select>
    </label><br>
    <label><br>
        Data: 
        <input type="date" name="data">
    </label><br><br>
  
    <input type="submit" value="Adicionar">

</form>
</body>
</html>
