<?php

//INICIAÇÃO DE SESSÃO E INCLUSÃO DE ARQUIVOS
session_start();
require_once("../model/Ferramentas.php");
require_once("../model/Conexao.php");

//VERIFICAÇÃO DE SESSÃO
if(!isset($_SESSION['ADM-ID'])){  
    session_destroy();   
        ?>
            <form action="../index.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MI01">
            </form>
            <script>document.getElementById("Form").submit();</script>
        <?php
}else{

    //ADICIONANDO ADMINISTRADOR
    if(isset($_POST['adm_new'])){
        $dados['nome'] = $_REQUEST['nome'];
        $dados['email'] = $_REQUEST['email'];
        require_once("../model/Ferramentas.php");
        $ferr = new Ferramentas(); 
        $dados['senha'] = $ferr->hash256($_REQUEST['senha']);
        $dados['poder'] = $_REQUEST['poder'];
        $dados['status'] = $_REQUEST['status'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->admNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV06">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php

        }else{//erro
            ?>
            <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    //EDITANDO ADMINISTRADOR
    if(isset($_REQUEST['adm_edit'])){
        $dados['id'] = $_REQUEST['id'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['email'] = $_REQUEST['email'];
        $dados['senha'] = "";
        if(isset($_REQUEST['senha']) | $_REQUEST['senha'] != ""){
            require_once("../model/Ferramentas.php");
            $ferr = new Ferramentas(); 
            $dados['senha'] = $ferr->hash256($_REQUEST['senha']);
        }
        $dados['poder'] = $_REQUEST['poder'];
        $dados['status'] = $_REQUEST['status'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->admEdit($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV06">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php

        }else{//erro
            ?>
            <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    //DELETANDO ADMINISTRADOR
    if(isset($_REQUEST['adm_delete'])){
        $id = $_REQUEST['id'];
        require_once('../model/Manager.php');
        $manager = new Manager();
        $result = $manager->admDelete($id);
        if($result == 1){//tudo certo
            ?>
                <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="MV07">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
                <form action="../view/admList.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME08">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }


    //MUDANDO SENHA DE ADMINISTRADOR
    if(isset($_REQUEST['adm_mudarSenha'])){
        if($_REQUEST['senha1'] == "" || $_REQUEST['senha2'] == ""){
            ?>
                <form action="../view/admChangePassw.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="MI02">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }

        if($_REQUEST['senha1'] != $_REQUEST['senha2']){
            ?>
                <form action="../view/admChangePassw.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME09">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }

        $dados['id'] = $_REQUEST['id'];
        require_once("../model/Ferramentas.php");
        $ferr = new Ferramentas();
        $dados['senha'] = $ferr->hash256($_REQUEST['senha1']);
        require_once('../model/Manager.php');
        $manager = new Manager();
        $result = $manager->admMudarSenha($dados);
        if($result == 1){//tudo certo
            ?>
                <form action="../view/area_administrativa.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="MV08">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
                <form action="../view/area_administrativa.php" method="POST" id="Form" name="myForm">
                    <input type="hidden" name="msg" value="ME10">
                </form>
                <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['menu_new'])){
        $dados['folder'] = "v";
        $dados['nome'] = $_REQUEST['nome'];
        $dados['url'] = $_REQUEST['url'];
        $dados['status'] = $_REQUEST['status'];
        $dados['replica'] = $_REQUEST['replica'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->menuNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV03">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['submenu_new'])){
        $dados['idmenu'] = $_REQUEST['idmenu'];
        $dados['folder'] = "v";
        $dados['nomesub'] = $_REQUEST['nomesub'];
        $dados['url'] = $_REQUEST['url'];
        $dados['status'] = $_REQUEST['status'];
        $dados['replica'] = $_REQUEST['replica'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->submenuNew($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV03">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['menu_edit'])){
        $dados['id'] = $_REQUEST['id'];
        $dados['folder'] = $_REQUEST['folder'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['url'] = $_REQUEST['url'];
        $dados['status'] = $_REQUEST['status'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->menuEdit($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['submenu_edit'])){
        $dados['id'] = $_REQUEST['id'];
        $dados['folder'] = $_REQUEST['folder'];
        $dados['idmenu'] = $_REQUEST['idmenu'];
        $dados['nomesub'] = $_REQUEST['nomesub'];
        $dados['url'] = $_REQUEST['url'];
        $dados['status'] = $_REQUEST['status'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->submenuEdit($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['menu_delete'])){
        require_once("../model/Manager.php");
        $manager = new Manager();
        $id = $_REQUEST['id'];
        $resp = $manager->menuDelete($id);
        if($resp == 1){
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME08">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

    if(isset($_REQUEST['submenu_delete'])){
        require_once("../model/Manager.php");
        $manager = new Manager();
        $id = $_REQUEST['id'];
        $resp = $manager->submenuDelete($id);
        if($resp == 1){
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{
            ?>
            <form action="../view/menuList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME08">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }

    }

    if(isset($_REQUEST['categoria_new'])){
        require_once("../model/Manager.php");
        $manager = new Manager();
        $dados = array();
        $dados['categoria'] = $_REQUEST['categoria'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['preco'] = $_REQUEST['preco'];
        $dados['imagem'] = $_REQUEST['imagem'];
        $dados['legenda'] = $_REQUEST['legenda'];
        $resp = $manager->categoriaNew($dados);
        if($resp == true){
            ?>
            <form action="../view/categoriasList.php" id="Form" method="post">
                <input type="hidden" name="msg" value="MV03">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
       }else{
            ?>
            <form action="../view/categoriasList.php" id="Form" method="post">
                <input type="hidden" name="msg" value="ME04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
       }
      }

      if(isset($_REQUEST['categoria_edit'])){
        $dados['id'] = $_REQUEST['id'];
        $dados['categoria'] = $_REQUEST['categoria'];
        $dados['nome'] = $_REQUEST['nome'];
        $dados['preco'] = $_REQUEST['preco'];
        $dados['imagem'] = $_REQUEST['imagem'];
        $dados['legenda'] = $_REQUEST['legenda'];
        require_once("../model/Manager.php");
        $manager = new Manager();
        $resp = $manager->CategoriaEdit($dados);
        if($resp == 1){//tudo certo
            ?>
            <form action="../view/categoriasList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV04">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{//erro
            ?>
            <form action="../view/mcategoriasList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }


    if(isset($_REQUEST['categoria_delete'])){
        require_once("../model/Manager.php");
        $manager = new Manager();
        $id = $_REQUEST['id'];
        $resp = $manager->categoriaDelete($id);
        if($resp == 1){
            ?>
            <form action="../view/categoriasList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{
            ?>
            <form action="../view/categoriasList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME08">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }


    if(isset($_REQUEST['usuario_delete'])){
        require_once("../model/Manager.php");
        $manager = new Manager();
        $id = $_REQUEST['id'];
        $resp = $manager->usuarioDelete($id);
        if($resp == 1){
            ?>
            <form action="../view/usuariosList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="MV07">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }else{
            ?>
            <form action="../view/usuariosList.php" method="POST" id="Form" name="myForm">
                <input type="hidden" name="msg" value="ME08">
            </form>
            <script>document.getElementById("Form").submit();</script>
            <?php
        }
    }

}


