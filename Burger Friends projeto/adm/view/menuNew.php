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
    <link href="css/style.menunew.css" rel="stylesheet">
    <title>Adicionar</title>
    <script>
        function voltar(){
            location.href="menuList.php";
        }
    </script>
</head>
<body>
    <!--INÍCIO MENU-->
    <h3>Administração do Menu</h3>
    <h4>Novo Menu | Submenu</h4>

    <div class="caixa-form-add">
    <form class="form-add" action="../controller/controller.php" name="form" method="POST">
        <?php 
            if(isset($_REQUEST['menu'])){
                echo "<b>Novo Menu</b><br><br>";
        ?>

        <div class="caixa-input">
        <input type="hidden" name="menu_new" value="1">
        <label for="Nome">Nome:</label>    
        <input type="text" name="nome"><br>
        </div>

        <div class="caixa-input">
        <label for="Url">Url:</label>    
        <input type="text" name="url"><br>
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option name="ativo" value="1">Ativo</option>
            <option name="inativo" value="0">Inativo</option>
        </select><br>
        </div>

        <div class="caixa-input-replic">
        <input class="replic" type="checkbox" name="replica" value="1" checked>
        <label for="replica">Replicar ajustando para todos os "folders"</label>
        <br>
        </div>
        <!--FIM MENU-->

        <!--INÍCIO SUBMENU-->
        <?php
        }else{
            echo "<b>Novo Submenu</b><br>";
            require_once ("../model/Menu.class.php");
            $submenu = new Menu();
            $dados = $submenu->ListaTabela("menu");
        ?>

        <input type="hidden" name="submenu_new" value="1">

        <div class="caixa-input-idmenu">
        <label for="Nome">Id Menu:</label>    
        <select name="idmenu" id="idmenu">
            <?php 
                $nome = "";
                for($i = 0;$i < count($dados);$i++){
                    if($nome != $dados[$i]["nome"]){
                        echo "<option value=\"{$dados[$i]['id']}\"> {$dados[$i]['id']} - {$dados[$i]['nome']}</option>";
                    }
                }
            ?>
        </select><br>
        </div>

        <div class="caixa-input">
        <label for="Nome">Nome Submenu:</label>    
        <input type="text" name="nomesub"><br>
        </div>

        <div class="caixa-input">
        <label for="Email">Url:</label>    
        <input type="text" name="url"><br>
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option name="ativo" value="1">Ativo</option>
            <option name="inativo" value="0">Inativo</option>
        </select><br>
        </div>

        <div class="caixa-input-replic">
        <input class="replic" type="checkbox" name="replica" value="1" checked>
        <label for="replica">Replicar ajustando para todos os "folders"</label><br>
        </div>

        <?php
        }
        ?>
        <div class="caixa-add-sub">
        <input type="submit" class="button-add-sub" name="sbmt" value="registrar"><br>
        </div>
    </form>
    </div>
    <!--FIM SUBMENU-->
</body>
</html>