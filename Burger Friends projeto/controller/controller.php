<?php 
    session_start();

    /*if(isset($_REQUEST['cadastrar'])){
        require_once('../model/Manager.php');
        $manager = new Manager();
        $dados = array();
        $dados['nome'] = $_REQUEST['nome'];
        $dados['endereco'] = $_REQUEST['endereco'];
        $dados['complemento'] = $_REQUEST['complemento'];
        $dados['numero'] = $_REQUEST['numero'];
        $dados['telefone'] = $_REQUEST['telefone'];
        $dados['email'] = $_REQUEST['email'];
        $dados['senha'] = $_REQUEST['senha'];
        $resp = $manager->usuarioNew($dados);
        if($resp == true){
            ?>
                <form action="../ind.php" method="POST" id="Form">
                    <input type="hidden" name="msg" value="MV09">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }else{
            ?>
                <form action="../ind.php" id="Form">
                    <input type="hidden" name="msg" value="ME11">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }*/

    if(isset($_POST['usuario_new'])){
        $dados['nome'] = $_REQUEST['nome'];
        $dados['endereco'] = $_REQUEST['endereco'];
        $dados['complemento'] = $_REQUEST['complemento'];
        $dados['numero'] = $_REQUEST['numero'];
        $dados['telefone'] = $_REQUEST['telefone'];
        $dados['email'] = $_REQUEST['email'];
        require_once("../model/Ferramentas.php");
        $ferr = new Ferramentas(); 
        $dados['senha'] = $ferr->hash256($_REQUEST['senha']);
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->usuarioNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../index.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV09">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../index.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME11">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    
    if(isset($_GET['carrinho_new'])){
        if($_REQUEST['produto'] == "existente"){
        $dados['email'] = $_SESSION['USER-EMAIL'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['produto'] = $_REQUEST['produto'];
        $dados['imagem'] = $_REQUEST['imagem'];
        $dados['legenda'] = $_REQUEST['legenda'];
        $dados['preco'] = $_REQUEST['preco'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->carrinhoNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/carrinho.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV10">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../index.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME12">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }else{
        $dados['email'] = $_SESSION['USER-EMAIL'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['produto'] = $_REQUEST['produto'];
        $dados['imagem'] = $_REQUEST['imagem'];
        $dados['pao'] = $_REQUEST['pao'];
        $dados['burger'] = $_REQUEST['burger'];
        $dados['ponto'] = $_REQUEST['ponto'];
        $dados['queijo'] = $_REQUEST['queijo'];
        $dados['alface'] = $_REQUEST['alface'];
        $dados['bacon'] = $_REQUEST['bacon'];
        $dados['tomate'] = $_REQUEST['tomate'];
        $dados['cebola'] = $_REQUEST['cebola'];
        $dados['picles'] = $_REQUEST['picles'];
        $dados['pimenta'] = $_REQUEST['pimenta'];
        $dados['preco'] = $_REQUEST['preco'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->carrinhoNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/carrinho.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV10">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../index.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME12">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }
    }


    if(isset($_REQUEST['compra_final'])){
        require_once('../model/Manager.php');
        $email = $_REQUEST['email'];
        $manager = new Manager();
        $result = $manager->CompraFinal($email);
        if($result == 1){//tudo certo
            ?>
                <form action="../view/carrinho.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="MV07">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
                <form action="../view/carrinho.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME08">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

?>