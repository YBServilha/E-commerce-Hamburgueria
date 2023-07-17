<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.admedit1.css" rel="stylesheet">
    <title>Edit Adm</title>
    <script>
        function voltar(){
            location.href="admList.php";
        }
    </script>
</head>
<body>
    <?php
        if(!isset($_REQUEST['id'])){//ausência de id
            ?>
                <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME05">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
            require_once("../model/Manager.php");
            $man = new Manager();
            $dados = $man->confirmAdm($_REQUEST['id']);
            if($dados['result'] == 0){
            ?>
                <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME06">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
            exit();
            }
        
    ?>

    <h3>Administradores do sistema</h3>
    <h4>Editar administrador</h4>

    <div class="caixa-form">
    <form action="../controller/controller.php" name="form" method="POST">
        <input type="hidden" name="adm_edit" value="1">
        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

        <div class="caixa-input">
        <label for="Nome">Nome:</label>    
        <input type="text" name="nome" value="<?php echo $dados['nome']; ?>">
        </div>

        <div class="caixa-input">
        <label for="Email">Email:</label>    
        <input type="email" name="email" value="<?php echo $dados['email']; ?>">
        </div>

        <div class="caixa-input">
        <label for="Senha">Nova Senha (Não obrigatório):</label>    
        <input type="password" name="senha">
        </div>

        <div class="caixa-input">
        <label for="Status">Status:</label>    
        <select name="status" id="status">
            <option name="ativo" value="1" <?php echo $dados['status'] == 1 ? "selected":""?>>Ativo</option>
            <option name="inativo" value="0" <?php echo $dados['status'] == 0 ? "selected":""?>>Inativo</option>
        </select>
        </div>

        <div class="caixa-input">
        <label for="Status">Poder:</label>    
        <select name="poder" id="poder">
            <option value="1" <?php echo $dados['poder'] == 1 ? "selected":""?>>1</option>
            <option value="2" <?php echo $dados['poder'] == 2 ? "selected":""?>>2</option>
            <option value="3" <?php echo $dados['poder'] == 3 ? "selected":""?>>3</option>
            <option value="4" <?php echo $dados['poder'] == 4 ? "selected":""?>>4</option>
            <option value="5" <?php echo $dados['poder'] == 5 ? "selected":""?>>5</option>
            <option value="6" <?php echo $dados['poder'] == 6 ? "selected":""?>>6</option>
            <option value="7" <?php echo $dados['poder'] == 7 ? "selected":""?>>7</option>
            <option value="8" <?php echo $dados['poder'] == 8 ? "selected":""?>>8</option>
            <option value="9" <?php echo $dados['poder'] == 9 ? "selected":""?>>9</option>
        </select>
        </div>

        <div class="caixa-edit">
        <input class="edit" type="submit" name="sbmt" value="editar">
        </div>
    </form>
    </div>

    <!--<button classe="voltar" onclick="voltar();">&larr;</button>-->

    <?php
    if(isset($_POST['msg'])){
        include_once('msg.php');
        $value = $_POST['msg'];
        ?>
        <script>alert("<?php echo $msg[$value]; ?>");</script>
        <?php
    }else{
    }
    ?>
</body>
</html>