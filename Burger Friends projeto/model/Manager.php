<?php 

    class Manager{

    public function pegaMenusSubmenus($folder){
        require_once("Conexao.php");
        $conn = new Conexao();
        $sql = "SELECT menu.id AS menuId, menu.nome AS menuNome, menu.url AS menuURL, submenu.idmenu AS subId, submenu.nomesub AS subNome, submenu.url AS subURL FROM menu INNER JOIN submenu ON menu.id = submenu.idmenu WHERE menu.folder = '{$folder}' AND menu.status = 1;";
        $result = $conn->Executar($sql);
        $dados = array();
        if($result->num_rows > 0){
            $dados['result'] = 1;
            $i = 0;
            while($row = $result->fetch_assoc()){
                $dados[$i]['menuId'] = $row['menuId'];
                $dados[$i]['menuNome'] = $row['menuNome'];
                $dados[$i]['menuURL'] = $row['menuURL'];
                $dados[$i]['subId'] = $row['subId'];
                $dados[$i]['subNome'] = $row['subNome'];
                $dados[$i]['subURL'] = $row['subURL'];
                $i++;
            }
            $sql = "SELECT MAX(ID) FROM submenu;";
            $r = $conn->Executar($sql);
            $row = $r->fetch_assoc();
            $dados['num'] = $row['MAX(ID)'];
            return $dados;
        }else{
            $dados['result'] = 0;
            return $dados;
        }
    }

    public function Categorias($categoric){
    require_once("Conexao.php");
    $conn = new Conexao();
    $sql = "SELECT* FROM categorias WHERE categoria = '{$categoric}';";
    $query = $conn->Executar($sql);
    if($query == true){
    while($dados = mysqli_fetch_array($query)){
        ?>
        <div class="produto">
        <img src="../view/img/<?php echo $dados['imagem'];?>" >
        <p><?php echo $dados['nome'] . "<br>";?></p>
        <p class="preco">R$<?php echo $dados['preco'];?>,00<br></p>
        <form action="../view/produto.php" method="POST">
            <input type="submit" class="rubik botaoform" name="comprar" value="comprar">
            <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
            <input type="hidden" name="nome" value="<?php echo $dados['nome'];?>">
            <input type="hidden" name="preco" value="<?php echo $dados['preco'];?>">
            <input type="hidden" name="imagem" value="<?php echo $dados['imagem'];?>">
            <input type="hidden" name="categoria" value="<?php echo $dados['categoria'];?>">
            <input type="hidden" name="legenda" value="<?php echo $dados['legenda'];?>">
        </form>
        </div>
    <?php
            }
        }else{
            
        }
    }


    public function usuarioNew($dados){
        require_once 'Conexao.php';
        $conn = new Conexao();
        if($dados['complemento'] == true){
            $sql = "INSERT INTO usuarios (nome, endereco, complemento, numero, telefone, email, senha) VALUES('{$dados["nome"]}','{$dados["endereco"]}','{$dados["complemento"]}','{$dados["numero"]}','{$dados["telefone"]}','{$dados["email"]}','{$dados["senha"]}');";
            $result = $conn->Executar($sql);
        }else{
            $sql = "INSERT INTO usuarios (nome, endereco, numero, telefone, email, senha) VALUES('{$dados["nome"]}','{$dados["endereco"]}','{$dados["numero"]}','{$dados["telefone"]}','{$dados["email"]}','{$dados["senha"]}');";
            $result = $conn->Executar($sql);
        }

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


    public function carrinhoNew($dados){
        require_once('Conexao.php'); 
        $conn = new Conexao();
            if($dados['produto'] == "existente"){
                $sql = "INSERT INTO carrinho(email, preco, nome, imagem, legenda) VALUES('{$dados["email"]}','{$dados["preco"]}','{$dados["nome"]}','{$dados["imagem"]}','{$dados["legenda"]}');";
                $resp = $conn->Executar($sql);
                return $resp;
            }else{
                $sql = "INSERT INTO monteseu(email, nome, produto, imagem, pao, burger, ponto, queijo, alface, bacon, tomate, cebola, picles, pimenta, preco) VALUES('{$dados["email"]}','{$dados["nome"]}','{$dados["produto"]}','{$dados["imagem"]}','{$dados["pao"]}','{$dados["burger"]}','{$dados["ponto"]}','{$dados["queijo"]}','{$dados["alface"]}','{$dados["bacon"]}','{$dados["tomate"]}','{$dados["cebola"]}','{$dados["picles"]}','{$dados["pimenta"]}','{$dados["preco"]}');";
                $resp = $conn->Executar($sql);
                return $resp;
            }
    }


    public function pegaRegCarrinho($email){
        require_once("Conexao.php");
        $conn = new Conexao();
        $sql = "SELECT* FROM carrinho WHERE email = '{$email}';";
        $query = $conn->Executar($sql);
        if($query == true){
            $total = 0;
        while($dados = mysqli_fetch_array($query)){  
                $total = $total + $dados['preco'];
            ?>
                <div class="produto">
                    <img width="200px" src="img/<?php echo $dados['imagem'];?>" alt="#">
                    <div class="desc-produto">
                        <h2 class="rubik"><?php echo $dados['nome']; ?></h2>
                        <p><?php echo $dados['legenda'];?></p>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <form action="carrinho.php">
                            <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
                            <input type="submit" style="margin-top:15px" name="remover_item" value="remover">
                        </form>
                    </div>
                    <p class="preco-carrinho">R$<?php echo $dados['preco'];?>,00</p>
                </div>
                <div id="frete">
                </div>
            <?php
                }
            }else{
                
            }

        }


        public function pegaRegMonteSeu($email){
            require_once("Conexao.php");
            $conn = new Conexao();
            $sql = "SELECT* FROM monteseu WHERE email = '{$email}';";
            $query = $conn->Executar($sql);
            if($query == true){
                $total = 0;
            while($dados = mysqli_fetch_array($query)){  
                    $total = $total + $dados['preco'];
                ?>
                    <div class="produto">
                    <img width="200px" src="img/<?php echo $dados['imagem'];?>" alt="#">
                    <div class="desc-produto">
                        <h2 class="rubik"><?php echo $dados['nome']; ?></h2>
                        <p><?php echo "Pão: " .  $dados['pao'] . "<br>";
                                 echo "Carne: " .  $dados['burger'] . "<br>";
                                 echo "Ponto: " .  $dados['ponto'] . "<br>";
                                 echo "Queijo: " .  $dados['queijo'] . "<br>";
                                 echo "Alface: " .  $dados['alface'] . "<br>";
                                 echo "Bacon: " .  $dados['bacon'] . "<br>";
                                 echo "Tomate: " .  $dados['tomate'] . "<br>";
                                 echo "Cebola: " .  $dados['cebola'] . "<br>";
                                 echo "Picles: " .  $dados['picles'] . "<br>";
                                 echo "Pimenta: " .  $dados['pimenta'] . "<br>";
                                ?></p>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <form action="carrinho.php">
                            <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
                            <input type="submit" style="margin-top:15px" name="remover_item_monteseu" value="remover">
                        </form>
                    </div>
                    <p class="preco-carrinho">R$<?php echo $dados['preco'];?>,00</p>
                </div>
                <div id="frete">
                </div>
                <?php
                    }
                }else{
                    
                }
            }
    


        public function pegaTotalCarrinho($campo, $tabela, $email){
            require_once('Conexao.php');
            $conexao = new Conexao;
            $sql = "SELECT SUM($campo) FROM $tabela WHERE email = '$email';";
            $total = $conexao->Executar($sql);
            $result = mysqli_fetch_array($total);
            return $result;
        }


        public function ItemCarrinhoDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM carrinho WHERE id = {$id} ;";
            $result = $conn->Executar($sql); 
            if($result == true){
                return 1;
            }else{
                return 0;
            }
        }


        public function ItemMonteSeuDelete($id){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM monteseu WHERE id = {$id} ;";
            $result = $conn->Executar($sql); 
            if($result == true){
                return 1;
            }else{
                return 0;
            }
        }


        //FUNÇÃO PARA FINALIZAR COMPRA
        public function CompraFinal($email){
            require_once('Conexao.php');
            $conn = new Conexao();
            $sql = "DELETE FROM carrinho WHERE email = '{$email}';";
            $sql2 = "DELETE FROM monteseu WHERE email = '{$email}';";
            $result = $conn->Executar($sql);
            $result2 = $conn->Executar($sql2); 
            if($result == true){
                return 1;
            }else{
                return 0;
            }

        }
}

?>


