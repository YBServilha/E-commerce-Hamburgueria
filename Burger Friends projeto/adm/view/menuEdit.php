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
            <form action="menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME06">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
        require_once("../model/Manager.php");
        $manager = new Manager();
        $dados = array();
        if($_REQUEST['destino'] == "menuedit"){
            $dados = $manager->pegaRegMenu($_REQUEST['id']);
        }else{
            $dados = $manager->pegaRegSubmenu($_REQUEST['id']);
        }

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
    <h3>Administração do Menu</h3>
    <h4>Atualizção Menu | Submenu</h4>

    <div class="caixa-form">
    <form action="../controller/controller.php" name="Menuedit" method="POST">
        <?php 
            if(isset($_REQUEST['destino']) && $_REQUEST['destino'] == "menuedit"){
                echo "<b>Edição de Menu</b><br>";
        ?>

        <input type="hidden" name="menu_edit" value="1">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">

        <div class="caixa-input">
        <label for="Nome">Folder:</label>
        <select name="folder" id="folder">
            <option value="r" <?php echo $dados['folder'] == 'r' ? "selected" : ""; ?>>Root</option>
            <option value="v" <?php echo $dados['folder'] == 'v' ? "selected" : ""; ?>>View</option>
        </select>
        </div>

        <div class="caixa-input">
        <label for="Nome">Nome:</label>    
        <input type="text" value="<?php echo $dados['nome'] ?>" name="nome">
        </div>

        <div class="caixa-input">
        <label for="Url">Url:</label>    
        <input type="text" value="<?php echo $dados['url'] ?>" name="url">
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option  value="1" <?php echo $dados['status'] == 1 ? "selected" : "" ;?>>Ativo</option>
            <option  value="0" <?php echo $dados['status'] == 2 ? "selected" : "" ;?>>Inativo</option>
        </select>
        </div>
        <!--FIM MENU-->

        <!--INÍCIO SUBMENU-->
        <?php
        }else{
            echo "<b>Edição de Submenu</b><br>";
        ?>

        <input type="hidden" name="submenu_edit" value="1">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">

        <div class="caixa-input">
        <label for="Nome">Folder:</label>
        <select name="folder" id="folder">
            <option value="r" <?php echo $dados['folder'] == 'r' ? "selected" : ""; ?>>Root</option>
            <option value="v" <?php echo $dados['folder'] == 'v' ? "selected" : ""; ?>>View</option>
        </select>
        </div>

        <div class="caixa-input">
        <label for="Nome">IdMenu:</label>    
        <select name="idmenu" id="idmenu">
            <?php 
               require_once("../Model/Menu.class.php");
               $menu = new Menu();
               $mdados = $menu->PegaTodosMenu();
               for($i = 0;$i < count($mdados);$i ++){
            ?>

                <option value="<?=$mdados[$i]['id']?>" <?php $mdados[$i]['id'] == $dados['idmenu'] ? "selected" : ""?>>
                    <?=$mdados[$i]['folder'] . " - " . $mdados[$i]['nome']; ?>
                </option>

            <?php 
                }   
            ?>
        </select>
        </div>

        <div class="caixa-input">
        <label for="Nome">Nome Submenu:</label>    
        <input type="text" value="<?php echo $dados['nomesub'] ?>" name="nomesub">
        </div>

        <div class="caixa-input">
        <label for="Email">Url:</label>    
        <input type="text" value="<?php echo $dados['url'] ?>" name="url">
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option  value="1" <?php echo $dados['status'] == 1 ? "selected" : "" ;?>>Ativo</option>
            <option  value="0" <?php echo $dados['status'] == 2 ? "selected" : "" ;?>>Inativo</option>
        </select>
        </div>
        
        <?php
        }
        ?>
        <div class="button-update">
        <input class="atualizar" type="submit" name="sbmt" value="atualizar">
        </div>
    </form>
    </div>

    <!--<button classe="voltar" onclick="voltar();">&larr;</button>-->
    <!--FIM SUBMENU-->
</body>
</html>