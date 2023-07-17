<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="view/css/style.index.css" rel="stylesheet">
    <title>Adm login</title>
</head>
<body>

    <!--INÍCIO FORMULÁRIO DE LOGIN-->
    <div class="caixa-form-login">
    <form class="form-login" action="CONTROLLER/valida_login.php" method="POST" name="FormLogin" id="FormLogin">
        <div class="caixa-label caixa-Email">
            <label>Email:</label>
            <input class="input-campo" type="email" name="email"><br><br>
        </div>

        <div class="caixa-label caixa-Senha">
            <label>Senha:</label>
            <input class="input-campo" type="password" name="senha"><br></br>
        </div>

        <div class="caixa-button">
            <input class="button button-entrar" type="submit" value="LogIn" name="entrar">
        </div>
    </form>
    <!--FIM FORMULÁRIO DE LOGIN-->
    
</body>
</html>

<?php
    //ALERTA DE MENSAGEM
    if(isset($_POST['msg'])){
        include_once('view/msg.php');
        $value = $_POST['msg'];
        ?>
        <script>alert("<?php echo $msg[$value]; ?>");</script>
        <?php
    }else{
    }
?>

