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
    <link href="css/style.menuedit.css" rel="stylesheet">
    <title>Adicionar</title>
    <script>
        function voltar(){
            location.href="menuList.php";
        }
    </script>
</head>
<body>
      <?php 
        if(!isset($_REQUEST['id'])){
            ?>
            <form action="categoriasList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME06">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
        require_once("../model/Manager.php");
        $manager = new Manager();
        $dados = array();
        $dados = $manager->pegaRegCategoria($_REQUEST['id']);
        

        if($dados['result'] == 0){
            ?>
            <form action="menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME06">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }

      ?>  

    <!--INÍCIO MENU-->
    <h3>Administração de Categorias</h3>
    <h4>Atualização Categorias</h4>

    <div class="caixa-form">
    <form action="../controller/controller.php" name="Categoriaedit" method="POST">

        <input type="hidden" name="categoria_edit" value="1">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">

        <div class="caixa-input">
        <label for="Nome">Categoria:</label>
        <input type="text" value="<?php echo $dados['categoria'] ?>" name="categoria">
        </div>

        <div class="caixa-input">
        <label for="Nome">Nome:</label>    
        <input type="text" value="<?php echo $dados['nome'] ?>" name="nome">
        </div>

        <div class="caixa-input">
        <label for="Url">Preço:</label>    
        <input type="text" value="<?php echo $dados['preco'] ?>" name="preco">
        </div>

        <div class="caixa-input">
        <label for="Url">Imagem:</label>    
        <input type="text" value="<?php echo $dados['imagem'] ?>" name="imagem">
        </div>

        <div class="caixa-input">
        <label for="Url">Legenda:</label>    
        <input type="text" value="<?php echo $dados['legenda'] ?>" name="legenda">
        </div>
        <!--FIM MENU-->

        <div class="button-update">
        <input class="atualizar" type="submit" name="sbmt" value="atualizar">
        </div>
    </form>
    </div>

    <!--<button classe="voltar" onclick="voltar();">&larr;</button>-->
    <!--FIM SUBMENU-->
</body>
</html>