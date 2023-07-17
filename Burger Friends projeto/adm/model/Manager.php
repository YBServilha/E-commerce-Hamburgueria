<?php 
    class Manager{
        //FUNÇÃO PARA MOSTRAR DADOS DE ADMINISTRADOR
        public function dadosAdministrador($email, $senha){
            require_once('Conexao.php');
            $sql = "SELECT* FROM administradores WHERE email = '$email' AND senha = '$senha' AND status = 1";
            $conexao = new Conexao();
            $result = $conexao->Executar($sql);

            if($result->num_rows > 0){
                $dados = array();
                $dados["array"] = 1;
                while($row = $result->fecth_assoc()){
                    $dados['id'] = $row['id'];
                    $dados['nome'] = $row['nome'];
                    $dados['email'] = $row['email'];
                    $dados['senha'] = $row['senha'];
                    $dados['poder'] = $row['poder'];
                }
                return $dados;
            }else{
                $dados["result"] = 0;
                return $dados;
            }
        }

        //FUNÇÃO PARA LISTAR ADM
        public function ListAdm(){
            require_once('Conexao.php');
            $sql = "SELECT* FROM administradores;";
            $result = $conexao->query($sql);
            if($result->num_rows > 0){
                $num = $result->num_rows;
                $dados = array();
                $dados["array"] = 1;
                $dados["num"] = $num;
                $i = 1;
                while($row = $result->fetch_assoc()){
                    $dados[$i]['id'] = $row['id'];
                    $dados[$i]['nome'] = $row['nome'];
                    $dados[$i]['email'] = $row['email'];
                    $dados[$i]['senha'] = $row['senha'];
                    $dados[$i]['poder'] = $row['poder'];
                    $dados[$i]['datahora'] = $row['datahora'];
                    $dados[$i]['status'] = $row['status'];
                    $i++;
                }
                $conexao->close();
                return $dados;
            }else{
                $dados["result"] = 0;
                $conexao->close();
                return $dados;
            }
        }

        //FUNÇÃO PARA ADICIONAR ADM
        public function admNew($dados){
            require_once 'Conexao.php';
            $conn = new Conexao();
            $sql = "INSERT INTO administradores (nome, email, senha, datahora, poder, status) VALUES('{$dados["nome"]}','{$dados["email"]}','{$dados["senha"]}',now(),'{$dados["poder"]}','{$dados["status"]}');";
            $result = $conn->Executar($sql);
            if($result == true){
                return 1;
            }else{
                return 0;
            }
        }

       //FUNÇÃO PARA CONFIRMAR SE ADM EXISTE
        public function confirmAdm($id){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "SELECT* FROM administradores WHERE id = {$id};";
            $result = $conexao->query($sql);
            if($result->num_rows > 0){
                $array = array();
                $dados['result'] = 1;
                while($row = $result->fetch_assoc()){
                    $dados['id'] = $row['id'];
                    $dados['nome'] = $row['nome'];
                    $dados['email'] = $row['email'];
                    $dados['poder'] = $row['poder'];
                    $dados['status'] = $row['status'];
                }
                return $dados;
            }else{
                $dados['result'] = 0;
                return $dados;
            }
        }

        //FUNÇÃO PARA EDITAR ADM
        public function admEdit($dados){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "";
            if(!isset($dados['senha']) || $dados['senha'] == ""){
                $sql = "UPDATE administradores set nome = '{$dados["nome"]}', email = '{$dados["email"]}', poder = '{$dados["poder"]}', status = '{$dados["status"]}' WHERE id = {$dados["id"]};";
            }else{
                $sql = "UPDATE administradores set nome = '{$dados["nome"]}', email = '{$dados["email"]}', senha = '{$dados["senha"]}', poder = {$dados["poder"]}, status = {$dados["status"]} WHERE id = {$dados["id"]};";
            }
            $result = $conn->Executar($sql);
            return $result;
        }

        //FUNÇÃO PARA DELETAR ADM
        public function admDelete($id){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "DELETE FROM administradores WHERE id = {$id};";
            $result = $conn->Executar($sql);
            return $result;
        }

        //FUNÇÃO PARA ALTERAR SENHA
        public function admMudarSenha($dados){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "UPDATE administradores set senha = '{$dados["senha"]}' WHERE id = {$dados["id"]};";
            $result = $conn->Executar($sql);
            return $result;
        }

        //FUNÇÃO PARA TABELA MENU
        public function menuList(){
        require_once('Conexao.php');
            $sql = "SELECT* FROM menu;";
            $result = $conexao->query($sql);
            if($result->num_rows > 0){
                $num = $result->num_rows;
                $dados = array();
                $dados["array"] = 1;
                $dados["num"] = $num;
                $i = 1;
                while($row = $result->fetch_assoc()){
                    $dados[$i]['id'] = $row['id'];
                    $dados[$i]['folder'] = $row['folder'];
                    $dados[$i]['nome'] = $row['nome'];
                    $dados[$i]['url'] = $row['url'];
                    $dados[$i]['datahora'] = $row['datahora'];
                    $dados[$i]['status'] = $row['status'];
                    $i++;
                }
                $conexao->close();
                return $dados;
            }else{
                $dados["result"] = 0;
                $conexao->close();
                return $dados;
            }
        }

        //FUNÇÃO PARA TABELA MENU
        public function submenuList(){
        require_once('Conexao.php');
            $sql = "SELECT* FROM submenu;";
            $result = $conexao->query($sql);
            if($result->num_rows > 0){
                $num = $result->num_rows;
                $dados = array();
                $dados["array"] = 1;
                $dados["num"] = $num;
                $i = 1;
                while($row = $result->fetch_assoc()){
                    $dados[$i]['id'] = $row['id'];
                    $dados[$i]['folder'] = $row['folder'];
                    $dados[$i]['idmenu'] = $row['idmenu'];
                    $dados[$i]['nomesub'] = $row['nomesub'];
                    $dados[$i]['url'] = $row['url'];
                    $dados[$i]['datahora'] = $row['datahora'];
                    $dados[$i]['status'] = $row['status'];
                    $i++;
                }
                $conexao->close();
                return $dados;
            }else{
                $dados["result"] = 0;
                $conexao->close();
                return $dados;
            }
        }

        //FUNÇÃO PARA NOVO MENU
        public function menuNew($dados){
            require_once("conexao.php");
            $conn = new Conexao();
            $sql = "INSERT INTO menu(folder, nome, url, datahora, status) VALUES('{$dados["folder"]}','{$dados["nome"]}','{$dados["url"]}',now(),'{$dados["status"]}')";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                if(isset($dados['replica']) && $dados['replica'] == 1){
                    $dados['folder'] = "r";
                    $dados['url'] = "view/" . $dados['url'];
                    $sql = "INSERT INTO menu(folder, nome, url, datahora, status) VALUES('{$dados["folder"]}','{$dados["nome"]}','{$dados["url"]}',now(),'{$dados["status"]}')";
                    $result = $conn->Executar($sql);
                    if($result == true){
                        return 1;
                    }
                }else{ // não replicar
                    return 1;
                }
            }else{//errado
                return 0;
            }
        }

        //FUNÇÃO PARA NOVO SUBMENU
        public function submenuNew($dados){
            require_once("conexao.php");
            $conn = new Conexao();
            $sql = "INSERT INTO submenu(folder, idmenu, nomesub, url, datahora, status) VALUES('{$dados["folder"]}',{$dados["idmenu"]},'{$dados["nomesub"]}','{$dados["url"]}',now(),'{$dados["status"]}')";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                if(isset($dados['replica']) && $dados['replica'] == 1){
                    $dados['idmenu'] = $dados['idmenu'] + 1;
                    $dados['folder'] = "r";
                    $dados['url'] = "view/" . $dados['url'];
                    $sql = "INSERT INTO submenu(folder, idmenu, nomesub, url, datahora, status) VALUES('{$dados["folder"]}',{$dados["idmenu"]},'{$dados["nomesub"]}','{$dados["url"]}',now(),'{$dados["status"]}')";
                    $result = $conn->Executar($sql);
                    if($result == true){
                        return 1;
                    }
                }else{ // não replicar
                    return 1;
                }
            }else{//errado
                return 0;
            }
        }

        //FUNÇÃO PARA PEGAR MENU SELECIONADO POR ID
        public function pegaRegMenu($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $dados = array();
            $sql = "SELECT* FROM menu WHERE id = {$id};";
            $result = $conn->Executar($sql);
            if($result->num_rows > 0){//tudo certo
                $dados['result'] = 1;
                while($row = $result->fetch_assoc()){
                    $dados['id'] = $row['id'];
                    $dados['folder'] = $row['folder'];
                    $dados['nome'] = $row['nome'];
                    $dados['url'] = $row['url'];
                    $dados['datahora'] = $row['datahora'];
                    $dados['status'] = $row['status'];
                    return $dados;
                }
            }else{//erro
                $dados['result'] = 0;
                return $dados;
            }
        }

        public function pegaRegCategoria($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $dados = array();
            $sql = "SELECT* FROM categorias WHERE id = {$id};";
            $result = $conn->Executar($sql);
            if($result->num_rows > 0){//tudo certo
                $dados['result'] = 1;
                while($row = $result->fetch_assoc()){
                    $dados['id'] = $row['id'];
                    $dados['categoria'] = $row['categoria'];
                    $dados['nome'] = $row['nome'];
                    $dados['preco'] = $row['preco'];
                    $dados['imagem'] = $row['imagem'];
                    $dados['legenda'] = $row['legenda'];
                    return $dados;
                }
            }else{//erro
                $dados['result'] = 0;
                return $dados;
            }
        }

        //FUNÇÃO PARA PEGAR SUBMENU SELECIONADO PELO ID
        public function pegaRegSubmenu($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $dados = array();
            $sql = "SELECT* FROM submenu WHERE id = {$id};";
            $result = $conn->Executar($sql);
            if($result->num_rows > 0){//tudo certo
                $dados['result'] = 1;
                while($row = $result->fetch_assoc()){
                    $dados['id'] = $row['id'];
                    $dados['folder'] = $row['folder'];
                    $dados['idmenu'] = $row['idmenu'];
                    $dados['nomesub'] = $row['nomesub'];
                    $dados['url'] = $row['url'];
                    $dados['datahora'] = $row['datahora'];
                    $dados['status'] = $row['status'];
                    return $dados;
                }
            }else{//erro
                $dados['result'] = 0;
                return $dados;
            }
        }

        //FUNÇÃO PARA EDITAR MENU
        public function menuEdit($dados){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "UPDATE menu SET folder = '{$dados["folder"]}', nome = '{$dados["nome"]}', url = '{$dados["url"]}', status = {$dados["status"]} WHERE id = {$dados['id']};";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                if($dados['status'] == 0){
                    $sql = "UPDATE submenu SET status = 0 WHERE id = {$dados["id"]};";
                    $result = $conn->Executar($sql);
                    if($result == true){
                        return 1;
                    }
                }if($dados['status'] == 1){
                    $sql = "UPDATE submenu SET status = 1 WHERE id = {$dados["id"]};";
                    $result = $conn->Executar($sql);
                    if($result == true){
                        return 1;
                    }
                }else{
                    return 1;
                }
            }else{//erro
                return 0;
            }
        }

        //FUNÇÃO PARA EDITAR SUBMENU
        public function submenuEdit($dados){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "UPDATE submenu SET folder = '{$dados["folder"]}', idmenu = {$dados["idmenu"]}, nomesub = '{$dados["nomesub"]}', url = '{$dados["url"]}', status = {$dados["status"]} WHERE id = {$dados['id']};";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                return 1;
            }else{//erro
                return 0;
            }
        }

        //FUNÇÃO PARA DELETAR MENU
        public function menuDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "SELECT id FROM submenu WHERE idmenu = {$id} ;";
            $result = $conn->Executar($sql); 
            if($result->num_rows > 0){
                $dados = array();
                $i = 0;
                while($row = $result->fetch_assoc()){
                    $dados[$id]["id"] = $row["id"];
                    $i++;
                }
                for($ii = 0;$ii < $i;$ii++){
                    $sql = "DELETE FROM submenu WHERE id = {$dados[$id]["id"]};";
                    $result = $conn->Executar($sql); 
                }
                if($result == true){
                $sql = "DELETE FROM menu WHERE id = {$id};";
                $result = $conn->Executar($sql);
                if($result == true){//tudo certo
                    return 1;
                }else{//erro
                    return 0;
                }
                }
            }else{
                $sql = "DELETE FROM menu WHERE id = {$id};";
                $result = $conn->Executar($sql);
                if($result == true){//tudo certo
                    return 1;
                }else{//erro
                    return 0;
                }
            }    
        }

        //FUNÇÃO PARA DELETAR SUBMENU
        public function submenuDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM submenu WHERE id = {$id};";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                return 1;
            }else{//erro
                return 0;
            }
        }

        //FUNÇÃO PARA ADICIONAR CATEGORIAS
        public function categoriaNew($dados){
            require_once('Conexao.php'); 
            $conn = new Conexao();
            $sql = "INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('{$dados["categoria"]}','{$dados["nome"]}','{$dados["preco"]}','{$dados["imagem"]}','{$dados["legenda"]}');";
            $resp = $conn->Executar($sql);
            return $resp;
        }

        //FUNÇÃO PARA EDITAR CATEGORIAS
        public function CategoriaEdit($dados){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "UPDATE categorias SET categoria = '{$dados["categoria"]}', nome = '{$dados["nome"]}', preco = '{$dados["preco"]}', imagem = '{$dados["imagem"]}', legenda = '{$dados["legenda"]}' WHERE id = '{$dados['id']}';";
            $result = $conn->Executar($sql);
            if($result == true){//tudo certo
                return 1;
            }else{//erro
                return 0;
            }
        }

        //FUNÇÃO PARA DELETAR CATEGORIAS
        public function categoriaDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM categorias WHERE id = {$id} ;";
            $result = $conn->Executar($sql); 
            if($result == true){
                return 1;
            }else{
                return 0;
            }
        }

        public function usuarioDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM usuarios WHERE id = {$id} ;";
            $result = $conn->Executar($sql); 
            if($result == true){
                return 1;
            }else{
                return 0;
            }
        }
        
    }


    
?>