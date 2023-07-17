<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.categorianew.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .file{
            color: transparent;
            height: 30px;
        }
    </style>
</head>
<body>

<h3>Administração de Categorias</h3>
    <h4>Nova Usuário</h4>

    <div class="caixa-form-add">
    <form class="form-add" action="../controller/controller.php" name="form" method="POST">

        <div class="caixa-input">
        <input type="hidden" name="categoria_new">
        <label for="Categoria">Categoria:</label>
        <select name="categoria">
            <option value="Hamburguer">Hamburguer</option>
            <option value="Acompanhamento">Acompanhamento</option>
            <option value="Bebida">Bebida</option>
            <option value="Sobremesa">Sobremesa</option>
        </select>  
        <!--<input type="text" name="categoria"><br>-->
        </div><br>

        <div class="caixa-input">
        <label for="Nome">Nome:</label>    
        <input type="text" name="nome"><br>
        </div>

        <div class="caixa-input">
        <label for="Preco">Preço:</label>    
        <input type="text" name="preco"><br>
        </div>

        <div class="caixa-input">
        <label for="Imagem">Imagem:</label>    
        <input type="file" class="file" name="imagem" required><br>
        </div>

        <div class="caixa-input">
        <label for="Legenda">Legenda:</label>    
        <textarea class="textarea" name="legenda" placeholder="Ingredientes..."></textarea><br>
        </div>

        <div class="caixa-add-sub">
        <input type="submit" class="button-add-sub" name="registrar" value="registrar"><br>
        </div>

        </form>
        </div>
    
</body>
</html>