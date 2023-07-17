<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.mudarsenha.css" rel="stylesheet">
    <title>Mudar senha</title>
    <script>
        function voltar(){
            location.href="area_administrativa.php";
        }
    </script>
</head>
<body>
    <h3>Administradores do Sistema</h3>
    <h4>Mudar Senha</h4>

    <!--FORMULÁRIO | MUDAR SENHA-->
    <div class="caixa-form-senha">
    <form action="../controller/controller.php" name="form" method="POST">
        <div class="caixa-input">
        <input type="hidden" name="adm_mudarSenha" value="1">
        <input type="hidden" name="id" value="<?php echo $_SESSION['ADM-ID']; ?>">
        </div>

        <div class="caixa-input">
        <label for="Senha">Nova Senha:</label>    
        <input type="password" name="senha1" required><br><br>
        </div>

        <div class="caixa-input">
        <label for="Senha">Digite a senha novamente:</label>    
        <input type="password" name="senha2" required><br>
        </div>
       
        <input type="submit" class="executar" name="sbmt" value="executar"><br><br>

    </form>
    <div>
    <!--FIM DO FORMULÁRIO | MUDAR SENHA-->

    <?php 
    //ALERTA DE MENSAGEM
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