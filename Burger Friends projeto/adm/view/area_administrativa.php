<?php
    session_start();

    //VERIFICAÇÃO DE SESSÃO
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
    <link href="css/style.areaadmin1.css" rel="stylesheet">
    <title>Area adm</title>
</head>
<body>
    <header>
        <!--BOTÃO DE LOGOUT-->
        <script>
            function ExecutarLogout(){
            var resp = confirm("Deseja sair da conta?");
            if(resp == true){
            location.href="../index.php";
            }
        }
        </script>
        <div class="caixa-button">
            <button id="logout" onclick="ExecutarLogout()">Logout</button>
        </div>
        <!--FIM BOTÃO DE LOGOUT-->
   
        <!--INFORMAÇÕES DE ADM-->
        <div class="caixa-info">
            <p>Nome: <?php echo $_SESSION['ADM-NOME'] ?></p>
            <p>Email: <?php echo $_SESSION['ADM-EMAIL'] ?></p>
            <p>Poder: <?php echo $_SESSION['ADM-PODER'] ?></p>
        </div>
        <!--FIM INFORMAÇÕES DE ADM-->
    </header>


    <!--BOTÕES DE ADM-->
<div class="caixa-iframe">
    <div class="caixa-botoes">
    <h2>Botões de ADM</h2>
    <div class="caixa-item-botoes">
    <?php 
        if($_SESSION['ADM-PODER'] == 9){
    ?>
    <a href="admList.php" target="iframe">Administradores</a><br><br>
    <?php
    }
    ?>

    <?php 
        if($_SESSION['ADM-PODER'] == 9){
    ?>
    <a href="usuariosList.php" target="iframe">Usuários</a><br><br>
    <?php
    }
    ?>

    <?php 
        if($_SESSION['ADM-PODER'] == 9){
    ?>
    <a href="menuList.php" target="iframe">Menu | Submenu</a><br><br>
    <?php
    }
    ?>

    <?php
        if($_SESSION['ADM-PODER'] == 9){
    ?>
    <a href="categoriasList.php" target="iframe">Categorias</a><br><br>
    <?php
    }
    ?>

    <a href="admChangePassw.php" target="iframe">Mudar Senha</a>
    </div>
    </div>
    <!--FIM BOTÕES DE ADM-->
    
    <!--INÍCIO IFRAME-->
    <iframe name="iframe" src="" frameborder="2"></iframe>
    <!--FIM IFRAME-->
</div>

</body>
</html>

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