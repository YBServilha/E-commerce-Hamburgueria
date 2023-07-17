<?php 
session_start();
if(isset($_SESSION['USER-ID'])){
  
}else{
    ?>
        <form action="login.php" method="POST" id="Form" name="myForm">
            <input type="hidden" name="msg" value="MI01">
        </form>
        <script>document.getElementById("Form").submit();</script>
    <?php
} 

if(isset($_REQUEST['remover_item'])){
    require_once('../model/Manager.php');
    $manager = new Manager();
    $manager->ItemCarrinhoDelete($_REQUEST['id']);
}if(isset($_REQUEST['remover_item_monteseu'])){
  require_once('../model/Manager.php');
  $manager = new Manager();
  $manager->ItemMonteSeuDelete($_REQUEST['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Burger Friends - Seu Carrinho</title>
    <link rel="stylesheet" href="css/carrinho1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;800&family=Rubik+Dirt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
       p{
        color:white;
      }

      select{
        width: 100px;
      }
    </style>
</head>
<body>
  <!-- Cabeçalho/Menu-->
  <nav id="navbar"class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand col-5" href="../index.php"><img width="130px" src="img/logo1.png" alt="Logo" id="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <?php 
            require_once("../model/Manager.php");
            $manager = new Manager();
            $dados = $manager->pegaMenusSubmenus("v");

            $keyMenu = array();
            $keySub = array();

            /*
            echo "<pre>";
            var_dump($dados);
            echo "</pre>";
            exit();
            */
            if(isset($dados['num'])){
              if($dados['num'] > 0){
                for($i = 0;$i < $dados['num'];$i++){ //menu
                    if(isset($dados[$i]['menuId'])){
                      //$reMenu = array_search($dados[$i]['menuNome'],$keyMenu,true);
                      $reMenu = in_array($dados[$i]['menuNome'],$keyMenu);
                      if($reMenu == 0){
                        echo "<li class='nav-item dropdown'>";
                        echo "<a class='nav-link dropdown-toggle text-light' href='" . $dados[$i]["menuURL"] . "' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $dados[$i]["menuNome"] . "</a>";
                        $keyMenu[$i] = $dados[$i]['menuNome'];
                        $drop = 0;
                        for($ii = 0;$ii <= $dados['num'];$ii++){ 
                          if(isset($dados[$ii]['subId'])){
                            //$reSub = array_search($dados[$ii]['subURL'],$keySub,true);
                            $reSub = in_array($dados[$ii]['subURL'],$keySub);
                            if($dados[$i]['menuId'] == $dados[$ii]['subId'] && $reSub == ""){
                                if($drop == 0){
                                  echo "<div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
                                  $drop = 1;
                                }
                                echo "<a class='dropdown-item' href='" . $dados[$ii]['subURL'] . "'>" . $dados[$ii]['subNome'] . "</a>";
                                $keySub[$i] = $dados[$ii]['subNome'];
                            }
                          }
                          
                        }
                        if($drop == 1){
                          echo "</div>";
                        }
                        echo "</li>";
                      }
                    }
                }
              }
            }else{

            }
          
            

          ?>
          <li class="nav-item">
            <a class="nav-link text-light" href="../index.php#quem-somos">Sobre <span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="../index.php#localizacao">Localização</a>
          </li>

        </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="login" href="login.php">LogIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-5 mt-1" id="signin" href="cadastro-teste.php">SignIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrinho.php"><ion-icon name="cart-outline" id="icon-carrinho" class="text-light"></ion-icon><span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="Logout" href="logout.php">Logout<span class="sr-only">(Página atual)</span></a>
            </li>

          </ul>
        </div>
    </nav>
    <!-- FIM Cabeçalho/Menu-->

    <!-- Carrinho de compras1 -->
    <h1>Meu carrinho</h1>
    <section class="carrinho">
        <div class="informacoes-produto">
            

    <?PHP 
      require_once("../model/Manager.php");
      $manager = new Manager();
      $manager->pegaRegCarrinho($_SESSION['USER-EMAIL']);
      $manager->pegaRegMonteSeu($_SESSION['USER-EMAIL']);
    ?>
        </div>
<div class="resumo-pedido">
            <h2>Resumo do pedido</h2>

            <div class="sub-total">
                <div id="sub-total">
                    <p>Subtotal</p>
                    <p><?php $total = $manager->pegaTotalCarrinho('preco','carrinho',$_SESSION['USER-EMAIL']);
                    $total2 = $manager->pegaTotalCarrinho('preco','monteseu',$_SESSION['USER-EMAIL']);
                        echo "R$" . ($total[0] + $total2[0]) . ",00";
                    ?></p>
                </div>
                <div id="frete">
                    <p>Frete</p>
                    <p>Grátis</p>
                </div>
            </div>
            <div class="total">
                <div id="total">
                    <p>Total</p>
                    <p><?php $total = $manager->pegaTotalCarrinho('preco','carrinho',$_SESSION['USER-EMAIL']);
                    $total2 = $manager->pegaTotalCarrinho('preco','monteseu',$_SESSION['USER-EMAIL']);
                        echo "R$" . ($total[0] + $total2[0]) . ",00";
                    ?></p>
                </div>
                <button onclick="MaisPedido();" type="button" class="btn btn-outline-warning btn-lg btn-block">Adicionar outro produto</button>
                <button onclick="FinalizarCompra();" type="button" class="btn btn-outline-success btn-lg btn-block">Comprar</button>
            </div>
    </section>

    <script>
        function MaisPedido(){
            location.href="cardapio.php";
        }

        function FinalizarCompra(){
            swal("Compra aprovada!", "Pedido realizado com sucesso!", "success");
        }
    </script>





<!--
    <section class="carrinho">
        <div class="informacoes-produto">
            <div class="produto">
                <img src="https://conteudo.imguol.com.br/c/entretenimento/7c/2022/03/14/volkswagen-fusca-1965-1647298960975_v2_4x3.jpg" alt="#">
                <div class="desc-produto">
                    <h2 class="rubik">Fusca raridade</h2>
                    <p>Peças: Volante, Banco, motor, câmbio.</p>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <p class="preco-carrinho">Preço R$119,90</p>
            </div>
            <div class="produto">
                <img src="https://conteudo.imguol.com.br/c/entretenimento/7c/2022/03/14/volkswagen-fusca-1965-1647298960975_v2_4x3.jpg" alt="#">
                <div class="desc-produto">
                    <h2 class="rubik">Fusca raridade</h2>
                    <p>Peças: Volante, Banco, motor, câmbio.</p>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <p class="preco-carrinho">Preço R$119,90</p>
            </div>
            <div class="produto">
                <img src="https://conteudo.imguol.com.br/c/entretenimento/7c/2022/03/14/volkswagen-fusca-1965-1647298960975_v2_4x3.jpg" alt="#">
                <div class="desc-produto">
                    <h2 class="rubik">Fusca raridade</h2>
                    <p>Peças: Volante, Banco, motor, câmbio.</p>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <p class="preco-carrinho">Preço R$119,90</p>
            </div>
        </div>
        <div class="resumo-pedido">
            <h2>Resumo do pedido</h2>

            <div class="sub-total">
                <div id="sub-total">
                    <p>Subtotal</p>
                    <p>R$ 35,00</p>
                </div>
                <div id="frete">
                    <p>Frete</p>
                    <p>Grátis</p>
                </div>
            </div>
            <div class="total">
                <div id="total">
                    <p>Total</p>
                    <p>R$ 35,00</p>
                </div>
                <button type="button" class="btn btn-outline-warning btn-lg btn-block">Adicionar outro produto</button>
                <button type="button" class="btn btn-outline-success btn-lg btn-block">Comprar</button>
            </div>
        </div>
    </section>
-->




    <!-- FIM Carrinho de compras1 -->



            <!-- Footer -->
  <footer class="bg-dark">
    <div class="logo-rodape"><img src="img/logo1.png" alt="Logo"></div>
    <p class="text-light">Burger Friends - Todos os direitos reservados &copy2022</p>
    <div class="redes-sociais">
    <h2>Siga em nossas redes sociais:<a href="https://www.facebook.com/profile.php?id=100088285543880" target="_blank"><ion-icon name="logo-facebook" class="first-icon-footer"></a><a href="https://www.instagram.com/_burger_friends/" target="_blank"></ion-icon><ion-icon name="logo-instagram"></ion-icon></a></h2>
    </div>
  </footer>
<!-- FIM Footer -->
       



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php
    //ALERTA DE MENSAGEM
    if(isset($_POST['msg'])){
        require_once('msg.php');
        $value = $_POST['msg'];
        ?>
        <script>alert("<?php echo $msg[$value]; ?>");</script>
        <?php
    }else{
    }
?>
    
</body>
</html>