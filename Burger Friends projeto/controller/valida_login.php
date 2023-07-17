<?php
    session_start();
    require_once("../model/Ferramentas.php");
    require_once("../model/Conexao.php");

    //VERIFICAÇÃO DE EXISTÊNCIA DO EMAIL E SENHA DO ADM
    if(!isset($_POST['email']) || !isset($_POST['senha']) || empty($_POST['email']) || empty($_POST['senha'])){  
        session_destroy();   
            ?>
                <form action="../ind.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME02">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
    }else{
        //VERIFICAÇÃO DE INJECTIONS
        require_once("../model/Ferramentas.php");
        require_once("../model/Conexao.php");
        $connect = new Conexao();
        $ferr = new Ferramentas();
        $respEmail = $ferr->antiinjection($_POST['email']);
        $respSenha = $ferr->antiinjection($_POST['senha']);

        if($respEmail == 0 || $respSenha == 0){
            ?>
                <form action="../index.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME03">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
        //VERIFICAÇÃO DA SENHA EM HASH
        $email = $_POST['email'];
        $senha = $ferr->hash256($_POST['senha']);
        $sql = "SELECT* FROM usuarios WHERE email = '{$email}' AND senha = '{$senha}';";
        $req = $connect->Executar($sql);
        $query = mysqli_fetch_array($req);

        if($query == null){
            session_destroy();
            ?>
                <form action="../index.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME01">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }else if($query['email'] == $email && $query['senha'] == $senha){
            $_SESSION['USER-ID'] = $query['id'];
            $_SESSION['USER-EMAIL'] = $email;
            $_SESSION['USER-SENHA'] = $senha;
            $_SESSION['USER-NOME'] = $query['nome'];
            $_SESSION['USER-ENDERECO'] = $query['endereco'];
            $_SESSION['USER-NUMERO'] = $query['numero'];
            $_SESSION['USER-TELEFONE'] = $query['telefone'];
            ?>
                <form action="../index.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="MV02">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
         }
    }

    
   
   

?>