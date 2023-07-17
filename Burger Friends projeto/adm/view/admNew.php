<?php
session_start();

    if(!isset($_SESSION['ADM-EMAIL'])){
        session_destroy();
        ?>
            <form action="../index.php" method="POST" name="myForm" id="Form">
                <input type="hidden" name="msg" value="MI01">
            </form>
            <script>document.getElementById("Form").submit();</script>
        <?php
    }else{
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.admnew.css" rel="stylesheet">
    <title>Adicionar</title>
    <script>
        function voltar(){
            location.href="admList.php";
        }
    </script>
</head>
<body>
    <h3>Administradores do sistema</h3>
    <h4>Novo administrador</h4>

    <div class="caixa-form">
    <form action="../controller/controller.php" name="form" method="POST">
        <input type="hidden" name="adm_new" value="1">

        <div class="caixa-input">
        <label for="Nome">Nome:</label>    
        <input type="text" name="nome">
        </div>

        <div class="caixa-input">
        <label for="Email">Email:</label>    
        <input type="email" name="email">
        </div>

        <div class="caixa-input">
        <label for="Senha">Senha:</label>    
        <input type="password" name="senha">
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option name="ativo" value="1">Ativo</option>
            <option name="inativo" value="0">Inativo</option>
        </select>
        </div>
        

        <div class="caixa-input">
        <label for="Status">Poder:</label>    
        <select name="poder" id="poder">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        </div>
        

        <div class="button-add">
        <input class="registrar" type="submit" name="sbmt" value="registrar">
        </div>

    </form>
    </div>

    <!--<button classe="voltar" onclick="voltar();">&larr;</button>-->
    
</body>
</html>